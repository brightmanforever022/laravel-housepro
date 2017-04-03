@extends('frontend.layout.applogin')

@section('content')
<div class="aboutus">
	<div class="container">
    	<div class="row">
        	<div class="col-md-12">
            	<h1 class="wow fadeIn animated" data-wow-duration="2s">IMPRINT</h1>
            </div>
        </div>
        <div class="row">
        	<div class="col-md-12">
            	<div class="imprint">
                    <h1>APPARTOLINO GmbH</h1>
                    <p>Zürcherstrasse 137</p>
                    <p>8406 Winterthur</p>
                    <p>Switzerland</p>
                    <p class="mar-t50"><strong>Managing Director :</strong><!--  Raphael Michel --></p>
                    <p><strong>Comapany registration number :</strong></p>
                    <p><strong>VAT Nr. :</strong></p>
                    <p class="mar-t50"><strong>Contact us per E-Mail :</strong></p>
                    <p>support@appartolino.ch</p>
                    <!-- <hr> -->
                </div>
            </div>
        </div>
    </div>
</div>

@include('frontend.includes.popups')

@endsection
