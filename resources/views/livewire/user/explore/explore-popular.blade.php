<div>
    {{-- Popular Recipes Section --}}
    {{-- <div class="space-y-2 mb-10">
        <h1 class="text-4xl font-bold font-display text-secondary">
            Apa Yang Lagi Nge-Trend Nih?
        </h1>
        <p class="text-primary text-sm">
            Resep yang sedang tren saat ini
        </p>
    </div> --}}

    {{-- Popular Recipes Carousel Section --}}
    <div class="relative w-full overflow-hidden mb-16">
        {{-- Carousel Container --}}
        <div class="carousel-container relative">
            <div class="carousel-track flex transition-transform duration-700 ease-in-out" id="popularCarousel">
                @for ($i = 0; $i < 8; $i++)
                    <div class="carousel-slide flex-none w-1/3 px-2">
                        <div
                            class="h-72 shadow-md hover:shadow-xl transition-all duration-500 relative group cursor-pointer overflow-hidden rounded-xl">
                            <img src="{{ asset('storage/img/main/secondary-background.jpg') }}"
                                alt="popular-recipe-{{ $i + 1 }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

                            {{-- Gradient Overlay --}}
                            <div
                                class="absolute top-0 left-0 w-full h-full bg-gradient-to-t from-black/70 via-black/40 to-transparent group-hover:bg-black/50 transition-all duration-500">
                            </div>

                            {{-- Recipe Info --}}
                            <div
                                class="w-full absolute bottom-0 left-0 px-5 pb-2 group-hover:bottom-1/2 group-hover:left-1/2 group-hover:-translate-x-1/2 group-hover:translate-y-1/2 transition-all duration-500 flex justify-between group-hover:block">
                                {{-- Recipe Name --}}
                                <h3
                                    class="text-lg font-semibold text-white transition-all duration-500 group-hover:text-center mb-2">
                                    {{ ['Steak Daging', 'Nasi Goreng', 'Ayam Bakar', 'Soto Ayam', 'Rendang Padang', 'Gado-Gado', 'Bakso Malang', 'Gudeg Jogja'][$i] }}
                                </h3>

                                {{-- Recipe Rating --}}
                                <div class="group-hover:hidden text-sm font-medium text-gray-300">
                                    @for ($star = 1; $star <= 5; $star++)
                                        <i
                                            class="fa-{{ $star <= 4 ? 'solid' : 'regular' }} fa-star text-xs text-yellow-400"></i>
                                    @endfor
                                </div>

                                {{-- Recipe Description --}}
                                <p class="hidden group-hover:block text-sm text-center font-medium text-gray-300">
                                    Resep
                                    {{ ['Steak Daging', 'Nasi Goreng', 'Ayam Bakar', 'Soto Ayam', 'Rendang Padang', 'Gado-Gado', 'Bakso Malang', 'Gudeg Jogja'][$i] }}
                                    yang lezat dan mudah dibuat dengan bahan-bahan pilihan terbaik.
                                </p>
                            </div>

                            {{-- Recipe Badge --}}
                            <div
                                class="absolute top-4 left-4 bg-white text-secondary text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                #{{ $i + 1 }}
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        {{-- Navigation Arrows --}}
        <button
            class="carousel-btn carousel-prev absolute left-4 top-[45%] transform -translate-y-1/2 bg-white/20 backdrop-blur-md hover:bg-white/30 text-white p-3 text-sm rounded-full shadow-lg transition-all duration-300 z-10 group">
            <i class="fa-solid fa-chevron-left group-hover:scale-110 transition-transform duration-300"></i>
        </button>

        <button
            class="carousel-btn carousel-next absolute right-4 top-[45%] transform -translate-y-1/2 bg-white/20 backdrop-blur-md hover:bg-white/30 text-white p-3 text-sm rounded-full shadow-lg transition-all duration-300 z-10 group">
            <i class="fa-solid fa-chevron-right group-hover:scale-110 transition-transform duration-300"></i>
        </button>

        {{-- Carousel Indicators --}}
        <div class="flex justify-center mt-6 py-2 space-x-2">
            @for ($i = 0; $i < 6; $i++)
                <button
                    class="carousel-indicator w-2 h-2 rounded-full bg-gray-300 hover:bg-secondary transition-all duration-300 {{ $i === 0 ? 'bg-secondary scale-125' : '' }}"
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
            const slidesToShow = 3;
            const maxSlideIndex = totalSlides - slidesToShow;

            let currentSlide = 0;
            let isAutoPlaying = true;
            let autoPlayInterval;

            const indicators = document.querySelectorAll('.carousel-indicator');
            const prevBtn = document.querySelector('.carousel-prev');
            const nextBtn = document.querySelector('.carousel-next');
            // Removed references to play/pause button elements

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

            // Removed play/pause button event listener

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
