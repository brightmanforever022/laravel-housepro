ng.ready( function() {
    var my_cal = new ng.Calendar({
        input: 'cal_input',
        end_date: 'year + 3',
        multi_selection: true,
        max_selection: 31,
        hide_clear_button: true,
        hide_view_all_dates_button: true,
        visible: true,
        object: 'cal_div'
    });
    $.each(availableDates, function (index, value) {
        // view.el.find('.ng_cal_dates_tr td[rel="' + value + '"]').css('background-color', '#f45559');
        my_cal.select_date(value);
    });
});
$(document).ready(function() {


      setTimeout(function() {
            $('#successMessage').fadeOut('fast');
            }, 10000);

      var localcount = 0;
      var nowDate = new Date();
      var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);

      if(document.getElementById('startdate') != undefined || document.getElementById('startdate') != "")
      {
            
        /* initialize the calendar*/

            var selectedDates = [];
            var selectedDates1 = [];
            var unSelectedDates = [];
            var deleteDates = [];

           // $("#calendar").fullCalendar({
           //      header: {
           //          left: 'prev,next today',
           //          center: 'title',
           //          right: ''
           //      },
           //      editable: true,
           //      droppable: true,
           //      eventOverlap:false,
           //      firstDay: 1,
           //      dayNamesShort: ['SU', 'MO', 'TU', 'WE', 'TH', 'FR', 'SA'],
             
           //      drop: function(date) {
           //          // console.log(  moment(event.start).format("DD-MM-YYYY HH:mm")  + ' ' +  moment(event.end).format("DD-MM-YYYY HH:mm") ); 
           //          var start = date.format("DD-MM-YYYY");
           //          //var end = date.format("DD-MM-YYYY");

           //          selectedDates1.push({'start': start});
           //          //console.log(JSON.stringify(selectedDates));
           //          $("#drop_ranges").val(JSON.stringify(selectedDates1));
           //      },
           //      eventClick: function(calEvent, jsEvent, view)
           //      {
           //          var r = confirm("Are you sure you want to remove this range?");
           //          if (r === true)
           //          {
                        
           //              var start = moment(calEvent.start).format("DD-MM-YYYY");
           //              var end = moment(calEvent.end).format("DD-MM-YYYY");

           //              deleteDates.push({'start': start, 'end': end});
           //              $("#delete_dates").val(JSON.stringify(deleteDates));
                        
           //              $('#calendar').fullCalendar('removeEvents', calEvent._id);
           //          }
           //      },
           //      viewRender: function (view, element) {
           //          // console.log(element);
           //      },
           //      dayRender: function (date, element, view) {                    
           //          // console.log(view);
           //          // console.log(nowDate.getMonth());
           //          if(date._d.getMonth() == nowDate.getMonth() + 1){
           //              // console.log(element);
           //              // element.remove();
           //              // return false;
           //          }
           //          // $('.fc-other-month.fc-future').remove();
           //          // console.log(view);
           //          $.each(availableDates, function (index, value) {
           //              view.el.find('.fc-day[data-date="' + value + '"]').css('background-color', '#f45559');
           //          });
           //          // $('#calendar').fullCalendar('windowResize');

                                                         
           //      },
           //      dayClick: function(date, jsEvent, view) {
           //          if ($(this).attr('style')) {
           //              unSelectedDates.push(date.format());
           //              // change the day's background color just for fun
           //              $(this).css('background-color', '#fff');
           //              $("#unselected").val(unSelectedDates);
           //          }

           //      },
           //      eventResize: function( event, jsEvent, ui, view  ) {
           //          // console.log(  moment(event.start).format("DD-MM-YYYY")  + ' ' +  moment(event.end).format("DD-MM-YYYY") ); 
           //          var start = moment(event.start).format("DD-MM-YYYY");
           //          var end = moment(event.end).format("DD-MM-YYYY");

           //          selectedDates.push({'start': start, 'end': end});
           //          // console.log(JSON.stringify(selectedDates));
           //          $("#ranges").val(JSON.stringify(selectedDates));
           //      } 
           //  }); 
        }

    var count = 1;

    $images = $('.imageOutput');

    $(".imageUpload").change(function(event){
        if($('.delete_image_one').data( 'count' ) == undefined)
        readURL(this);
        else if(localcount == 0)
        {
            count = $('.delete_image_one').data( 'count' ) + 1;
            localcount = 1;
            readURL(this);
        }
        else 
        {
            readURL(this);
        }    
    });

    function readURL(input) {
        
        if (input.files && input.files[0]) {
            
            $.each(input.files, function() {
                var reader = new FileReader();
                reader.onload = function (e) {    
                    if(count > 9)
                    {
                      $.fancybox([ { href : '#error_message' } ]);
                      $('#errorCustomMessage').text(" You have reached to maximum limits. ");
                    }else 
                    {
                    var property_id = $('#property_id').val();       
                    $images.append('<div class="col-xs-4"><div class="image-box"><img src="'+ e.target.result+'" data-propertyid="'+property_id+'" /><div> <a href="javascript:void(0)" class="cross delete_image_one"><img src="'+base_url +'/images/cross.png" /></a></div></div></div>');
                       count = count + 1;
                   }
                }
                reader.readAsDataURL(this);
            });
            
        }
    } 

   
    $(document).on('click', '.delete_image_one', function (event) {
           var sum = $(this).data( 'count' );
           var imageid = $(this).data( 'imageid');
           $(this).closest(".col-xs-4").remove();
           if(imageid == undefined)
           {
             count--;
           }else if(localcount == 0)
           {
                count = sum + 1;
                localcount = 1;
                $.ajax({
                    type: 'POST',
                    url: base_url + '/deleteSingleImage ', 
                    data: {'imageid' : imageid },
                    headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val()},
                    async:false

                }).done(function(dataserver){
                    count--;
                }).fail(function() {
                    alert( "Posting failed." );
                });

           }else 
           {
                $.ajax({
                    type: 'POST',
                    url: base_url + '/deleteSingleImage ', 
                    data: {'imageid' : imageid },
                    headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val()},
                    async:false

                }).done(function(dataserver){
                    count--;
                }).fail(function() {
                    alert( "Posting failed." );
                });
           }
           
           
          
         });   

    $(document).on('click', '.continue-btn-save-form', function (event) {
        var count = 1;
        var display = [];
        var property_id = document.getElementById('property_id').value;
        $('.imageOutput .col-xs-4 .image-box img').each(function() {
             if(($(this).attr('src').substr(0,4)) == 'http')
            {
                //temp['image'] = $(this).attr('src');
                   //console.log(temp);
                   
            }else 
            {
                
                var temp = new Object();
                temp['_token'] = $('input[name=_token]').val();
                temp['profile_pic']  = $(this).attr('src');
                temp['property_id']  = $(this).data('propertyid');;
                //console.log(temp);
                display.push(temp);
                
                   
            }    
        });
        
        var datajson = JSON.stringify(display);
        $.ajax({
            type: 'POST',
            url: base_url + '/saveEidtTemporary ', 
            data: datajson,
            contentType: "application/json",
            headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val()},
            async:false

        }).done(function(dataserver){
             
            // show the response
           console.log(dataserver);
             
        })
        .fail(function() {
         
           alert( "Posting failed." );
             
        });

        //return;
        if($('#property_form').valid())
        {
          document.getElementById('property_form').submit();
        }
    });

    var form = $("#property_form");
    
    //Host Register Validation
    form.validate({
        rules: {
            plz_place: {
                required: true
            },
            street: {
                required: true,
            },
            country_id: {
                required: true,
            },
            bedroom: {
                required: true,
                number: true,
                min:1,
            },
            bathroom: {
                required: true,
                number: true,
                min:1,
            },
            bed: {
                required: true,
                number: true,
                min:1,
            },
            apartment_for: {
                required: true,
                number: true,
                min:1,
            },
            property_type_id: {
                required: true,
                number: true,
                min:1,
            },
            reference: {
                required: true
            },
            price_per_night: {
                required: true,
                number: true,
                min:1,
            },
            price_per_week: {
                required: true,
                number: true,
                min:1,
            },
            cleaning_fee: {
                required: true,
                number: true,
                min:1,
            },
            lining_space: {
                required: true,
                number: true,
                min:1,
            },
            start_date: {
                required: true,
            },
            end_date: {
                required:true,
            },
            min_stay: {
                required: true,
                number: true,
                min:1,
            },
            cancel_day:{
                required: true,
                number: true,
                min:1,
            },
            cancel_fee:{
                required: true,
                number: true,
                min:1,
            },
            vat_number: {
                required: true,
            },
            title: {
                required: true,
            },
            description: {
                required: true,
            },
            "checkboxvar[]": { 
              required: true, 
              minlength: 1 
              },
            "upload[]": {
               extension: "jpeg|jpg|png|gif"
            }
        },
        messages: {
            plz_place: {
                required: "<h6 style='color:#fb5252'>Please enter PLZ property.</h6>"
            },
            street: {
                required: "<h6 style='color:#fb5252'>Please enter your Stree, Nf.</h6>",
            },
            country_id: {
                required: "<h6 style='color:#fb5252'>Please select your Country.</h6>",
            },
            bedroom: {
                required: "<h6 style='color:#fb5252'>Please enter Bedroom.</h6>",
                number: "<h6 style='color:#fb5252'>Please enter number.</h6>",
                min:"<h6 style='color:#fb5252'>Please enter greater than 0.</h6>",
            },
            bathroom: {
                required: "<h6 style='color:#fb5252'>Please enter Bathroom.</h6>",
                number: "<h6 style='color:#fb5252'>Please enter number.</h6>",
                min:"<h6 style='color:#fb5252'>Please enter greater than 0.</h6>",
            },
            bed: {
                required: "<h6 style='color:#fb5252'>Please enter Beds.</h6>",
                number: "<h6 style='color:#fb5252'>Please enter number.</h6>",
                min:"<h6 style='color:#fb5252'>Please enter greater than 0.</h6>",
            },
            apartment_for: {
                required: "<h6 style='color:#fb5252'>Please select Apartment for.</h6>",
                number: "<h6 style='color:#fb5252'>Please select Apartment for.</h6>",
                min:"<h6 style='color:#fb5252'>Please enter greater than 0.</h6>",
            },
            lining_space: {
                required: "<h6 style='color:#fb5252'>Please enter Living space m2.</h6>",
                number: "<h6 style='color:#fb5252'>Please enter number.</h6>",
                min:"<h6 style='color:#fb5252'>Please enter greater than 0.</h6>",
            },
            property_type_id: {
                required: "<h6 style='color:#fb5252'>Please select Proper type.</h6>",
                number: "<h6 style='color:#fb5252'>Please select Property type.</h6>",
                min:"<h6 style='color:#fb5252'>Please enter greater than 0.</h6>",
            },
            vat_number:{
                required: "<h6 style='color:#fb5252'>Please enter VAT registration number.</h6>",
                number: "<h6 style='color:#fb5252'>Please enter number.</h6>",
                min:"<h6 style='color:#fb5252'>Please enter greater than 0.</h6>",
            },
            reference: {
                required: "<h6 style='color:#fb5252'>Please enter Object reference</h6>"
            },
            price_per_night: {
                required: "<h6 style='color:#fb5252'>Please enter Price per night.</h6>",
                number: "<h6 style='color:#fb5252'>Please enter number.</h6>",
                min:"<h6 style='color:#fb5252'>Please enter greater than 0.</h6>",
            },
            price_per_week: {
                required: "<h6 style='color:#fb5252'>Please enter Price per week.</h6>",
                number: "<h6 style='color:#fb5252'>Please enter number.</h6>",
                min:"<h6 style='color:#fb5252'>Please enter greater than 0.</h6>",
            },
            cleaning_fee: {
                required: "<h6 style='color:#fb5252'>Please enter Cleaning fee.</h6>",
                number: "<h6 style='color:#fb5252'>Please enter number.</h6>",
                min:"<h6 style='color:#fb5252'>Please enter greater than 0.</h6>",
            },
            start_date: {
                required: "<h6 style='color:#fb5252'>Please select Valid availability start date.</h6>",
                
            },
            end_date: {
                required: "<h6 style='color:#fb5252'>Please select Valid availability end date.</h6>",
                    },
            min_stay: {
                required: "<h6 style='color:#fb5252'>Please enter Minimum stay / night.</h6>",
                number: "<h6 style='color:#fb5252'>Please enter number.</h6>",
                min:"<h6 style='color:#fb5252'>Please enter greater than 0.</h6>",
            },
            min_stay: {
                required: "<h6 style='color:#fb5252'>Please enter Minimum stay / night.</h6>",
                number: "<h6 style='color:#fb5252'>Please enter number.</h6>",
                min:"<h6 style='color:#fb5252'>Please enter greater than 0.</h6>",
            },
            cancel_day: {
                required: "<h6 style='color:#fb5252'>Please enter Cancel day in advance.</h6>",
                number: "<h6 style='color:#fb5252'>Please enter number.</h6>",
                min:"<h6 style='color:#fb5252'>Please enter greater than 0.</h6>",
            },
            cancel_fee: {
                required: "<h6 style='color:#fb5252'>Please Select Cancel fee.</h6>",
                number: "<h6 style='color:#fb5252'>Please Select Cancel fee.</h6>",
                min:"<h6 style='color:#fb5252'>Please enter greater than 0.</h6>",
            },
            title: {
                required: "<h6 style='color:#fb5252'>Please enter Title.</h6>"
            },
            description: {
                required: "<h6 style='color:#fb5252'>Please enter Description.</h6>"
            },
            'checkboxvar[]': {
                required: "<h6 style='color:#fb5252'>Please Check one feature..</h6>",
                minlength: "<h6 style='color:#fb5252'>Please Check one feature.</h6>",
            },
            'upload[]': {
                
                extension: "<h6 style='color:#fb5252'>Please choose .jpeg,.gif,.png</h6>",
              
            }
            
        },
      errorPlacement: function(error, element) {
            if (element.attr("name") == "apartment_for" ){
                    error.insertAfter(".firstSelect");
            }else if (element.attr("name") == "property_type_id" ){
                    error.insertAfter(".secondSelect");
            }else if (element.attr("name") == "start_date" ){
                    error.insertAfter(".thirdSelect");
            }else if (element.attr("name") == "end_date" ){
                    error.insertAfter(".fourthSelect");
            }else if (element.attr("name") == "cancel_fee" ){
                    error.insertAfter(".fifthSelect");
            }else if (element.attr("name") == "upload[]" ){
                    error.insertAfter(".upload-pic");
            }else {
                //alert("Come Else");
              error.insertAfter(element);
            }
          },
        submitHandler: function (form) {
           //Handle Ajax Method and success  / error here
            form.submit();
        }
    });

    var $tabs = $('#wheel-tab li');

    $('#wheel-left').on('click', function () {
        $tabs.filter('.active').prev('li').find('a[data-toggle="tab"]').tab('show');
    });

    $('#wheel-right').on('click', function () {
        var reference = $('#addReference').val();
        $('#property_form').valid();
        if(document.getElementById('startdate') != null && document.getElementById('enddate') != null)
        {
            date1 = document.getElementById('startdate').value;
            dateArr1 = date1.split("/");
            d1 = new Date(dateArr1[1]+'/'+dateArr1[0]+'/'+dateArr1[2]);

            date2 = document.getElementById('enddate').value;
            dateArr2 = date2.split("/");
            d2 = new Date(dateArr2[1]+'/'+dateArr2[0]+'/'+dateArr2[2]);
             //console.log(d1+":"+d2);
            
            if ((Date.parse(d2) <= Date.parse(d1))) 
                document.getElementById("enddate").value = "";
            

           

           
        }  

        if(reference != "" )
        {
            $.ajax({
                type: 'GET',
                url: base_url + '/uniqueEditReference', 
                data: {reference:reference, id:proper_id},
                contentType: "application/json",
                headers: { 'X-CSRF-TOKEN': $('input[name=_token]').val()},
                async:false

            }).done(function(dataserver){
                 
               // if(parseInt(dataserver))
               // {
               //  $.fancybox([ { href : '#error_message' } ]);
               //  $('#errorCustomMessage').text(" Reference code already exist. ");
               //  $('#addReference').val("");

               // }else 
               // {
                 if($('#property_form').valid())
                 $tabs.filter('.active').next('li').find('a[data-toggle="tab"]').tab('show');
                 Sortable.create(simpleList, { /* options */ });

               //}
                 
            })
            .fail(function() {
             
               alert( "Posting failed." );
                 
            }); 
        }
    });

    var geocoder;
    geocoder = new google.maps.Geocoder();

    $( "#street_create_edit" ).blur(function() {
        
        
        geocoder.geocode( { 'address': $('#street_create_edit').val() + ',' + $('#plz_place').val()}, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                var lat = results[0].geometry.location.lat();
                var lng = results[0].geometry.location.lng();
                $('#street_lat_edit').val(lat.toFixed(6));
                $('#street_lng_edit').val(lng.toFixed(6));
                //alert( "Handler for .focus() called." );
              }
        });      

      
    });

    console.log(availableDates);

});