document.addEventListener("DOMContentLoaded", function () {
	triggerFirstSlide();
	triggerGalleryImageMutation();
});

function triggerFirstSlide() {
	const sliderTrigger = document.querySelector(
		".woocommerce-product-gallery-thumbnails__wrapper div"
	);
	const variationWrap = jQuery(".single_variation_wrap");

	if (variationWrap && sliderTrigger) {
		variationWrap.on("show_variation", function (event, variation) {
			sliderTrigger.click();
		});
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
        console.warn('Main image element not found');
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

    const observer = new MutationObserver(function (mutationsList) {
        for (let mutation of mutationsList) {
            if (mutation.type === "attributes" && mutation.attributeName === "src") {
                const selectedVariationImageSrc = mutation.target?.getAttribute("src");

                const galleryImages = document.querySelectorAll(
                    ".woocommerce-product-gallery-thumbnails__wrapper .ast-woocommerce-product-gallery__image"
                );

                let foundInGallery = false;
                for (let i = 1; i < galleryImages.length; i++) {
                    const imageWrapper = galleryImages[i];
                    const image = imageWrapper?.querySelector("img");
                    if (!image) continue;
                    
                    const imageFound = image.src.includes(
                        mutation.target?.getAttribute("title")?.split(".")[0]
                    );
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

                            observer.observe(mainImageElement, { attributes: true });
                        }, 50);

                        break;
                    }
                }

                if (!foundInGallery) {
                    observer.disconnect();

                    if (galleryImages[0]) {
                        galleryImages[0]
                            .querySelector("img")
                            ?.setAttribute("src", selectedVariationImageSrc);
                    }
                    if (verticalGallery && typeof MoveSlide === "function") {
                        MoveSlide("prev", prevButton, nextButton);
                    }

                    observer.observe(mainImageElement, { attributes: true });
                }
            }
        }
    });

   // Start observing changes to the 'src' attribute of the main image element.
	mainImageElement && observer.observe(mainImageElement, { attributes: true });
}