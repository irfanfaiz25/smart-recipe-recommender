<?php

namespace App\Livewire;

use App\Models\Ingredient;
use Livewire\Component;
use Livewire\WithFileUploads;
use OpenAI;

class SavoryIngredients extends Component
{
    use WithFileUploads;

    public $ingredients;
    public $selectedIngredients = [];
    public $search = '';
    public $image;
    public $testIngredients = [];
    public $isImageRecognitionOpen = false;


    public function mount()
    {
        $this->ingredients = Ingredient::select(['id', 'name', 'image', 'category'])
            ->get();
    }

    public function recognizeImage()
    {
        $this->validate([
            'image' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);

        $path = $this->image->getRealPath();

        $ingredients = $this->detectIngredients($path);
        $this->dispatch('detected-ingredient', $ingredients);
        $this->reset('image');
        $this->isImageRecognitionOpen = false;
    }

    public function detectIngredients($imagePath)
    {
        $client = OpenAI::client(config('services.openai.key'));

        // read the image as base64
        $imageData = base64_encode(file_get_contents($imagePath));

        // Get all ingredient names from database for matching
        $availableIngredients = Ingredient::select('id', 'name', 'image')->get()
            ->map(fn($ingredient) => $ingredient->name)
            ->toArray();

        $prompt = "Analyze this image and list only the food ingredients that match these available options: " . implode(', ', $availableIngredients) . '. Return only the ingredient names separated by commas, nothing else.';

        // Build the request payload
        $payload = [
            'model' => 'gpt-4o',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => $prompt
                        ],
                        [
                            'type' => 'image_url',
                            'image_url' => [
                                'url' => "data:image/jpeg;base64,{$imageData}"
                            ]
                        ]
                    ]
                ]
            ],
            'max_tokens' => 300,
        ];

        // Send the request to OpenAI
        try {
            $response = $client->chat()->create($payload);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        $detectedIngredients = explode(', ', $response['choices'][0]['message']['content']);

        $matchedIngredients = Ingredient::select('id', 'name', 'image')
            ->whereIn('name', $detectedIngredients)
            ->get()
            ->map(function ($ingredient) {
                return [
                    'id' => $ingredient->id,
                    'name' => $ingredient->name,
                    'image' => $ingredient->image
                ];
            })->toArray();

        $this->selectedIngredients = array_merge($this->selectedIngredients, $matchedIngredients);

        return $matchedIngredients;
    }

    public function removeIngredient($id)
    {
        $this->selectedIngredients = collect($this->selectedIngredients)
            ->reject(fn($ingredient) => $ingredient['id'] === $id)
            ->values()
            ->toArray();

        $this->ingredients = Ingredient::select(['id', 'name', 'image'])
            ->whereNotIn('id', collect($this->selectedIngredients)->pluck('id'))
            ->get();

        $this->dispatch('remove-selected-ingredient', $id);
    }

    public function selectIngredient($value)
    {
        $ingredient = json_decode($value, true);
        $this->selectedIngredients[] = $ingredient;

        $this->ingredients = Ingredient::select(['id', 'name', 'image'])
            ->whereNotIn('id', collect($this->selectedIngredients)->pluck('id'))
            ->get();

        $this->reset('search');
        $this->dispatch('selected-ingredient', $ingredient);
    }

    public function resetIngredients()
    {
        $this->selectedIngredients = [];
        $this->dispatch('reset-ingredients');
    }

    public function render()
    {
        $searchTerm = '%' . $this->search . '%';

        $this->ingredients = Ingredient::select(['id', 'name', 'image', 'category'])
            ->whereNotIn('id', collect($this->selectedIngredients)->pluck('id'))
            ->where('name', 'like', $searchTerm)
            ->orderBy('category')
            ->get()
            ->groupBy('category')
            ->toBase();

        return view('livewire.user.savoryai.savory-ingredients');
    }
}
