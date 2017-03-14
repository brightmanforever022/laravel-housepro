

<div class="popup" id="login">
	<h1>LOG-IN PROVIDER</h1>
    <div class="alert-box success" id="successMessage">
    <h1 style="color:green">You Email Vefiried Successfully</h1>
                       
    </div>
    <form role="formlogin" id="form_login" method="POST" action="{{ url('/login') }}">
    {{ csrf_field() }}
    	<fieldset>
        	<input type="text" placeholder="E-mail*" name="email" id="email"/>
            <label class="error_label"></label>
        </fieldset>
        <fieldset>
        	<input type="password" placeholder="Password*" name="password" id="password"/>
            <label class="error"></label>
        </fieldset>
        <fieldset>
        	<p>Welcome back to APARTOLINO. We wish you good business and a nice day</p>
        </fieldset>
        <fieldset>
        	<input id="btn_login" type="submit" value="LOG IN"/>
        </fieldset>
    </form>
</div>

<div class="popup" id="register">
	<h1>NEW AT APARTOLINO?</h1>
    <div class="alert-box success" id="successMessage_user">
    </div>
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
        	<input type="text" placeholder="Phone*" name="phone"/>
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
        	<p>When I register at APARTOLINO, i agree with the <a href="">Terms of Use</a> and the <a href="">Privacy rules</a>.</p>
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
    <form role="form" method="POST" id="form_register_user" action="{{ url('/') }}/postRegister">
    {{ csrf_field() }}
        <fieldset>
            <input type="text" placeholder="Name*" name="name"/>
        </fieldset>
        <fieldset>
            <input type="text" placeholder="Surname*" name="surname"/>
        </fieldset>
        <fieldset>
            <input type="text" placeholder="Phone*" name="phone"/>
        </fieldset>
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
            <p>When I register at APARTOLINO, i agree with the <a href="">Terms of Use</a> and the <a href="">Privacy rules</a>.</p>
        </fieldset>
        <fieldset>
            <input type="submit" value="REGISTER"/>
        </fieldset>
        <fieldset>
            <p>Already at APARTOLINO ?<a href="#login" class="fancybox"> Log-in</a></p>
        </fieldset>
    </form>
</div>
