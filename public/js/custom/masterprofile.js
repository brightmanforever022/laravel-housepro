$(document).ready(function() {
  $.material.init();  
  $( "#datepicker" ).datepicker();

  
  $(document ).on('keypress','#phone' , function (e) {   
        var field=this.value.replace("+41", "");
        

        if (e.which < 0x20) {
            // e.which < 0x20, then it's not a printable character
            // e.which === 0 - Not a character
            return;     // Do nothing
        }
        if (field.length == 9) {
            document.getElementById('phone-error-some').style.display = 'none';
            e.preventDefault();
        } else if (field.length < 9) {
           document.getElementById('phone-error-some').innerHTML = 'Please enter 9 digit.';
           document.getElementById('phone-error-some').style.color = '#fb5252';
           document.getElementById('phone-error-some').style.display = 'block';
        } else if (field.length > 9) {
            // Maximum exceeded
            //this.value = this.value.substring(0, max);
        }
  });

 
  $(document ).on('keydown','#phone' , function (e) {   
        var field=this.value.replace("+41", "");
        if(e.which == 7 && field.length <= 9)
        {
           document.getElementById('phone-error-some').innerHTML = 'Please enter 9 digit.';
           document.getElementById('phone-error-some').style.color = '#fb5252';
           document.getElementById('phone-error-some').style.display = 'block';
           return;
        }

       
  });

  
  $(document ).on('keyup','#phone' , function (e) {    
    var field=this.value.replace("+41", "");
    if(/^\d+$/.test(field.trim()))
    {
       //document.getElementById('phone-error-some').style.display = 'none';
    }else 
    {
        document.getElementById('phone-error-some').innerHTML = 'Please enter number only';
        document.getElementById('phone-error-some').style.color = '#fb5252';
        document.getElementById('phone-error-some').style.display = 'block';
        
    }
    //alert(field.length);


    
  });

 
$(document ).on('focus','#phone' , function (e) {     
    var oldvalue='+41';
    var field=this;
    setTimeout(function () {
        if(field.value.indexOf('+41') !== 0) {
            $(field).val(oldvalue);
        } 
    }, 1);
});


$(document ).on('keydown','#phone' , function (e) {    
    var oldvalue='+41';
    var field=this;
    setTimeout(function () {
        if(field.value.indexOf('+41') !== 0) {
            $(field).val(oldvalue);
        } 
    }, 1);
});



$(document ).on('keypress','#phone_user' , function (e) {      
        var field=this.value.replace("+41", "");
       

        if (e.which < 0x20) {
            // e.which < 0x20, then it's not a printable character
            // e.which === 0 - Not a character
            return;     // Do nothing
        }
        if (field.length == 9) {
            document.getElementById('phone-error-some-user').style.display = 'none';
            e.preventDefault();
        } else if (field.length < 9) {
           document.getElementById('phone-error-some-user').innerHTML = 'Please enter 9 digit.';
           document.getElementById('phone-error-some-user').style.color = '#fb5252';
           document.getElementById('phone-error-some-user').style.display = 'block';
        } else if (field.length > 9) {
            // Maximum exceeded
            //this.value = this.value.substring(0, max);
        }
  });

  
  $(document ).on('keydown','#phone_user' , function (e) {    
        var field=this.value.replace("+41", "");
        if(e.which == 7 && field.length <= 9)
        {
           document.getElementById('phone-error-some-user').innerHTML = 'Please enter 9 digit.';
           document.getElementById('phone-error-some-user').style.color = '#fb5252';
           document.getElementById('phone-error-some-user').style.display = 'block';
           return;
        }

       
  });

  $(document ).on('keyup','#phone_user' , function (e) {   
    var field=this.value.replace("+41", "");
    if(/^\d+$/.test(field.trim()))
    {
       //document.getElementById('phone-error-some').style.display = 'none';
    }else 
    {
        document.getElementById('phone-error-some-user').innerHTML = 'Please enter number only';
        document.getElementById('phone-error-some-user').style.color = '#fb5252';
        document.getElementById('phone-error-some-user').style.display = 'block';
        
    }
    //alert(field.length);


    
  });


$(document ).on('focus','#phone_user' , function (e) {     
    var oldvalue='+41';
    var field=this;
    setTimeout(function () {
        if(field.value.indexOf('+41') !== 0) {
            $(field).val(oldvalue);
        } 
    }, 1);
});


$(document ).on('keydown','#phone_user' , function (e) {      
    var oldvalue='+41';
    var field=this;
    setTimeout(function () {
        if(field.value.indexOf('+41') !== 0) {
            $(field).val(oldvalue);
        } 
    }, 1);
});



    jQuery.validator.setDefaults({
    errorPlacement: function(error, element) {
        error.insertAfter('#invalid-' + element.attr('id'));
    }
    });

    
    $('#form_login').validate({
        rules: {
            password: {
                required: true
            },
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            password: {
                required: "<h6 style='color:#fb5252'>Please enter your password.</h6>"
            },
            email: {
                required: "<h6 style='color:#fb5252'>Please enter your email address.</h6>",
                email   : "<h6 style='color:#fb5252'>Please enter valid email address.</h6>"
            }
        },
      errorPlacement: function(error, element) {
            if (element.attr("name") == "fname" || element.attr("name") == "lname" ) {
              error.insertAfter("#lastname");
            } else {
              error.insertAfter(element);
            }
          },
        submitHandler: function (form) {
           //Handle Ajax Method and success  / error here
            //form.submit();
        }
    });

    //Host Register Validation
    $('#form_register').validate({
        rules: {
            company: {
                required: true
            },
            name: {
                required: true,
            },
            surname: {
                required: true,
            },
            phone: {
                required: true,
                
            },
            email: {
                required: true,
                email:true,
            },
            address: {
                required:true,
            },
            password: {
                required: true,
                minlength:6
            },
            confirmpassword:{
                equalTo: "#host_password"
       
            },
        },
        messages: {
            company: {
                required: "<h6 style='color:#fb5252'>Please enter company name.</h6>"
            },
            name: {
                required: "<h6 style='color:#fb5252'>Please enter your Name.</h6>",
            },
            surname: {
                required: "<h6 style='color:#fb5252'>Please enter your Surname.</h6>",
            },
            phone: {
                required: "<h6 style='color:#fb5252'>Please enter your phone.</h6>",
                
            },
            email: {
                required: "<h6 style='color:#fb5252'>Please enter your email address.</h6>",
                email   : "<h6 style='color:#fb5252'>Please enter valid email address.</h6>"
            },
            address: {
                required: "<h6 style='color:#fb5252'>Please enter your address.</h6>",
            },
            password: {
                required: "<h6 style='color:#fb5252'>Please enter your password.</h6>",
                minlength: "<h6 style='color:#fb5252'>Please enter minimum six digit.</h6>",
            },
            confirmpassword: {
                equalTo: "<h6 style='color:#fb5252'>Enter Confirm Password Same as Password.</h6>",
            }
        },
      errorPlacement: function(error, element) {
            if (element.attr("name") == "fname" || element.attr("name") == "lname" ) {
              error.insertAfter("#lastname");
            } else {
              error.insertAfter(element);
            }
          },
        submitHandler: function (form) {
           //Handle Ajax Method and success  / error here
            //form.submit();
        }
    });


     $('#message_form_send').validate({
        rules: {
            
            message: {
                required: true,
            }
        },
        messages: {
            
            message: {
                required: "<h6 style='color:#fb5252'>Please enter your Message.</h6>",
            }
        },
      errorPlacement: function(error, element) {
            if (element.attr("name") == "fname" || element.attr("name") == "lname" ) {
              error.insertAfter("#lastname");
            } else {
              error.insertAfter(element);
            }
          },
        submitHandler: function (form) {
           //Handle Ajax Method and success  / error here
            //form.submit();
        }
    });    
    
    



    //User Register Validation
    $('#form_register_user').validate({
        rules: {
            
            name: {
                required: true,
            },
            surname: {
                required: true,
            },
            phone: {
                required: true,
                
            },
            email: {
                required: true,
                email:true,
            },
            address: {
                required:true,
            },
            password: {
                required: true,
                minlength:6
            },
            confirmpassword:{
                equalTo: "#user_password"
       
            },
        },
        messages: {
            
            name: {
                required: "<h6 style='color:#fb5252'>Please enter your Name.</h6>",
            },
            surname: {
                required: "<h6 style='color:#fb5252'>Please enter your Surname.</h6>",
            },
            phone: {
                required: "<h6 style='color:#fb5252'>Please enter your phone.</h6>",
                
            },
            email: {
                required: "<h6 style='color:#fb5252'>Please enter your email address.</h6>",
                email   : "<h6 style='color:#fb5252'>Please enter valid email address.</h6>"
            },
            address: {
                required: "<h6 style='color:#fb5252'>Please enter your address.</h6>",
            },
            password: {
                required: "<h6 style='color:#fb5252'>Please enter your password.</h6>",
                minlength: "<h6 style='color:#fb5252'>Please enter minimum six digit.</h6>",
            },
            confirmpassword: {
                equalTo: "<h6 style='color:#fb5252'>Enter Confirm Password Same as Password.</h6>",
            }
        },
      errorPlacement: function(error, element) {
            if (element.attr("name") == "fname" || element.attr("name") == "lname" ) {
              error.insertAfter("#lastname");
            } else {
              error.insertAfter(element);
            }
          },
        submitHandler: function (form) {
           //Handle Ajax Method and success  / error here
            //form.submit();
        }
    });    
    
    


    $('#edit-host-form').validate({
        rules: {
            company: {
                required: true
            },
            name: {
                required: true,
            },
            surname: {
                required: true,
            },
            phone: {
                required: true,
                
            },
            email: {
                required: true,
                email:true,
            },
            address: {
                required:true,
            },
            
        },
        messages: {
            company: {
                required: "<h6 style='color:#fb5252'>Please enter company name.</h6>"
            },
            name: {
                required: "<h6 style='color:#fb5252'>Please enter your Name.</h6>",
            },
            surname: {
                required: "<h6 style='color:#fb5252'>Please enter your Surname.</h6>",
            },
            phone: {
                required: "<h6 style='color:#fb5252'>Please enter your phone.</h6>",
               
            },
            email: {
                required: "<h6 style='color:#fb5252'>Please enter your email address.</h6>",
                email   : "<h6 style='color:#fb5252'>Please enter valid email address.</h6>"
            },
            address: {
                required: "<h6 style='color:#fb5252'>Please enter your address.</h6>",
            },
            
        },
      errorPlacement: function(error, element) {
            if (element.attr("name") == "fname" || element.attr("name") == "lname" ) {
              error.insertAfter("#lastname");
            } else {
              error.insertAfter(element);
            }
          },
        submitHandler: function (form) {
           //Handle Ajax Method and success  / error here
            form.submit();
        }
    });


      
     $(document ).on('click','.res-nav' , function (e) {         
            $(".responsive-nav").addClass("open-nav");
      });
     
      $(document ).on('click','.close' , function (e) {   
            $(".responsive-nav").removeClass("open-nav");
      });


        function initialize_location() { 
            var input = document.getElementById('city_where_met');
            if(input) { 
                var autocomplete = new google.maps.places.Autocomplete(input, ['city']);
            }
        }
          initialize_location();


        $('.banner').parallax({imageSrc: 'images/banner.jpg'});
        $('.about-us').parallax({imageSrc: 'images/banner2.png'});
        $('.fancybox').fancybox();
          $( "li.after-login a" ).click(function() {
            $( ".login_dropdown" ).toggle("slow")
          });

          var gallery = $('.photos').gallerify({
            margin:15,
            mode:{
                maxHeight: screen.height * 1,
                breakPoints:[
                    {
                        minWidth: 1280,
                        columns: 4,
                    },{
                        minWidth: 1024,
                        columns: 3,
                    },{
                        minWidth: 768,
                        columns: 3,
                    },{
                        maxWidth: 640,
                        columns: 2,
                    }
                ]
            },
            lastRow:'adjust'
        });  


        /*Edit Host Form jquery
        */
       

        $(document ).on('click','.continue-btn-user' , function (e) {     
            var form = $( "#edit-host-form" );
            form.validate();
            if(form.valid())
            document.getElementById("edit-host-form").submit();
        }) ;


        $('#edit-host-account').validate({
        rules: {
            name: {
                required: true
            },
            iban: {
                required: true,
            },
            vat_nr: {
                required: true,
            }
            
        },
        messages: {
            name: {
                required: "<h6 style='color:#fb5252'>Please enter Name of bank.</h6>"
            },
            iban: {
                required: "<h6 style='color:#fb5252'>Please enter IBAN.</h6>",
            },
            vat_nr: {
                required: "<h6 style='color:#fb5252'>Please enter your VAT -NR.</h6>",
            },
            
        },
      errorPlacement: function(error, element) {
            if (element.attr("name") == "fname" || element.attr("name") == "lname" ) {
              error.insertAfter("#lastname");
            } else {
              error.insertAfter(element);
            }
          },
        submitHandler: function (form) {
           //Handle Ajax Method and success  / error here
            form.submit();
        }
    });

        
        $(document ).on('click','.continue-btn-account' , function (e) {     
            var form = $( "#edit-host-account" );
            form.validate();
            if(form.valid())
            document.getElementById("edit-host-account").submit();
        }) ;


       $(document ).on('click','.reject' , function (e) { 
            e.preventDefault();
            var self = $(this).parentsUntil(".delete-parent");
            $.ajax({
                url: $(this).attr('href'),
                type: 'GET',
                success: function (data) {
                    if(data.confirm !== 'CANCELING FAILED!')
                    self.remove();
                    $.fancybox([ { href : '#cancel_message' } ]);
                      $('#cancelCustomMessage').html(data.message);
                      $('#headerText').html(data.confirm);
                      
                }
            });
       });

    
});    