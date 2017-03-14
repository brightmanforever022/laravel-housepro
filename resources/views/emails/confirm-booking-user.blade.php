<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet' type='text/css'>
	<title>Email Confirmation</title>
	<style>
		.wrapper{
			margin:0 auto;
			border:2px solid #E96B5C;
			width:500px;
			padding:40px;
			text-align:center;
			border-radius:5px;
			background:url("{!! url('/') !!}/images/banner.jpg") center center;
		}
		.title{
			font-size:30px;font-weight:500;
			margin-bottom:50px; color:#fff;
		}
		.paragraph{
			font-size:16px;
			font-weight:400; 
			margin-bottom:50px;
			color:#fff;
			letter-spacing:1px;
		}
		.button{
			background: #E96B5C;
			color: #fff;
			padding:10px 15px;
			font-size: 18px;
			letter-spacing: 1px;
			display:block;
			text-decoration:none;
			width:200px;
			margin:50px auto 0;
			font-weight:700;
			letter-spacing:1px;
			border-radius:3px;
		}
	</style>
</head>
<body style="font-family: 'Roboto', sans-serif;">
	<div class="wrapper">
		<h1 class="title" style="color: #999">Hi {!! $name !!},</h1>
	    <p class="paragraph" style="color: #999">Host {!! $host_name !!}  has accepted the following booking. </p>
		
		<a href="{!! $link !!}" class="button" target="_blank">See Property</a>
		<a href="{!! $cancel !!}" class="button" target="_blank">Cancel Booking</a>
                <a href="{!! $attach !!}" class="button" target="_blank">Booking PDF</a>
	</div>
</body>
</html>
