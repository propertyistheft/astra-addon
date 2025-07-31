
const woocommerceGallery = document.querySelector( '.woocommerce-product-gallery__wrapper' );
const mediaQuery = window.matchMedia( '(min-width: 922px)' );

if (  woocommerceGallery && ! mediaQuery.matches ) {

    let slider = tns( {
        container: '.woocommerce-product-gallery__wrapper',
        items: 1,
        slideBy: 'page',
        mouseDrag: true,
        loop: false
    } );

    destroySlider( slider );
    triggerFirstSlide( slider );

    updateSlideAccessibility();
    slider.getInfo().container.addEventListener( 'transitionend', updateSlideAccessibility );
    setupKeyboardNavigation( slider );

	let resizeEnd;
    window.addEventListener('resize', function() {
        clearTimeout( resizeEnd );
        resizeEnd = setTimeout( function() {
            destroySlider( slider );
        }, 250 );   
    } );

}

function destroySlider( slider ) {
    const productGallery = document.querySelector( '.woocommerce-product-gallery__wrapper' );

    if( mediaQuery.matches && productGallery && productGallery.classList.contains('tns-slider') ) {
        slider.destroy();
    }
} 

function triggerFirstSlide( slider ) {
    const variationWrap = jQuery( '.single_variation_wrap' );

    if( variationWrap ) {
      variationWrap.on( "show_variation", function ( event, variation ) {
        slider.goTo('first');
      } );
    } 
}

// Improved accessibility by preventing focus on links inside hidden product gallery slides.
function updateSlideAccessibility() {
	const slides = document.querySelectorAll( '.woocommerce-product-gallery__wrapper .tns-item' );

	slides.forEach( function( slide ) {
		const isHidden = slide.getAttribute( 'aria-hidden' ) === 'true';
		const link = slide.querySelector( 'a' );

		if ( link ) {
			if ( isHidden ) {
				link.setAttribute( 'tabindex', '-1' );
				link.setAttribute( 'aria-hidden', 'true' );
			} else {
				link.removeAttribute( 'tabindex' );
				link.removeAttribute( 'aria-hidden' );
			}
		}
	} );

	const prevBtn = document.querySelector( '[data-controls="prev"]' );
	const nextBtn = document.querySelector( '[data-controls="next"]' );

	if ( prevBtn ) {
		const isPrevHidden = prevBtn.style.display === 'none' || 
		prevBtn.hasAttribute( 'disabled' ) || prevBtn.classList.contains( 'tns-button-disabled' );
		
		if ( isPrevHidden ) {
			prevBtn.setAttribute( 'tabindex', '-1' );
			prevBtn.setAttribute( 'aria-hidden', 'true' );
		} else {
			prevBtn.setAttribute( 'tabindex', '0' );
			prevBtn.removeAttribute( 'aria-hidden' );
		}		
		prevBtn.setAttribute( 'aria-label', 'Previous product image' );
	}

	if ( nextBtn ) {
		const isNextHidden = nextBtn.style.display === 'none' || 
		nextBtn.hasAttribute( 'disabled' ) || nextBtn.classList.contains( 'tns-button-disabled' );
		
		if ( isNextHidden ) {
			nextBtn.setAttribute( 'tabindex', '-1' );
			nextBtn.setAttribute( 'aria-hidden', 'true' );
		} else {
			nextBtn.setAttribute( 'tabindex', '0' );
			nextBtn.removeAttribute( 'aria-hidden' );
		}
		
		nextBtn.setAttribute( 'aria-label', 'Next product image' );
	}

	const paginationBtns = document.querySelectorAll( '.tns-nav button' );

	paginationBtns.forEach( function( btn, index ) {
		btn.setAttribute( 'tabindex', '-1' );
	} );
}

// Setup keyboard navigation for gallery controls
function setupKeyboardNavigation( slider ) {
	const prevBtn = document.querySelector( '[data-controls="prev"]' );
	const nextBtn = document.querySelector( '[data-controls="next"]' );
	
	if ( prevBtn ) {
		prevBtn.addEventListener( 'keydown', function( e ) {
			if ( e.key === 'Enter' || e.key === ' ' ) {
				e.preventDefault();
				if ( !prevBtn.hasAttribute( 'aria-hidden' ) && prevBtn.getAttribute( 'tabindex' ) !== '-1' ) {
					slider.goTo( 'prev' );
				}
			}
		} );
	}
	
	if ( nextBtn ) {
		nextBtn.addEventListener( 'keydown', function( e ) {
			if ( e.key === 'Enter' || e.key === ' ' ) {
				e.preventDefault();
				if ( !nextBtn.hasAttribute( 'aria-hidden' ) && nextBtn.getAttribute( 'tabindex' ) !== '-1' ) {
					slider.goTo( 'next' );
				}
			}
		} );
	}
}
