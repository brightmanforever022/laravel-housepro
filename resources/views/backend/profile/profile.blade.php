@extends('backend.layout.master')

@section('content')



<div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        @include('backend.includes.nav-each')
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>Contacts 2</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            App Views
                        </li>
                        <li class="active">
                            <strong>Contacts 2</strong>
                        </li>
                    </ol>
                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-3">
                <div class="contact-box center-version">

                    <a href="javascript:void(0);">

                        
                          @if($user[0]->path == "")
                          <img alt="image" class="img-circle" src="../../dist/img/user4-128x128.jpg">
                          @else
                          <img alt="image" class="img-circle" src="{{url('/')}}/profilepics/{{ $user[0]->path }}">
                          @endif

                        <h3 class="m-b-xs"><strong>{{ $user[0]->saluation }} {{ $user[0]->name }} {{ $user[0]->surname }}</strong></h3>

                        <div class="font-bold">
                              @if($user[0]->user_type == 0)
                              User
                              @elseif($user[0]->user_type == 1)
                              Host
                              @endif
                        </div>
                        <address class="m-t-md">
                            @if($user[0]->company != "Not Required")
                            <strong>{{ $user[0]->company }}.</strong><br>
                            @endif
                            {{ $user[0]->address }}<br>
                            @if($user[0]->additional_address != "")
                            {{ $user[0]->additional_address }}<br>
                            @endif
                            @if($user[0]->place != "")
                            {{ $user[0]->place }}<br>
                            @endif
                            Email:{{ $user[0]->email }}<br>
                            Phone: {{ $user[0]->phone }}
                            

                        </address>

                    </a>
                    <!--div class="contact-box-footer">
                        <div class="m-t-xs btn-group">
                            <a class="btn btn-xs btn-white"><i class="fa fa-phone"></i> Call </a>
                            <a class="btn btn-xs btn-white"><i class="fa fa-envelope"></i> Email</a>
                            <a class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Follow</a>
                        </div>
                    </div-->

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
