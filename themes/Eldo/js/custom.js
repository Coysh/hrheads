// Number counter
document.addEventListener("DOMContentLoaded", function(){

const counterUp = window.counterUp.default

const callback = entries => {
	entries.forEach( entry => {
		const el = entry.target
		if ( entry.isIntersecting && ! el.classList.contains( 'is-visible' ) ) {
			counterUp( el, {
				duration: 1000,
			} )
			el.classList.add( 'is-visible' )
		}
	} )
}

const IO = new IntersectionObserver( callback, { threshold: 1 } )

const el = document.querySelectorAll( '.counter:not(.no)' )
	el.forEach((el) => {
	IO.observe( el )
	});
});

	
var clickEvent = (function() {
  if ('ontouchstart' in document.documentElement === true)
    return 'touchstart';
  else
    return 'click';
})();

// jQuery
jQuery(document).ready(function($) {

		// To Top
		var pxScrolled = 200;
		var duration = 500;
		$(window).scroll(function() {
			if ($(this).scrollTop() > pxScrolled) {
				$('.fab-container').css({
					'bottom': '20px',
					'transition': '.3s'
				});
			} else {
				$('.fab-container').css({
					'bottom': '-72px'
				});
			}
		});
		// Click to scroll to top
		$('.to-top').click(function(){
			$('html, body').animate({scrollTop : 0},400);
			return false;
		});


		$('#category-select select').on('change', function(){
			$(this).closest('form').submit();
		});

		// Apply Form
		$('.button--apply').click(function(){
			$('#apply-form').toggleClass('open');
		});

		// Toggle sidebar
		$('.toggle-sidebar').click(function(){
			$('#sidebar').slideToggle();
		});

		// WOW
		wow = new WOW(
		{
			boxClass:     'anim',      // default
			animateClass: 'animated', // default
			offset:       10,          // default
			mobile:       false,       // default
			live:         true        // default
		});
		wow.init();

		$('.testimonial-slider').flickity({
			cellAlign: 'center',
			contain: true,
			pageDots: true,
			prevNextButtons: true,
			wrapAround: false,
			adaptiveHeight: false,
			autoPlay: false,
			imagesLoaded: true,
		});
		$('.slider').flickity({
			cellAlign: 'center',
			contain: true,
			pageDots: true,
			dragThreshold: 10,
			prevNextButtons: false,
			wrapAround: true,
			autoPlay: false,
			bgLazyLoad: 1,
		});
		$('.carousel').flickity({
			cellAlign: 'center',
			contain: true,
			pageDots: true,
			draggable: true,
			freeScroll: true,
			percentPosition: false,
			groupCells: true,
			imagesLoaded: true,
			prevNextButtons: false,
			wrapAround: true,
			autoPlay: 4000,
			selectedAttraction: 0.01,
			friction: 0.15,
		});


		// Custom mega menu
		$('.mega .has-sub').on("mouseover", function (e) {
		    e.preventDefault();
		    $('.menu-item.has-sub').removeClass('active');

		    $(this).addClass('active');

		    var id = $(this).attr("data-menu-id");
		    $('.sub').removeClass('show');
		    $('#menu-' + id).toggleClass('show');

		});
		// Close mega menu on hover
		$('.sub').mouseleave(function() {
		  $('.sub').removeClass('show');
		  $('.menu-item.has-sub').removeClass('active');
		})
		$('.mega .no-sub').on("mouseover", function (e) {
		    $('.sub').removeClass('show');
		    $('.menu-item.has-sub').removeClass('active');
		});

		// Smart Menus
		$('#header-menu').smartmenus({
		  hideOnClick: null,
		});
		$('#header-menu-desktop').smartmenus({
		  hideOnClick: null,
		});
		$('#mobile-menu').smartmenus({
		  hideOnClick: null,
		});
		$('#mobile-menu-standard').smartmenus({
		  hideOnClick: null,
		//   collapsibleBehavior: 'accordion',
		});

		// Menu Toggle Standard
		$('#menu-toggle.standard .toggle-wrap').on(clickEvent, function () {
	      $(this).toggleClass('active');
	      $('#mobile-menu-wrap').slideToggle('fast');
	  	});


		// Menu Toggle Fixed
		$('#menu-toggle.fixed .toggle-wrap').on(clickEvent, function () {
			$('#mobile-menu-overlay').fadeToggle('fast');
			$('body').addClass('menu-open');
			$('html').addClass('menu-open');
		});

		$('.close-menu').on(clickEvent, function () {
			$('#mobile-menu-overlay').fadeToggle('fast');
			$('body').removeClass('menu-open');
			$('html').removeClass('menu-open');
		});

		$('.grid.testimonials').isotope({
			itemSelector: '.grid-item',
			percentPosition: true,
			// resizable: false, // disable normal resizing
			layoutMode: 'masonry',
				// filter: '.*',
		});

		function getHashFilter() {
			var hash = location.hash;
			// get filter=filterName
			var matches = location.hash.match( /filter=([^&]+)/i );
			var hashFilter = matches && matches[1];
			return hashFilter && decodeURIComponent( hashFilter );
		  }
		  
		  $( function() {
		  
			var $grid = $('.grid.testimonials');
		  
			// bind filter button click
			var $filters = $('.filter').on( 'click', 'button', function() {
				alert
			  var filterAttr = $( this ).attr('data-filter');
			  // set filter in hash
			  location.hash = 'filter=' + encodeURIComponent( filterAttr );
			});
		  
			var isIsotopeInit = false;
		  
			function onHashchange() {
			  var hashFilter = getHashFilter();
			  if ( !hashFilter && isIsotopeInit ) {
				return;
			  }
			  isIsotopeInit = true;
			  // filter isotope
			  $grid.isotope({
				itemSelector: '.grid-item',
				filter: hashFilter
			  });
			  // set selected class on button
			  if ( hashFilter ) {
				$filters.find('.current').removeClass('current');
				$filters.find('[data-filter="' + hashFilter + '"]').addClass('current');
			  }
			}
		  
			$(window).on( 'hashchange', onHashchange );
			// trigger event handler to init Isotope
			onHashchange();
		  });

		$('.filter button').click(function(){
				$('.filter .current').removeClass('current');
				$(this).addClass('current');
				var selector = $(this).attr('data-filter');
				$('.grid.testimonials').isotope({
						filter: selector,

				});


				// Filter has
				var filterAttr = $( this ).attr('data-filter');
				// set filter in hash
				location.hash = 'filter=' + encodeURIComponent( filterAttr );

				return false;

				
		});


		// Tabs
		$('ul.tabs li').click(function(){
			var tab_id = $(this).attr('data-tab');
			$(this).parent().parent().find('.tab-content').removeClass('current');
			$(this).parent().find('li').removeClass('current');

			$(this).addClass('current');
			$("#"+tab_id).addClass('current');
		})

		// Jarallax
		// Jarallax
		let isIOS = (/iPad|iPhone|iPod/.test(navigator.platform) || (navigator.platform === 'MacIntel' && navigator.maxTouchPoints > 1)) && !window.MSStream;
		if (isIOS) {
		  // Do nothing
		} else {
		  // Jarallax
		  jarallax(document.querySelectorAll('.jarallax'), {
		      disableParallax: /iPad|iPhone|iPod|Android/,
		      disableVideo: /iPad|iPhone|iPod|Android/,
		      speed: 0.2
		  });
		}

		// Accordion
		$('.accordionmain').find('.accordion-toggle').on(clickEvent, function () {
				//Expand or collapse this panel
				$(this).next().slideToggle('fast');
				$(this).toggleClass('active');
				$(this).find('i').toggleClass(
						'rotate180');
				//Hide the other panels
		/*
				$(".accordion-content").not($(this).next()).slideUp(
						'fast');
				$(".accordion-toggle").not($(this)).removeClass(
						'active');
				$(".accordion-toggle").not($(this)).find(
						'.fa-arrow-circle-o-down').removeClass(
						'rotate180');
		*/
		});

		// Accordion first open

		$('.accordionmain').find('.accordion:first-child').find('.accordion-toggle').addClass('active');
		$('.accordionmain').find('.accordion:first-child').find('.accordion-toggle').find('i').addClass(
				'rotate180');
		$('.accordionmain').find('.accordion:first-child').find('.accordion-toggle').next().slideToggle('fast');


		// Fancybox
		$('[data-fancybox]').fancybox({
			backFocus: false,
		});
		
		$('[data-fancybox="image"]').fancybox({
		});


		$('[data-fancybox="group"]').fancybox({
			thumbs : {
				autoStart : true
			}
		})

		// Isotope
		$(window).on("load", function() {
			// $('.grid.team').isotope();
		//   $('.grid').isotope({
		//       itemSelector: '.grid-item',
		//   });
		//   $('.filter a').click(function(){
		//       $('.filter .current').removeClass('current');
		//       $(this).addClass('current');
		//       var selector = $(this).attr('data-filter');
		//       $('.grid').isotope({
		//           filter: selector,
		//        });
		//       return false;
		//   });
		});
});
