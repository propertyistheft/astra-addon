document.addEventListener("DOMContentLoaded", function () {
	triggerGalleryImageMutation();
});

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