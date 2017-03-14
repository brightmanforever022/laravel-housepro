 
@extends('backend.layout.master')

@section('content')

<div id="page-wrapper" class="gray-bg">
  <div class="row border-bottom">
    @include('backend.includes.nav-each')
  </div>
  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
      <h2>Change Password</h2>
      <ol class="breadcrumb">
        <li>
          <a href="javascript:void(0);">Home</a>
        </li>

        <li class="active">
          <strong>Change Password</strong>
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
            <h5>Change Password
              <small>
                  @if(Session::has('message'))
                        <span style="color: #fff; padding: 5px 10px; background-color: #1ab394">{{ Session::get('message') }}</span>
                  @endif
              </small>
            </h5>
            {{-- <div class="ibox-tools">
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
            </div> --}}
          </div>
          <div class="ibox-content">
	        <form action="{{ route('admin.save.password.setting') }}" class="form-horizontal" role="form" method="post">
             {{ csrf_field() }}
                <div class="form-group">
                    <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Current Password</label>
                    <div class="col-lg-9">
                        <input type="password" name="old_pass" class="form-control" " id="inputEmail1" placeholder="Current Password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">New Password</label>
                    <div class="col-lg-9 ">
                        <input type="password" name="new_pass" class="form-control disabled" id="inputPassword1" placeholder="New Password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Confirm Password</label>
                    <div class="col-lg-9 ">
                        <input type="password" name="confirm_pass" class="form-control disabled" id="inputPassword1" placeholder="Confirm Password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label"></label>
                    <div class="col-lg-9 ">
                        <button class="btn btn-primary pull-right" type="submit">Update</button>
                    </div>
                </div>
            </form>
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



