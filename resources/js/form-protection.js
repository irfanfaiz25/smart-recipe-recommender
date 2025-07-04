// Tambahkan di file form-protection.js yang sudah ada
class FormProtection {
    constructor() {
        this.hasUnsavedChanges = false;
        this.init();
    }

    init() {
        // Track perubahan form
        document.addEventListener("input", (e) => {
            if (e.target.closest("form[wire\\:submit]")) {
                this.hasUnsavedChanges = true;
            }
        });

        // Konfirmasi sebelum meninggalkan halaman
        window.addEventListener("beforeunload", (e) => {
            if (this.hasUnsavedChanges) {
                e.preventDefault();
                e.returnValue =
                    "Anda memiliki perubahan yang belum disimpan. Yakin ingin meninggalkan halaman?";
                return e.returnValue;
            }
        });

        // Reset flag saat form berhasil disimpan
        document.addEventListener("livewire:init", () => {
            Livewire.on("recipe-saved", () => {
                this.hasUnsavedChanges = false;
            });
        });
    }
}

new FormProtection();
