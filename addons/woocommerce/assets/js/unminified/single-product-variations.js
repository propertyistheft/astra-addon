const productVariation = () => {
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
            } );
        } );
    }

    if( productSingleVariations ) {
        productSingleVariations.forEach( element => {

            // Single Product Variation Buttons.
            element.addEventListener( 'click', (e) => {
                const allVariationButtons = e.target.closest( '.ast-variation-button-group' );

                if( allVariationButtons ) {
                    const allVariationButtonSingle = allVariationButtons.querySelectorAll( '.ast-single-variation' );
                    if( allVariationButtonSingle ) {
                        allVariationButtonSingle.forEach( element => {
                            element.classList.remove( 'active' );
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
                                const buttonList = buttons.querySelectorAll( '.ast-single-variation');

                                buttonList.forEach( element => {
                                    if( ! node.includes( element.getAttribute('data-slug') ) ) {
                                        element.style.opacity = '.5';
                                        element.style.pointerEvents = 'none';
                                    } else {
                                        element.style.opacity = '1';
                                        element.style.pointerEvents = 'inherit';
                                    }

                                } );

                            } );
                        }, 100 );
                    }
                }

                const currentSlug   = e.target.getAttribute( 'data-slug' );
                const currentTarget = e.target.closest( 'td' ).querySelector( 'select' );

                // On Variation Change Trigger Hidden Select.
                if( currentSlug && currentTarget ) {
                    e.target.classList.add( 'active' );
                    currentTarget.value = currentSlug;
                    currentTarget.dispatchEvent( new Event( 'change', { 'bubbles': true } ) )
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
