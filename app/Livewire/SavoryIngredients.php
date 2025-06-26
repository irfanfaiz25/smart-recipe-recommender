<?php

namespace App\Livewire;

use App\Models\Ingredient;
use Livewire\Component;
use Livewire\WithFileUploads;
use Masmerise\Toaster\Toaster;
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
        try {
            // Set execution time limit for this operation
            set_time_limit(120);

            // Validate image file exists and is readable
            if (!file_exists($imagePath)) {
                Toaster::error('File gambar tidak ditemukan. Silakan coba lagi.');
                return [];
            }

            if (!is_readable($imagePath)) {
                Toaster::error('File gambar tidak dapat dibaca. Periksa izin file.');
                return [];
            }

            // Validate file size (max 20MB for OpenAI)
            $fileSize = filesize($imagePath);
            if ($fileSize > 20 * 1024 * 1024) {
                Toaster::error('Ukuran file terlalu besar. Maksimal 20MB.');
                return [];
            }

            if ($fileSize === 0) {
                Toaster::error('File gambar kosong atau rusak.');
                return [];
            }

            // Validate image type
            $imageInfo = getimagesize($imagePath);
            if ($imageInfo === false) {
                Toaster::error('File bukan gambar yang valid.');
                return [];
            }

            $allowedTypes = [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF, IMAGETYPE_WEBP];
            if (!in_array($imageInfo[2], $allowedTypes)) {
                Toaster::error('Format gambar tidak didukung. Gunakan JPEG, PNG, GIF, atau WebP.');
                return [];
            }

            // Initialize OpenAI client (correct syntax)
            $client = OpenAI::client(config('services.openai.key'));

            // Read the image as base64
            $imageData = base64_encode(file_get_contents($imagePath));
            if ($imageData === false) {
                Toaster::error('Gagal membaca file gambar.');
                return [];
            }

            // Get all ingredient names from database for matching
            $availableIngredients = Ingredient::select('id', 'name', 'image')->get()
                ->map(fn($ingredient) => $ingredient->name)
                ->toArray();

            if (empty($availableIngredients)) {
                Toaster::error('Tidak ada data bahan tersedia di database.');
                return [];
            }

            $prompt = "Analyze this image and list only the food ingredients that match these available options: " . implode(', ', $availableIngredients) . '. Return only the ingredient names separated by commas, nothing else. If no ingredients are visible or recognizable, return "NONE".';

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
                ]
            ];

            // Send the request to OpenAI with comprehensive error handling
            try {
                $response = $client->chat()->create($payload);
            } catch (\OpenAI\Exceptions\ErrorException $e) {
                // Handle OpenAI API specific errors
                $errorMessage = $e->getMessage();
                if (str_contains($errorMessage, 'timeout')) {
                    Toaster::error('Permintaan timeout. Silakan coba lagi dengan gambar yang lebih kecil.');
                } elseif (str_contains($errorMessage, 'rate_limit')) {
                    Toaster::error('Terlalu banyak permintaan. Silakan tunggu beberapa saat.');
                } elseif (str_contains($errorMessage, 'invalid_request')) {
                    Toaster::error('Format gambar tidak valid untuk analisis AI.');
                } elseif (str_contains($errorMessage, 'insufficient_quota')) {
                    Toaster::error('Kuota API habis. Silakan hubungi administrator.');
                } else {
                    Toaster::error('Terjadi kesalahan pada layanan AI: ' . $errorMessage);
                }
                return [];
            } catch (\GuzzleHttp\Exception\ConnectException $e) {
                // Handle connection timeout
                Toaster::error('Koneksi timeout. Periksa koneksi internet Anda.');
                return [];
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                // Handle HTTP request errors
                if ($e->hasResponse()) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    if ($statusCode === 429) {
                        Toaster::error('Terlalu banyak permintaan. Silakan tunggu beberapa saat.');
                    } elseif ($statusCode >= 500) {
                        Toaster::error('Server sedang bermasalah. Silakan coba lagi nanti.');
                    } else {
                        Toaster::error('Terjadi kesalahan jaringan. Silakan coba lagi.');
                    }
                } else {
                    Toaster::error('Tidak dapat terhubung ke layanan AI. Periksa koneksi internet.');
                }
                return [];
            } catch (\Exception $e) {
                // Handle any other unexpected errors
                Toaster::error('Terjadi kesalahan tidak terduga: ' . $e->getMessage());
                return [];
            }

            // Validate API response structure
            if (!isset($response['choices']) || empty($response['choices'])) {
                Toaster::error('Respons API tidak valid. Silakan coba lagi.');
                return [];
            }

            if (!isset($response['choices'][0]['message']['content'])) {
                Toaster::error('Konten respons tidak ditemukan. Silakan coba lagi.');
                return [];
            }

            $content = trim($response['choices'][0]['message']['content']);

            // Handle empty or "NONE" response
            if (empty($content) || strtoupper($content) === 'NONE') {
                Toaster::warning('Tidak ada bahan makanan yang terdeteksi dalam gambar. Pastikan gambar menampilkan bahan makanan dengan jelas.');
                return [];
            }

            // Parse detected ingredients
            $detectedIngredients = array_map('trim', explode(',', $content));
            $detectedIngredients = array_filter($detectedIngredients, function ($ingredient) {
                return !empty($ingredient) && strtoupper($ingredient) !== 'NONE';
            });

            // Handle when no valid ingredients are detected after parsing
            if (empty($detectedIngredients)) {
                Toaster::warning('Tidak ada bahan yang valid terdeteksi dalam gambar. Silakan coba dengan gambar yang lebih jelas.');
                return [];
            }

            // Validate the detected ingredients against available ingredients
            $validDetectedIngredients = array_filter($detectedIngredients, function ($ingredient) use ($availableIngredients) {
                return in_array($ingredient, $availableIngredients);
            });

            if (empty($validDetectedIngredients)) {
                Toaster::warning('Bahan yang terdeteksi tidak tersedia dalam database kami. Bahan terdeteksi: ' . implode(', ', $detectedIngredients));
                return [];
            }

            // Match detected ingredients with available ingredients
            $matchedIngredients = Ingredient::select('id', 'name', 'image')
                ->whereIn('name', $validDetectedIngredients)
                ->get()
                ->map(function ($ingredient) {
                    return [
                        'id' => $ingredient->id,
                        'name' => $ingredient->name,
                        'image' => $ingredient->image
                    ];
                })->toArray();

            if (empty($matchedIngredients)) {
                Toaster::error('Gagal mencocokkan bahan dengan database.');
                return [];
            }

            // Merge with existing selected ingredients (avoid duplicates)
            $existingIds = array_column($this->selectedIngredients, 'id');
            $newIngredients = array_filter($matchedIngredients, function ($ingredient) use ($existingIds) {
                return !in_array($ingredient['id'], $existingIds);
            });

            if (empty($newIngredients)) {
                Toaster::info('Semua bahan yang terdeteksi sudah dipilih sebelumnya.');
                return $matchedIngredients;
            }

            $this->selectedIngredients = array_merge($this->selectedIngredients, $newIngredients);

            // Success message
            $detectedCount = count($newIngredients);
            Toaster::success("Berhasil mendeteksi {$detectedCount} bahan: " . implode(', ', array_column($newIngredients, 'name')));

            return $matchedIngredients;

        } catch (\Throwable $e) {
            // Catch any remaining errors
            Toaster::error('Terjadi kesalahan sistem: ' . $e->getMessage());
            return [];
        }
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
