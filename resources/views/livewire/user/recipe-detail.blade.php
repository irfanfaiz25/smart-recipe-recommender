<div x-show="pageLoaded" x-transition:enter="transform transition-all duration-700 ease-out"
    x-transition:enter-start="opacity-0 -translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
    class="w-full">
    <div class="mt-3 w-full bg-white rounded-lg shadow-lg h-fit">
        @if ($recipe->image)
            <div class="relative w-full h-[30rem] rounded-t-lg ">
                <img class="w-full h-[30rem] rounded-t-lg object-cover" src="{{ asset($recipe->image) }}">
                <a href="{{ route('savoryai.index') }}" wire:navigate
                    class="px-6 py-3 absolute top-3 left-3 bg-black/40 hover:bg-black/60 text-text-dark-primary text-base font-semibold rounded-lg shadow-lg">
                    <i class="fa-solid fa-chevron-left pe-1 text-sm"></i>
                    Kembali
                </a>
            </div>
        @else
            <div class="w-full h-[30rem] rounded-t-lg bg-gray-200"></div>
        @endif
        <div class="py-8 px-14">
            <h3 class="text-lg font-medium text-text-primary text-center uppercase">
                recipe by tomingse
            </h3>
            <h1 class="mt-2 text-6xl font-bold font-display text-center">
                {{ $recipe->name }}
            </h1>
            <div class="mt-8 flex space-x-1 justify-center items-center text-secondary text-2xl">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-regular fa-star"></i>
            </div>
            <div class="mt-8 flex items-center justify-center">
                <div class="w-1/3 h-24 grid grid-cols-3">
                    <div class="border-t border-b border-gray-200 flex justify-center items-center space-x-2 text-lg">
                        <div class="text-center">
                            <i class="fa-solid fa-sliders text-yellow-500"></i>
                            <p class="font-medium capitalize">{{ $recipe->difficulty }}</p>
                        </div>
                    </div>
                    <div class="border border-gray-200 flex justify-center items-center space-x-2 text-lg">
                        <div class="text-center">
                            <i class="fa-regular fa-clock text-primary"></i>
                            <p class="font-medium">{{ $recipe->cooking_time }} min</p>
                        </div>
                    </div>
                    <div class="border-t border-b border-gray-200 flex justify-center items-center space-x-2 text-lg">
                        <div class="text-center">
                            <i class="fa-solid fa-bowl-food text-secondary"></i>
                            <p class="font-medium">{{ $recipe->servings }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex justify-center items-center">
                <p class="w-1/2 text-base text-center font-medium text-text-primary italic">
                    {{ $recipe->description }}
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, ducimus. Molestias inventore et
                    corporis
                    sit eligendi laudantium magni quam consectetur odio ad delectus ipsam, qui illo, iusto quod, vitae
                    labore!
                </p>
            </div>
            <div class="mt-10 flex justify-center items-center space-x-3">
                <button
                    class="px-6 py-3 bg-secondary hover:bg-secondary-hover text-text-dark-primary text-base font-semibold rounded-full shadow-lg">
                    <i class="fa-regular fa-heart pe-1 text-base"></i>
                    Simpan Resep
                </button>
                <button
                    class="px-6 py-3 bg-primary hover:bg-primary-hover text-text-dark-primary text-base font-semibold rounded-full shadow-lg">
                    <i class="fa-solid fa-utensils pe-1 text-base"></i>
                    Tambah Ke Riwayat Masak
                </button>
            </div>
            <div class="mt-12 flex space-x-4">
                <div class="w-[40%]">
                    <h2 class="text-2xl font-display font-medium text-text-primary">
                        Bahan Masakan
                    </h2>
                    <ul class="mt-3 w-[80%] text-lg text-text-primary space-y-3 font-normal">
                        @foreach ($recipe->ingredients as $ingredient)
                            <li class="pb-2 border-b border-gray-200"><i class="fa-solid fa-check pe-2"></i>2
                                {{ $ingredient->amount . ' ' . $ingredient->unit . ' ' . $ingredient->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="w-[60%]">
                    <h2 class="text-2xl font-display font-medium text-text-primary">
                        Langkah Pembuatan
                    </h2>
                    <ul class="mt-3 text-lg text-text-primary space-y-4 font-normal">
                        @foreach ($recipe->steps as $step)
                            <li class="pb-3 flex space-x-2 border-b border-gray-200">
                                <p class="text-base font-normal pt-1 flex items-start">
                                    <span class="text-5xl font-display font pe-3">{{ $step->step_number }}</span>
                                    <span class="pt-1">
                                        {{ $step->description }}
                                    </span>
                                </p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
