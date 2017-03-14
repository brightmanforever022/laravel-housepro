@extends('frontend.layout.master')

@section('content')
<script type="text/javascript">
    $(document).ready(function() {
        $('#close-search-specific-page').html("").hide();
        $('#change-text-specific-page').html("All What You Need <br> to Know").show();
    });
</script>

<div class="aboutus">
	<div class="container">
    	<div class="row">
        	<div class="col-md-12">
            	<h1 class="wow fadeIn animated" data-wow-duration="2s">About APARTOLINO</h1>
               
            </div>
        </div>
        <div class="row">
        	<div class="col-md-12">
            	<div class="description">
                	<p>APARTOLINO was founded in July 2016 in Winterthur with a creative and highly qualified team, which has set itself the goal of offering a leading platform for the mediation of business / serviced apartments.</p>

                    <p>The range of furnished accommodation, especially professionally managed serviced apartments, is growing world-wide. The idea of ​​APARTOLINO was implemented in order to simplify the search for business people and at the same time to accelerate sales channels for suppliers.</p>

                    <p>The apartments advertised at APARTOLINO are all from professional suppliers, who usually offer additional services. The providers are all checked by APARTOLINO, so only reputable providers can advertise their accommodation. The offer includes furnished studios to large apartments or villas all over Switzerland.</p>

                    <p>The unique APARTOLINO booking system ensures a fast processing, with collateral for the guest and the provider. No time-consuming inquiries about availability to the providers. Guests can book an apartment with a deposit, so there is no need for bank transfers during the booking process, or large amounts payable with the credit card.</p>
                    <p>The novelty of APARTOLINO is the combination of booking confirmation and invoice. The customer and the vendor will receive an automatically generated PDF with all relevant information about the booking, as well as an accurate statement of the total booking amount, the down payment and the amount to be paid. The invoice is VAT-compliant and is therefore ideal for business people.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@include('frontend.includes.popups')

@endsection