
@extends('backend.layout.master')

@section('content')
        <!-- Page-Level Scripts -->
        <script>
            $(document).ready(function(){
                console.log("Come");
                $('.dataTables-example').DataTable({
                    pageLength: 25,
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
                            <strong>Users</strong>
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
                        <h5>Basic Data Tables example with responsive plugin</h5>
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



