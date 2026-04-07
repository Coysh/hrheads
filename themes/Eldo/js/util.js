jQuery(document).ready(function($) {

  // Smooth scrolling
  $('a[href^="#"]').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });


  // Add fancybox automatically
  $.fn.hasAttr = function(name) {
     return this.attr(name) !== undefined;
  };

  var imageLink = $("a[href$='.jpg'],a[href$='.jpeg'],a[href$='.png'],a[href$='.gif']");

  if($(imageLink).hasAttr('data-fancybox')) {
    // do nothing
  } else { // add fancybox
      $(imageLink).attr('data-fancybox', 'image');
  }

});
