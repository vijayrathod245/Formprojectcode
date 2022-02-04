/*$('.owl-carousel').owlCarousel({
                loop:false,
                margin:50,
                nav:true,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:2
                    },
                    1000:{
                        items:2
                    },
                    1200:{
                        items:2
                    }
                }
            });*/
jQuery(document).ready(function($){



// external js: isotope.pkgd.js

// init Isotope
var $grid = $('.grid').isotope({
  itemSelector: '.element-item',
  layoutMode: 'fitRows'
});
// filter functions
var filterFns = {
  // show if number is greater than 50
  numberGreaterThan50: function() {
    var number = $(this).find('.number').text();
    return parseInt( number, 10 ) > 50;
  },
  // show if name ends with -ium
  ium: function() {
    var name = $(this).find('.name').text();
    return name.match( /ium$/ );
  }
};
// bind filter button click
$('.filters-button-group').on( 'click', 'button', function() {
  var filterValue = $( this ).attr('data-filter');
  // use filterFn if matches value
  filterValue = filterFns[ filterValue ] || filterValue;
  $grid.isotope({ filter: filterValue });
});
// change is-checked class on buttons
$('.button-group').each( function( i, buttonGroup ) {
  var $buttonGroup = $( buttonGroup );
  $buttonGroup.on( 'click', 'button', function() {
    $buttonGroup.find('.is-checked').removeClass('is-checked');
    $( this ).addClass('is-checked');
  });
});

//
$("#headingOne").click(function(){
                $('#collapseOne').slideToggle('slow');
                $(this).toggleClass("toggle-arrow")
            });
			
//

//
var hides = "all";
        $('.filters ul li').click(function() {
        var include = $(this).attr("id");
        $("." + hides).slideUp();
        setTimeout(function() {
            $("." + include).slideDown()
        }, 500)
        hides = include;
        });

        /* CLICK BUTTON PORTFOLIO */
        $(".filters ul li").on("click", function() {
        $(".filters").find(".active").removeClass("active");
        $(this).addClass("active");
        });
//

/* Detail Page */

      $('.slick-master').slick({
        dots: true,
        arrows: false,
        autoplaySpeed: 3000,
        autoplay: true,
        responsive: [
        {
          breakpoint: 1024,
          settings: { 
            adaptiveHeight: true,
          },
        }        
      ],
      });
      $('.toggle').click(function () {
        $('#target').toggle('slow');
        $(this).toggleClass('active');
      });

});





