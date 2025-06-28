<footer class="bg-gradient-to-br from-neutral-50 via-neutral-100 to-neutral-50 text-gray-900 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0"
            style="background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 100 100">
            <defs>
                <pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse">
                    <circle cx="25" cy="25" r="2" fill="white" />
                    <circle cx="75" cy="75" r="1.5" fill="white" />
                    <circle cx="50" cy="10" r="1" fill="white" />
                    <circle cx="10" cy="60" r="1.5" fill="white" />
                    <circle cx="90" cy="30" r="1" fill="white" />
                </pattern>
            </defs>
        </div>
    </div>

    <div class="relative z-10">
        <!-- Main Footer Content -->
        <div class="mx-auto px-4 sm:px-6 lg:px-20 pt-16 pb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">

                <!-- Brand Section -->
                <div class="lg:col-span-1">
                    <div class="flex space-x-2 items-center mb-6">
                        <img src="{{ asset('storage/img/main/savory-logo.png') }}" alt="logo" class="w-16 h-16">
                        <h3
                            class="text-2xl font-bold bg-gradient-to-r from-orange-400 to-red-500 bg-clip-text text-transparent">
                            SavoryAI
                        </h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-6 leading-relaxed">
                        Platform resep cerdas yang menggunakan AI untuk membantu Anda menemukan dan membuat hidangan
                        lezat dari bahan-bahan yang tersedia.
                    </p>
                </div>

                <!-- AI Features -->
                <div>
                    <div class="space-y-4">
                        <!-- Feature Card 1 -->
                        <div class="bg-white/50 backdrop-blur-sm rounded-lg p-4 border border-gray-100 shadow-sm">
                            <div class="flex items-start space-x-3">
                                <div class="p-2 bg-purple-100 rounded-lg">
                                    <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="font-medium text-gray-900">Rekomendasi Cerdas</h5>
                                    <p class="text-sm text-gray-600 mt-1">Dapatkan rekomendasi resep yang
                                        dipersonalisasi berdasarkan preferensi dan bahan yang Anda miliki</p>
                                </div>
                            </div>
                        </div>

                        <!-- Feature Card 2 -->
                        <div class="bg-white/50 backdrop-blur-sm rounded-lg p-4 border border-gray-100 shadow-sm">
                            <div class="flex items-start space-x-3">
                                <div class="p-2 bg-green-100 rounded-lg">
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="flex items-center">
                                        <h5 class="font-medium text-gray-900">Asisten Memasak</h5>
                                        <span
                                            class="ml-2 px-2 py-1 bg-green-500/20 text-green-500 text-xs rounded-full">Segera</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1">Panduan langkah demi langkah dengan AI yang
                                        membantu Anda memasak seperti chef profesional</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-6 flex items-center">
                        Jelajahi
                    </h4>
                    <ul class="space-y-3">
                        <li>
                            <a href="{{ route('explore-recipes.index') }}" wire:navigate
                                class="text-sm text-gray-600 hover:text-orange-400 transition-colors duration-200 flex items-center group">
                                <i
                                    class="fa fa-utensils text-sm mr-2 group-hover:translate-x-1 transition-transform"></i>
                                Jelajahi Resep
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('savoryai.index') }}" wire:navigate
                                class="text-sm text-gray-600 hover:text-orange-400 transition-colors duration-200 flex items-center group">
                                <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                                    </path>
                                </svg>
                                Rekomendasi Cerdas
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('creators.index') }}" wire:navigate
                                class="text-sm text-gray-600 hover:text-orange-400 transition-colors duration-200 flex items-center group">
                                <i
                                    class="fa fa-bell-concierge text-sm mr-2 group-hover:translate-x-1 transition-transform"></i>
                                Creators
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('bookmarks.index') }}" wire:navigate
                                class="text-sm text-gray-600 hover:text-orange-400 transition-colors duration-200 flex items-center group">
                                <svg class="w-3 h-3 mr-2 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                </svg>
                                Favorit Saya
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('suggestions.index') }}" wire:navigate
                                class="text-sm text-gray-600 hover:text-orange-400 transition-colors duration-200 flex items-center group">
                                <i
                                    class="fa fa-file-pen text-sm mr-2 group-hover:translate-x-1 transition-transform"></i>
                                Saran dan Masukan
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact & Social -->
                <div>
                    <h4 class="text-lg font-semibold mb-6 flex items-center">
                        Hubungi Kami
                    </h4>

                    <!-- Contact Info -->
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center text-gray-600">
                            <svg class="w-4 h-4 mr-3 text-blue-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            <span class="text-sm">hello@savoryai.com</span>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <svg class="w-4 h-4 mr-3 text-green-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                            <span class="text-sm">+62 812-3456-7890</span>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div>
                        <p class="text-sm text-gray-600 mb-4">Ikuti kami di:</p>
                        <div class="flex space-x-3">
                            <a href="#"
                                class="w-10 h-10 bg-blue-600 hover:bg-blue-700 rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110">
                                <i class="fa-brands fa-twitter text-xl text-white"></i>
                            </a>
                            <a href="#"
                                class="w-10 h-100 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600  rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110">
                                <i class="fa-brands fa-instagram text-xl text-white"></i>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-red-600 hover:bg-red-700 rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110">
                                <i class="fa-brands fa-youtube text-xl text-white"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-gray-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="md:flex md:items-center md:justify-center">
                    <div class="text-center md:text-left">
                        <p class="text-gray-600 text-sm">
                            © {{ date('Y') }} SavoryAI. Made with ❤️ untuk para pecinta kuliner Indonesia.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button -->
    <button id="scrollToTop"
        class="fixed bottom-8 right-8 w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110 opacity-0 invisible z-50"
        onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
        <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18">
            </path>
        </svg>
    </button>
</footer>

<!-- Footer JavaScript -->
<script>
    // Scroll to top button functionality
    window.addEventListener('scroll', function() {
        const scrollToTopBtn = document.getElementById('scrollToTop');
        if (window.pageYOffset > 300) {
            scrollToTopBtn.classList.remove('opacity-0', 'invisible');
            scrollToTopBtn.classList.add('opacity-100', 'visible');
        } else {
            scrollToTopBtn.classList.add('opacity-0', 'invisible');
            scrollToTopBtn.classList.remove('opacity-100', 'visible');
        }
    });

    // Newsletter subscription (you can integrate with your backend)
    document.querySelector('button[type="submit"], button:contains("Berlangganan")')?.addEventListener('click',
        function(e) {
            e.preventDefault();
            const email = this.previousElementSibling.value;
            if (email && email.includes('@')) {
                // Add your newsletter subscription logic here
                alert('Terima kasih! Anda akan segera menerima resep terbaru di email Anda.');
                this.previousElementSibling.value = '';
            } else {
                alert('Mohon masukkan email yang valid.');
            }
        });
</script>
