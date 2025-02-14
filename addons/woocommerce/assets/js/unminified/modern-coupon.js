window.addEventListener('DOMContentLoaded', (event) => {
    customCoupon();
});

// Triggers Coupon.
function customCoupon() {
    const pageParentClass   = document.querySelector( 'div.woocommerce' );
    const wooAstraWrap      = document.querySelector( 'body' );
    
    if( pageParentClass && ( wooAstraWrap.classList.contains( 'woocommerce-checkout' ) || wooAstraWrap.classList.contains( 'woocommerce-cart' ) ) ) {
        const triggerCouponClick = (e) => {
            const realCouponInput            = document.querySelector( '#coupon_code' );
            const realCouponButton           = document.querySelector( 'button[name="apply_coupon"]' );
            const customCouponSelectorInput  = document.querySelector( '#ast-coupon-code' );
            const couponContentWrapper       = document.querySelector( '#ast-checkout-coupon .coupon' );
    
            // Show coupon field.
            if( couponContentWrapper && e.target && 'ast-coupon-trigger' === e.target.id ){
                couponContentWrapper.style.display  = "flex";
                e.target.style.display              = "none";
                customCouponSelectorInput?.focus();
            }
    
            // Adds value inside real input and triggers click.
            if( realCouponInput && realCouponButton && customCouponSelectorInput && e.target && 'ast-apply-coupon' === e.target.id ){
                // Remove the coupon error notice.
                document.querySelector( '.woocommerce-notices-wrapper .woocommerce-error.coupon-error-notice' )?.remove();
                realCouponInput.value = customCouponSelectorInput.value;
                realCouponButton.click();
            }
        }

        pageParentClass.addEventListener( 'click' ,function(e) {
            triggerCouponClick(e);
        } );

        // Trigger click for Coupon through Enter Key on Tab Navigation.
        pageParentClass.addEventListener('keypress', function (e) {
            const key = e.which || e.keyCode;
            if (key === 13) {
                document.querySelector( '#ast-apply-coupon' )?.click();
            }
        });

        // Listen for the 'applied_coupon' event on the document body.
        jQuery( document.body ).on( 'applied_coupon', () => {
            // Select the coupon error notice and the WooCommerce notices wrapper.
            const couponErrorNotice = document.querySelector( '.coupon-error-notice' );
            const wcNoticesWrapper = document.querySelector( '.woocommerce-notices-wrapper' );

            if ( couponErrorNotice && wcNoticesWrapper ) {
                // Append the coupon error notice to the WooCommerce notices wrapper.
                couponErrorNotice?.classList?.add( 'woocommerce-error' );
                wcNoticesWrapper?.append( couponErrorNotice );
            }
        } );

        // Listen for the 'applied_coupon_in_checkout' event on the document body.
        jQuery( document.body ).on( 'applied_coupon_in_checkout', () => {
            // Remove the error notice.
            document.querySelector( '#ast-checkout-coupon .coupon-error-notice' )?.remove();
            const couponErrorNotice = document.querySelector( '.coupon-error-notice' );
            if ( couponErrorNotice ) {
                document.querySelector( '#ast-checkout-coupon' )?.append( couponErrorNotice );
            }
        } );
    }
}




