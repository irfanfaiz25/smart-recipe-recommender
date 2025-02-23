<div x-show="pageLoaded" x-transition:enter="transform transition-all duration-700 ease-out"
    x-transition:enter-start="opacity-0 translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
    class="w-[65%] rounded-lg p-4 bg-white shadow-lg">
    <h2 class="text-base">
        Bahan Masakan :
    </h2>
    <div class="w-full mt-2 h-[5.5rem] flex space-x-3 overflow-x-auto">
        @for ($i = 0; $i < 3; $i++)
            <div
                class="h-[4.5rem] min-w-56 max-w-56 p-2 bg-primary text-text-dark-primary rounded-lg flex items-center space-x-2 shadow-md relative">
                <div class="min-w-14 h-full flex justify-center items-center bg-gray-100 rounded-md">
                    <i class="fa-regular fa-image text-base text-gray-400"></i>
                </div>
                <h3 class="text-sm font-medium">
                    Bawang Merah Putihhh
                </h3>
                <i
                    class="absolute top-1 right-1 fa fa-solid fa-circle-xmark text-base hover:text-gray-200 cursor-pointer"></i>
            </div>
        @endfor
    </div>
    <div class="mt-2 w-full">
        <h2 class="text-base">
            Rekomendasi Resep :
        </h2>
        {{-- card recipe recommendation --}}
        <div class="mt-2 flex space-y-3">
            <div class="w-full border-2 border-primary rounded-lg">
                {{-- card header --}}
                <div class="h-12 w-full p-3 flex justify-between items-center bg-primary rounded-t-sm">
                    <div class="flex space-x-1 items-center justify-start text-text-dark-primary text-base">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <div class="flex space-x-2 items-center justify-end">
                        <i class="fa-regular fa-bookmark text-xl text-gray-50 hover:text-gray-200 cursor-pointer"></i>
                        <button class="px-4 py-1.5 text-xs bg-gray-50 text-text-primary hover:bg-gray-200 rounded-md">
                            Lihat Detail
                        </button>
                    </div>
                </div>
                {{-- card body --}}
                <div class="h-[205px] w-full flex gap-3 p-3">
                    {{-- image card --}}
                    <div>
                        <div
                            class="h-[180px] w-[180px] flex justify-center items-center bg-gray-300 rounded-md shadow-md">
                            <i class="fa-regular fa-image text-2xl text-gray-400"></i>
                        </div>
                    </div>
                    <div class="flex flex-col justify-between">
                        <div>
                            <h2 class="text-lg font-bold text-primary">
                                Nasi Goreng
                            </h2>
                            <p class="mt-1 text-neutral-700 text-sm font-normal">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis ullam, ut
                                porro
                                quasi maiores labore cum. Possimus at id, ipsum laudantium et perspiciatis
                                doloribus, minima officiis pariatur autem praesentium corrupti?
                            </p>
                            <div class="w-full flex space-x-2">
                                <div class="w-[50%]">
                                    <p class="mt-1 text-neutral-700 text-sm font-semibold">
                                        Bahan Masakan :
                                    </p>
                                    <p class="text-neutral-700 text-sm font-normal">
                                        Bawang Merah, Bawang Putih, Telur, dll.
                                    </p>
                                </div>
                                <div class="w-[50%]">
                                    <p class="mt-1 text-neutral-700 text-sm font-semibold">
                                        Bahan masakan tidak ada :
                                    </p>
                                    <p class="text-neutral-700 text-sm font-normal">
                                        Ayam, Timun
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="flex space-x-4">
                            <div class="flex justify-center items-center space-x-3">
                                <div class="flex items-center space-x-2 text-sm">
                                    <i class="fa-regular fa-clock text-primary"></i>
                                    <span class="font-medium">20 min</span>
                                </div>
                                <div class="flex items-center space-x-2 text-sm capitalize">
                                    <i class="fa-solid fa-sliders text-yellow-500"></i>
                                    <span class="font-medium">Mudah</span>
                                </div>
                                <div class="flex items-center space-x-2 text-sm">
                                    <i class="fa-solid fa-bowl-food text-secondary"></i>
                                    <span class="font-medium">1</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
