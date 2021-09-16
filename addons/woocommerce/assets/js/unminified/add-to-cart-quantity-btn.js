/**
 * WooCommerce quantity buttons.
 *
 * @package Astra Addon
 * @since 2.1.3
 */

window.addEventListener( "load", function(e) {
    astrawpWooQuantityButtons();
});

(function() {
    var send = XMLHttpRequest.prototype.send
    XMLHttpRequest.prototype.send = function() { 
        this.addEventListener('load', function() {
            astrawpWooQuantityButtons();
        })
        return send.apply(this, arguments)
    }
})();

/**
 * Astra WooCommerce Quantity Buttons.
 */
function astrawpWooQuantityButtons( $quantitySelector ) {

    var $cart = document.querySelector( '.woocommerce div.product form.cart' );

    if ( ! $quantitySelector ) {
        $quantitySelector = '.qty';
    }

    $quantityBoxesWrap = document.querySelectorAll( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' );

    for ( var i = 0; i < $quantityBoxesWrap.length; i++ ) {

        var e = $quantityBoxesWrap[i];
        
        var $quantityBoxes = e.querySelector( $quantitySelector );
        
        if ( $quantityBoxes && 'date' !== $quantityBoxes.getAttribute( 'type' ) && 'hidden' !== $quantityBoxes.getAttribute( 'type' ) ) {
            
            // Add plus and minus icons.
            $qty_parent = $quantityBoxes.parentElement;
            $qty_parent.classList.add( 'buttons_added' );
            $qty_parent.insertAdjacentHTML( 'afterbegin', '<label class="screen-reader-text" for="minus_qty">' + astraAddon.product_plus_minus_text.minus_qty + '</label><a href="javascript:void(0)" id ="minus_qty" class="minus">-</a>' );
            $qty_parent.insertAdjacentHTML( 'beforeend', '<label class="screen-reader-text" for="plus_qty"> '+ astraAddon.product_plus_minus_text.plus_qty + '</label><a href="javascript:void(0)" id ="plus_qty" class="plus">+</a>' );
            $quantityEach = document.querySelectorAll( 'input' + $quantitySelector + ':not(.product-quantity)' );
            
            for ( var j = 0; j < $quantityEach.length; j++ ) {
                
                var el = $quantityEach[j];
                
                var $min = el.getAttribute( 'min' );
                
                if ( $min && $min > 0 && parseFloat( el.value ) < $min ) {
                    el.value = $min;
                }
            }
            
            // Quantity input.
            var objBody = document.getElementsByTagName( 'BODY' )[0];
            if ( objBody.classList.contains( 'single-product' ) && ! $cart.classList.contains( 'grouped_form' ) ) {
                // Check for single product page.
                var $quantityInput = document.querySelector( '.woocommerce form input[type=number].qty' );
                $quantityInput.addEventListener( 'keyup' , function() {
                    var qty_val = $quantityInput.value;
                    $quantityInput.value = qty_val;
                });
            }

            var plus_minus_obj = e.querySelectorAll( '.plus, .minus' );
            
            for ( var l = 0; l < plus_minus_obj.length; l++ ) {
                
                var pm_el = plus_minus_obj[l];

                pm_el.addEventListener( "click", function(ev) {

                    // Quantity.
                    var $quantityBox;
                    
                    $quantityBox = ev.target.parentElement.querySelector( $quantitySelector );

                    // Get values.
                    var $currentQuantity = parseFloat( $quantityBox.value ),
                    $maxQuantity = parseFloat( $quantityBox.getAttribute( 'max' ) ),
                    $minQuantity = parseFloat( $quantityBox.getAttribute( 'min' ) ),
                    $step = $quantityBox.getAttribute( 'step' );

                    // Fallback default values.
                    if ( ! $currentQuantity || '' === $currentQuantity || 'NaN' === $currentQuantity ) {
                        $currentQuantity = 0;
                    }
                    if ( '' === $maxQuantity || 'NaN' === $maxQuantity ) {
                        $maxQuantity = '';
                    }

                    if ( '' === $minQuantity || 'NaN' === $minQuantity ) {
                        $minQuantity = 0;
                    }
                    if ( 'any' === $step || '' === $step || undefined === $step || 'NaN' === parseFloat( $step ) ) {
                        $step = 1;
                    }

                    // Change the value.
                    if ( ev.target.classList.contains( 'plus' ) ) {

                        if ( $maxQuantity && ( $maxQuantity == $currentQuantity || $currentQuantity > $maxQuantity ) ) {
                            $quantityBox.value = $maxQuantity;
                        } else {
                            $quantityBox.value = $currentQuantity + parseFloat( $step );
                        }

                    } else {

                        if ( $minQuantity && ( $minQuantity == $currentQuantity || $currentQuantity < $minQuantity ) ) {
                            $quantityBox.value = $minQuantity;
                        } else if ( $currentQuantity > 0 ) {
                            $quantityBox.value = $currentQuantity - parseFloat( $step );
                        }

                    }

                    // Trigger change event.
                    var event = document.createEvent( 'HTMLEvents' );
                    event.initEvent( 'change', true, false );
                    $quantityBox.dispatchEvent( event );

                }, false);             
            }
        }
    }
}