<style type="text/css">
    .pad-L5{
        padding-left: 5px !important;
    }
    .pad-R5{
        padding-right: 5px !important;
    }
    .grey-bg{
        background: #F5F5F6;
        padding:0 3px 3px;
        margin-bottom: 25px;
    }
    .grey-bg h1{
        margin: 0;
        padding: 0;
        line-height: 30px;
            font-size: 15px;
    color: #676A6C;
        font-weight: bold;
    }
    .heading-grey{
        font-size: 16px;
        line-height: 24px;
        color: #000;
        font-weight: 600;
        padding: 0;
        padding-left: 10px;
        background: #ddd;
        margin: 0;
    }
    .ibox{
        margin-bottom: 0 !important;
    }
    .mar-t30{
        margin-top: 30px;
    }
    .dropdown.profile-element img {
        max-width: 100%;
    }
    .gray-bg{
        background: #fff !important;
    }
    .bg-change{
        border-color: #FFFFFF !important;
    }

</style>
@extends('backend.layout.master')

@section('content')
         <script>
            $(document).ready(function(){
                //console.log("Come");
                $('.dataTables-example').DataTable({
                    pageLength: 5,
                    responsive: true,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [
                        { extend: 'copy'},
                        {extend: 'csv'},
                        {extend: 'excel', title: 'ExampleFile'},
                        {extend: 'pdf', title: 'ExampleFile'},

                        {extend: 'print',
                         customize: function (win){
                                $(win.document.body).addClass('white-bg');
                                $(win.document.body).css('font-size', '10px');

                                $(win.document.body).find('table')
                                        .addClass('compact')
                                        .css('font-size', 'inherit');
                        }
                        }
                    ]

                });

                $('.dataTables-example-special').DataTable({
                    pageLength: 5,
                    responsive: true,
                    order: [[ 5, "desc" ]],
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [
                        { extend: 'copy'},
                        {extend: 'csv'},
                        {extend: 'excel', title: 'ExampleFile'},
                        {extend: 'pdf', title: 'ExampleFile'},

                        {extend: 'print',
                         customize: function (win){
                                $(win.document.body).addClass('white-bg');
                                $(win.document.body).css('font-size', '10px');

                                $(win.document.body).find('table')
                                        .addClass('compact')
                                        .css('font-size', 'inherit');
                        }
                        }
                    ]

                });


                $('.dataTables-example-pending').DataTable({
                    pageLength: 5,
                    responsive: true,
                    order: [[ 5, "desc" ]],
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [
                        { extend: 'copy'},
                        {extend: 'csv'},
                        {extend: 'excel', title: 'ExampleFile'},
                        {extend: 'pdf', title: 'ExampleFile'},

                        {extend: 'print',
                         customize: function (win){
                                $(win.document.body).addClass('white-bg');
                                $(win.document.body).css('font-size', '10px');

                                $(win.document.body).find('table')
                                        .addClass('compact')
                                        .css('font-size', 'inherit');
                        }
                        }
                    ]

                });

            });

        </script>
        <script type="text/javascript">
            var providers        = <?php echo json_encode($providers) ?>;
            var tenants          = <?php echo json_encode($tenants) ?>;
            var new_bookings     = <?php echo json_encode($new_bookings) ?>;
            var yearly_bookings  = <?php echo json_encode($yearly_bookings) ?>;
            var properties       = <?php echo json_encode($properties) ?>;
            var income            = <?php echo json_encode($monthly_income);?>
        </script>
        <?php 
           $sum_tenant = 0;
           foreach($tenants as $key=>$val)
           {
            $sum_tenant = $sum_tenant + intVal($val->total);
           }
           $sum_provider = 0;
           foreach($providers as $key=>$val)
           {
            $sum_provider = $sum_provider + intVal($val->total);
           }
           $sum_booking = 0;
           foreach($yearly_bookings as $key=>$val)
           {
            $sum_booking = $sum_booking + intVal($val->total);
           }
           $sum_properties = 0;
           foreach($properties as $key=>$val)
           {
            $sum_properties = $sum_properties + intVal($val->total);
           }
        ?>

        
        <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
        @include('backend.includes.nav-each')
        </div>
        <meta name="google-signin-client_id" content="1018568614469-9uo2ikddddgklpvn44mmmqmkvib363uv.apps.googleusercontent.com">
        <meta name="google-signin-scope" content="https://www.googleapis.com/auth/analytics.readonly">
 
<!-- <textarea cols="80" rows="20" id="query-output"></textarea> -->
      
        
        


       
<script src="{{ url('/') }}/js/backend/home.js"></script>
<script>
  // Replace with your view ID.
  var VIEW_ID = '130655923';
  var month_current = 0;
  var month_year    = 0;


  function apartolino_round(x){
         console.log(x);
         a = x.toString().split('.');
         if(parseInt(a[1]) < 5) 
         b = (parseFloat(a[0] + '0')/100).toFixed(2); 
         else if(parseInt(a[1]) == 5) 
         b = (parseFloat(a[0] + '5')/100).toFixed(2); 
         else if(parseInt(a[1]) > 5) 
         b = (parseFloat((parseInt(a[0]) + 1) + '0')/100).toFixed(2);
         return b; 
    }

  // Query the API and print the results to the page.
  function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
  }

  function queryReports() {
    gapi.client.request({
      path: '/v4/reports:batchGet',
      root: 'https://analyticsreporting.googleapis.com/',
      method: 'POST',
      body: {
        reportRequests: [
          {
            viewId: VIEW_ID,
            dateRanges: [
              {
                startDate: '2016-08-15',
                endDate: 'today'
              }
            ],
            dimensions:[
            {
              "name":"ga:countryIsoCode"
            }],
            metrics: [
              {
                expression: 'ga:sessions'
              }
            ]
          }
        ]
      }
    }).then(displayResults, console.error.bind(console));
  }


  function queryReports1() {
    var date = new Date();
    var firstDay_current = new Date(date.getFullYear(), date.getMonth(), 1);
    // var lastDay_current = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    // var firstDay_previous = new Date(date.getFullYear(), date.getMonth()-1, 1);
    // var lastDay_previous = new Date(date.getFullYear(), date.getMonth(), 0);

    gapi.client.request({
      path: '/v4/reports:batchGet',
      root: 'https://analyticsreporting.googleapis.com/',
      method: 'POST',
      body: {
        reportRequests: [
          {
            viewId: VIEW_ID,
            dateRanges: [
              {
                startDate: formatDate(firstDay_current),
                endDate: 'today'
              }
            ],
            dimensions:[
            {
              "name":"ga:countryIsoCode"
            }],
            metrics: [
              {
                expression: 'ga:sessions'
              }
            ]
          }
        ]
      }
    }).then(displayResults1, console.error.bind(console));
  }


  function queryReports1_year() {
    var date = new Date();
    var firstDay_year = date.getFullYear()+'-01-01';
    // var lastDay_current = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    // var firstDay_previous = new Date(date.getFullYear(), date.getMonth()-1, 1);
    // var lastDay_previous = new Date(date.getFullYear(), date.getMonth(), 0);

    gapi.client.request({
      path: '/v4/reports:batchGet',
      root: 'https://analyticsreporting.googleapis.com/',
      method: 'POST',
      body: {
        reportRequests: [
          {
            viewId: VIEW_ID,
            dateRanges: [
              {
                startDate: firstDay_year,
                endDate: 'today'
              }
            ],
            dimensions:[
            {
              "name":"ga:countryIsoCode"
            }],
            metrics: [
              {
                expression: 'ga:sessions'
              }
            ]
          }
        ]
      }
    }).then(displayResults1_year, console.error.bind(console));
  }


  function queryReports2() {
    var date = new Date();
    var firstDay_previous = new Date(date.getFullYear(), date.getMonth()-1, 1);
    var lastDay_previous = new Date(date.getFullYear(), date.getMonth(), 0);

    gapi.client.request({
      path: '/v4/reports:batchGet',
      root: 'https://analyticsreporting.googleapis.com/',
      method: 'POST',
      body: {
        reportRequests: [
          {
            viewId: VIEW_ID,
            dateRanges: [
              {
                startDate: formatDate(firstDay_previous),
                endDate: formatDate(lastDay_previous)
              }
            ],
            dimensions:[
            {
              "name":"ga:countryIsoCode"
            }],
            metrics: [
              {
                expression: 'ga:sessions'
              }
            ]
          }
        ]
      }
    }).then(displayResults2, console.error.bind(console));
  }

   function queryReports2_year() {
    var date = new Date();
    var firstDay_previous_year = (date.getFullYear()-1)+'-01-01';
    var lastDay_previous_year  = (date.getFullYear()-1)+'-12-31';

    gapi.client.request({
      path: '/v4/reports:batchGet',
      root: 'https://analyticsreporting.googleapis.com/',
      method: 'POST',
      body: {
        reportRequests: [
          {
            viewId: VIEW_ID,
            dateRanges: [
              {
                startDate: firstDay_previous_year,
                endDate: lastDay_previous_year
              }
            ],
            dimensions:[
            {
              "name":"ga:countryIsoCode"
            }],
            metrics: [
              {
                expression: 'ga:sessions'
              }
            ]
          }
        ]
      }
    }).then(displayResults2_year, console.error.bind(console));
  }

   function displayResults2(response) {
    var month_previous = parseInt(response.result.reports[0].data.totals[0].values[0]);
    var avgdiff1     = month_current  - month_previous;
    var avgsum1     = (month_current  + month_previous) / 2;
    var percentage2 = (avgdiff1 / avgsum1) * 100;
    //console.log(month_current+":"+month_previous);
    //console.log(percentage2);
    $('.current_month_statics').text(month_current);
    $('#current_month_percentage').text(apartolino_round(parseFloat(percentage2*10).toFixed(1)) +' % ');
    //console.log(month_current+":"+month_previous+":"+apartolino_round(parseFloat(percentage1*10).toFixed(1)));
   }

   function displayResults2_year(response) {
    var month_previous_year = parseInt(response.result.reports[0].data.totals[0].values[0]);
    

    var avgdiff1     = month_year  - month_previous_year;
    var avgsum1     = (month_year  + month_previous_year) / 2;
    var percentage1 = (avgdiff1 / avgsum1) * 100;
    $('.current_year_statics').text(month_year);
    $('#current_year_percentage').text(apartolino_round(parseFloat(percentage1*10).toFixed(1)) +' % ');
    //console.log(month_current+":"+month_previous+":"+apartolino_round(parseFloat(percentage1*10).toFixed(1)));
   }

  function displayResults1(response) {
    month_current = parseInt(response.result.reports[0].data.totals[0].values[0]);
    queryReports2();
   }

   function displayResults1_year(response) {
    month_year = parseInt(response.result.reports[0].data.totals[0].values[0]);
    queryReports2_year();
    
   }


  
  function displayResults(response) {
    

    var formattedJson = JSON.stringify(response.result, null, 2);
    var mapData1 = {};
    for (index = 0; index < response.result.reports[0].data.rows.length; ++index) {
        mapData1[response.result.reports[0].data.rows[index].dimensions[0]] = parseInt(response.result.reports[0].data.rows[index].metrics[0].values[0]);
    }
    
    $('#world-map').vectorMap({
                map: 'world_mill_en',
                backgroundColor: "transparent",
                regionStyle: {
                    initial: {
                        fill: '#e4e4e4',
                        "fill-opacity": 0.9,
                        stroke: 'none',
                        "stroke-width": 0,
                        "stroke-opacity": 0
                    }
                },

                series: {
                    regions: [{
                        values: mapData1,
                        scale: ["#1ab394", "#22d6b1"],
                        normalizeFunction: 'polynomial'
                    }]
                },
            });


    //document.getElementById('query-output').value = formattedJson;
    queryReports1();
    queryReports1_year();
  }

    


</script>

        <script src="https://apis.google.com/js/client:platform.js"></script>
                            <canvas id="doughnutChart2" width="0" height="0" ></canvas>
                                 <canvas id="doughnutChart" width="0" height="0" ></canvas>
                                    
                            

                <div class="row mar-t30">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="grey-bg">
                                <h1>NEW PROVIDERS</h1>
                                <div class="row">
                                    <div class="col-lg-6 pad-R5">
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-title">
                                                <span class="label label-success pull-right">Monthly</span>
                                                <!--h5>Views</h5-->
                                            </div>
                                            <div class="ibox-content bg-change">
                                                <h1 class="no-margins">{{$current1}}</h1>
                                                <div class="stat-percent font-bold text-success">{{intVal($percentage1)}}% <i class="fa fa-bolt"></i></div>
                                                <!--small>Total views</small-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 pad-L5">
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-title">
                                                <span class="label label-info pull-right">Annual</span>
                                                <!-- <h5>Orders</h5> -->
                                            </div>
                                            <div class="ibox-content bg-change">
                                                        <h1 class="no-margins">{{$current2}}</h1>
                                                        <div class="stat-percent font-bold text-info">{{intVal($percentage2)}}% <i class="fa fa-level-up"></i></div>
                                                        <!-- <small>New orders</small> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="grey-bg">
                                <h1>NEW TENANTS</h1>
                                <div class="row">
                                    <div class="col-lg-6 pad-R5">
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-title">
                                                <span class="label label-success pull-right">Monthly</span>
                                                <!-- <h5>Views</h5> -->
                                            </div>
                                            <div class="ibox-content bg-change">
                                                <h1 class="no-margins">{{$current3}}</h1>
                                                <div class="stat-percent font-bold text-success">{{intVal($percentage3)}}% <i class="fa fa-bolt"></i></div>
                                                <!-- <small>Total views</small> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 pad-L5">
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-title">
                                                <span class="label label-info pull-right">Annual</span>
                                                <!-- <h5>Orders</h5> -->
                                            </div>
                                            <div class="ibox-content bg-change">
                                                        <h1 class="no-margins">{{$current4}}</h1>
                                                        <div class="stat-percent font-bold text-info">{{intVal($percentage4)}}% <i class="fa fa-level-up"></i></div>
                                                        <!-- <small>New orders</small> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="grey-bg">
                                <div class="row">
                                    <div class="col-lg-6 pad-R5">
                                    <h1>NEW BOOKINGS</h1>
                                    </div>
                                    <div class="col-lg-6 pad-L5">
                                    <h1>BOOKINGS</h1>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 pad-R5">
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-title">
                                                <span class="label label-success pull-right">Monthly</span>
                                                <!-- <h5>Views</h5> -->
                                            </div>
                                            <div class="ibox-content bg-change">
                                                <h1 class="no-margins">{{$current5}}</h1>
                                                <div class="stat-percent font-bold text-success">{{intVal($percentage5)}}% <i class="fa fa-bolt"></i></div>
                                                <!-- <small>Total views</small> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 pad-L5">
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-title">
                                                <span class="label label-info pull-right">Annual</span>
                                                <!-- <h5>Orders</h5> -->
                                            </div>
                                            <div class="ibox-content bg-change">
                                                        <h1 class="no-margins">{{$current6}}</h1>
                                                        <div class="stat-percent font-bold text-info">{{intVal($percentage6)}}% <i class="fa fa-level-up"></i></div>
                                                       <!--  <small>New orders</small> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="grey-bg">
                                <div class="row">
                                    <div class="col-lg-6 pad-R5">
                                    <h1>NEW LISTINGS</h1>
                                    </div>
                                    <div class="col-lg-6 pad-L5">
                                    <h1>TOTAL LISTINGS</h1>
                                    </div>
                                </div>

                                
                                <div class="row">
                                    <div class="col-lg-6 pad-R5">
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-title">
                                                <span class="label label-success pull-right">Monthly</span>
                                                <!-- <h5>Views</h5> -->
                                            </div>
                                            <div class="ibox-content bg-change">
                                                <h1 class="no-margins">{{$current7}}</h1>
                                                <div class="stat-percent font-bold text-success">{{intVal($percentage7)}}% <i class="fa fa-bolt"></i></div>
                                                <!-- <small>Total views</small> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 pad-L5">
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-title">
                                                <span class="label label-info pull-right">Annual</span>
                                                <!-- <h5>Orders</h5> -->
                                            </div>
                                            <div class="ibox-content bg-change">
                                                        <h1 class="no-margins">{{$current8}}</h1>
                                                        <div class="stat-percent font-bold text-info">{{intVal($percentage8)}}% <i class="fa fa-level-up"></i></div>
                                                        <!-- <small>New orders</small> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="grey-bg">
                                <h1>INCOME FEE (MONTH)</h1>
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <!--h5>Bar Chart Example</h5-->
                                    </div>
                                    <div class="ibox-content">
                                        <div>
                                            <!-- <canvas id="barChart" height="140" data-set='<?php //echo json_encode($monthly_income); ?> ' ></canvas> -->
                                            <canvas id="barChart" height="140" ></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="grey-bg">
                                <h1>INCOME FEE (YEAR)</h1>
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <!-- <h5>Bar Chart Example</h5> -->
                                    </div>
                                    <div class="ibox-content">
                                        <div>
                                            <canvas id="barChart1" height="140"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-4">
                         <div class="grey-bg">
                                <h1>VISITORS</h1>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="g-signin2" data-onsuccess="queryReports"></div>
                                    <div id="world-map" style="height: 320px;"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <span class="label label-primary pull-right"></span>
                                            <h5>MONTHLY</h5>
                                        </div>
                                        <div class="ibox-content">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h1 class="no-margins current_month_statics"></h1>
                                                    <div class="font-bold text-navy"><span id="current_month_percentage"></span><i class="fa fa-level-up"></i> <small>Rapid pace</small></div>
                                                </div>
                                                <!-- <div class="col-md-6">
                                                    <h1 class="no-margins">206,120</h1>
                                                    <div class="font-bold text-navy">22% <i class="fa fa-level-up"></i> <small>Slow pace</small></div>
                                                </div> -->
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>

                             <div class="row">
                                <div class="col-md-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <span class="label label-primary pull-right"></span>
                                            <h5>YEAR</h5>
                                        </div>
                                        <div class="ibox-content">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h1 class="no-margins current_year_statics"></h1>
                                                    <div class="font-bold text-navy"><span id="current_year_percentage"></span><i class="fa fa-level-up"></i> <small>Rapid pace</small></div>
                                                </div>
                                                <!-- <div class="col-md-6">
                                                    <h1 class="no-margins">206,120</h1>
                                                    <div class="font-bold text-navy">22% <i class="fa fa-level-up"></i> <small>Slow pace</small></div>
                                                </div> -->
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                


                

                <div class="row">
                <div class="col-lg-12">
                    <div class="grey-bg">
                            <h1>NEW REGISTERED</h1>
                            <div class="ibox float-e-margins">
                                <!--div class="ibox-title">
                                    <h5>NEW REGISTERED<br>
                                        PENDING TO APPROVE
                                    </h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-wrench"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-user">
                                            <li><a href="#">Config option 1</a>
                                            </li>
                                            <li><a href="#">Config option 2</a>
                                            </li>
                                        </ul>
                                        <a class="close-link">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div-->
                                <div class="ibox-content">

                                    <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>Company</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                <tr class="gradeX">
                                    <td>{{ $user->company }}</td>
                                    <td>{{ $user->name }} {{ $user->surname }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>
                                        @if($user->active == 0)
                                         <a href="{{  url('/change_status/'.$user->id.'/1') }}" class="btn btn-primary btn-xs">Approve</a></td>
                                        @else
                                             <a href="{{  url('/change_status/'.$user->id.'/0') }}" class="btn btn-danger btn-xs">Disapprove</a></td>
                                        @endif
                                        @if($user->user_type == 0) 
                                        <td>User</td>
                                        @elseif($user->user_type == 1)
                                        <td>Host</td>
                                        @endif
                                    <td><a href="{{ url('/') }}/admin_profile_view/{{ $user->id }}" class="btn btn-info btn-xs">View</a>
                                      <a href="{{ url('/') }}/admin_profile_edit/{{ $user->id }}" class="btn btn-info btn-xs">Edit</a>
                                      <a href="{{ url('/') }}/admin_profile_delete/{{ $user->id }}" class="btn btn-info btn-xs" onclick="return confirm('Are you sure?')">Delete</a></td>
                                </tr>
                                @endforeach
                                </tbody>
                                <!--tfoot>
                                <tr>
                                    <th>Company</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot-->
                                </table>
                                    </div>

                                </div>
                            </div>
                    </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                    <div class="grey-bg">
                            <h1>LATEST BOOKINGS</h1>
                    <div class="ibox float-e-margins">
                        <!-- <div class="ibox-title">
                            <h5>LATEST BOOKINGS<br>
                                LIST
                            </h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#">Config option 1</a>
                                    </li>
                                    <li><a href="#">Config option 2</a>
                                    </li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div> -->
                        <div class="ibox-content">

                            <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example-special" >
                        <thead>
                        <tr>
                          <th>Property Title</th>
                          <th>Provider</th>
                          <th>Tenant</th>
                          <th>Check In</th>
                          <th>Check Out</th>
                          <th>Booking Date</th>
                          <th>Price Per Night</th>
                          <th>Total Amount</th>
                          <th>Deposit Paid</th>
                          <th>Final Amount</th>
                          <th>Total Stay</th>
                          <th>Tenant Booking Status</th>
                          <th>Host Booking Status</th>
                        </tr>
                        </thead>
                        <tbody> 
                        @if(count($bookings_new)) 
                        @foreach($bookings_new as $property)
                        <?php
                           $properties = \App\Property::where('user_id', $property->user_id)->where('booking_id','!=',0)->get();
                           $payments_yearly = \App\Payment::where('host_id', $property->user_id)->where('created_at', 'like', "%{date('Y')}%")->get();
                            
                            if(count($payments_yearly) < 50)
                            {
                              $deduct = 3.5;
                            }else if(count($payments_yearly) > 50 && count($payments_yearly) < 100)
                            {
                              $deduct = 3.0;
                            }else if(count($payments_yearly) > 100 && count($payments_yearly) < 200)
                            {
                              $deduct = $amount * 2.5;
                            }else if( count($payments_yearly) >= 200)
                            {
                              $deduct = 2.0;
                            }
                          
                        ?>

                        <tr class="gradeX">
                          <td>{{ $property->title }}</td>
                          <td>@if(count($property->user) > 0){{ $property->user->name }} {{ $property->user->surname }}@endif</td>
                          <td>{{ $property->booking->booking->name }} {{ $property->booking->booking->surname }}</td>
                          <td>{{ date('d-m-Y', strtotime($property->booking->booking->check_in)) }}</td>
                          <td>{{ date('d-m-Y', strtotime($property->booking->booking->check_out)) }}</td>
                          <td data-order="{{ strtotime(date('d-m-Y', strtotime( $property->booking->created_at))) }}">{{ date('d-m-Y h:i:s', strtotime( $property->booking->created_at)) }} </td>
                          <td>{{ $property->price_per_night }} </td>
                          <td>{{ $property->booking->amount }}</td>
                          <td>{{ $property->booking->initial }}</td>
                          <td>{{ number_format( $property->booking->amount -  $property->booking->initial, 2,'.','') }}</td>
                          <td>{{ $property->booking->booking->nights }} nights</td>
                          <td>
                          @if($property->booking->booking->booking_status_tenant == 1)
                          Confirmed
                          @elseif($property->booking->booking->booking_status_tenant == 2)
                          Canceled
                          @else
                          Unknown
                          @endif
                          </td>
                          <td>
                            @if($property->property_booking_status == 0)
                          Accept/Reject
                          @elseif($property->property_booking_status == 1)
                          Adopted 
                          @else
                          Rejected
                          @endif

                          </td>

                        </tr>
                        @endforeach
                        @else
                           No Booking Found.
                        @endif
                       
                        </tbody>
                        <!--tfoot>
                        <tr>
                            <th>Rendering engine</th>
                            <th>Browser</th>
                            <th>Platform(s)</th>
                            <th>Engine version</th>
                            <th>CSS grade</th>
                        </tr>
                        </tfoot-->
                        </table>
                            </div>

                        </div>
                    </div>
                    </div>
                    </div>
                   
                </div>


                <div class="row">
                     <div class="col-lg-12">
                     <div class="grey-bg">
                            <h1>PENDING PAYMENTS</h1>
                    <div class="ibox float-e-margins">
                        <!--div class="ibox-title">
                            
                            <h5>PENDING PAYMENTS<br>
                                LIST (TRANSACTIONS)
                            </h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#">Config option 1</a>
                                    </li>
                                    <li><a href="#">Config option 2</a>
                                    </li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div-->
                        <div class="ibox-content">

                            <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example-pending" >
                        <thead>
                        <tr>
                              <th>Property Title</th>
                              <th>Provider</th>
                              <th>Tenant</th>
                              <th>Check In</th>
                              <th>Check Out</th>
                              <th>Booking Date</th>
                              <th>Total Amount</th>
                              <th>Deposit Paid</th>
                              <th>Fee Paid</th>
                              <th>Tenant Booking Status</th>
                              <th>Host Booking Status</th>
                              <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($transactions_new))
                        @foreach($transactions_new as $key=>$property)
                        <?php
                           $properties = \App\Property::where('user_id', $property->user_id)->where('booking_id','!=',0)->get();

                           $payments_yearly = \App\Payment::where('host_id', $property->user_id)->where('created_at', 'like', "%{date('Y')}%")->get();
                            
                            if(count($payments_yearly) < 50)
                            {
                              $deduct = 3.5;
                            }else if(count($payments_yearly) > 50 && count($payments_yearly) < 100)
                            {
                              $deduct = 3.0;
                            }else if(count($payments_yearly) > 100 && count($payments_yearly) < 200)
                            {
                              $deduct = $amount * 2.5;
                            }else if( count($payments_yearly) >= 200)
                            {
                              $deduct = 2.0;
                            }

                            $amount = $property->booking->initial - ($property->booking->amount * $deduct / 100);
                           
                        ?>
                        @if($property->booking->refund_status == 0)
                       
                        <tr class="gradeX">
                            <td>{{ $property->title }}</td>
                          <td>@if(count($property->user) > 0){{ $property->user->name }} {{ $property->user->surname }}@endif</td>
                          <td>{{ $property->booking->booking->name }} {{ $property->booking->booking->surname }}</td>
                          <td>{{ date('d-m-Y', strtotime($property->booking->booking->check_in)) }}</td>
                          <td>{{ date('d-m-Y', strtotime($property->booking->booking->check_out)) }}</td>
                          <td data-order="{{ strtotime(date('d-m-Y', strtotime( $property->booking->created_at))) }}">{{ date('d-m-Y h:i:s', strtotime($property->booking->created_at)) }} </td>
                          <td>{{ $property->booking->amount }}</td>
                          <td>{{ $property->booking->initial }}</td>
                          <td>{{  \ApartHelper::apartolino_round(round($property->booking->amount * $deduct / 100, 2)*10)  }}</td>
                          <td>
                          @if($property->booking->booking->booking_status_tenant == 1)
                          Confirmed<br/>({{ date('d-m-Y h:i:s', strtotime($property->booking->created_at)) }})
                          @elseif($property->booking->booking->booking_status_tenant == 2)
                          Canceled<br/>({{ date('d-m-Y h:i:s', strtotime($property->booking->booking->updated_at)) }})
                          @else
                          Unknown
                          @endif
                          </td>
                          <td>
                          @if($property->property_booking_status == 0)
                          Accept/Reject<br/>
                          @elseif($property->property_booking_status == 1)
                          Adopted<br/>({{ date('d-m-Y h:i:s', strtotime($property->updated_at)) }})
                          @else
                          Rejected<br/>({{ date('d-m-Y h:i:s', strtotime($property->updated_at)) }})
                          @endif

                          </td>
                          <td>
                            @if($property->booking->booking->booking_status_tenant == 1 && $property->property_booking_status == 1 && $property->booking->refund_status == 0 && $property->booking->booking->check_in <= date('Y-m-d'))
                            @if(count($property->user) > 0)
                            <a href="{{  url('/payToHost/'.$property->user->paypal_email.'/'.$amount.'/'.$property->booking_id.'/'.$property->user_id) }}" class="btn btn-primary btn-xs">Transfer To Host</a>
                            @endif
                            </td>
                           @elseif($property->booking->booking->booking_status_tenant == 1 && $property->property_booking_status == 1 && $property->booking->refund_status == 2 && $property->booking->booking->check_in <= date('Y-m-d'))
                            <a href="javascript:void(0)" class="btn btn-primary btn-xs">Transferred</a></td>
                           @elseif($property->booking->booking->booking_status_tenant == 1 && $property->property_booking_status == 1 && $property->booking->refund_status == 0 && $property->booking->booking->check_in > date('Y-m-d'))
                            <a href="javascript:void(0)" class="btn btn-primary btn-xs">Booking Date Not Arrived</a></td>
                           @elseif($property->booking->booking->booking_status_tenant == 1 && $property->property_booking_status == 0 && $property->booking->refund_status == 0)
                            <a href="javascript:void(0)" class="btn btn-primary btn-xs">Host needs to updated status</a> </td>
                           @elseif($property->booking->booking->booking_status_tenant == 2 && $property->booking->refund_status == 0)
                             <a href="{{  url('/refundSale/'.$property->booking->token) }}" class="btn btn-primary btn-xs">Refund To User</a></td>
                           @elseif($property->property_booking_status == 2 && $property->booking->refund_status == 0)
                             <a href="{{  url('/refundSale/'.$property->booking->token) }}" class="btn btn-primary btn-xs">Refund To User</a></td> 
                           @elseif($property->property_booking_status == 2 && $property->booking->refund_status == 1)
                             <a href="javascript:void(0)" class="btn btn-primary btn-xs">Refunded</a></td>
                           @elseif($property->booking->booking->booking_status_tenant == 2 && $property->booking->refund_status == 1)
                             <a href="javascript:void(0)" class="btn btn-primary btn-xs">Refunded</a></td>                        
                           @endif
                         </td>
                        </tr>
                        @endif
                        @endforeach
                        @else
                           No Booking Found.
                        @endif
                        </tbody>
                        <!--tfoot>
                        <tr>
                              <th>Property Title</th>
                              <th>Posted By</th>
                              <th>Tenant</th>
                              <th>Check In</th>
                              <th>Check Out</th>
                              <th>Booking Date</th>
                              <th>Amount Paid</th>
                              <th>Total Amount</th>
                              <th>Tenant Booking Satatus</th>
                              <th>Host Booking Satatus</th>
                              <th>Action</th>
                        </tr>
                        
                        </tfoot-->
                        </table>
                            </div>

                        </div>
                    </div>
                    </div>
                    </div>
                </div>

                


        </div>
        <div class="small-chat-box fadeInRight animated">

            <div class="heading" draggable="true">
                <small class="chat-date pull-right">
                    02.19.2015
                </small>
                Small chat
            </div>

            <div class="content">

                <div class="left">
                    <div class="author-name">
                        Monica Jackson <small class="chat-date">
                        10:02 am
                    </small>
                    </div>
                    <div class="chat-message active">
                        Lorem Ipsum is simply dummy text input.
                    </div>

                </div>
                <div class="right">
                    <div class="author-name">
                        Mick Smith
                        <small class="chat-date">
                            11:24 am
                        </small>
                    </div>
                    <div class="chat-message">
                        Lorem Ipsum is simpl.
                    </div>
                </div>
                <div class="left">
                    <div class="author-name">
                        Alice Novak
                        <small class="chat-date">
                            08:45 pm
                        </small>
                    </div>
                    <div class="chat-message active">
                        Check this stock char.
                    </div>
                </div>
                <div class="right">
                    <div class="author-name">
                        Anna Lamson
                        <small class="chat-date">
                            11:24 am
                        </small>
                    </div>
                    <div class="chat-message">
                        The standard chunk of Lorem Ipsum
                    </div>
                </div>
                <div class="left">
                    <div class="author-name">
                        Mick Lane
                        <small class="chat-date">
                            08:45 pm
                        </small>
                    </div>
                    <div class="chat-message active">
                        I belive that. Lorem Ipsum is simply dummy text.
                    </div>
                </div>


            </div>
            <div class="form-chat">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control">
                    <span class="input-group-btn"> <button
                        class="btn btn-primary" type="button">Send
                </button> </span></div>
            </div>

        </div>
        <!-- <div id="small-chat">

            <span class="badge badge-warning pull-right">5</span>
            <a class="open-small-chat">
                <i class="fa fa-comments"></i>

            </a>
        </div> -->
        <div id="right-sidebar" class="animated">
            <div class="sidebar-container">

                <ul class="nav nav-tabs navs-3">

                    <li class="active"><a data-toggle="tab" href="#tab-1">
                        Notes
                    </a></li>
                    <li><a data-toggle="tab" href="#tab-2">
                        Projects
                    </a></li>
                    <li class=""><a data-toggle="tab" href="#tab-3">
                        <i class="fa fa-gear"></i>
                    </a></li>
                </ul>

                <div class="tab-content">


                    <div id="tab-1" class="tab-pane active">

                        <div class="sidebar-title">
                            <h3> <i class="fa fa-comments-o"></i> Latest Notes</h3>
                            <small><i class="fa fa-tim"></i> You have 10 new message.</small>
                        </div>

                        <div>

                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="{!! url('/') !!}/inspinia/img/a1.jpg">

                                        <div class="m-t-xs">
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">

                                        There are many variations of passages of Lorem Ipsum available.
                                        <br>
                                        <small class="text-muted">Today 4:21 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="{!! url('/') !!}/inspinia/img/a2.jpg">
                                    </div>
                                    <div class="media-body">
                                        The point of using Lorem Ipsum is that it has a more-or-less normal.
                                        <br>
                                        <small class="text-muted">Yesterday 2:45 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="{!! url('/') !!}/inspinia/img/a3.jpg">

                                        <div class="m-t-xs">
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        Mevolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                        <br>
                                        <small class="text-muted">Yesterday 1:10 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="{!! url('/') !!}/inspinia/img/a4.jpg">
                                    </div>

                                    <div class="media-body">
                                        Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the
                                        <br>
                                        <small class="text-muted">Monday 8:37 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="{!! url('/') !!}/inspinia/img/a8.jpg">
                                    </div>
                                    <div class="media-body">

                                        All the Lorem Ipsum generators on the Internet tend to repeat.
                                        <br>
                                        <small class="text-muted">Today 4:21 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="{!! url('/') !!}/inspinia/img/a7.jpg">
                                    </div>
                                    <div class="media-body">
                                        Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
                                        <br>
                                        <small class="text-muted">Yesterday 2:45 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="{!! url('/') !!}/inspinia/img/a3.jpg">

                                        <div class="m-t-xs">
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        The standard chunk of Lorem Ipsum used since the 1500s is reproduced below.
                                        <br>
                                        <small class="text-muted">Yesterday 1:10 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="{!! url('/') !!}/inspinia/img/a4.jpg">
                                    </div>
                                    <div class="media-body">
                                        Uncover many web sites still in their infancy. Various versions have.
                                        <br>
                                        <small class="text-muted">Monday 8:37 pm</small>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>

                    <div id="tab-2" class="tab-pane">

                        <div class="sidebar-title">
                            <h3> <i class="fa fa-cube"></i> Latest projects</h3>
                            <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
                        </div>

                        <ul class="sidebar-list">
                            <li>
                                <a href="#">
                                    <div class="small pull-right m-t-xs">9 hours ago</div>
                                    <h4>Business valuation</h4>
                                    It is a long established fact that a reader will be distracted.

                                    <div class="small">Completion with: 22%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                                    </div>
                                    <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="small pull-right m-t-xs">9 hours ago</div>
                                    <h4>Contract with Company </h4>
                                    Many desktop publishing packages and web page editors.

                                    <div class="small">Completion with: 48%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 48%;" class="progress-bar"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="small pull-right m-t-xs">9 hours ago</div>
                                    <h4>Meeting</h4>
                                    By the readable content of a page when looking at its layout.

                                    <div class="small">Completion with: 14%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-primary pull-right">NEW</span>
                                    <h4>The generated</h4>
                                    There are many variations of passages of Lorem Ipsum available.
                                    <div class="small">Completion with: 22%</div>
                                    <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="small pull-right m-t-xs">9 hours ago</div>
                                    <h4>Business valuation</h4>
                                    It is a long established fact that a reader will be distracted.

                                    <div class="small">Completion with: 22%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                                    </div>
                                    <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="small pull-right m-t-xs">9 hours ago</div>
                                    <h4>Contract with Company </h4>
                                    Many desktop publishing packages and web page editors.

                                    <div class="small">Completion with: 48%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 48%;" class="progress-bar"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="small pull-right m-t-xs">9 hours ago</div>
                                    <h4>Meeting</h4>
                                    By the readable content of a page when looking at its layout.

                                    <div class="small">Completion with: 14%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-primary pull-right">NEW</span>
                                    <h4>The generated</h4>
                                    <!--<div class="small pull-right m-t-xs">9 hours ago</div>-->
                                    There are many variations of passages of Lorem Ipsum available.
                                    <div class="small">Completion with: 22%</div>
                                    <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                </a>
                            </li>

                        </ul>

                    </div>

                    <div id="tab-3" class="tab-pane">

                        <div class="sidebar-title">
                            <h3><i class="fa fa-gears"></i> Settings</h3>
                            <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
                        </div>

                        <div class="setings-item">
                    <span>
                        Show notifications
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example">
                                    <label class="onoffswitch-label" for="example">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Disable Chat
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" checked class="onoffswitch-checkbox" id="example2">
                                    <label class="onoffswitch-label" for="example2">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Enable history
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example3">
                                    <label class="onoffswitch-label" for="example3">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Show charts
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example4">
                                    <label class="onoffswitch-label" for="example4">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Offline users
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox" id="example5">
                                    <label class="onoffswitch-label" for="example5">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Global search
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox" id="example6">
                                    <label class="onoffswitch-label" for="example6">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Update everyday
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example7">
                                    <label class="onoffswitch-label" for="example7">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-content">
                            <h4>Settings</h4>
                            <div class="small">
                                I belive that. Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                And typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                Over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                            </div>
                        </div>

                    </div>
                </div>

            </div>



        </div>

<script>
        $(document).ready(function() {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('Admin', 'Welcome to APARTOLINO');

            }, 1300);


/***************************Monthly Income **********************/
         
            var barData = {
                    labels: [
                        @foreach($monthly_income as $key => $value)
                        {{$key}},
                        @endforeach
                    ],
                    datasets: [
                        {
                            label: "Fee CHF",
                            backgroundColor: 'rgba(26,179,148,0.5)',
                            borderColor: "rgba(26,179,148,0.7)",
                            pointBackgroundColor: "rgba(26,179,148,1)",
                            pointBorderColor: "#fff",
                            data: [ 
                            @foreach($monthly_income as $value)
                                {{ round($value,-1,PHP_ROUND_HALF_UP) }},
                            @endforeach
                            ]
                        }
                    ]
                };

                 var barOptions = {
                    responsive: true
                };


                var ctx2 = document.getElementById("barChart").getContext("2d");
                new Chart(ctx2, {type: 'bar', data: barData, options:barOptions});
         

/***************************Yearly Income **********************/
         
            var barData1 = {
                    labels: [
                        @foreach($yearly_income as $key => $value)
                        "{{$key}}",
                        @endforeach
                    ],
                    datasets: [
                        {
                            label: "Fee CHF",
                            backgroundColor: 'rgba(26,179,148,0.5)',
                            borderColor: "rgba(26,179,148,0.7)",
                            pointBackgroundColor: "rgba(26,179,148,1)",
                            pointBorderColor: "#fff",
                            data: [ 
                            @foreach($yearly_income as $value)
                               {{round($value,-1,PHP_ROUND_HALF_UP)}},
                            @endforeach
                            ]
                        }
                    ]
                };

                 var barOptions = {
                    responsive: true
                };


                var ctx3 = document.getElementById("barChart1").getContext("2d");
                new Chart(ctx3, {type: 'bar', data: barData1, options:barOptions});
          });
           
    </script>        

@endsection



