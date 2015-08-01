/*!
 * Start Bootstrap - Agency Bootstrap Theme (http://startbootstrap.com)
 * Code licensed under the Apache License v2.0.
 * For details, see http://www.apache.org/licenses/LICENSE-2.0.
 */

// jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});

// Highlight the top nav as scrolling occurs
$('body').scrollspy({
    target: '.navbar-fixed-top'
})

// Closes the Responsive Menu on Menu Item Click
$('.navbar-collapse ul li a').click(function() {
    $('.navbar-toggle:visible').click();
});

$('#aboutTerms').on('hidden.bs.collapse', function () {
    $(this).find('a.collapsed div:first-child').html('<i class="fa fa-arrow-circle-o-right fa-fw"></i>');
});
$('#aboutTerms').on('shown.bs.collapse', function () {
    $(this).find('a').not('.collapsed').find('div:first-child').html('<i class="fa fa-arrow-circle-o-down fa-fw"></i>');
});

$(document).ready(function(){
    //Header animate
    headerAnimate();
    $(window).scroll(function(){
        headerAnimate();
    });
    $( window ).resize(function() {
        headerAnimate();
    });
});

function headerAnimate() {
    var thresHold = $('header').outerHeight();
    var top = $(window).scrollTop();
    if (top < thresHold) {
        $('.navbar-default').css('top',thresHold-top).removeClass('navbar-shrink');;
    }
    else {
        $('.navbar-default').css('top',0).addClass('navbar-shrink');;
    }
}