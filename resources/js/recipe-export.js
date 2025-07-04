import html2canvas from "html2canvas";

class RecipeExporter {
    static async exportAsImage(recipeId, recipeName) {
        try {
            // Show loading indicator
            this.showLoadingIndicator("Memproses gambar...");

            // Get the recipe container
            const recipeContainer = document.querySelector(".recipe-container");
            if (!recipeContainer) {
                throw new Error("Recipe container not found");
            }

            // Hide elements that shouldn't be in export
            const elementsToHide = [
                ".export-buttons",
                ".comment-section",
                ".rating-form",
                ".reviews-section",
                ".hide-on-export",
            ];

            const hiddenElements = [];

            // Hide export buttons
            elementsToHide.forEach((selector) => {
                try {
                    const elements = document.querySelectorAll(selector);
                    elements.forEach((el) => {
                        if (el && el.style.display !== "none") {
                            hiddenElements.push({
                                element: el,
                                originalDisplay: el.style.display,
                            });
                            el.style.display = "none";
                        }
                    });
                } catch (selectorError) {
                    console.warn(
                        `Invalid selector: ${selector}`,
                        selectorError
                    );
                }
            });

            // Hide Livewire forms
            const livewireForms = document.querySelectorAll("form");
            livewireForms.forEach((form) => {
                if (
                    form.hasAttribute("wire:submit") ||
                    form.hasAttribute("wire:submit.prevent")
                ) {
                    hiddenElements.push({
                        element: form,
                        originalDisplay: form.style.display,
                    });
                    form.style.display = "none";
                }
            });

            // Hide back buttons
            const backButtons = document.querySelectorAll("button");
            backButtons.forEach((button) => {
                if (
                    button.onclick &&
                    button.onclick.toString().includes("history.back")
                ) {
                    hiddenElements.push({
                        element: button,
                        originalDisplay: button.style.display,
                    });
                    button.style.display = "none";
                }
            });

            // Add export styling
            const exportStyle = document.createElement("style");
            exportStyle.id = "export-style";
            exportStyle.textContent = `
                .recipe-container {
                    background: white !important;
                    padding: 20px !important;
                    box-shadow: none !important;
                }
                .recipe-container * {
                    -webkit-print-color-adjust: exact !important;
                    color-adjust: exact !important;
                }
                .recipe-container img {
                    max-width: 100% !important;
                    height: auto !important;
                }
            `;
            document.head.appendChild(exportStyle);

            // PERBAIKAN: Set crossOrigin untuk semua gambar sebelum capture
            const images = recipeContainer.querySelectorAll("img");
            images.forEach((img) => {
                if (
                    img.src.includes("cloudinary") ||
                    img.src.includes("http")
                ) {
                    img.crossOrigin = "anonymous";
                }
            });

            // Wait for images to load
            await this.waitForImages(recipeContainer);

            // Capture the screenshot dengan konfigurasi CORS yang benar
            const canvas = await html2canvas(recipeContainer, {
                backgroundColor: "#ffffff",
                scale: 1, // Reduced scale untuk menghindari memory issues
                useCORS: true, // Enable CORS
                allowTaint: true, // Allow tainted canvas untuk fallback
                foreignObjectRendering: false, // Disable untuk kompatibilitas yang lebih baik
                logging: false,
                width: recipeContainer.scrollWidth,
                height: recipeContainer.scrollHeight,
                scrollX: 0,
                scrollY: 0,
                onclone: (clonedDoc) => {
                    // Set crossOrigin pada cloned document juga
                    const clonedImages = clonedDoc.querySelectorAll("img");
                    clonedImages.forEach((img) => {
                        if (
                            img.src.includes("cloudinary") ||
                            img.src.includes("http")
                        ) {
                            img.crossOrigin = "anonymous";
                        }
                    });
                },
            });

            // Restore hidden elements
            hiddenElements.forEach(({ element, originalDisplay }) => {
                element.style.display = originalDisplay;
            });

            // Remove export styling
            const styleElement = document.getElementById("export-style");
            if (styleElement) {
                styleElement.remove();
            }

            // Download the image
            const link = document.createElement("a");
            link.download = `resep-${this.slugify(recipeName)}.png`;
            link.href = canvas.toDataURL("image/png", 0.9);
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            this.hideLoadingIndicator();
            this.showSuccessMessage("Gambar berhasil didownload!");
        } catch (error) {
            console.error("Export error:", error);
            this.hideLoadingIndicator();

            // Specific error handling untuk CORS
            if (
                error.message.includes("tainted") ||
                error.message.includes("CORS")
            ) {
                this.showErrorMessage(
                    "Gagal mengexport gambar karena masalah CORS. Coba gunakan browser lain."
                );
            } else {
                this.showErrorMessage(
                    "Gagal mengexport gambar. Silakan coba lagi."
                );
            }
        }
    }

    static async waitForImages(container) {
        const images = container.querySelectorAll("img");
        console.log(`Found ${images.length} images to wait for`);

        const imagePromises = Array.from(images).map((img, index) => {
            return new Promise((resolve) => {
                if (img.complete && img.naturalHeight !== 0) {
                    console.log(`Image ${index + 1} already loaded`);
                    resolve();
                } else {
                    console.log(
                        `Waiting for image ${index + 1} to load:`,
                        img.src
                    );

                    const timeout = setTimeout(() => {
                        console.log(`Image ${index + 1} timeout`);
                        resolve();
                    }, 5000);

                    img.onload = () => {
                        console.log(`Image ${index + 1} loaded successfully`);
                        clearTimeout(timeout);
                        resolve();
                    };

                    img.onerror = (error) => {
                        console.log(
                            `Image ${index + 1} failed to load:`,
                            error
                        );
                        clearTimeout(timeout);
                        resolve(); // Continue even if image fails
                    };

                    // Set crossOrigin untuk Cloudinary images
                    if (
                        img.src.includes("cloudinary") ||
                        img.src.includes("http")
                    ) {
                        img.crossOrigin = "anonymous";
                    }
                }
            });
        });

        await Promise.all(imagePromises);
        console.log("All images processed");
    }

    static async shareAsImage(recipeId, recipeName) {
        if (!navigator.share || !navigator.canShare) {
            // Fallback to copy link
            this.copyRecipeLink();
            return;
        }

        try {
            this.showLoadingIndicator("Memproses untuk share...");

            const recipeContainer = document.querySelector(".recipe-container");
            const canvas = await this.captureRecipeImage(recipeContainer);

            canvas.toBlob(
                async (blob) => {
                    try {
                        const file = new File(
                            [blob],
                            `resep-${this.slugify(recipeName)}.png`,
                            {
                                type: "image/png",
                            }
                        );

                        if (navigator.canShare({ files: [file] })) {
                            await navigator.share({
                                title: `Resep ${recipeName}`,
                                text: `Coba resep ${recipeName} ini!`,
                                files: [file],
                            });
                        } else {
                            // Fallback to share URL only
                            await navigator.share({
                                title: `Resep ${recipeName}`,
                                text: `Coba resep ${recipeName} ini!`,
                                url: window.location.href,
                            });
                        }

                        this.hideLoadingIndicator();
                    } catch (shareError) {
                        console.error("Share error:", shareError);
                        this.hideLoadingIndicator();
                        this.copyRecipeLink();
                    }
                },
                "image/png",
                0.9
            );
        } catch (error) {
            console.error("Share preparation error:", error);
            this.hideLoadingIndicator();
            this.copyRecipeLink();
        }
    }

    static copyRecipeLink() {
        if (navigator.clipboard) {
            navigator.clipboard
                .writeText(window.location.href)
                .then(() => {
                    this.showSuccessMessage("Link resep berhasil disalin!");
                })
                .catch(() => {
                    this.fallbackCopyTextToClipboard(window.location.href);
                });
        } else {
            this.fallbackCopyTextToClipboard(window.location.href);
        }
    }

    static fallbackCopyTextToClipboard(text) {
        const textArea = document.createElement("textarea");
        textArea.value = text;
        textArea.style.position = "fixed";
        textArea.style.left = "-999999px";
        textArea.style.top = "-999999px";
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();

        try {
            document.execCommand("copy");
            this.showSuccessMessage("Link resep berhasil disalin!");
        } catch (err) {
            this.showErrorMessage("Gagal menyalin link");
        }

        document.body.removeChild(textArea);
    }

    static async waitForImages(container) {
        const images = container.querySelectorAll("img");
        console.log(`Found ${images.length} images to wait for`); // Debug log

        const imagePromises = Array.from(images).map((img, index) => {
            return new Promise((resolve) => {
                if (img.complete && img.naturalHeight !== 0) {
                    console.log(`Image ${index + 1} already loaded`); // Debug log
                    resolve();
                } else {
                    console.log(
                        `Waiting for image ${index + 1} to load:`,
                        img.src
                    ); // Debug log

                    const timeout = setTimeout(() => {
                        console.log(`Image ${index + 1} timeout`); // Debug log
                        resolve();
                    }, 5000); // Increased timeout

                    img.onload = () => {
                        console.log(`Image ${index + 1} loaded successfully`); // Debug log
                        clearTimeout(timeout);
                        resolve();
                    };

                    img.onerror = () => {
                        console.log(`Image ${index + 1} failed to load`); // Debug log
                        clearTimeout(timeout);
                        resolve();
                    };

                    // For Cloudinary images, try to add crossorigin
                    if (img.src.includes("cloudinary")) {
                        img.crossOrigin = "anonymous";
                    }
                }
            });
        });

        await Promise.all(imagePromises);
        console.log("All images processed"); // Debug log
    }

    static async captureRecipeImage(container) {
        return await html2canvas(container, {
            backgroundColor: "#ffffff",
            scale: 2,
            useCORS: true,
            allowTaint: false,
            foreignObjectRendering: true,
            logging: false,
        });
    }

    static slugify(text) {
        return text
            .toString()
            .toLowerCase()
            .trim()
            .replace(/\s+/g, "-")
            .replace(/[^\w\-]+/g, "")
            .replace(/\-\-+/g, "-");
    }

    static showLoadingIndicator(message) {
        // Create or update loading indicator
        let loader = document.getElementById("export-loader");
        if (!loader) {
            loader = document.createElement("div");
            loader.id = "export-loader";
            loader.innerHTML = `
                <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; display: flex; justify-content: center; align-items: center;">
                    <div style="background: white; padding: 20px; border-radius: 8px; text-align: center;">
                        <div style="width: 40px; height: 40px; border: 4px solid #f3f3f3; border-top: 4px solid #3498db; border-radius: 50%; animation: spin 1s linear infinite; margin: 0 auto 10px;"></div>
                        <p style="margin: 0; font-weight: 500;">${message}</p>
                    </div>
                </div>
                <style>
                    @keyframes spin {
                        0% { transform: rotate(0deg); }
                        100% { transform: rotate(360deg); }
                    }
                </style>
            `;
            document.body.appendChild(loader);
        } else {
            loader.querySelector("p").textContent = message;
            loader.style.display = "block";
        }
    }

    static hideLoadingIndicator() {
        const loader = document.getElementById("export-loader");
        if (loader) {
            loader.remove();
        }
    }

    static showSuccessMessage(message) {
        this.showToast(message, "success");
    }

    static showErrorMessage(message) {
        this.showToast(message, "error");
    }

    static showToast(message, type) {
        // Create toast notification
        const toast = document.createElement("div");
        toast.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === "success" ? "#10b981" : "#ef4444"};
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            z-index: 10000;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transform: translateX(100%);
            transition: transform 0.3s ease;
        `;
        toast.textContent = message;

        document.body.appendChild(toast);

        // Animate in
        setTimeout(() => {
            toast.style.transform = "translateX(0)";
        }, 100);

        // Remove after 3 seconds
        setTimeout(() => {
            toast.style.transform = "translateX(100%)";
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 300);
        }, 3000);
    }
}

// Make it globally available
window.RecipeExporter = RecipeExporter;

export default RecipeExporter;
