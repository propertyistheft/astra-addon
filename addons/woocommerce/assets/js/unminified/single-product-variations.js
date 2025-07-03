const triggerActiveAttributeButton = () => {
    const activeAttributeButton = document.querySelector('.ast-variation-button-group .ast-single-variation.active');
    if (activeAttributeButton) {
        activeAttributeButton.click();
    }
};

const productVariation = (image_slider_wrap) => {
    const productSingleVariations = document.querySelectorAll( '.ast-single-variation' );
    const productVariationReset   = document.querySelector( '.reset_variations' );

    // Resets Buttons on Clear Button.
    if( productVariationReset ) {
        productVariationReset.addEventListener( 'click', (e) => {
            const allVariationButtons = document.querySelectorAll( '.ast-single-variation' );
            allVariationButtons.forEach( element => {
                element.classList.remove( 'active' );
                element.style.opacity = '1';
                element.style.pointerEvents = 'inherit';
                element.setAttribute('aria-pressed', 'false');
            } );
        } );
    }

    // Add accessibility attributes to all variation buttons
    const setupAccessibility = () => {
        const variationButtons = document.querySelectorAll('.ast-single-variation');
        variationButtons.forEach((button, index) => {
            // Make sure each button is focusable
            button.setAttribute('tabindex', '0');
            
            // Add proper ARIA attributes
            button.setAttribute('role', 'button');
            button.setAttribute('aria-pressed', button.classList.contains('active') ? 'true' : 'false');
            
            // Get the variation name for better accessibility
            const variationName = button.getAttribute('data-slug') || 'variation option';
            const variationGroup = button.closest('.ast-variation-button-group');
            const attributeName = variationGroup && variationGroup.previousElementSibling ? 
                variationGroup.previousElementSibling.textContent.trim() : 'Product variation';
            
            button.setAttribute('aria-label', `${attributeName}: ${variationName}`);
        });
    };

    // Run accessibility setup
    setupAccessibility();

    if( productSingleVariations ) {
        productSingleVariations.forEach( element => {
            // Handle keyboard interactions
            element.addEventListener('keydown', (e) => {
                // Handle Enter or Space key to activate the button
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    element.click();
                }
            });

            // Single Product Variation Buttons.
            element.addEventListener( 'click', (e) => {
                const allVariationButtons = e.target.closest( '.ast-variation-button-group' );

                if( allVariationButtons ) {
                    const allVariationButtonSingle = allVariationButtons.querySelectorAll( '.ast-single-variation' );
                    if( allVariationButtonSingle ) {
                        allVariationButtonSingle.forEach( element => {
                            element.classList.remove( 'active' );
                            element.setAttribute('aria-pressed', 'false');
                        } );
                    }
                }

                const allVariationContainer = document.querySelector( '.ast-product-single-variable form .variations' )

                if( allVariationContainer ) {
                    allVariationSelector = allVariationContainer.querySelectorAll( 'select' );
                    allVariationButton   = allVariationContainer.querySelectorAll( '.ast-variation-button-group' );

                    // Enables and Disables Variation Buttons.
                    if( allVariationSelector && allVariationButton ) {
                        setTimeout( () => {
                            allVariationSelector.forEach( select => {
                                const options = select.querySelectorAll('option');
                                const node = [];

                                options.forEach( element => {
                                    node.push( element.getAttribute('value') );
                                });

                                const buttons = select.nextElementSibling;
                                const buttonList = buttons !== null ? buttons.querySelectorAll('.ast-single-variation') : null;                                

                                if (buttonList !== null) {
                                    buttonList.forEach(button => {
                                        buttonList.forEach( element => {
                                            if( ! node.includes( element.getAttribute('data-slug') ) ) {
                                                element.style.opacity = '.5';
                                                element.style.pointerEvents = 'none';
                                                element.setAttribute('aria-disabled', 'true');
                                                element.setAttribute('tabindex', '-1');
                                            } else {
                                                element.style.opacity = '1';
                                                element.style.pointerEvents = 'inherit';
                                                element.setAttribute('aria-disabled', 'false');
                                                element.setAttribute('tabindex', '0');
                                            }
                                        } );
                                    });
                                }
                            } );
                        }, 100 );
                    }
                }

                const currentSlug   = e.target.getAttribute( 'data-slug' );
                const currentTarget = e.target.closest( 'td' ).querySelector( 'select' );

                // On Variation Change Trigger Hidden Select.
                if( currentSlug && currentTarget ) {
                    e.target.classList.add( 'active' );
                    e.target.setAttribute('aria-pressed', 'true');
                    currentTarget.value = currentSlug;
                    currentTarget.dispatchEvent( new Event( 'change', { 'bubbles': true } ) )

                    // Triggering the active Attribute button to ensure the state is updated
                    triggerActiveAttributeButton();
                }

                if (image_slider_wrap != null) {
					image_slider_wrap.flexslider(0);
				}
            } );
        } );
    }
}

document.addEventListener("DOMContentLoaded", function(event) {
    productVariation();
});

document.addEventListener( "astUpdateSingleProductVariations", function() {
	productVariation();
});

// Composite product plugin compatibility.
jQuery('.composite_data').on('wc-composite-initializing', function (event, composite) {
    composite.actions.add_action('component_scripts_initialized', function () {
        productVariation();
    }, 100)
});

// Adding Function to read URL parameters dynamically.
document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);

    urlParams.forEach((value, key) => {
        const variationButton = document.querySelector(`.ast-single-variation[data-slug="${value}"]`);

        if (variationButton) {
            variationButton.classList.add('active');
            const selectElement = document.querySelector(`select[name="${key}"]`);
            if (selectElement) {
                selectElement.value = value;
                selectElement.dispatchEvent(new Event('change', { bubbles: true }));
            }
        }
    });
});
