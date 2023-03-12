// Webpack Imports
import * as bootstrap from 'bootstrap';
//import 'select2';
import 'bootstrap-cookie-alert';




(function($) {
    'use strict';

    // Focus input if Searchform is empty
    // [].forEach.call(document.querySelectorAll('.search-form'), (el) => {
    //     el.addEventListener('submit', function(e) {
    //         var search = el.querySelector('input');
    //         if (search.value.length < 1) {
    //             e.preventDefault();
    //             search.focus();
    //         }
    //     });
    // });

    // Initialize Popovers: https://getbootstrap.com/docs/5.0/components/popovers
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl, {
            trigger: 'focus',
        });
    });
    var myCarousel = document.querySelector('#carouselMainSlider')
    if (myCarousel !== null) {
        var carousel = new bootstrap.Carousel(myCarousel)
    }

    var swiperArt = new Swiper('.swiper-bestseller', {
        slidesPerView: '4',
        spaceBetween: 47,

        // pagination: {
        //     el: '.swiper-pagination',
        //     clickable: true,
        // },
        breakpoints: {
            1200: {
                slidesPerView: 4,

            },
            1024: {
                slidesPerView: 3,

            },
            768: {
                slidesPerView: 2,

            },
            640: {
                slidesPerView: 1,


            },
            1: {
                slidesPerView: 1,

            }
        },
        navigation: {
            nextEl: '[data-arrow="best-next"]',
            prevEl: '[data-arrow="best-prev"]'
        }
    });





    jQuery('.orderby').select2({
        minimumResultsForSearch: Infinity
    });

    var timeout;
    jQuery(document).on('change', 'input.qty', function() {

        if (timeout !== undefined) {
            clearTimeout(timeout);
        }

        timeout = setTimeout(function() {
            jQuery("[name='update_cart']").trigger("click");
        }, 1000); // 1 second delay, half a second (500) seems comfortable too

    });

    window.addEventListener("cookieAlertAccept", function() {

    })



    // Dealing with Textarea Height
    function calcHeight(value) {
        let numberOfLineBreaks = (value.match(/\n/g) || []).length;
        // min-height + lines x line-height + padding + border
        let newHeight = 59 + numberOfLineBreaks * 21 + 30;
        return newHeight;
    }

    let textarea = document.querySelector("#order_comments");
    if (textarea) {
        textarea.addEventListener("keyup", () => {
            textarea.style.height = calcHeight(textarea.value) + "px";
        });
    }

    // Filtry

    jQuery(document).on("click", '[data-action="open-filter"]', function() {

        console.log('fsfsd')
        jQuery('[data-item="filter"]').toggle();
    })

})();