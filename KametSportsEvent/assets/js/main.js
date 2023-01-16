 (function($) {
     "use strict";

     // Convert All Image to SVG
     $('img.svg').each(function() {
         var $img = $(this),
             imgID = $img.attr('id'),
             imgClass = $img.attr('class'),
             imgURL = $img.attr('src');

         $.get(imgURL, function(data) {
             // Get the SVG tag, ignore the rest
             var $svg = $(data).find('svg');

             // Add replaced image's ID to the new SVG
             if (typeof imgID !== 'undefined') {
                 $svg = $svg.attr('id', imgID);
             }
             // Add replaced image's classes to the new SVG
             if (typeof imgClass !== 'undefined') {
                 $svg = $svg.attr('class', imgClass);
             }

             // Remove any invalid XML tags as per http://validator.w3.org
             $svg = $svg.removeAttr('xmlns:a');

             // Replace image with new SVG
             $img.replaceWith($svg);
         }, 'xml');

     });

     // Initialize MixITUp
     $('#plan-table').mixItUp({
         load: {
             filter: '.shared-hosting'
         },
         animation: {
             perspectiveDistance: '1000px'
         }
     });

     // Testimonial Slider
     $('.testimonial-slider').owlCarousel({
         loop: true,
         margin: 30,
         nav: false,
         autoplay: true,
         autoplayTimeout: 3000,
         autoplaySpeed: 1000,
         smartSpeed: 1000,
         dots: true,
         responsiveClass: true,
         responsive: {
             0: {
                 items: 1,
             },
             479: {
                 items: 1,
             },
             600: {
                 items: 1,
             },
             991: {
                 items: 2,
             },
             1000: {
                 items: 2,
             }
         }
     })

     //Testimonial Slider 2
     $('.testimonial-slider2').owlCarousel({
         loop: true,
         margin: 30,
         nav: false,
         autoplay: true,
         autoplayTimeout: 3000,
         autoplaySpeed: 1000,
         smartSpeed: 1000,
         dots: true,
         responsiveClass: true,
         responsive: {
             0: {
                 items: 1,
             },
             479: {
                 items: 1,
             },
             600: {
                 items: 1,
             },
             991: {
                 items: 1,
             },
             1000: {
                 items: 1,
             }
         }
     })

     // Partners Slider
     $('.partners-slider').owlCarousel({
         loop: true,
         margin: 30,
         nav: false,
         autoplay: false,
         autoplayTimeout: 3000,
         autoplaySpeed: 1000,
         smartSpeed: 1000,
         dots: false,
         responsiveClass: true,
         responsive: {
             0: {
                 items: 1,
             },
             479: {
                 items: 2,
             },
             600: {
                 items: 4,
             },
             991: {
                 items: 6,
             },
             1000: {
                 items: 6,
             }
         }
     });

     //Initilize tooltip
     $('[data-toggle="tooltip"]').tooltip();
     // Domain Name list
     $('.domN').hide();
     $('.down-btn').on('click', function() {
         $('.domN').slideToggle();
     });
     $('.domN li').on('click', function() {
         var innerElement = $(this).html();
         $('.domain-name-list > p').html(innerElement);
         $(this).parent().slideUp(200);
     });

     //Main Slider
     $('.main-slider2-content').owlCarousel({
             animateOut: 'fadeOut',
             animateIn: 'fadeIn',
             items: 1,
             loop: true,
             margin: 30,
             nav: false,
             autoplay: true,
             autoplayHoverPause: true,
             autoplayTimeout: 4000,
             autoplaySpeed: 1000,
             smartSpeed: 1000,
             dots: false,
             responsiveClass: true

         })
         //Testimonial Slider 3
     $('.testimonial-carousel-type3').owlCarousel({
         animateOut: 'fadeOutDown',
         animateIn: 'fadeIn',
         items: 1,
         loop: true,
         margin: 30,
         nav: false,
         autoplay: false,
         autoplayHoverPause: true,
         autoplayTimeout: 4000,
         autoplaySpeed: 1000,
         smartSpeed: 1000,
         dots: true,
         responsiveClass: true

     })

     // Mobile Menu
     $('.open-nav').on('click', function() {
         $(this).siblings('.sidenav').css({
             'width': '100%'
         });
     });
     $('.closebtn').on('click', function() {
         $(this).parent('.sidenav').css({
             'width': '0%'
         });
     });
     var childNav = $('.sidenav > ul > li');
     childNav.on('click', function() {
         $(this).children('ul').slideToggle(500);
         childNav.not($(this)).removeClass('active');
         $(this).toggleClass('active');
         $(this).siblings('li')
             .children('ul').slideUp();
     });
     //Preloader
     jQuery(window).load(function() {
         $('.preloader').fadeOut('slow');
     });
     // Scroll Top
     $(window).scroll(function() {
         if ($(this).scrollTop() > 1200) {
             $('.go-top').fadeIn();
             $('.go-top').removeClass('no-visibility');
         } else {
             $('.go-top').fadeOut();
         }
     });
     //// Animate the scroll to top
     $('.go-top').on('click', function(event) {
         event.preventDefault();
         $('html, body').animate({
             scrollTop: 0
         }, 2000);
     });

     // Google Map
     var googleMapSelector = $('#contactgoogleMap'),
         myCenter = new google.maps.LatLng(40.789886, -74.056700);

     function initialize() {
         var mapProp = {
             center: myCenter,
             zoom: 15,
             scrollwheel: false,
             mapTypeId: google.maps.MapTypeId.ROADMAP,
             styles: [{
                 "featureType": "administrative",
                 "elementType": "labels.text.fill",
                 "stylers": [{
                     "color": "#eee"
                 }]
             }, {
                 "featureType": "landscape",
                 "elementType": "all",
                 "stylers": [{
                     "color": "#eee"
                 }]
             }, {
                 "featureType": "poi",
                 "elementType": "all",
                 "stylers": [{
                     "visibility": "off"
                 }]
             }, {
                 "featureType": "road",
                 "elementType": "all",
                 "stylers": [{
                     "saturation": -100
                 }, {
                     "lightness": 45
                 }]
             }, {
                 "featureType": "road.highway",
                 "elementType": "all",
                 "stylers": [{
                     "visibility": "simplified"
                 }]
             }, {
                 "featureType": "road.arterial",
                 "elementType": "labels.icon",
                 "stylers": [{
                     "visibility": "off"
                 }]
             }, {
                 "featureType": "transit",
                 "elementType": "all",
                 "stylers": [{
                     "visibility": "off"
                 }]
             }, {
                 "featureType": "water",
                 "elementType": "all",
                 "stylers": [{
                     "color": "#267AE9"
                 }, {
                     "visibility": "on"
                 }]
             }]
         };
         var map = new google.maps.Map(document.getElementById("contactgoogleMap"), mapProp);
         var marker = new google.maps.Marker({
             position: myCenter,
             animation: google.maps.Animation.BOUNCE,
             icon: 'img/icon/map-icon.png'
         });
         marker.setMap(map);
     }
     if (googleMapSelector.length) {
         google.maps.event.addDomListener(window, 'load', initialize);
     }
     // Talk to Chat
     (function() {
         var s1 = document.createElement("script"),
             s0 = document.getElementsByTagName("script")[0];
         s1.async = true;
         s1.src = 'https://embed.tawk.to/57cabc981105e45f7b3ba9f7/default';
         s1.charset = 'UTF-8';
         s1.setAttribute('crossorigin', '*');
         s0.parentNode.insertBefore(s1, s0);
     })();

 })(jQuery);