<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="select-icon">
                            <select>
                                <option>English</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-12">
                        <h1 class="wow fadeIn">COMPANY</h1>
                        <div class="footer-link wow fadeIn">
                            <ul>
                                <li><a href="{{ url('/press') }}">Press</a></li>
                                <li><a href="{{ url('/terms-of-services') }}">Terms of Services</a></li>
                                <li><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-12">
                        <h1 class="wow fadeIn">INFO</h1>
                        <div class="footer-link wow fadeIn">
                            <ul>
                                <li><a href="{{ url('/help-footer') }}">FAQ</a></li>
                                <li><a href="{{ url('/imprint') }}">Imprint</a></li>
                                <li><a href="{{ url('/about') }}">About us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-12">
                        <h1 class="wow fadeIn">MY ACCOUNT</h1>
                        <div class="footer-link wow fadeIn">
                            <ul>
                                <li><a href="#login" class="fancybox">Login</a></li>
                                <li><a href="#register" class="fancybox">Sign up</a></li>
                                <li><a href="#password-forget" class="fancybox">Forgot Password</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <h1 class="wow fadeIn">GET IN TOUCH</h1>
                <div class="social-link wow fadeIn">
                    <ul>
                        <li><a href="https://www.facebook.com/APARTOLINO/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                        <li><a href=""><i class="fa fa-instagram"></i></a></li>
                        <li><a href=""><i class="fa fa-pinterest"></i></a></li>
                        <li><a href=""><i class="fa fa-twitter"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row footer-bottom">
            <hr class="footer_split" />
            <!-- <h1>APARTOLINO serviced Apartments</h1> -->
            <p>Apartolino one of the largest sites for placement of serviced aprtments. A stay with a provider is the ideal alternative to a hotel room and means for originality, privacy, cost savings and flexibility. Take advantage of the many benefits of Business Apartments: more space, more bedrooms, a kitchen and Wi-Fi and a washing machine - all at no extra cost.</p>
            <p>Book easily a stay in Switzerland.</p>
            <p>All rights reserved. 2017</p>
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


