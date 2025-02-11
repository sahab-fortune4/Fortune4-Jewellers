require([
    'jquery',
    'jquery/ui'
], function($) {
    $(document).ready(function() {
        // Example: Toggle submenu on hover
        $('.level0').hover(function() {
            $(this).find('.level0').slideDown(200);
        }, function() {
            $(this).find('.level0').slideUp(200);
        });
    });
});

console.log("hii")
const myCarouselElement = document.querySelector('#homepageCarousel')

const carousel = new bootstrap.Carousel(myCarouselElement, {
  interval: 2000,
  touch: false
})