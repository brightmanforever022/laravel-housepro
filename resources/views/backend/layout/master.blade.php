<!--
*
*  INSPINIA - Responsive Admin Theme
*  version 2.6
*
-->

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="google-signin-client_id" content="1018568614469-9uo2ikddddgklpvn44mmmqmkvib363uv.apps.googleusercontent.com">
    <meta name="google-signin-scope" content="https://www.googleapis.com/auth/analytics.readonly">
    <title>APARTOLINO | Dashboard</title>

    <link href="{!! url('/') !!}/inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="{!! url('/') !!}/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="{!! url('/') !!}/inspinia/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="{!! url('/') !!}/inspinia/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="{!! url('/') !!}/inspinia/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="{!! url('/') !!}/inspinia/css/animate.css" rel="stylesheet">
    <link href="{!! url('/') !!}/inspinia/css/style.css" rel="stylesheet">
    <script src="{!! url('/') !!}/inspinia/js/jquery-2.1.1.js"></script>
    
    <!-- Image cropper -->
    <script src="{!! url('/') !!}/inspinia/js/plugins/cropper/cropper.min.js"></script>


</head>

<body>
    <div id="wrapper">
    @include('backend.includes.left-nav')
    @yield('content')
    </div>

    <!-- Mainly scripts -->
    
    <script src="{!! url('/') !!}/inspinia/js/bootstrap.min.js"></script>
    <script src="{!! url('/') !!}/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="{!! url('/') !!}/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="{!! url('/') !!}/inspinia/js/plugins/flot/jquery.flot.js"></script>
    <script src="{!! url('/') !!}/inspinia/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="{!! url('/') !!}/inspinia/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="{!! url('/') !!}/inspinia/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="{!! url('/') !!}/inspinia/js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="{!! url('/') !!}/inspinia/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="{!! url('/') !!}/inspinia/js/demo/peity-demo.js"></script>


    <script src="{!! url('/') !!}/inspinia/js/plugins/dataTables/datatables.min.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="{!! url('/') !!}/inspinia/js/inspinia.js"></script>
    <script src="{!! url('/') !!}/inspinia/js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="{!! url('/') !!}/inspinia/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    <script src="{!! url('/') !!}/inspinia/js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="{!! url('/') !!}/inspinia/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="{!! url('/') !!}/inspinia/js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="{!! url('/') !!}/inspinia/js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="{!! url('/') !!}/inspinia/js/plugins/toastr/toastr.min.js"></script>
    <!-- ChartJS-->
    <script src="{!! url('/') !!}/inspinia/js/plugins/chartJs/Chart.min.js"></script>
 <!--    <script src="{!! url('/') !!}/inspinia/js/demo/chartjs-demo.js"></script> -->

     <!-- Jvectormap -->
    <script src="{!! url('/') !!}/inspinia/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="{!! url('/') !!}/inspinia/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="https://apis.google.com/js/client:platform.js"></script>



    
</body>
</html>



