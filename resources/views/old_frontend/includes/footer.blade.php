<footer style="background:#233336 !important;">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="select-icon">
                            <select>
                                <option>English</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xs-6">
                        <h1 class="wow fadeIn">COMPANY</h1>
                        <div class="footer-link wow fadeIn">
                            <ul>
                                <li><a href="{{ url('/press') }}">Press</a></li>
                                <li><a href="{{ url('/jobs') }}">Jobs</a></li>
                                <li><a href="{{ url('/terms-of-services') }}">Terms of services</a></li>
                                <li><a href="{{ url('/privacy-policy') }}">Privacy policy</a></li>

                                <!--li><a href="{{ url('/about') }}">About us</a></li>
                                <li><a href="{{ url('/contactus') }}">Contact</a></li>
                                <li><a href="{{ url('/advertising') }}">Advertising</a></li>
                                <li><a href="{{ url('/disclaimer') }}">Disclaimer</a></li>
                                <li><a href="{{ url('/imprint') }}">Imprint</a></li-->
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xs-6">
                        <h1 class="wow fadeIn">INFO</h1>
                        <div class="footer-link wow fadeIn">
                            <ul>
                                <li><a href="{{ url('/help-footer') }}">FAQ</a></li>
                                <li><a href="{{ url('/imprint') }}">Imprint</a></li>
                                <li><a href="{{ url('/about') }}">About us</a></li>
                                <!--li><a href="{{ url('/adevertise') }}">Advertise</a></li>
                                <li><a href="{{ url('/price-plan') }}">Price plan</a></li>
                                <li><a href="{{ url('/customer-service') }}">Customer service</a></li>
                                <li><a href="{{ url('/site-map') }}">Site Map</a></li-->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <h1 class="wow fadeIn">Social Media</h1>
                <div class="social-link wow fadeIn">
                    <ul>
                        <li><a href="https://www.facebook.com/APARTOLINO/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <!-- <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                        <li><a href=""><i class="fa fa-instagram"></i></a></li>
                        <li><a href=""><i class="fa fa-pinterest"></i></a></li>
                        <li><a href=""><i class="fa fa-twitter"></i></a></li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">All rights reserved. 2016</div>
</footer>
 <script type="text/javascript" src="{!! url('/') !!}/js/custom/footer.js"></script>
<script>
 $(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 73) {
        $(".menu").addClass("sticky");
    }
    else{
        $(".menu").removeClass("sticky");
    }
}); 

</script> 


