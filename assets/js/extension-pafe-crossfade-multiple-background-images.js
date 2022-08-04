jQuery(document).ready(function( $ ) {

  function pafeCrossfadeMultipleBackgroundImages($element, $fadeOutSpeed){
    var $active = $element.find('.pafe-crossfade-multiple-background-images__item.active');
    var $next = ($active.next().length > 0) ? $active.next() : $element.find('.pafe-crossfade-multiple-background-images__item:first');
    $next.css('z-index','2');
    $active.fadeOut($fadeOutSpeed,function(){
      $active.css('z-index','1').show().removeClass('active');
      $next.css('z-index','3').addClass('active');
    });
  }

  $('[data-pafe-crossfade-multiple-background-images]').each(function(){
    var images = $(this).data('pafe-crossfade-multiple-background-images'),
        imagesArray = images.split(","),
        speed = $(this).data('pafe-crossfade-multiple-background-images-speed'),
        fadeOutSpeed =  $(this).data('pafe-crossfade-multiple-background-images-speed-fadeout');

    for (var i = 0; i < imagesArray.length; i++) {
      var classActive = '';
      if (i == 0) {
        var classActive = ' active';
      }
      $(this).append( '<div class="pafe-crossfade-multiple-background-images__item' + classActive + '" style="background-image:url(' + imagesArray[i] + ');"></div>' );
    }

    if (imagesArray.length > 1) {
      setInterval(pafeCrossfadeMultipleBackgroundImages, speed,  $(this), fadeOutSpeed);
    }
  });
  
});