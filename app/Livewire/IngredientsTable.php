<?php

namespace App\Livewire;

use App\Models\Ingredient;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class IngredientsTable extends Component
{
    use WithPagination, WithFileUploads;


    public $search = '';
    public $selectedFilter = '';

    public $showModal = false;
    public $isEditMode = false;
    public $ingredientId = null;
    public $isAddCategory = false;

    public $newImage = null;
    public $existingImagePath = null;
    public $name = '';
    public $description = '';
    public $category = '';

    public $showDeleteConfirmationModal = false;
    public $deleteId = null;


    public function mount()
    {
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedSelectedFilter($value)
    {
        $this->selectedFilter = $value;
    }

    public function handleOpenModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->isEditMode = false;
        $this->ingredientId = null;
        $this->reset(['name', 'description', 'category', 'newImage', 'existingImagePath']);
        $this->isAddCategory = false;

        $this->showModal = false;
    }

    public function openConfirmationModal($ingredientId)
    {
        $this->deleteId = $ingredientId;
        $this->showDeleteConfirmationModal = true;
    }

    public function closeConfirmationModal()
    {
        $this->deleteId = null;
        $this->showDeleteConfirmationModal = false;
    }

    public function editIngredient($ingredientId)
    {
        $this->isEditMode = true;
        $this->ingredientId = $ingredientId;

        $ingredient = Ingredient::find($ingredientId);

        $this->name = $ingredient->name;
        $this->description = $ingredient->description;
        $this->category = $ingredient->category;
        $this->existingImagePath = $ingredient->image;

        $this->handleOpenModal();
    }

    public function updatedCategory($value)
    {
        if ($value === 'addNewCategory') {
            $this->isAddCategory = true;
            $this->category = '';
        }
    }

    public function handleSaveIngredient()
    {
        $ingredient = Ingredient::find($this->ingredientId);

        $validated = $this->validate([
            'name' => 'required|max:100|string|unique:ingredients,name,' . $this->ingredientId,
            'description' => 'nullable|string|max:255',
            'category' => 'required',
            'newImage' => 'nullable|mimes:jpg,jpeg,png|max:2048'
        ], [
            'newImage.mimes' => 'The image must be a file of type: jpg, jpeg, png.',
            'newImage.max' => 'The image may not be greater than 2MB.',
        ]);

        $imagePath = $this->isEditMode ? $this->existingImagePath : null;

        if ($this->newImage) {
            try {
                // Upload ke Cloudinary
                $uploadApi = new \Cloudinary\Api\Upload\UploadApi();
                $uploadResult = $uploadApi->upload($this->newImage->getRealPath(), [
                    'folder' => 'ingredients',
                    'public_id' => 'ingredient_' . ($this->isEditMode ? $this->ingredientId : 'temp'),
                    'transformation' => [
                        'quality' => 'auto:good',
                        'format' => 'auto',
                        'width' => 600,
                        'height' => 400,
                        'crop' => 'fill'
                    ]
                ]);

                $imagePath = $uploadResult['secure_url'];
            } catch (\Exception $e) {
                // Fallback ke penyimpanan lokal jika Cloudinary gagal
                if (
                    $this->isEditMode && $ingredient->image && !str_contains($ingredient->image, 'cloudinary.com') &&
                    Storage::disk('public')->exists(str_replace('storage/', '', $ingredient->image))
                ) {
                    Storage::disk('public')->delete(str_replace('storage/', '', $ingredient->image));
                }
                $imagePath = 'storage/' . $this->newImage->store('img/ingredients', 'public');
            }
        }

        if ($this->isEditMode) {
            $ingredient->update([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'category' => $validated['category'],
                'image' => $imagePath ?? null,
            ]);

            // Update public_id jika menggunakan temporary ID
            if ($this->newImage && str_contains($imagePath, 'cloudinary.com') && str_contains($imagePath, 'ingredient_temp')) {
                try {
                    $uploadApi = new \Cloudinary\Api\Upload\UploadApi();
                    $uploadApi->rename(
                        'ingredients/ingredient_temp',
                        'ingredients/ingredient_' . $ingredient->id
                    );
                } catch (\Exception $e) {
                    // Lanjutkan meskipun rename gagal
                }
            }
        } else {
            $newIngredient = Ingredient::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'category' => $validated['category'],
                'image' => $imagePath ?? null,
            ]);

            // Update public_id jika menggunakan temporary ID
            if ($this->newImage && str_contains($imagePath, 'cloudinary.com') && str_contains($imagePath, 'ingredient_temp')) {
                try {
                    $uploadApi = new \Cloudinary\Api\Upload\UploadApi();
                    $uploadApi->rename(
                        'ingredients/ingredient_temp',
                        'ingredients/ingredient_' . $newIngredient->id
                    );

                    // Update URL dengan ID yang benar
                    $newUrl = str_replace('ingredient_temp', 'ingredient_' . $newIngredient->id, $imagePath);
                    $newIngredient->update(['image' => $newUrl]);
                } catch (\Exception $e) {
                    // Lanjutkan meskipun rename gagal
                }
            }
        }

        $this->closeModal();
        Toaster::success('Ingredient berhasil ditambahkan.');
    }

    public function handleDelete()
    {
        $ingredient = Ingredient::find($this->deleteId);

        if ($ingredient->image && Storage::disk('public')->exists(str_replace('storage/', '', $ingredient->image))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $ingredient->image));
        }

        $ingredient->delete();
        $this->closeConfirmationModal();
        Toaster::success('Ingredient berhasil dihapus.');
    }

    public function render()
    {
        $ingredients = Ingredient::when($this->selectedFilter, function ($query) {
            $query->where('category', $this->selectedFilter);
        })->when($this->search, function ($query) {
            $query->where('name', 'like', "%$this->search%");
        })->latest()->paginate(5);
        $categories = Ingredient::groupBy('category')->pluck('category');

        return view('livewire.admin.ingredients-table', [
            'ingredients' => $ingredients,
            'filterOptions' => $categories
        ]);
    }
}
