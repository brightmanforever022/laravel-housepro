<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>APARTOLINO - Rent unique accomodation of professional providers.</title>

<link rel="icon" href="{!! url('/') !!}/images/favicon.png" type="image/png" sizes="16x16">
<link href="{!! url('/') !!}/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
<link href="{!! url('/') !!}/css/animate.min.css" type="text/css" rel="stylesheet" />
<link href="{!! url('/') !!}/css/jquery.fancybox.css" type="text/css" rel="stylesheet" />
<link href="{!! url('/') !!}/css/style.css" type="text/css" rel="stylesheet" />
<link href="{!! url('/') !!}/css/flexslider.css" type="text/css" rel="stylesheet" />

<link rel="stylesheet" type="text/css" href="{!! url('/') !!}/css/bootstrap-datepicker.css">
<link href="{!! url('/') !!}/css/bootstrap-material-design.css" type="text/css" rel="stylesheet" />

{{-- <link href="{!! url('/') !!}/css/css/jquery.datepick.css" rel="stylesheet"> --}}

<link href="{!! url('/') !!}/css/fullcalendar.min.css" type="text/css" rel="stylesheet" />
<!-- <link rel="stylesheet" type="text/css" href="https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.min.css"> -->

<script type="text/javascript">
      var base_url = '{!! url('/') !!}';
      @if(Auth::check())
      var paypal = '{!! Auth::user()->paypal_email !!}';
      @endif
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script type="text/javascript" src="{!! url('/') !!}/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{!! url('/') !!}/js/animation.js"></script>
<script type="text/javascript" src="{!! url('/') !!}/js/parallax.min.js"></script>
<script type="text/javascript" src="{!! url('/') !!}/js/jquery.xgallerify.js"></script>
<script type="text/javascript" src="{!! url('/') !!}/js/jquery.fancybox.js"></script>
<script type="text/javascript" src="{!! url('/') !!}/js/jquery.gray.min.js"></script>
<script type="text/javascript" src="{!! url('/') !!}/js/jquery.flexslider.js"></script>

<script type="text/javascript" src="{!! url('/') !!}/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="{!! url('/') !!}/js/additional-methods.min.js"></script>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDva_vadLUrg0CqnkTzkZOdmX72tcO7a0E&libraries=places"></script>
<script type="text/javascript" src="{!! url('/') !!}/js/parallaxjx.min.js"></script>
<script type="text/javascript" src="{!! url('/') !!}/js/jquery.MultiFile.js"></script>
<script type="text/javascript" src="{!! url('/') !!}/js/material.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js"></script>

@yield('custom-javascript')
{{-- <script type="text/javascript" src="https://fullcalendar.io/js/fullcalendar-3.1.0/lib/jquery-ui.min.js"></script> --}}
<!-- <script type="text/javascript" src="{!! url('/') !!}/js/fullcalendar.js"></script> -->
<script type="text/javascript" src="{!! url('/') !!}/js/fullcalendar.js"></script>
<script type="text/javascript" src="{!! url('/') !!}/js/jquery.vide.js"></script>
<script type="text/javascript" src="{!! url('/') !!}/js/custom/masterprofile.js"></script>
<script type="text/javascript" src="{!! url('/') !!}/js/jquery.sticky-div.js"></script>
<script type="text/javascript" src="{!! url('/') !!}/js/sortable.min.js"></script>

{{-- <script src="{!! url('/') !!}/js/js/jquery.plugin.min.js"></script>
<script src="{!! url('/') !!}/js/js/jquery.datepick.js"></script> --}}

<script type="text/javascript">


$(document).ready(function() {    

    @if (Request::path() == 'help')
    $("#banner_id").attr('class', 'howitworks');
    $('.howitworks').parallax({imageSrc: 'images/howitwork.jpg'});
    $('.savetime').parallax({imageSrc: 'images/savetime.jpg'});
    $('.fancybox').fancybox();
    
    $(window).load(function() {
      $('.flexslider').flexslider({
              touch: true,
              slideshow: false,
              controlNav: true,
              slideshowSpeed: 7000,
              animationSpeed: 600,
              initDelay: 0,
              start: function(slider) { // Fires when the slider loads the first slide
                var slide_count = slider.count - 1;

                $(slider)
                  .find('img.lazy:eq(0)')
                  .each(function() {
                    var src = $(this).attr('data-src');
                    $(this).attr('src', src).removeAttr('data-src');
                  });
              },
              before: function(slider) { // Fires asynchronously with each slider animation
                var slides     = slider.slides,
                    index      = slider.animatingTo,
                    $slide     = $(slides[index]),
                    $img       = $slide.find('img[data-src]'),
                    current    = index,
                    nxt_slide  = current + 1,
                    prev_slide = current - 1;

                $slide
                  .parent()
                  .find('img.lazy:eq(' + current + '), img.lazy:eq(' + prev_slide + '), img.lazy:eq(' + nxt_slide + ')')
                  .each(function() {
                    var src = $(this).attr('data-src');
                    $(this).attr('src', src).removeAttr('data-src');
                  });
              }
            });
    });


   @else
   $("#banner_id").attr('class', 'banner');
    $('.banner').parallax({imageSrc: '{!! url('/') !!}/images/banner.jpg'});
    $('.about-us').parallax({imageSrc: '{!! url('/') !!}/images/banner2.png'});
    $('.fancybox').fancybox();


    $(window).load(function() {
      $('.flexslider').flexslider({
              touch: true,
              slideshow: false,
              controlNav: true,
              slideshowSpeed: 7000,
              animationSpeed: 600,
              initDelay: 0,
              start: function(slider) { // Fires when the slider loads the first slide
                var slide_count = slider.count - 1;

                $(slider)
                  .find('img.lazy:eq(0)')
                  .each(function() {
                    var src = $(this).attr('data-src');
                    $(this).attr('src', src).removeAttr('data-src');
                  });
              },
              before: function(slider) { // Fires asynchronously with each slider animation
                var slides     = slider.slides,
                    index      = slider.animatingTo,
                    $slide     = $(slides[index]),
                    $img       = $slide.find('img[data-src]'),
                    current    = index,
                    nxt_slide  = current + 1,
                    prev_slide = current - 1;

                $slide
                  .parent()
                  .find('img.lazy:eq(' + current + '), img.lazy:eq(' + prev_slide + '), img.lazy:eq(' + nxt_slide + ')')
                  .each(function() {
                    var src = $(this).attr('data-src');
                    $(this).attr('src', src).removeAttr('data-src');
                  });
              }
            });
    });
    
    @endif 
   

    
});


</script>
</head>

<body>
<?php
//To show number of booking in host panel
if(Auth::check() && Auth::user()->user_type == 1)
{
    $count_new_bookings = App\Property::where('property_booking_status', 0)->where('booking_id','>', 0)->where('user_id', Auth::user()->id)->count();
    
} 
?>


@include('frontend.includes.header-profile')

@yield('content')

@include('frontend.includes.footer')

<script>
    // if ( ! Modernizr.objectfit ) {
    //     $('figure img').each(function () {
    //         var $container = $(this).parent('figure'),
    //         imgUrl = $(this).prop('src');
    //         thisClass = $(this).prop('class');
    //         thisHeight = $(this).height();
    //         thisWidth = $(this).width();
    //         if (imgUrl) {
    //             $container
    //                 .css('backgroundImage', 'url(' + imgUrl + ')')
    //                 .css('width', thisWidth)
    //                 .css('height', thisHeight)
    //                 .addClass(thisClass + ' compat-object-fit');
    //         }
    //         $(this).addClass('hide');
    //     });
    // }
    // 
    if ( ! Modernizr.objectfit && GetIEVersion() > 0 ) {
        $('figure img').each(function () {
            var $container = $(this).parent('figure'),
            imgUrl = $(this).prop('src');
            thisClass = $(this).prop('class');
            thisHeight = $(this).height();
            thisWidth = $(this).width();
            if (imgUrl) {
                $container
                    .css('backgroundImage', 'url(' + imgUrl + ')')
                    .css('width', thisWidth)
                    .css('height', thisHeight)
                    .addClass(thisClass + ' compat-object-fit');
            }
            $(this).addClass('hide');
        });
    }
    function GetIEVersion() {
        var sAgent = window.navigator.userAgent;
        var Idx = sAgent.indexOf("MSIE");

        // If IE, return version number.
        if (Idx > 0) 
            return parseInt(sAgent.substring(Idx+ 5, sAgent.indexOf(".", Idx)));

        // If IE 11 then look for Updated user agent string.
        else if (!!navigator.userAgent.match(/Trident\/7\./)) 
            return 11;

        else
            return 0; //It is not IE
    }
    

</script>

</body>
</html>
