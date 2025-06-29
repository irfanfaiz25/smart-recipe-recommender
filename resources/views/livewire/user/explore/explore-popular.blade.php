<div>
    {{-- Popular Recipes Carousel Section --}}
    <div class="relative w-full overflow-hidden mb-8 md:mb-16">
        {{-- Carousel Container --}}
        <div class="carousel-container relative">
            <div class="carousel-track flex transition-transform duration-700 ease-in-out" id="popularCarousel">
                @foreach ($popularRecipes as $index => $recipe)
                    <div class="carousel-slide flex-none w-full sm:w-1/2 lg:w-1/3 px-1 sm:px-2">
                        <div
                            class="h-64 sm:h-72 shadow-md hover:shadow-xl transition-all duration-500 relative group cursor-pointer overflow-hidden rounded-xl">
                            {{-- Recipe Image --}}
                            @if ($recipe->image)
                                <img src="{{ asset($recipe['image']) }}" alt="{{ $recipe['name'] }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gray-100 flex justify-center items-center">
                                    <i class="fa fa-utensils text-2xl sm:text-3xl text-gray-300"></i>
                                </div>
                            @endif

                            {{-- Gradient Overlay --}}
                            <div
                                class="absolute top-0 left-0 w-full h-full bg-gradient-to-t from-black/70 via-black/40 to-transparent group-hover:bg-black/50 transition-all duration-500">
                            </div>

                            {{-- Recipe Info --}}
                            <div
                                class="w-full absolute bottom-0 left-0 px-3 sm:px-5 pb-2 group-hover:bottom-1/2 group-hover:left-1/2 group-hover:-translate-x-1/2 group-hover:translate-y-1/2 transition-all duration-500 flex justify-between group-hover:block">
                                {{-- Recipe Name --}}
                                <h3
                                    class="text-sm sm:text-lg font-semibold text-white transition-all duration-500 group-hover:text-center mb-1 sm:mb-2 line-clamp-2 sm:line-clamp-none">
                                    {{ $recipe['name'] }}
                                </h3>

                                {{-- Recipe Rating --}}
                                <div
                                    class="group-hover:hidden text-xs sm:text-sm font-medium text-gray-300 flex-shrink-0">
                                    @if ($recipe->ratings->count() > 0)
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i
                                                class="fa-{{ $i <= (int) number_format($recipe->ratings->avg('rating')) ? 'solid' : 'regular' }} fa-star group-hover:scale-110 transition-transform duration-300 text-yellow-500"></i>
                                        @endfor
                                    @else
                                        <i
                                            class="fa-regular fa-star group-hover:scale-110 transition-transform duration-300"></i>
                                        <i
                                            class="fa-regular fa-star group-hover:scale-110 transition-transform duration-300"></i>
                                        <i
                                            class="fa-regular fa-star group-hover:scale-110 transition-transform duration-300"></i>
                                        <i
                                            class="fa-regular fa-star group-hover:scale-110 transition-transform duration-300"></i>
                                        <i
                                            class="fa-regular fa-star group-hover:scale-110 transition-transform duration-300"></i>
                                    @endif
                                </div>

                                {{-- Recipe Description --}}
                                <p
                                    class="hidden group-hover:block text-xs sm:text-sm text-center font-medium text-gray-300 line-clamp-3">
                                    {{ $recipe['description'] }}
                                </p>
                            </div>

                            {{-- Recipe Badge --}}
                            <div
                                class="absolute top-2 sm:top-4 left-2 sm:left-4 bg-white text-secondary text-xs font-bold px-2 sm:px-3 py-1 rounded-full shadow-lg">
                                #{{ $index + 1 }}
                            </div>
                            <div class="absolute top-2 sm:top-4 right-2 sm:right-4 text-xs font-normal">
                                <a href="{{ route('explore-recipes.show', $recipe->id) }}"
                                    class="bg-yellow-400 text-black px-2 sm:px-3 py-1 rounded-full flex items-center gap-1 text-xs">
                                    <i class="fa fa-up-right-from-square"></i>
                                    <span class="hidden sm:inline">Lihat Detail</span>
                                    <span class="sm:hidden">Detail</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Navigation Arrows --}}
        @if ($popularRecipes->count() > 1)
            <button
                class="carousel-btn carousel-prev absolute left-1 sm:left-4 top-[45%] transform -translate-y-1/2 bg-white/20 backdrop-blur-md hover:bg-white/30 text-white p-2 sm:p-3 text-xs sm:text-sm rounded-full shadow-lg transition-all duration-300 z-10 group">
                <i class="fa-solid fa-chevron-left group-hover:scale-110 transition-transform duration-300"></i>
            </button>

            <button
                class="carousel-btn carousel-next absolute right-1 sm:right-4 top-[45%] transform -translate-y-1/2 bg-white/20 backdrop-blur-md hover:bg-white/30 text-white p-2 sm:p-3 text-xs sm:text-sm rounded-full shadow-lg transition-all duration-300 z-10 group">
                <i class="fa-solid fa-chevron-right group-hover:scale-110 transition-transform duration-300"></i>
            </button>
        @endif

        {{-- Carousel Indicators --}}
        <div class="flex justify-center mt-4 sm:mt-6 py-2 space-x-1 sm:space-x-2">
            @for ($i = 0; $i < $popularRecipes->count(); $i++)
                <button
                    class="carousel-indicator w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-gray-300 hover:bg-secondary transition-all duration-300 {{ $i === 0 ? 'bg-secondary scale-125' : '' }}"
                    data-slide="{{ $i }}"></button>
            @endfor
        </div>
    </div>
</div>

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.getElementById('popularCarousel');
            const slides = carousel.children;
            const totalSlides = slides.length;

            // Responsive slides to show
            function getSlidesToShow() {
                if (window.innerWidth < 640) return 1; // Mobile
                if (window.innerWidth < 1024) return 2; // Tablet
                return 3; // Desktop
            }

            let slidesToShow = getSlidesToShow();
            let maxSlideIndex = totalSlides - slidesToShow;
            let currentSlide = 0;
            let isAutoPlaying = true;
            let autoPlayInterval;

            const indicators = document.querySelectorAll('.carousel-indicator');
            const prevBtn = document.querySelector('.carousel-prev');
            const nextBtn = document.querySelector('.carousel-next');

            // Update carousel position
            function updateCarousel() {
                const translateX = -(currentSlide * (100 / slidesToShow));
                carousel.style.transform = `translateX(${translateX}%)`;

                // Update indicators
                indicators.forEach((indicator, index) => {
                    indicator.classList.toggle('bg-secondary', index === currentSlide);
                    indicator.classList.toggle('scale-125', index === currentSlide);
                    indicator.classList.toggle('bg-gray-300', index !== currentSlide);
                });
            }

            // Next slide
            function nextSlide() {
                currentSlide = currentSlide >= maxSlideIndex ? 0 : currentSlide + 1;
                updateCarousel();
            }

            // Previous slide
            function prevSlide() {
                currentSlide = currentSlide <= 0 ? maxSlideIndex : currentSlide - 1;
                updateCarousel();
            }

            // Go to specific slide
            function goToSlide(slideIndex) {
                currentSlide = Math.min(slideIndex, maxSlideIndex);
                updateCarousel();
            }

            // Auto-play functionality
            function startAutoPlay() {
                autoPlayInterval = setInterval(nextSlide, 4000);
            }

            function stopAutoPlay() {
                clearInterval(autoPlayInterval);
            }

            // Handle window resize
            function handleResize() {
                const newSlidesToShow = getSlidesToShow();
                if (newSlidesToShow !== slidesToShow) {
                    slidesToShow = newSlidesToShow;
                    maxSlideIndex = totalSlides - slidesToShow;
                    currentSlide = Math.min(currentSlide, maxSlideIndex);
                    updateCarousel();
                }
            }

            // Event listeners
            nextBtn.addEventListener('click', () => {
                nextSlide();
                if (isAutoPlaying) {
                    stopAutoPlay();
                    startAutoPlay(); // Restart timer
                }
            });

            prevBtn.addEventListener('click', () => {
                prevSlide();
                if (isAutoPlaying) {
                    stopAutoPlay();
                    startAutoPlay(); // Restart timer
                }
            });

            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => {
                    goToSlide(index);
                    if (isAutoPlaying) {
                        stopAutoPlay();
                        startAutoPlay(); // Restart timer
                    }
                });
            });

            // Window resize listener
            window.addEventListener('resize', handleResize);

            // Pause on hover
            carousel.addEventListener('mouseenter', () => {
                if (isAutoPlaying) stopAutoPlay();
            });

            carousel.addEventListener('mouseleave', () => {
                if (isAutoPlaying) startAutoPlay();
            });

            // Touch/swipe support for mobile
            let startX = 0;
            let endX = 0;

            carousel.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;
            });

            carousel.addEventListener('touchend', (e) => {
                endX = e.changedTouches[0].clientX;
                const diff = startX - endX;

                if (Math.abs(diff) > 50) { // Minimum swipe distance
                    if (diff > 0) {
                        nextSlide();
                    } else {
                        prevSlide();
                    }

                    if (isAutoPlaying) {
                        stopAutoPlay();
                        startAutoPlay();
                    }
                }
            });

            // Initialize
            startAutoPlay();
            updateCarousel();
        });
    </script>
@endpush
