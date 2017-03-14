@if((\Request::route()->getName() != 'search_search') && (\Request::route()->getName() != 'search'))
@if(Auth::check())
<footer>
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
                                <li><a href="{{ url('/about') }}">About us</a></li>
                                <li><a href="{{ url('/contactus') }}">Contact</a></li>
                                <li><a href="{{ url('/advertising') }}">Advertising</a></li>
                                <li><a href="{{ url('/disclaimer') }}">Disclaimer</a></li>
                                <li><a href="{{ url('/imprint') }}">Imprint</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xs-6">
                        <h1 class="wow fadeIn">INFO</h1>
                        <div class="footer-link wow fadeIn">
                            <ul>
                                <li><a href="{{ url('/adevertise') }}">Advertise</a></li>
                                <li><a href="{{ url('/price-plan') }}">Price plan</a></li>
                                <li><a href="{{ url('/customer-service') }}">Customer service</a></li>
                                <li><a href="{{ url('/site-map') }}">Site Map</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <h1 class="wow fadeIn">Social Media</h1>
                <div class="social-link wow fadeIn">
                    <ul>
                        <li><a href=""><i class="fa fa-facebook"></i></a></li>
                        <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                        <li><a href=""><i class="fa fa-instagram"></i></a></li>
                        <li><a href=""><i class="fa fa-pinterest"></i></a></li>
                        <li><a href=""><i class="fa fa-twitter"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">All rights reserved. 2016</div>
</footer>
@else
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
                                <li><a href="{{ url('/about') }}">About us</a></li>
                                <li><a href="{{ url('/contactus') }}">Contact</a></li>
                                <li><a href="{{ url('/advertising') }}">Advertising</a></li>
                                <li><a href="{{ url('/disclaimer') }}">Disclaimer</a></li>
                                <li><a href="{{ url('/imprint') }}">Imprint</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xs-6">
                        <h1 class="wow fadeIn">INFO</h1>
                        <div class="footer-link wow fadeIn">
                            <ul>
                                <li><a href="{{ url('/adevertise') }}">Advertise</a></li>
                                <li><a href="{{ url('/price-plan') }}">Price plan</a></li>
                                <li><a href="{{ url('/customer-service') }}">Customer service</a></li>
                                <li><a href="{{ url('/site-map') }}">Site Map</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <h1 class="wow fadeIn">Social Media</h1>
                <div class="social-link wow fadeIn">
                    <ul>
                        <li><a href=""><i class="fa fa-facebook"></i></a></li>
                        <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                        <li><a href=""><i class="fa fa-instagram"></i></a></li>
                        <li><a href=""><i class="fa fa-pinterest"></i></a></li>
                        <li><a href=""><i class="fa fa-twitter"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">All rights reserved. 2016</div>
</footer>
@endif
@else
@if(Auth::check())
<footer>
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
                                <li><a href="{{ url('/about') }}">About us</a></li>
                                <li><a href="{{ url('/contactus') }}">Contact</a></li>
                                <li><a href="{{ url('/advertising') }}">Advertising</a></li>
                                <li><a href="{{ url('/disclaimer') }}">Disclaimer</a></li>
                                <li><a href="{{ url('/imprint') }}">Imprint</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xs-6">
                        <h1 class="wow fadeIn">INFO</h1>
                        <div class="footer-link wow fadeIn">
                            <ul>
                                <li><a href="{{ url('/adevertise') }}">Advertise</a></li>
                                <li><a href="{{ url('/price-plan') }}">Price plan</a></li>
                                <li><a href="{{ url('/customer-service') }}">Customer service</a></li>
                                <li><a href="{{ url('/site-map') }}">Site Map</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <h1 class="wow fadeIn">Social Media</h1>
                <div class="social-link wow fadeIn">
                    <ul>
                        <li><a href=""><i class="fa fa-facebook"></i></a></li>
                        <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                        <li><a href=""><i class="fa fa-instagram"></i></a></li>
                        <li><a href=""><i class="fa fa-pinterest"></i></a></li>
                        <li><a href=""><i class="fa fa-twitter"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">All rights reserved. 2016</div>
</footer>
@else
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
                                <li><a href="{{ url('/about') }}">About us</a></li>
                                <li><a href="{{ url('/contactus') }}">Contact</a></li>
                                <li><a href="{{ url('/advertising') }}">Advertising</a></li>
                                <li><a href="{{ url('/disclaimer') }}">Disclaimer</a></li>
                                <li><a href="{{ url('/imprint') }}">Imprint</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xs-6">
                        <h1 class="wow fadeIn">INFO</h1>
                        <div class="footer-link wow fadeIn">
                            <ul>
                                <li><a href="{{ url('/adevertise') }}">Advertise</a></li>
                                <li><a href="{{ url('/price-plan') }}">Price plan</a></li>
                                <li><a href="{{ url('/customer-service') }}">Customer service</a></li>
                                <li><a href="{{ url('/site-map') }}">Site Map</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <h1 class="wow fadeIn">Social Media</h1>
                <div class="social-link wow fadeIn">
                    <ul>
                        <li><a href=""><i class="fa fa-facebook"></i></a></li>
                        <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                        <li><a href=""><i class="fa fa-instagram"></i></a></li>
                        <li><a href=""><i class="fa fa-pinterest"></i></a></li>
                        <li><a href=""><i class="fa fa-twitter"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">All rights reserved. 2016</div>
</footer>
@endif
@endif


<script>


$(document).ready(function() {


  var reader  = new FileReader();

  reader.addEventListener("load", function () {
    document.getElementById("profilepics").src = reader.result;
  }, false);


   $(document ).on('change','#imageFile' , function (e) {
            file = e.target.files[0];
            reader.readAsDataURL(file);
            document.getElementById("profilepics").src = "";
    });
   
    function readURL(input) {
        alert(JSON.stringify(document.getElementById('imageFile').files[0]));
        // if (input.files && input.files[0]) {
            
        //     $.each(input.files, function() {
        //         var reader = new FileReader();
        //         reader.onload = function (e) {    
        //             document.getElementById("profilepics").src =  e.target.result;
        //         }
        //     });
        // }
    }




$('#href_fresh').click(function(e)
{
          e.preventDefault();
});

$('#href_fesh1').click(function(e)
{
          e.preventDefault();
});

$('#href_fresh2').click(function(e)
{
          e.preventDefault();
});

$(document).ajaxStart(function(){
        $(".wait_loading").css("display", "block");
    });
$(document).ajaxComplete(function(){
        $(".wait_loading").css("display", "none");
});



$('#form_login').submit(function(event){
        event.preventDefault();
        if('#email').val() ==
        //console.log($('#form_login').serialize());
        if($('#form_login').valid())
        {
     
        $.ajax({
            url: '{{ url("/")}}/freshUserLogin',
            type: 'POST',
            data: $('#form_login').serialize(),
            dataType: 'JSON',
            success: function (data) {
                if(data.status == 0 || data.status == -1)
                 $('#successMessage').html("<h1 style='color:red; font-size: 12px;'>"+data.message+"</h1>");
                else 
                {
                 $('#successMessage').html("<h1 style='color:green; font-size: 12px;'>" +data.message + "");
                 $("#form_login")[0].reset();  
                  var single_search_form = document.getElementById('single_search_form');
                  if(single_search_form == undefined || single_search_form == '')
                  window.location="{{ url('/') }}";
                  else
                      window.location = document.getElementById('single_search_form').value;

                }  
            }
        });
        }
});




$('#form_register_user').submit(function(event){
        event.preventDefault();
        //console.log($('#form_register_user').serialize());
        if($('#form_register_user').valid())
        {
            $.ajax({
                url: '{{ url("/")}}/postRegister',
                type: 'POST',
                data: $('#form_register_user').serialize(),
                dataType: 'JSON',
                success: function (data) {
                     if(data.status == 0 || data.status == -1)
                     $('#successMessage_user_').html("<h1 style='color:red;font-size: 12px;'>"+data.message+"</h1>");
                    else 
                    {
                     $('#successMessage_user_').html("<h1 style='color:green;font-size: 12px;'>" +data.message + "");  
                     $("#form_register_user")[0].reset();  
                    
                    }  
                }
            });
        }
});


$('#form_register').submit(function(event){
        event.preventDefault();
        //console.log($('#form_register').serialize());
       if($('#form_register').valid())
        {
          
        $.ajax({
            url: '{{ url("/")}}/postRegister',
            type: 'POST',
            data: $('#form_register').serialize(),
            dataType: 'JSON',
            success: function (data) {
                 if(data.status == 0 || data.status == -1)
                 $('#successMessage_user').html("<h1 style='color:red'>"+data.message+"</h1>");
                else 
                {
                 $('#successMessage_user').html("<h1 style='color:green'>" +data.message + "");  
                 $("#form_register")[0].reset();  
                
                }  
            }
        });

       }

});


function initialize_location() { 
            var input = document.getElementById('city_where_met_search');

            var options = {
              types: ['(cities)'],
              componentRestrictions: {country: "ch"}
             };
            if(input) { 
                var autocomplete = new google.maps.places.Autocomplete(input, options);
            }
        }
initialize_location();

     


      var nowDate = new Date();
      var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);

      $('#startdate_start').datepicker({ 
        startDate: today 
        });

      $('#end_date_end').datepicker({ 
        startDate: today 
        });

      $("#startdate_start").datepicker({
        todayBtn:  1,
        autoclose: true,
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#end_date_end').datepicker('setStartDate', minDate);
    });
    
    $("#end_date_end").datepicker()
        .on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#startdate_start').datepicker('setEndDate', minDate);
        });


    /*Singel Search Start/End Date
    */
    $('#startdate_single').datepicker({ 
        startDate: today 
        });

    $('#end_date_single').datepicker({ 
        startDate: today 
        });

    $("#startdate_single").datepicker({
        todayBtn:  1,
        autoclose: true,
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#end_date_single').datepicker('setStartDate', minDate);
    });
    
    $("#end_date_single").datepicker()
        .on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#startdate_single').datepicker('setEndDate', minDate);
            $(days);
        });    


    var a = $("#startdate_single").val();
    var b = $("#end_date_single").val();
    if(a != undefined && b != undefined)
    {
            if(parseInt($('#script_single').val()) && parseInt($('#script_single_end').val()))
            {
            a = $("#startdate_single").datepicker('getDate').getTime();
            b = $("#end_date_single").datepicker('getDate').getTime();
            var c = 24*60*60*1000;
            diffDays = Math.round(Math.abs((a - b)/(c)));
            var price_per_night = $('#price_per_night').val();
            var cleaning_fee = $('#cleaning_fee').val();
            $("#price").val(diffDays * price_per_night);
            $('#total_one').text('CHF ' + price_per_night + ' x '+ diffDays +' Nights + CHF ' + cleaning_fee + ' Cleaning Fee' );
            $('#nights').val(diffDays);
            $('#total_two').text('CHF '+ (parseFloat(diffDays * price_per_night) + parseFloat(cleaning_fee)));
            $('#total_three').text('CHF '+ (parseFloat(diffDays * price_per_night) + parseFloat(cleaning_fee)));
            }
    }

    function days() {
            var a = $("#startdate_single").datepicker('getDate').getTime();
            var b = $("#end_date_single").datepicker('getDate').getTime();
            var c = 24*60*60*1000;
            diffDays = Math.round(Math.abs((a - b)/(c)));
            var price_per_night = $('#price_per_night').val();
            var cleaning_fee = $('#cleaning_fee').val();
            $("#price").val(diffDays * price_per_night);
            $('#total_one').html('CHF ' + price_per_night + ' x '+ diffDays +' Nights + <br>CHF ' + cleaning_fee + ' Cleaning Fee' );
            $('#nights').val(diffDays);
            $('#total_two').text('CHF '+ (parseFloat(diffDays * price_per_night) + parseFloat(cleaning_fee)));
            $('#total_three').text('CHF '+ (parseFloat(diffDays * price_per_night) + parseFloat(cleaning_fee)));
    }


    $('.create-add-btn-property').click(function(e)
    {
       var paypal_email = "<?php if(Auth::check()){echo Auth::user()->paypal_email;} ?>";
       if(paypal_email == "")
       {
        e.preventDefault();
        alert("Please provide your paypal_id");
        window.location = "<?php echo Request::root()?>/edit-profile-host";
        $("#paypal_email").focus();
       }
       else
       {

       }


       //
       //alert("Come" + $(this).attr("data-userid"));
       
       // $.ajax({
       //      type: "GET",
       //      url: "<?php echo Request::root().'/isPaypalEmail' ?>",
       //      dataType: "json",
       //      data: {
       //          id: $(this).attr("data-userid")
       //      }
       //  }).done(function (data) {
       //      // I'm assuming that the 'property_details' table has a 'url' field?
       //      // If not, just replace this with whatever you need.
       //      console.log(data);
       //      alert(data);
       //  });
    });

    $('.new-account-newacount').click(function()
    {
       window.open('https://www.paypal.com/signin?country.x=US&locale.x=en_US', '_blank');
    });
});
</script>

