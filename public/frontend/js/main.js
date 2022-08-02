
jQuery(document).ready(function () {

    // slider-active
    $('.slider-active').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        autoplay:true,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 3,
              infinite: true,
              dots: false
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
      });

    /** Product carousel**/
    $(".product-active").owlCarousel({
        loop: false,
        autoplay: false,
        margin: 30,
        navText: ['Prev', 'Next'],
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            568: {
                items: 2,
                nav: false
            },
            768: {
                items: 2,
                nav: true
            },
            992: {
                items: 3,
                nav: true
            },
            1000: {
                items: 4,
                nav: true,
            }
        }
    });
    /** brand carousel**/
    $(".brand-active").owlCarousel({
        loop: true,
        autoplay: false,
        nav: false,
        navText: ['Prev', 'Next'],
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
                nav: false
            },
            576: {
                items: 3,
                nav: false
            },
            768: {
                items: 4,
                nav: false
            },
            1000: {
                items: 6,
                loop: true
            }
        }
    });
    // main menu

    $('#mobile-menu-active').meanmenu(
        {
            meanMenuContainer: '.mobile-menu',
            meanScreenWidth: "768"
        }
    )
    //   tree veiw
    var toggler = document.getElementsByClassName("caret");
    var i;

    for (i = 0; i < toggler.length; i++) {
        toggler[i].addEventListener("click", function () {
            this.parentElement.querySelector(".nested").classList.toggle("active");
            this.classList.toggle("caret-down");
        });
    }
    // nice select
    $('select').niceSelect();


});// Ready function End
