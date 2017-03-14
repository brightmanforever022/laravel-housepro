
@extends('backend.layout.master')

@section('content')
        <!-- Page-Level Scripts -->
        <script>
            $(document).ready(function(){
                console.log("Come");

                $('.dataTables-example').DataTable({
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
        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        @include('backend.includes.nav-each')
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Data Tables</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="javascript:void(0);">Home</a>
                        </li>
                        <li>
                            <a>Tables</a>
                        </li>
                        <li class="active">
                            <strong>Bookings</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Bookings</h5>
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
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
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
                   @if(count($properties))
                   @foreach($properties as $property) 
                    <tr class="gradeX">
                      <td>{{ $property->title }}</td>
                      <td>@if ($property->user){{ $property->user->name }} {{ $property->user->surname }} @endif</td>
                      <td>{{ $property->booking->booking->name }} {{ $property->booking->booking->surname }}</td>
                      <td data-order="{{ strtotime(date('d-m-Y', strtotime($property->booking->booking->check_in))) }}">{{ date('d-m-Y', strtotime($property->booking->booking->check_in)) }}</td>
                      <td data-order="{{ strtotime(date('d-m-Y', strtotime($property->booking->booking->check_out))) }}">{{ date('d-m-Y', strtotime($property->booking->booking->check_out)) }}</td>
                      <td data-order="{{ strtotime(date('d-m-Y', strtotime( $property->booking->created_at))) }}">{{ date('d-m-Y', strtotime( $property->booking->created_at)) }} </td>
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

                      </td>
                    </tr>
                    @endforeach
                    @else
                       No Booking Found.
                    @endif
           
                    </tbody>
  
                    </table>
                        </div>

                    </div>
                </div>
            </div>
            </div>
        </div>
        <div class="footer">
            <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2017
            </div>
        </div>

        </div>
   
@endsection



