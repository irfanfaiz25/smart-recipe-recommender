<div class="max-w-full md:max-w-4xl mx-auto md:p-6">
    <!-- Main Form -->
    <form wire:submit.prevent="submitSuggestion" class="space-y-8">
        <!-- Feedback Type & Rating Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
            <h2 class="text-base md:text-lg font-semibold text-text-primary mb-6 flex items-center">
                <i class="fas fa-star text-primary mr-3"></i>
                Jenis Feedback & Rating
            </h2>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Feedback Type -->
                <div>
                    <label class="block text-sm font-medium text-text-primary mb-2">
                        Jenis Feedback <span class="text-sm text-red-500">*</span>
                    </label>
                    <select wire:model="feedback_type"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent bg-white  text-sm font-medium text-text-primary transition-all duration-200">
                        <option value="">Pilih jenis feedback</option>
                        <option value="bug_report">Laporan Bug</option>
                        <option value="feature_request">Permintaan Fitur Baru</option>
                        <option value="ui_improvement">Perbaikan UI/UX</option>
                        <option value="performance">Masalah Performa</option>
                        <option value="content_suggestion">Saran Konten</option>
                        <option value="general_feedback">Feedback Umum</option>
                        <option value="compliment">Pujian</option>
                    </select>
                    @error('feedback_type')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Overall Rating -->
                <div>
                    <label class="block text-sm font-medium text-text-primary mb-2">
                        Rating Kepuasan Keseluruhan <span class="text-sm text-red-500">*</span>
                    </label>
                    <div class="flex items-center space-x-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <button type="button" wire:click="$set('rating', {{ $i }})"
                                class="text-xl transition-all duration-200 hover:scale-110 {{ $rating >= $i ? 'text-yellow-400' : 'text-gray-300' }}">
                                <i class="fas fa-star"></i>
                            </button>
                        @endfor
                        <span class="ml-3 text-sm text-gray-600">
                            ({{ $rating }}/5 -
                            {{ $rating >= 4 ? 'Sangat Puas' : ($rating >= 3 ? 'Puas' : ($rating >= 2 ? 'Cukup' : 'Kurang Puas')) }})
                        </span>
                    </div>
                    @error('rating')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Main Feedback Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
            <h2 class="text-base md:text-lg font-semibold text-text-primary mb-6 flex items-center">
                <i class="fas fa-comment-dots text-primary mr-3"></i>
                Detail Saran & Masukan
            </h2>

            <div class="grid md:grid-cols-2 gap-6 mb-6">
                <!-- Subject -->
                <div>
                    <label class="block text-sm font-medium text-text-primary mb-2">
                        Subjek Saran <span class="text-sm text-red-500">*</span>
                    </label>
                    <input type="text" wire:model="subject" placeholder="Ringkasan singkat saran Anda..."
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent bg-white  text-sm font-medium text-text-primary transition-all duration-200">
                    @error('subject')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Specific Area -->
                <div>
                    <label class="block text-sm font-medium text-text-primary  mb-2">
                        Area Spesifik <span class="text-sm text-red-500">*</span>
                    </label>
                    <select wire:model="specific_area"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent bg-white  text-sm font-medium text-text-primary transition-all duration-200">
                        <option value="">Pilih area yang terkait</option>
                        <option value="ingredients">Bahan Makanan</option>
                        <option value="recipe_search">Pencarian Resep</option>
                        <option value="recipe_detail">Detail Resep</option>
                        <option value="ai_suggestions">Saran AI</option>
                        <option value="user_profile">Profil Pengguna</option>
                        <option value="bookmarks">Bookmark/Favorit</option>
                        <option value="navigation">Navigasi</option>
                        <option value="mobile_experience">Pengalaman Mobile</option>
                        <option value="performance">Performa</option>
                        <option value="design">Desain</option>
                        <option value="content">Konten</option>
                        <option value="other">Lainnya</option>
                    </select>
                    @error('specific_area')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Priority -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-text-primary mb-3">
                    Tingkat Prioritas <span class="text-sm text-red-500">*</span>
                </label>
                <div class="flex space-x-4">
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" wire:model.live.debounce.300ms="priority" value="low" class="sr-only">
                        <div
                            class="w-4 h-4 border-2 rounded-full mr-2 transition-all duration-200 {{ $priority === 'low' ? 'bg-green-500 border-green-500' : 'border-gray-300 ' }}">
                        </div>
                        <span class="text-sm font-medium text-text-primary">Rendah</span>
                    </label>
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" wire:model.live.debounce.300ms="priority" value="medium" class="sr-only">
                        <div
                            class="w-4 h-4 border-2 rounded-full mr-2 transition-all duration-200 {{ $priority === 'medium' ? 'bg-yellow-500 border-yellow-500' : 'border-gray-300 ' }}">
                        </div>
                        <span class="text-sm font-medium text-text-primary">Sedang</span>
                    </label>
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" wire:model.live.debounce.300ms="priority" value="high" class="sr-only">
                        <div
                            class="w-4 h-4 border-2 rounded-full mr-2 transition-all duration-200 {{ $priority === 'high' ? 'bg-red-500 border-red-500' : 'border-gray-300 ' }}">
                        </div>
                        <span class="text-sm font-medium text-text-primary">Tinggi</span>
                    </label>
                </div>
                @error('priority')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Main Message -->
            <div>
                <label class="block text-sm font-medium text-text-primary  mb-2">
                    Pesan Detail <span class="text-sm text-red-500">*</span>
                </label>
                <textarea wire:model.live.debounce.300ms="feedback_message" rows="6"
                    placeholder="Jelaskan saran, masukan, atau masalah yang Anda temukan secara detail. Semakin spesifik, semakin membantu kami untuk melakukan perbaikan."
                    class="w-full px-4 py-2.5 border border-gray-300  rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent bg-white text-sm font-normal text-text-primary  transition-all duration-200 resize-none"></textarea>
                <div class="flex justify-between items-center mt-2">
                    @error('message')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                    <span class="text-xs md:text-sm font-normal text-gray-500 ml-auto">
                        {{ strlen($feedback_message) }}/1000 karakter
                    </span>
                </div>
            </div>
        </div>

        <!-- User Experience Rating -->
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
            <h2 class="text-base md:text-lg font-semibold text-text-primary  mb-6 flex items-center">
                <i class="fas fa-chart-line text-primary mr-3"></i>
                Evaluasi Pengalaman Pengguna
            </h2>

            <div class="grid md:grid-cols-3 gap-6 mb-6">
                <!-- Ease of Use -->
                <div>
                    <label class="block text-sm font-medium text-text-primary  mb-3">
                        Kemudahan Penggunaan
                    </label>
                    <div class="flex items-center space-x-1">
                        @for ($i = 1; $i <= 5; $i++)
                            <button type="button" wire:click="$set('ease_of_use', {{ $i }})"
                                class="text-lg transition-all duration-200 hover:scale-110 {{ $ease_of_use >= $i ? 'text-blue-400' : 'text-gray-300' }}">
                                <i class="fas fa-star"></i>
                            </button>
                        @endfor
                    </div>
                </div>

                <!-- Performance -->
                <div>
                    <label class="block text-sm font-medium text-text-primary  mb-3">
                        Performa Aplikasi
                    </label>
                    <div class="flex items-center space-x-1">
                        @for ($i = 1; $i <= 5; $i++)
                            <button type="button" wire:click="$set('performance', {{ $i }})"
                                class="text-lg transition-all duration-200 hover:scale-110 {{ $performance >= $i ? 'text-green-400' : 'text-gray-300' }}">
                                <i class="fas fa-star"></i>
                            </button>
                        @endfor
                    </div>
                </div>

                <!-- Design -->
                <div>
                    <label class="block text-sm font-medium text-text-primary  mb-3">
                        Desain & Tampilan
                    </label>
                    <div class="flex items-center space-x-1">
                        @for ($i = 1; $i <= 5; $i++)
                            <button type="button" wire:click="$set('design', {{ $i }})"
                                class="text-lg transition-all duration-200 hover:scale-110 {{ $design >= $i ? 'text-purple-400' : 'text-gray-300' }}">
                                <i class="fas fa-star"></i>
                            </button>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Would Recommend -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-text-primary  mb-3">
                    Apakah Anda akan merekomendasikan SavoryAI kepada teman?
                </label>
                <div class="flex space-x-6">
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" wire:model="would_recommend" value="1" class="sr-only">
                        <div
                            class="w-4 h-4 md:w-5 md:h-5 border-2 rounded-full mr-3 transition-all duration-200 {{ $would_recommend ? 'bg-green-500 border-green-500' : 'border-gray-300 ' }}">
                        </div>
                        <span class="text-sm font-medium text-text-primary ">👍 Ya,
                            pasti!</span>
                    </label>
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" wire:model="would_recommend" value="0" class="sr-only">
                        <div
                            class="w-4 h-4 md:w-5 md:h-5 border-2 rounded-full mr-3 transition-all duration-200 {{ !$would_recommend ? 'bg-red-500 border-red-500' : 'border-gray-300 ' }}">
                        </div>
                        <span class="text-sm font-medium text-text-primary ">👎 Belum
                            yakin</span>
                    </label>
                </div>
            </div>

            <!-- Additional Features -->
            <div>
                <label class="block text-sm font-medium text-text-primary  mb-2">
                    Fitur Tambahan yang Diinginkan
                </label>
                <textarea wire:model="additional_features" rows="3"
                    placeholder="Adakah fitur khusus yang Anda inginkan? Misalnya: kalkulator nutrisi, timer memasak, sharing resep ke media sosial, dll."
                    class="w-full px-4 py-2.5 border border-gray-300  rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent bg-white  text-sm font-normal text-text-primary  transition-all duration-200 resize-none"></textarea>
                <div class="flex justify-end">
                    <span class="text-xs md:text-sm font-medium text-gray-500">
                        {{ strlen($additional_features) }}/500 karakter
                    </span>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
            <h2 class="text-base md:text-lg font-semibold text-text-primary  mb-6 flex items-center">
                <i class="fas fa-address-card text-primary mr-3"></i>
                Informasi Kontak (Opsional)
            </h2>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-text-primary  mb-2">
                        Nama Lengkap
                    </label>
                    <input type="text" wire:model="name" placeholder="Nama Anda (untuk follow-up jika diperlukan)"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent bg-white  text-sm font-medium text-text-primary  transition-all duration-200">
                    @error('name')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-text-primary  mb-2">
                        Email
                    </label>
                    <input type="email" wire:model="email" placeholder="email@example.com"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent bg-white  text-sm font-medium text-text-primary  transition-all duration-200">
                    @error('email')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <p class="text-xs font-normal text-gray-600 mt-4">
                <i class="fas fa-info-circle mr-2"></i>
                Informasi kontak hanya akan digunakan untuk follow-up jika diperlukan dan tidak akan dibagikan kepada
                pihak ketiga.
            </p>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit"
                class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-secondary to-orange-500 text-base text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-primary/50">
                <i class="fas fa-paper-plane mr-3"></i>
                Kirim Saran & Masukan
            </button>

            <p class="text-sm text-gray-600 mt-4">
                Terima kasih telah membantu kami meningkatkan SavoryAI! 🙏
            </p>
        </div>
    </form>
</div>
