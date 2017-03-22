
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
        //console.log($('#form_login').serialize());
        if($('#form_login').valid())
        {
     
        $.ajax({
            url: base_url + '/freshUserLogin',
            type: 'POST',
            data: $('#form_login').serialize(),
            dataType: 'JSON',
            success: function (data) {
                if(data.status == 0 || data.status == -1)
                 $('#successMessage').html("<h1 style='color:red; font-size: 12px;'>"+data.message+"</h1>");
                else 
                {
                 $('#successMessage').html("<h1 style='color:grey; font-size: 12px;'>" +data.message + "");
                 $("#form_login")[0].reset();  
                  var single_search_form = document.getElementById('single_search_form');
                  if(single_search_form == undefined || single_search_form == ''){
                  window.location = base_url;
                } else {
                    
                    var url = document.getElementById('single_search_form').value;
                 
                    if(data.user_type == 1 && url == base_url ){
                      var url = url + '/provider-dashboard';
                    }

                    window.location = url;
                  }
                }  
            }
        });
        }
});

$('#form_login_forget').submit(function(event){
        event.preventDefault();
        //console.log($('#form_login').serialize());
        if($('#form_login_forget').valid())
        {
     
        $.ajax({
            url: base_url + '/forgetUserPassword',
            type: 'POST',
            data:{
                  _token: jQuery("#form_login_forget input[name='_token']").val(),
                  email: $('#email_email').val()
            },
            dataType:'json',
            success: function (data) {
                console.log(data);
                $('#successMatraMessage').html(data.msg);
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
                url: base_url + '/postRegister',
                type: 'POST',
                data: $('#form_register_user').serialize(),
                dataType: 'JSON',
                success: function (data) {
                     if(data.status == 0 || data.status == -1)
                     $('#successMessage_user_').html("<h1 style='color:red;font-size: 12px;'>"+data.message+"</h1>");
                    else 
                    {
                     $('#successMessage_user_').html("<h1 style='color:grey;font-size: 12px;'>" +data.message + "");  
                     $("#form_register_user")[0].reset();  
                    
                    }  
                }
            });
        }
});

$('.messagebefore').click(function(){
    var html='<input type="hidden" name="property_id" value="'+$(this).data("propertyid")+'"><input type="hidden" name="booking_id" value="'+$(this).data("bookingid")+'"><input type="hidden" name="owner_id" value="'+$(this).data("ownerid")+'"> ';
    $('#hidden_send_message').html(html);
    var html_ajax="";
    $.ajax({
              url: base_url + '/getMessage',
              type: 'POST',
              data: {'_token':$('#message_form_send').find('input[name="_token"]').val(), property_id: $(this).data("propertyid"), 'booking_id':$(this).data("bookingid") },
              dataType: 'JSON',
              success: function (data) {
                  
                  $.each(data.data, function(index, value) {
                    //console.log(value);
                   html_ajax = html_ajax + '<tr><td width="20%"><figure><img class="img-circle" src="'+base_url+'/profilepics/'+value.path+'"></figure></td><td width="20%"><h2>'+value.name+'<br>'+value.created+'</h2></td><td width="60%"><pre>'+value.message+'</pre></td></tr>';
                  });
                  $('#checkUnreadDynamice').html(data.name+'('+data.count+')');
                  //console.log(html_ajax);
                  $('#messageInsideTable').html(html_ajax);
              }
            });

    
});

$('#message_form_send').submit(function(event){
        event.preventDefault();
        //console.log($('#form_register_user').serialize());
        if($('#message_form_send').valid())
        {
            $.ajax({
                url: base_url + '/sendMessage',
                type: 'POST',
                data: $('#message_form_send').serialize(),
                dataType: 'JSON',
                success: function (data) {
                     if(data.status == 0 || data.status == -1)
                     $('#successSendMessage_user_').html("<h1 style='color:red;font-size: 12px;'>"+data.message+"</h1>");
                    else 
                    {
                     $('#successSendMessage_user_').html("<h1 style='color:grey;font-size: 12px;'>" +data.message + "");  
                     $("#message_form_send")[0].reset();  
                    
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
            url: base_url + '/postRegister',
            type: 'POST',
            data: $('#form_register').serialize(),
            dataType: 'JSON',
            success: function (data) {
                 if(data.status == 0 || data.status == -1)
                 $('#successMessage_user').html("<h1 style='color:red'>"+data.message+"</h1>");
                else 
                {
                 $('#successMessage_user').html("<h1 style='color:grey'>" +data.message + "");  
                 $("#form_register")[0].reset();  
                
                }  
            }
        });

       }

});

$('#loadMore').click(function(){
        $.ajax({
            url: base_url + '/getLoadBlog',
            type: 'GET',
            data: {},
            dataType: 'JSON',
            success: function (data) {
                var x = "";
                for (index = 0; index < data.length; ++index) {
                   x = x+ '<li><h2 class="wow fadeIn" data-wow-duration="2s">'+data[index].title+'</h2>'+'<p class="wow fadeIn" data-wow-duration="2s">'+data[index].description+'<p><span>'+data[index].created_at+'</span><div class="arrow"><a href=""><i class="fa fa-angle-right"></i></a></div></li>';
                }
                $('#div-append').html(x);
            }
        });
});


$('#loadCity').click(function(){
        $.ajax({
            url: base_url + '/getCityLoad',
            type: 'GET',
            data: {},
            dataType: 'JSON',
            success: function (data) {
                var city = data.cities;
                var price_list = data.price_list;
                var thml = "";
                for (index = 0; index < city.length; ++index) {
                   thml = thml+ '<div class="col-md-4 col-sm-6"><a target="_blank" href="'+base_url+'/search_home_link?address='+city[index].title+'"><figure><img src="'+base_url+'/cities/'+city[index].logo+'" class="grayscale grayscale-fade"/><span class="city_price">'+city[index].title+' ab CHF '+ price_list[index]+'</span><h5>'+city[index].description+'</h5></figure></a></div>';
                }
                //console.log(thml+'<div class="col-md-12 text-center"></div>');
                $('#div_append_city').html(thml);
            }
        });
});


// $('#loadCity').click(function(){
//         $.ajax({
//             url: base_url + '/getCityLoad',
//             type: 'GET',
//             data: {},
//             dataType: 'JSON',
//             success: function (data) {
//                 var x = "";
//                 for (index = 0; index < data.length; ++index) {
//                    x = x+ '<div class="col-md-4 col-sm-6"><a href="'+{{ url('/') }}+'/search_home_link?address='+data[index].titl+'"><figure><img src="'+{!! url('/') !!}+'/cities/'+data[index].logo+'" class="grayscale grayscale-fade"/><div class="text">Basel</div></figure></a></div>';
//                 }
//                 $('#div-append-city').html(x);
//             }
//         });
// });



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

      var  compare_min_stay = 0;   
      if( document.getElementById('compare_min_stay') != null)
      {
           compare_min_stay = parseInt(document.getElementById('compare_min_stay').value);
      }
      if(document.getElementById('date_compare') != null)
      var date_compare = new Date(document.getElementById('date_compare').value);
      else
      date_compare = new Date();  
      var nowDate = new Date();
      var nextDate = new Date(nowDate.getTime() + (24 * 60 * 60 * 1000));
      var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);

      var tomorrow = new Date(nextDate.getFullYear(), nextDate.getMonth(), nextDate.getDate(), 0, 0, 0, 0);

      
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


    /*Single Search Start/End Date
    */
    
    var a = document.getElementById('date_disabled'); 
    if(a != null)
    {
    var x = new Array();
    datesDisabled = a.value.split(",");
    }else 
    {
      datesDisabled = [];
    }
    
   
    if(localStorage.getItem('date_disabled') != null) {
        document.getElementById('date_disabled').value = localStorage.getItem('date_disabled');      
    }

    // if(date_compare > today) {
    //   var nextDate = new Date(date_compare.getTime() + (24 * 60 * 60 * 1000));
    //   var tomorrow = new Date(nextDate.getFullYear(), parseInt(nextDate.getMonth() + 1), nextDate.getDate(), 0, 0, 0, 0);

    //   $('#startdate_single').datepicker({ 
    //     startDate: date_compare ,
    //     datesDisabled: datesDisabled,
    //     });

    //   $('#end_date_single').datepicker({ 
    //     startDate: tomorrow,
    //     datesDisabled: datesDisabled, 
    //     });
    // }else {
    //   $('#startdate_single').datepicker({ 
    //     startDate: today ,
    //     datesDisabled: datesDisabled,
    //     });

    //   $('#end_date_single').datepicker({ 
    //     startDate: tomorrow ,
    //     datesDisabled: datesDisabled,
    //     });
    // }

    var start_date_select = "";
    var end_date_select   = "";
    $("#startdate_single").datepicker({
        todayBtn:  1,
        autoclose: true,
        datesDisabled: datesDisabled,
        beforeShowDay: available
    }).on('changeDate', function (selected) {
      start_date_select = selected.date;
      var nextDate = new Date(selected.date.getTime() + (24 * 60 * 60 * 1000));
      var tomorrow = new Date(nextDate.getFullYear(), nextDate.getMonth(), nextDate.getDate(), 0, 0, 0, 0);
      var start_date = ("0" + (start_date_select.getMonth()+1)).slice(-2) + "/" + ("0" + start_date_select.getDate()).slice(-2) + "/" + start_date_select.getFullYear();
      $("#temp_date").val(start_date);
    //console.log($("#startdate_single").val());
        // $.ajax({
        //     url: 'http://localhost/apartolino1/public/get-end-date',
        //     data: 'start_date='+start_date,
        //     method: 'GET',
        //     success: function (e) {
        //         //alert(e);
        //     }
        // });
        ///var minDate = new Date(selected.date.valueOf());
        $('#end_date_single').datepicker('setStartDate', tomorrow);
    });
    
    $("#end_date_single").datepicker({ beforeShowDay: available }).on('changeDate', function (selected) {
            end_date_select = selected.date;
            var minDate = new Date(selected.date.valueOf());
            var start = $("#startdate_single").val().date;
            var start_date = $("#temp_date").val();
            var end_date = ("0" + (end_date_select.getMonth()+1)).slice(-2) + "/" + ("0" + end_date_select.getDate()).slice(-2) + "/" + end_date_select.getFullYear();

            $.ajax({
                url: base_url + '/get-end-date',
                data: 'start_date='+start_date+'&end_date='+end_date,
                method: 'GET',
                success: function (e) {
                    var betweenDates = $.parseJSON(e);
                    var found = false;
                    if (availableDates.length < betweenDates.length) {
                        for (var i = 0; i < availableDates.length; i++) {
                            if (betweenDates.indexOf(availableDates[i]) > -1) {
                                found = true;
                            } 

                            if (betweenDates.indexOf(availableDates[i]) == -1) {
                                found = false;
                            }

                        }
                    } else {
                        for (var i = 0; i < betweenDates.length; i++) {
                            if (availableDates.indexOf(betweenDates[i]) > -1) {
                                found = true;
                            } 
                            if (availableDates.indexOf(betweenDates[i]) == -1) {
                                found = false;
                            }

                        }
                    }

                    if (!found) {
                        $.fancybox([ { href : '#information_message' } ]);
                        $('#infoCustomMessage').text(" Booking cannot be done for this selection ");
                        $('#end_date_single').val("");
                    }
                }
            });
            if(datesDisabled.length == 1)
            {
               $('#startdate_single').datepicker('setEndDate', minDate);
               $(days);
            }else 
            {
            $.each(datesDisabled,function(index,obj)
            {
                var from_start = obj.split("/");
                var fs = new Date(from_start[2], from_start[1] - 1, from_start[0]);
                if( fs.getFullYear() < 1970)
                fs.setFullYear(fs.getFullYear() + 100);  
                
                if(obj != "")
                {
                  if(start_date_select != "")
                  {
                    if(fs < end_date_select && fs > start_date_select)
                    {
                      // $.fancybox([ { href : '#information_message' } ]);
                      // $('#infoCustomMessage').text(" End date should be less than "+ fs);
                      // $('#end_date_single').val("");
                    }else if(obj != "")
                    {
                      $('#startdate_single').datepicker('setEndDate', minDate);
                      $(days);
                    }
                  }else 
                  {
                    // $.fancybox([ { href : '#information_message' } ]);
                    // $('#infoCustomMessage').text(" Please Select Start Date. "+ fs);
                    // $('#end_date_single').val("");
                  }
                }
                 
            });
           }    
    });  

    
    function available(date) {
        dmy = ("0" + date.getDate()).slice(-2) + "/" + ("0" + (date.getMonth()+1)).slice(-2) + "/" + date.getFullYear();
        if (availableDates != false) {
            if ($.inArray(dmy, availableDates) != -1) {
                var val = true; //[true, "","Available"];
            } else {
                var val = false; //[false,"","unAvailable"];
            }
        } else{
            var val = true;
        }
        
        return val;
    }

    $(function() {
        $('#startdate_single').datepicker({ beforeShowDay: available });
        $('#end_date_single').datepicker({ beforeShowDay: available });
    });

    function apartolino_round(x){
         a = x.toString().split('.');
         if(parseInt(a[1]) < 5) 
         b = (parseFloat(a[0] + '0')/100).toFixed(2); 
         else if(parseInt(a[1]) == 5) 
         b = (parseFloat(a[0] + '5')/100).toFixed(2); 
         else if(parseInt(a[1]) > 5) 
         b = (parseFloat((parseInt(a[0]) + 1) + '0')/100).toFixed(2);
         return b; 
    }

    


    var a = $("#startdate_single").val();
    var b = $("#end_date_single").val();
    if(a != undefined && b != undefined && !localStorage.getItem('startdate_single'))
    {
            if(parseInt($('#script_single').val()) && parseInt($('#script_single_end').val()))
            {
            var date_compare_start = new Date($("#startdate_single").val());
            var date_compare_end = new Date($("#end_date_single").val());
            $('#startdate_single').datepicker("setDate", date_compare_start );
            $('#end_date_single').datepicker("setDate", date_compare_end );  
            a = $("#startdate_single").datepicker('getDate').getTime();
            b = $("#end_date_single").datepicker('getDate').getTime();
            var c = 24*60*60*1000;
            diffDays = Math.round(Math.abs((a - b)/(c)));
            if(diffDays >= compare_min_stay)
            {
            var price_per_night = $('#price_per_night').val();
            var cleaning_fee = $('#cleaning_fee').val();
            $("#price").val(parseFloat(diffDays * price_per_night) + parseFloat(cleaning_fee));
            //$('#total_one').text('CHF ' + price_per_night + ' x '+ diffDays +' Nights + CHF ' + cleaning_fee + 'x' + diffDays + ' Cleaning Fee' );
            $('#total_one').text('CHF ' + price_per_night + ' x '+ diffDays +' Nights ');
            $('#total_cleaning_fee').text('CHF ' + cleaning_fee + ' x '+ 1 +' Cleaning Fee ');
            $('#nights').val(diffDays);
            //$('#total_two').text('CHF '+ (parseFloat(diffDays * price_per_night) + parseFloat(cleaning_fee)).toFixed(2));
            $('#total_two').text('CHF '+ (parseFloat(diffDays * price_per_night)).toFixed(2));
            $("#amount_cleaning_fee").text('CHF '+ (parseFloat(1 * cleaning_fee)).toFixed(2));
            
            //$('#total_three').text('CHF '+ (parseFloat(diffDays * price_per_night) + parseFloat(cleaning_fee)).toFixed(2));
            $('#total_three').text('CHF '+ (parseFloat(diffDays * price_per_night) + parseFloat(1 * cleaning_fee)).toFixed(2));
            var percent      = parseInt($('#percent_pay').val());
            var init_start1  = diffDays * price_per_night;
            var init_start2  = init_start1 + parseFloat(cleaning_fee);
            var initial_pay  = init_start2 * percent / 100;
            
            $('#total_initial').text('CHF '+ apartolino_round(parseFloat(initial_pay*10).toFixed(1)));
            $('#init_price').val(apartolino_round(parseFloat(initial_pay*10).toFixed(1)));

            }else 
             {
                $.fancybox([ { href : '#information_message' } ]);
                $('#infoCustomMessage').text("Minimum stay should be "+ compare_min_stay + " nights.");
                $('#end_date_single').val("");
                //$('#end_date_single-error').html("<h6 color:red>Minimum saty should"+compare_min_stay+"days </h6>");
               
             }
            }else {
              if($("#startdate_single").val() != ""){
               var date_compare_start = new Date($("#startdate_single").val());
               $('#startdate_single').datepicker("setDate", date_compare_start );
              }

            }
    }else
    {
     
      window.localStorage.clear();
    }

    function days() {
            var a = $("#startdate_single").datepicker('getDate').getTime();
            var b = $("#end_date_single").datepicker('getDate').getTime();
            var c = 24*60*60*1000;
            diffDays = Math.round(Math.abs((a - b)/(c)));
            if(diffDays >= compare_min_stay)
            {
            var price_per_night = $('#price_per_night').val();
            var cleaning_fee = $('#cleaning_fee').val();
            $("#price").val(parseFloat(diffDays * price_per_night) + parseFloat(cleaning_fee));
            //$('#total_one').html('CHF ' + price_per_night + ' x '+ diffDays +' Nights + <br>CHF ' + cleaning_fee + ' x ' + diffDays  + ' Cleaning Fee' );
            $('#total_one').html('CHF ' + price_per_night + ' x '+ diffDays +' Nights ');
            $('#total_cleaning_fee').html('CHF ' + cleaning_fee + ' x '+ 1 +' Cleaning Fee ');
            $('#nights').val(diffDays);
            //$('#total_two').text('CHF '+ (parseFloat(diffDays * price_per_night) + parseFloat(cleaning_fee)).toFixed(2));
            $('#total_two').text('CHF '+ (parseFloat(diffDays * price_per_night)).toFixed(2));
            $("#amount_cleaning_fee").text('CHF '+ (parseFloat(1 * cleaning_fee)).toFixed(2));
            //$('#total_three').text('CHF '+ (parseFloat(diffDays * price_per_night) + parseFloat(cleaning_fee)).toFixed(2));
            $('#total_three').text('CHF '+ (parseFloat(diffDays * price_per_night) + parseFloat(1 * cleaning_fee)).toFixed(2));
            var percent      = parseInt($('#percent_pay').val());
            var init_start1  = diffDays * price_per_night;
            var init_start2  = init_start1 + parseFloat(cleaning_fee);
            var initial_pay  = init_start2 * percent / 100;
            // console.log('percent:' + percent);
            // console.log('init_start1:' + init_start1);
            // console.log('init_start2:' + init_start2);
            // console.log('initial_pay:' + initial_pay);
            // console.log('go_to_pay:' + apartolino_round(parseFloat(initial_pay*10).toFixed(1)));

                       
            $('#total_initial').text('CHF '+ apartolino_round(parseFloat(initial_pay*10).toFixed(1)));
            $('#init_price').val(apartolino_round(parseFloat(initial_pay*10).toFixed(1)));
           }else 
           {
              $.fancybox([ { href : '#information_message' } ]);
              $('#infoCustomMessage').text("Minimum stay should be "+ compare_min_stay + " nights.");
              $('#end_date_single').val("");
              //$('#end_date_single-error').html("<h6 color:red>Minimum saty should"+compare_min_stay+"days </h6>");
             
           }
    }


    $('.create-add-btn-property').click(function(e)
    {
       // alert(base_url);
       
       if(paypal == "")
       {
        e.preventDefault();
         $.fancybox([ { href : '#error_message' } ]);
        $('#errorCustomMessage').text(" Please provide your paypal_id ");
        setTimeout(function() {
            window.location = base_url + "/edit-profile-host";
            $("#paypal_email").focus();
            }, 1000);   
        
        
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
    // $('.texthover').click(function(){ 
    //    $(this).hide();
    // });
    // $('.texthover-home').click(function(){
    //    $(this).hide();
    // });
});