// Auto-save form data setiap 30 detik atau saat ada perubahan
class RecipeFormPersistence {
    constructor() {
        this.storageKey = "recipe_form_draft";
        this.autoSaveInterval = 30000; // 30 seconds
        this.init();
    }

    init() {
        this.loadDraftData();
        this.setupAutoSave();
        this.setupBeforeUnload();
    }

    // Simpan data form ke localStorage
    saveDraft() {
        const formData = {
            name: document.getElementById("name")?.value || "",
            description: document.getElementById("description")?.value || "",
            cookingTime: document.getElementById("cookingTime")?.value || "",
            difficulty: document.getElementById("difficulty")?.value || "",
            servings: document.getElementById("servings")?.value || "",
            recipeCategory:
                document.getElementById("recipeCategory")?.value || "",
            selectedIngredients:
                window.livewire.find(
                    document
                        .querySelector("[wire\\:id]")
                        .getAttribute("wire:id")
                ).selectedIngredients || [],
            steps:
                window.livewire.find(
                    document
                        .querySelector("[wire\\:id]")
                        .getAttribute("wire:id")
                ).steps || [],
            timestamp: new Date().toISOString(),
        };

        localStorage.setItem(this.storageKey, JSON.stringify(formData));
        this.showSaveIndicator();
    }

    // Load draft data saat halaman dimuat
    loadDraftData() {
        const savedData = localStorage.getItem(this.storageKey);
        if (savedData) {
            const data = JSON.parse(savedData);
            const component = window.livewire.find(
                document.querySelector("[wire\\:id]").getAttribute("wire:id")
            );

            // Restore basic form fields
            if (data.name) component.set("name", data.name);
            if (data.description)
                component.set("description", data.description);
            if (data.cookingTime)
                component.set("cookingTime", data.cookingTime);
            if (data.difficulty) component.set("difficulty", data.difficulty);
            if (data.servings) component.set("servings", data.servings);
            if (data.recipeCategory)
                component.set("recipeCategory", data.recipeCategory);

            // Restore complex data
            if (data.selectedIngredients?.length > 0) {
                component.set("selectedIngredients", data.selectedIngredients);
            }
            if (data.steps?.length > 0) {
                component.set("steps", data.steps);
            }

            this.showRestoreNotification(data.timestamp);
        }
    }

    setupAutoSave() {
        // Auto-save setiap 30 detik
        setInterval(() => {
            this.saveDraft();
        }, this.autoSaveInterval);

        // Save saat ada perubahan pada input
        document.addEventListener("input", (e) => {
            if (e.target.closest("form[wire\\:submit]")) {
                clearTimeout(this.saveTimeout);
                this.saveTimeout = setTimeout(() => {
                    this.saveDraft();
                }, 2000); // Delay 2 detik setelah user berhenti mengetik
            }
        });
    }

    setupBeforeUnload() {
        window.addEventListener("beforeunload", () => {
            this.saveDraft();
        });
    }

    showSaveIndicator() {
        // Tampilkan indikator "Draft tersimpan"
        const indicator = document.createElement("div");
        indicator.className =
            "fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50 transition-opacity";
        indicator.textContent = "✓ Draft tersimpan";
        document.body.appendChild(indicator);

        setTimeout(() => {
            indicator.style.opacity = "0";
            setTimeout(() => indicator.remove(), 300);
        }, 2000);
    }

    showRestoreNotification(timestamp) {
        const date = new Date(timestamp).toLocaleString("id-ID");
        const notification = document.createElement("div");
        notification.className =
            "fixed top-4 left-1/2 transform -translate-x-1/2 bg-blue-500 text-white px-6 py-3 rounded-lg shadow-lg z-50";
        notification.innerHTML = `
            <div class="flex items-center space-x-3">
                <i class="fas fa-info-circle"></i>
                <span>Draft terakhir dimuat (${date})</span>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-2 text-white hover:text-gray-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        document.body.appendChild(notification);

        setTimeout(() => notification.remove(), 5000);
    }

    clearDraft() {
        localStorage.removeItem(this.storageKey);
    }
}

// Initialize saat DOM ready
document.addEventListener("DOMContentLoaded", () => {
    new RecipeFormPersistence();
});
