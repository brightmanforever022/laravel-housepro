
<div class="about-us">
	<div class="container">
    	<div class="row">
        	<div class="col-md-6">
            	<h1 class="wow fadeIn">apartolino</h1>
                <p class="wow fadeIn">Apartolino one of the largest sites for placement of serviced apartments. A stay with a provider is the ideal alternative to a hotel room and means for originality, privacy , cost savings and flexibility. Take advantage of the many benefits of Business Apartments: more space, more bedrooms, a kitchen and Wi-Fi and a washing machine - all at no extra cost.</p>
				<p class="wow fadeIn">Book easily a stay in Switzerland. Read what Apartolino customers talk about from their experiences of Apartolino.</p>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-4">
            	<h1>&nbsp;</h1>
            	<p class="wow fadeIn">Are you operator of business apartments ?</p>

				<p class="wow fadeIn">Register as a company. Once you have inserted your Serviced Apartments, you can list your first ads after a short time.</p>
                @if(!Auth::check())
                <a href="#register" class="offer_appartemnt_btn wow fadeIn fancybox">OFFER NOW APARTMENTS</a>
                @endif
                <a href="{{ url('/') }}/how-it-work" class="how_work_btn wow fadeIn">HOW IT WORKS - READ HERE</a>
            </div>
        </div>
    </div>
</div>
