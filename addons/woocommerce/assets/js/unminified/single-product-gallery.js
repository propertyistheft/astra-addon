document.addEventListener("DOMContentLoaded", function () {
	triggerGalleryImageMutation();
	makeGalleryAccessible();
});

/**
 * Function to make gallery images keyboard accessible
 */
function makeGalleryAccessible() {
    // Select all gallery image wrappers
    const galleryImages = document.querySelectorAll(
        ".woocommerce-product-gallery-thumbnails__wrapper .ast-woocommerce-product-gallery__image"
    );

    if (!galleryImages.length) {
        return;
    }

    // Make each gallery image focusable and keyboard accessible
    galleryImages.forEach((imageWrapper, index) => {
        // Add tabindex to make the image wrapper focusable
        imageWrapper.setAttribute('tabindex', '0');
        
        // Get image alt text for better accessibility
        const image = imageWrapper.querySelector('img');
        const imageAlt = image ? (image.getAttribute('alt') || `Product image ${index + 1}`) : `Product image ${index + 1}`;
        
        // Add aria-label for screen readers
        imageWrapper.setAttribute('aria-label', `View ${imageAlt}`);
        
        // Add active state indicator for the currently selected image
        if (imageWrapper.classList.contains('flex-active-slide')) {
            imageWrapper.setAttribute('aria-current', 'true');
        } else {
            imageWrapper.setAttribute('aria-current', 'false');
        }
        
        // Add keyboard event listener for Enter and Space keys
        imageWrapper.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
                
                // Update aria states for all images
                galleryImages.forEach(img => {
                    img.setAttribute('aria-current', 'false');
                });
                
                // Set this image as the current one
                this.setAttribute('aria-current', 'true');
            }
            
            // Handle tab key on the last gallery image to ensure focus moves to the next element
            if (e.key === 'Tab' && !e.shiftKey && index === galleryImages.length - 1) {
                // Find the next focusable element after the gallery
                const gallery = document.querySelector('.ast-single-product-thumbnails');
                if (gallery) {
                    // Get all focusable elements on the page
                    const focusableElements = Array.from(
                        document.querySelectorAll('a[href], button, input, textarea, select, details, [tabindex]:not([tabindex="-1"])')
                    ).filter(el => {
                        // Filter out hidden elements
                        const style = window.getComputedStyle(el);
                        return style.display !== 'none' && style.visibility !== 'hidden';
                    });
                    
                    // Find the index of the current element
                    const currentIndex = focusableElements.indexOf(this);
                    
                    // Find the next focusable element
                    if (currentIndex !== -1 && currentIndex < focusableElements.length - 1) {
                        e.preventDefault();
                        focusableElements[currentIndex + 1].focus();
                    }
                }
            }
        });
        
        // Update aria states when clicked
        imageWrapper.addEventListener('click', function() {
            galleryImages.forEach(img => {
                img.setAttribute('aria-current', 'false');
            });
            
            this.setAttribute('aria-current', 'true');
        });
    });
    
    // Make navigation buttons accessible if they exist
    const prevButton = document.querySelector('.flex-prev');
    const nextButton = document.querySelector('.flex-next');
    
    if (prevButton) {
        prevButton.setAttribute('aria-label', 'Previous image');
        if (prevButton.classList.contains('flex-disabled')) {
            prevButton.setAttribute('aria-disabled', 'true');
        } else {
            prevButton.setAttribute('aria-disabled', 'false');
            prevButton.setAttribute('tabindex', '0');
        }
    }
    
    if (nextButton) {
        nextButton.setAttribute('aria-label', 'Next image');
        if (nextButton.classList.contains('flex-disabled')) {
            nextButton.setAttribute('aria-disabled', 'true');
        } else {
            nextButton.setAttribute('aria-disabled', 'false');
            nextButton.setAttribute('tabindex', '0');
        }
    }
}

/**
 * Function to change the gallery's first image to current selected variation image
 */
function triggerGalleryImageMutation() {
    const mainImageElement = document.querySelector(
        ".woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image img"
    );

    if (!mainImageElement) {
        return;
    }

	const defaultImageAttributes =
		mainImageElement
			?.getAttributeNames()
			.map((name) => ({ name, value: mainImageElement.getAttribute(name) })) ||
		[];
    defaultImageAttributes.push({ name: "srcset", value: "" });

    const verticalGallery = document.querySelector("#ast-vertical-slider-inner");
    const prevButton = document.querySelector("#ast-vertical-navigation-prev");
    const nextButton = document.querySelector("#ast-vertical-navigation-next");

    // Flag to prevent multiple observer processing.
    let isObserverProcessing = false;

    const observer = new MutationObserver((mutationsList) => {
        for (let mutation of mutationsList) {
            if (mutation.type === "attributes" && mutation.attributeName === "src") {
                // Bail early if we're in the middle of observer processing.
                if (isObserverProcessing) {
                    return;
                }

                // Start observer processing.
                isObserverProcessing = true;
                const selectedVariationImageSrc = mutation.target?.getAttribute("src");

                const galleryImages = document.querySelectorAll(
                    ".woocommerce-product-gallery-thumbnails__wrapper .ast-woocommerce-product-gallery__image"
                );

                const mutatedImgSrc = mutation.target?.getAttribute("data-src");

                let foundInGallery = false;
                // Skipping the first image as it's the featured image, and starting the loop from the second image from where gallery images starts.
                for (let i = 1; i < galleryImages.length; i++) {
                    const imageWrapper = galleryImages[i];
                    const image = imageWrapper?.querySelector("img");
                    if (!image) continue;

                    const galleryImgSrc = image?.getAttribute("data-original-src");
                    const imageFound = mutatedImgSrc === galleryImgSrc;
                    if (imageFound) {
                        foundInGallery = true;

                        observer.disconnect();

                        defaultImageAttributes.forEach(({ name, value }) =>
                            mainImageElement?.setAttribute(name, value)
                        );
                        setTimeout(() => {
                            imageWrapper?.click();
                            if (verticalGallery && typeof MoveSlide === "function") {
                                const imageHeight = image.clientHeight + 10;
                                verticalGallery?.setAttribute(
                                    "ast-translate",
                                    (i - 4) * imageHeight
                                );
                                MoveSlide("next", prevButton, nextButton);
                            }

                            isObserverProcessing = false;
                            observer.observe(mainImageElement, { attributes: true });
                        }, 50);

                        break;
                    }
                }

                if (!foundInGallery) {
                    observer.disconnect();

                    if (galleryImages[0]) {
                        const imageWrapper = galleryImages[0];
                        imageWrapper?.querySelector("img")?.setAttribute("src", selectedVariationImageSrc);
                        imageWrapper?.querySelector("img")?.setAttribute("data-original-src", mutatedImgSrc);
                        imageWrapper?.click();
                    }
                    if (verticalGallery && typeof MoveSlide === "function") {
                        MoveSlide("prev", prevButton, nextButton);
                    }

                    setTimeout( () => ( isObserverProcessing = false ) );
                    observer.observe(mainImageElement, { attributes: true });
                }
            }
        }
    });

    // Start observing changes to the 'src' attribute of the main image element.
	mainImageElement && observer.observe(mainImageElement, { attributes: true });
}