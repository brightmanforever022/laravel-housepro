@extends('frontend.layout.master')

@section('content')

<script>
setTimeout(function() {
            $('.errorMessage').fadeOut('fast');
            }, 10000);
</script>
<div class="business_appartment">
	<div class="container">
    	<div class="row">
        	<div class="col-md-12">
            	<h1 class="wow fadeIn">Where do you want to go ?</h1>
                <p class="wow fadeIn">Discover Business Apartments in all of Switzerland</p>
            </div>
        </div>
        <div class="row mar-t30">
        	<div class="col-md-4 col-sm-6">
            	<a href="">
                	<figure>
                    	<img src="{!! url('/') !!}/images/img1.jpg" class="grayscale grayscale-fade"/>
                		<div class="text">Zurich</div>
                	</figure>
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
            	<a href="">
                	<figure>
                    	<img src="{!! url('/') !!}/images/img1.jpg" class="grayscale grayscale-fade"/>
                		<div class="text">Bern</div>
                	</figure>
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
            	<a href="">
                	<figure>
                    	<img src="{!! url('/') !!}/images/img1.jpg" class="grayscale grayscale-fade"/>
                		<div class="text">Basel</div>
                	</figure>
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
            	<a href="">
                	<figure>
                    	<img src="{!! url('/') !!}/images/img1.jpg" class="grayscale grayscale-fade"/>
                		<div class="text">Luzern</div>
                	</figure>
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
            	<a href="">
                	<figure>
                    	<img src="{!! url('/') !!}/images/img1.jpg" class="grayscale grayscale-fade"/>
                		<div class="text">Lausanne</div>
                	</figure>
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
            	<a href="">
                	<figure>
                    	<img src="{!! url('/') !!}/images/img1.jpg" class="grayscale grayscale-fade"/>
                		<div class="text">Genf</div>
                	</figure>
                </a>
            </div>
            <div class="col-md-12">
            	<a href="" class="see_more_btn wow fadeIn" data-wow-duration="2s">SEE MORE CITIES</a>
            </div>
        </div>
    </div>
</div>


<div class="latest_offer">
	<div class="container">
    	<div class="row">
        	<div class="col-md-12">
            	<h1 class="wow fadeIn">New Business Apartments</h1>
                <p class="wow fadeIn">Discover the latest offers</p>
            </div>
        </div>
        <div class="row mar-t30">
            <div class="col-md-4 col-sm-6">
                <a href="">
                    <figure>
                        <img src="{!! url('/') !!}/images/img4.jpg" class="grayscale grayscale-fade"/>
                        <div class="text">
                            <span>Zurich</span>
                            <p>CHF 85</p>
                        </div>
                    </figure>
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="">
                    <figure>
                        <img src="{!! url('/') !!}/images/img2.jpg" class="grayscale grayscale-fade"/>
                        <div class="text">
                            <span>Bern</span>
                            <p>CHF 85</p>
                        </div>
                    </figure>
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="">
                    <figure>
                        <img src="{!! url('/') !!}/images/img3.jpg" class="grayscale grayscale-fade"/>
                        <div class="text">
                            <span>Basel</span>
                            <p>CHF 85</p>
                        </div>
                    </figure>
                </a>
            </div>
            <div class="col-md-8 col-sm-6">
                <a href="">
                    <figure>
                        <img src="{!! url('/') !!}/images/img5.jpg" class="grayscale grayscale-fade"/>
                        <div class="text">
                            <span>Bern</span>
                            <p>CHF 85</p>
                        </div>
                    </figure>
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="">
                    <figure>
                        <img src="{!! url('/') !!}/images/img4.jpg" class="grayscale grayscale-fade"/>
                        <div class="text">
                            <span>Bern</span>
                            <p>CHF 85</p>
                        </div>
                    </figure>
                </a>
            </div>
        </div>
   </div>
</div>
@include('frontend.includes.about-us')
@include('frontend.includes.popups_verify')

@endsection

