(function($){

	/**
	 * Astra Advanced Headers 
	 *
	 * @class AstraPageTitle
	 * @since 1.0
	 */
	AstraPageTitle = {
		
		/**
		 * Initializes a Astra Advanced Headers.
		 *
		 * @since 1.0
		 * @method init
		 */ 
		init: function()
		{
			// Init backgrounds.
			AstraPageTitle._initBackgrounds();
			AstraPageTitle._initFullScreenHeight();
		},
		/**
		 * Initializes Page Parallax backgrounds that require
		 * parallax.
		 *
		 * @since 1.1.4
		 * @access private
		 * @method _initBackgrounds
		 */ 
		_initBackgrounds: function()
		{
			var win = $(window);
			
			// Init parallax backgrounds.
			if( $('.ast-advanced-headers-parallax').length > 0 ) {

				AstraPageTitle._scrollParallaxBackgrounds();
				win.on('scroll', AstraPageTitle._scrollParallaxBackgrounds);
				win.on('resize', AstraPageTitle._scrollParallaxBackgrounds);
			}
			
		},

		/**
		 * Fires when the window is scrolled to adjust
		 * a single parallax backgrounds.
		 *
		 * @since 1.1.4
		 * @access private
		 * @method _scrollParallaxBackgrounds
		 */ 
		_scrollParallaxBackgrounds: function()
		{

			$('.ast-advanced-headers-parallax').each(AstraPageTitle._scrollParallaxBackground);
		},
		/**
		 * Fires when the window is scrolled to adjust
		 * a single parallax background.
		 *
		 * @since 1.1.4
		 * @access private
		 * @method _scrollParallaxBackgrounds
		 */ 
		_scrollParallaxBackground: function()
		{

			var win     = $(window),
				row     = $(this),
				content = row,
				speed   = row.data('parallax-speed'),
				device   = row.data('parallax-device'),
				offset  = content.offset();
				yPos    = -((win.scrollTop() - offset.top) / speed);

				if( 'both' === device ) {
					content.css('background-position', 'center ' + yPos + 'px');
				} else if( 'desktop' === device ) {
					if( $( 'body' ).hasClass( 'ast-desktop' ) ) {
						content.css('background-position', 'center ' + yPos + 'px');
					} else {
						content.css('background-position', '');
					}
				} else {
					if( $( 'body' ).hasClass( 'ast-header-break-point' ) ) {
						content.css('background-position', 'center ' + yPos + 'px');
					} else {
						content.css('background-position', '');
					}
				}
		},
		/**
		 * Fires when the Advanced Headers full screen selected.
		 *
		 * @since 1.1.4
		 * @access private
		 * @method _initFullScreenHeight
		 */ 
		_initFullScreenHeight: function()
		{
			// Set up the resize timer
			var ResizeTime,
			    win     = $(window);
			if ( $('.ast-full-advanced-header')[0] ) {
				// Initiate full window height on resize
				AstraPageTitle._astraPageFullHeader();

				var width = win.width();
				win.resize(function() {
					if(win.width() != width){
						clearTimeout(ResizeTime);
						ResizeTime = setTimeout(AstraPageTitle._astraPageFullHeader, 200);
						width = win.width();
					}
				});
				
				win.on( "orientationchange", function( event ) {
					if(win.width() != width){
						clearTimeout(ResizeTime);
						ResizeTime = setTimeout(AstraPageTitle._astraPageFullHeader, 200);
						width = win.width();
					}
				});
			}
		},
		/**
		 * Fires when the Advanced Headers full screen selected.
		 *
		 * @since 1.1.4
		 * @access private
		 * @method _astraPageFullHeader
		 */ 
		_astraPageFullHeader: function()
		{
			// If we're not using a full screen element, bail.
			if ( ! $( '.ast-full-advanced-header' ).length )
				return;
			
			// Set up some variables
			var window_height = $( window ).height();
			
			// Get any space above our page header
			var offset = $(".ast-full-advanced-header").offset().top;

			// Apply the height to our div
			$( '.ast-full-advanced-header' ).css( 'height', window_height - offset + 'px' );

		},
	}

	/* Initializes the Astra Advanced Headers. */
	$(function(){
		AstraPageTitle.init();
	});

})(jQuery);