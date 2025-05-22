<div
    class="bg-gradient-to-br from-primary/5 via-secondary/5 to-accent/5 p-1 rounded-2xl shadow-lg hover:shadow-xl transition-all transform hover:scale-[1.01]">
    <div class="bg-white dark:bg-bg-dark-secondary p-8 rounded-2xl">
        <form wire:submit.prevent='save' class="space-y-6">
            @csrf

            <!-- Form Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Phone Number Field -->
                <div class="col-span-2">
                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nomor
                        Telepon</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 dark:text-gray-400">
                            <i class="fa-solid fa-phone"></i>
                        </span>
                        <input type="tel" id="phone" wire:model="phoneNumber"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary dark:focus:ring-primary-light focus:border-primary dark:focus:border-primary-light bg-white dark:bg-bg-dark-primary text-gray-900 dark:text-white"
                            placeholder="08xxxxxxxxxx" required>
                        @error('phoneNumber')
                            <p class="mt-1 text-red-500 text-xs italic">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- City Field -->
                <div class="col-span-2">
                    <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Kota Asal
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 dark:text-gray-400">
                            <i class="fa-solid fa-location-dot"></i>
                        </span>
                        <input type="text" id="city" wire:model="city"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary dark:focus:ring-primary-light focus:border-primary dark:focus:border-primary-light bg-white dark:bg-bg-dark-primary text-gray-900 dark:text-white"
                            placeholder="Masukkan kota asal" required>
                        @error('city')
                            <p class="mt-1 text-red-500 text-xs italic">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

            </div>

            <!-- Terms and Conditions -->
            {{-- <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="terms" name="terms" type="checkbox"
                            class="h-5 w-5 text-primary focus:ring-primary-light border-gray-300 rounded"
                            required>
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="terms" class="font-medium text-gray-700 dark:text-gray-300">Saya
                            setuju dengan <a href="#"
                                class="text-secondary hover:text-secondary-hover underline">Syarat dan
                                Ketentuan</a></label>
                    </div>
                </div> --}}

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit"
                    class="w-full py-4 px-6 bg-gradient-to-r from-primary via-primary-light to-primary bg-300% animate-shine text-white font-bold rounded-lg shadow-lg hover:shadow-xl transition-all transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-light">
                    <span class="flex items-center justify-center">
                        <span>Daftar Sebagai Creators</span>
                        <i class="fa-solid fa-arrow-right ml-2"></i>
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>
