<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>APARTOLINO - Rent unique accomodation of professional providers.</title>

<link href="{!! url('/') !!}/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
<link href="{!! url('/') !!}/css/animate.min.css" type="text/css" rel="stylesheet" />
<link href="{!! url('/') !!}/css/jquery.fancybox.css" type="text/css" rel="stylesheet" />
<link href="{!! url('/') !!}/css/style.css" type="text/css" rel="stylesheet" />

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
   <script type="text/javascript" src="{!! url('/') !!}/js/custom/applogin.js"></script>   





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
        animation: "slide"
      });
    });


   @else
   $("#banner_id").attr('class', 'banner');
    $('.banner').parallax({imageSrc: '{!! url('/') !!}/vedio/banner.jpg'});
    $('.about-us').parallax({imageSrc: '{!! url('/') !!}/images/banner2.png'});
    $('.fancybox').fancybox();


    $(window).load(function() {
      $('.flexslider').flexslider({
        animation: "slide"
      });
    });
    
    @endif 
   
      
          
      });


</script>
</head>

<body>
@include('frontend.includes.header-links')

@yield('content')


@include('frontend.includes.footer')

<script>



   
  <?php 
  try{
  ?>
  @if($verify_mess == 1)
  $('#successMessage').html('<h1 style="color:green">Your Email Verified Successfully Please Login.</h1>'); 
  $.fancybox.open('#login');
  @endif
  <?php
    }
    catch (\Exception $e){

    }
  ?>
</script>  
  
</body>
</html>
