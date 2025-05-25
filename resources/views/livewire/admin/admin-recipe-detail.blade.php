<div x-show="pageLoaded" x-transition:enter="transform transition-all duration-700 ease-out"
    x-transition:enter-start="opacity-0 -translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
    class="w-full">
    <div class="mt-3 w-full bg-white rounded-lg shadow-lg h-fit">
        <div class="relative w-full rounded-t-lg">
            @if ($recipe->image)
                <img class="w-full h-[30rem] rounded-t-lg object-cover" src="{{ asset($recipe->image) }}">
            @else
                <div class="w-full h-[30rem] rounded-t-lg bg-gray-200 flex justify-center items-center">
                    <div class="flex flex-col items-center space-y-3">
                        <i class="fa-solid fa-utensils text-4xl text-gray-500"></i>
                        <p class="font-normal italic text-gray-500">
                            {{ $recipe->title }}
                        </p>
                    </div>
                </div>
            @endif
            <a href="{{ route('admin-moderation.index') }}" wire:navigate
                class="px-6 py-3 absolute top-3 left-3 bg-black/40 hover:bg-black/60 text-white text-base font-semibold rounded-lg shadow-lg">
                <i class="fa-solid fa-chevron-left pe-1 text-sm"></i>
                Kembali ke Moderasi
            </a>
        </div>
        <div class="py-8 px-32">
            {{-- head details --}}
            <h3 class="text-lg font-medium text-gray-600 text-center uppercase">
                recipe by {{ $recipe->user->name }}
            </h3>
            <h1 class="mt-2 text-6xl font-bold font-display text-center">
                {{ $recipe->name }}
            </h1>
            <div class="mt-8 flex items-center justify-center">
                <div class="w-[60%] h-28 grid grid-cols-4">
                    <div class="border-t border-b border-gray-200 flex justify-center items-center space-x-2 text-lg">
                        <div class="text-center">
                            <i class="fa-solid fa-sliders text-yellow-500"></i>
                            <p class="font-medium capitalize">{{ $recipe->difficulty }}</p>
                        </div>
                    </div>
                    <div class="border border-gray-200 flex justify-center items-center space-x-2 text-lg">
                        <div class="text-center">
                            <i class="fa-regular fa-clock text-blue-500"></i>
                            <p class="font-medium">{{ $recipe->cooking_time }} min</p>
                        </div>
                    </div>
                    <div class="border border-gray-200 flex justify-center items-center text-lg">
                        <div class="text-center py-2">
                            <i class="fa-solid fa-fire-flame-curved text-orange-500 text-xl mb-2"></i>
                            @if ($recipe->calories)
                                <div class="flex">
                                    <div class="px-1.5 flex flex-col border-r border-gray-200">
                                        <span class="font-bold text-lg text-primary">{{ $recipe->calories }}</span>
                                        <span class="text-xs text-gray-600 font-medium">Total Kkal</span>
                                    </div>
                                    <div class="px-1.5 flex flex-col">
                                        <span
                                            class="font-bold text-lg text-primary">{{ floor($recipe->calories / $recipe->servings) }}</span>
                                        <span class="text-xs text-gray-600 font-medium">Kkal/Porsi</span>
                                    </div>
                                </div>
                            @else
                                <span class="text-sm text-gray-400 font-medium">Tidak ada info kalori</span>
                            @endif
                        </div>
                    </div>
                    <div class="border-t border-b border-gray-200 flex justify-center items-center space-x-2 text-lg">
                        <div class="text-center">
                            <i class="fa-solid fa-bowl-food text-orange-500"></i>
                            <p class="font-medium">{{ $recipe->servings }} porsi</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex justify-center items-center">
                <p class="w-1/2 text-base text-center font-medium text-gray-700 italic">
                    {{ $recipe->description ?? 'Resep lezat yang siap untuk dimoderasi dan dinikmati oleh semua pengguna.' }}
                </p>
            </div>
            {{-- end head details --}}

            {{-- moderation status --}}
            <div class="mt-10 flex justify-center items-center">
                <div class="bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200 rounded-2xl p-6 w-1/2">
                    <div class="text-center">
                        <div
                            class="inline-flex items-center px-6 py-3 text-white rounded-full text-base font-semibold shadow-lg mb-4
                            @if ($recipe->moderation->status === 'approved') bg-gradient-to-r from-green-700 to-green-500
                            @elseif($recipe->moderation->status === 'rejected') 
                                bg-gradient-to-r from-red-500 to-orange-600
                            @else
                                bg-gradient-to-r from-amber-400 to-orange-400 @endif
                            ">
                            <i class="fa-solid fa-clock mr-2"></i>
                            Status: {{ ucfirst($recipe->moderation->status) }}
                        </div>
                        <p class="text-gray-600 text-base font-medium">
                            Diajukan oleh: <span class="font-semibold text-gray-800">{{ $recipe->user->name }}</span>
                        </p>
                        @if ($recipe->moderation?->notes)
                            <div class="mt-4 bg-white/70 p-4 rounded-xl border border-white/50">
                                <p class="text-sm font-semibold text-gray-600 mb-2">Catatan Moderator:</p>
                                <p class="text-gray-700 text-base leading-relaxed">{{ $recipe->moderation->notes }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            {{-- end moderation status --}}

            {{-- moderation buttons --}}
            {{-- <div class="mt-8 flex justify-center items-center space-x-4">
                <button wire:click="approveRecipe"
                    class="px-8 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white text-base font-semibold rounded-full shadow-lg transition-all duration-300 hover:shadow-xl">
                    <i class="fa-solid fa-check pe-2 text-base"></i>
                    Setujui Resep
                </button>
                <button
                    class="px-8 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white text-base font-semibold rounded-full shadow-lg transition-all duration-300 hover:shadow-xl">
                    <i class="fa-solid fa-times pe-2 text-base"></i>
                    Tolak Resep
                </button>
            </div> --}}
            {{-- end moderation buttons --}}

            {{-- recipe ingredients & steps --}}
            <div class="mt-12 flex space-x-4">
                <div class="w-[40%]">
                    <h2 class="text-2xl font-display font-medium text-gray-800">
                        Bahan Masakan
                    </h2>
                    <ul class="mt-3 w-[80%] text-lg text-gray-700 space-y-3 font-normal">
                        @foreach ($recipe->ingredients as $ingredient)
                            <li class="pb-2 border-b border-gray-200">
                                <i class="fa-solid fa-circle-check pe-2 text-sm text-green-500"></i>
                                {{ $ingredient->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="w-[60%]">
                    <h2 class="text-2xl font-display font-medium text-gray-800">
                        Langkah Pembuatan
                    </h2>
                    <ul class="mt-3 text-lg text-gray-700 space-y-4 font-normal">
                        @foreach ($recipe->steps as $step)
                            <li class="pb-3 flex space-x-2 border-b border-gray-200">
                                <p class="text-base font-normal pt-1 flex items-start">
                                    <span
                                        class="text-5xl font-display font pe-3 text-gray-800">{{ $loop->iteration }}</span>
                                    <span class="pt-1">
                                        {{ $step->description }}
                                    </span>
                                </p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            {{-- end recipe ingredients & steps --}}
        </div>
    </div>
</div>
