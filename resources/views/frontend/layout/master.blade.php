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
   <script type="text/javascript" src="{!! url('/') !!}/js/jquery.vide.js"></script>
<script type="text/javascript" src="{!! url('/') !!}/js/custom/master.js"></script>

 

<style>
#loading
{
    width: 16px;
    height: 16px;
    background:transparent url('loading.png') no-repeat 0 0;
    font-size: 0px;
    display: inline-block;

    .js-cookie-consent cookie-consent{
      text-align: center;
    }
}

</style>
<script type="text/javascript">

$(document).ready(function() {

  
    $("#block").vide("{{ url('/') }}/video/ocean");


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
<!-- Google Analitic -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-84963219-1', 'auto');
  ga('send', 'pageview');
  ga('create', 'UA-XXXXX-Y', 'auto');

  ga(function(tracker) {
    // Logs the tracker created above to the console.
    console.log(tracker);
  });

</script>
<!-- Google Analitic -->
<body>
@include('cookieConsent::index')
@include('frontend.includes.header')

@yield('content')

@include('frontend.includes.footer')

<script>




   
  <?php try{ ?>
    @if($verify_mess == 1)
      $('#successMessage').html('<h1 style="color:green">Your Email Verified Successfully Please Login.</h1>'); 
      $.fancybox.open('#login');
    @endif
  <?php } catch (\Exception $e){ } ?>

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
