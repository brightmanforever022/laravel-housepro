
<div class="popup" id="error_message">
    <h1>Error Message</h1>
    <div class="alert-box success">
        <fieldset>
            <p id="errorCustomMessage" class="customeError red">dfjaslkfdjaslk;jfdlk;asjdf</p>
        </fieldset>         
    </div>
</div>


<div class="popup" id="information_message">
    <h1>Information</h1>
    <div class="alert-box success">
        <fieldset>
            <p id="infoCustomMessage" class="customeError red">dfjaslkfdjaslk;jfdlk;asjdf</p>
        </fieldset>         
    </div>
</div>



<div class="popup" id="paypal_error_information_message">
    <h1>Information</h1>
    <div class="alert-box success">
        <fieldset>
            <p id="infoCustomMessageNotRequire" class="customeError red">Payment Failed.Please try after some time.</p>
        </fieldset>         
    </div>
</div>




<div class="popup" id="cancel_message">
    <h1 id="headerText">BOOKING CANCELED!</h1>
    
    <form>
        <fieldset>
             <p class="welcome-grey" style="text-align: center;">Dear customer</p>
            <p class="welcome-grey" id="cancelCustomMessage" style="font-size: 12px !important;">Your booking has canceled. Your paid desposit will be refunded within 24 hours.</p>
            <p class="welcome-grey" style="text-align: center; font-size: 12px !important;">Thank you.</p>
        </fieldset>
        <!-- <fieldset><img src="{{ url("/") }}/images/welcome.png"></fieldset> -->
        <fieldset>
            <a href="{{ url('/') }}" class="edit-acct-btn">MAKE NOW A NEW BOOKING</a>
        </fieldset>
    </form>
</div>






<div class="popup-message" id="login_message">
    <div class="alert-box success" id="successSendMessage_user_">
    </div>
	<h1 id="checkUnreadDynamice"></h1>
    <table cellpadding="0" cellspacing="0" id="messageInsideTable">
       <!--  <tr>
            <td width="20%">
                <figure><img class="img-circle" src="http://localhost:8000/images/img.png"></figure>
            </td>
            <td width="20%"><h2>Sumit Dey<br>7:80</h2></td>
            <td width="60%">Every provider is checked by us which gurantees customer satisfaction of 95 %</td>
        </tr> -->
        <!-- <tr>
            <td width="20%">
                <figure><img class="img-circle" src="http://localhost:8000/images/img.png"></figure>
            </td>
            <td width="20%"><h2>Sumit Dey<br>7:80</h2></td>
            <td width="60%">Every provider is checked by us which gurantees customer satisfaction of 95 %</td>
        </tr>
        <tr>
            <td width="20%">
                <figure><img class="img-circle" src="http://localhost:8000/images/img.png"></figure>
            </td>
            <td width="20%"><h2>Sumit Dey<br>7:80</h2></td>
            <td width="60%">Every provider is checked by us which gurantees customer satisfaction of 95 %</td>
        </tr> -->
    </table>
    <form id="message_form_send">
    {{ csrf_field() }}
    <div id="hidden_send_message"></div>
        <textarea name="message"></textarea>
        <input type="submit" value="Send Message">
    </form>
    
</div>

<div class="popup" id="login">
    <h1>LOG-IN</h1>
    <div class="alert-box success" id="successMessage">
                       
    </div>

    <div class="wait_loading" style="display:none;width:69px;height:89px;border:1px solid white;position:absolute;top:50%;left:50%;padding:2px;"><img src='{{ url("/") }}/images/ajax-loader APARTOLINO.gif' width="32" height="32" /><br>Loading..</div>


    <form role="formlogin" id="form_login" method="POST" action="{{ url('/login') }}" onsubmit="return false;">
    {{ csrf_field() }}
        <fieldset>
            <input type="text" placeholder="E-mail*" name="email" id="email" required/>
            <label class="error_label"></label>
        </fieldset>
        <fieldset>
            <input type="password" placeholder="Password*" name="password" id="password" required/>
            <label class="error"></label>
        </fieldset>
        <fieldset>
            <p>Welcome back to APARTOLINO. We wish you a nice day.</p>
        </fieldset>
        <fieldset>
            <input type="hidden" id="single_search_form" name="single_search_form" value="{{ Request::fullUrl() }}">
            <input id="btn_login" type="submit" value="LOG IN"/>
        </fieldset>
        <fieldset>
            <p>Not at APARTOLINO now?<a href="#register" class="fancybox"> Sign up</a><a href="#password-forget" class="fancybox"> Forget password?</a></p>
        </fieldset>
    </form>
</div>




<div class="popup" id="password-forget">
    <h1>FORGET-PASSWORD</h1>
    <div class="alert-box success" id="successMatraMessage">
                       
    </div>

    <div class="wait_loading" style="display:none;width:69px;height:89px;border:1px solid white;position:absolute;top:50%;left:50%;padding:2px;"><img src='{{ url("/") }}/images/ajax-loader APARTOLINO.gif' width="32" height="32" /><br>Loading..</div>


    <form role="formlogin" id="form_login_forget" method="POST" action="{{ url('/login') }}" onsubmit="return false;">
    {{ csrf_field() }}
        <fieldset>
            <input type="text" placeholder="E-mail*" name="email" id="email_email" required/>
            <label class="error_label"></label>
        </fieldset>
        
        <fieldset>
            <p>Please enter your email. We will send link to mail for setting password.</p>
        </fieldset>
        <fieldset>
            <input type="hidden" id="single_search_form_forget" name="single_search_form" value="{{ Request::fullUrl() }}">
            <input id="btn_login" type="submit" value="VERIFY"/>
        </fieldset>
        
    </form>
</div>


<div class="popup" id="welcome-to-appartolino">
    <h1>WELCOME TO APARTOLINO</h1>
    
    <form>
        <fieldset>
            <p class="welcome-grey">Please complete your profile information and connect your PAYPAL ACCOUNT. Only then you can create your first advertisement and receive bookings.</p>
        </fieldset>
        <fieldset><img src="{{ url("/") }}/images/welcome.png"></fieldset>
        <fieldset>
            <a href="{{ url('/') }}/edit-profile-host" class="edit-acct-btn">EDIT PROFILE / ACCOUNT NOW</a>
        </fieldset>
    </form>
</div>

<div class="popup" id="register">
	<h1>NEW AT APARTOLINO?</h1>
    <div class="alert-box success" id="successMessage_user">
    </div>
    <div class="wait_loading" style="display:none;width:69px;height:89px;border:1px solid white;position:absolute;top:50%;left:50%;padding:2px;"><img src='{{ url("/") }}/images/ajax-loader APARTOLINO.gif' width="32" height="32" /><br>Loading..</div>

    <form role="form" method="POST" id="form_register" action="{{ url('/') }}/postRegister">
    {{ csrf_field() }}
    	<fieldset>
        	<input type="text" placeholder="Company*" name="company"/>
        </fieldset>
        <fieldset>
        	<input type="text" placeholder="Name*" name="name"/>
        </fieldset>
        <fieldset>
        	<input type="text" placeholder="Surname*" name="surname"/>
        </fieldset>
        <fieldset>
        	<input type="text" placeholder="Phone*" name="phone" id="phone"/>
        <label id="phone-error-some" class="error" for="phone_some"></label>    
       </fieldset>
    	<fieldset>
            <input type="text" placeholder="Address*" name="address"/>
        </fieldset>
        <fieldset>
            <input type="text" placeholder="E-mail*" name="email"/>
        </fieldset>
        <fieldset>
        	<input type="password" placeholder="Password*" name="password" id="host_password"/>
        </fieldset>
        <fieldset>
            <input type="password" placeholder="Confirm Password*" name="confirmpassword"/>
        </fieldset>
        <fieldset>
        	<p>When I register at APARTOLINO, i agree with the <a href="">Terms of Service</a> and the <a href="">Privacy policy</a>.</p>
        </fieldset>
        <fieldset>
        	<input type="submit" value="REGISTER"/>
        </fieldset>
        <fieldset>
        	<p>Already at APARTOLINO ?<a href="#login" class="fancybox"> Log-in</a></p>
        </fieldset>
    </form>
</div>


<div class="popup" id="register_user">
    <h1>NEW AT APARTOLINO?</h1>
    <div class="alert-box success" id="successMessage_user_">
    </div>
    <div class="wait_loading" style="display:none;width:69px;height:89px;border:1px solid white;position:absolute;top:50%;left:50%;padding:2px;"><img src='{{ url("/") }}/images/ajax-loader APARTOLINO.gif' width="32" height="32" /><br>Loading..</div>

    <form role="form" method="POST" id="form_register_user" action="{{ url('/') }}/postRegister">
    {{ csrf_field() }}
        <fieldset>
            <input type="text" placeholder="Name*" name="name"/>
        </fieldset>
        <fieldset>
            <input type="text" placeholder="Surname*" name="surname"/>
        </fieldset>
        <fieldset>
            <input type="text" placeholder="Phone*" name="phone" id="phone_user"/>
        <label id="phone-error-some-user" class="error" for="phone_some"></label>  
        <fieldset>
            <input type="text" placeholder="Address*" name="address"/>
        </fieldset>
        <fieldset>
            <input type="text" placeholder="E-mail*" name="email"/>
        </fieldset>
        <fieldset>
            <input type="password" placeholder="Password*" name="password" id="user_password"/>
        </fieldset>
        <fieldset>
            <input type="password" placeholder="Confirm Password*" name="confirmpassword"/>
        </fieldset>
        <fieldset>
            <p>When I register at APARTOLINO, i agree with the <a href="">Terms of Service</a> and the <a href="">Privacy policy</a>.</p>
        </fieldset>
        <fieldset>
            <input type="submit" value="REGISTER"/>
        </fieldset>
        <fieldset>
            <p>Already at APARTOLINO ?<a href="#login" class="fancybox"> Log-in</a></p>
        </fieldset>
    </form>
</div>
