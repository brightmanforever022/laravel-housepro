@extends('backend.layout.master')

@section('content')

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
         @include('backend.includes.nav-each')
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Basic Form</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a>Forms</a>
                        </li>
                        <li class="active">
                            <strong>Basic Form</strong>
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
                            <h5>All form elements <small>With custom checbox and radion elements.</small></h5>
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
                            <form method="post" action="{{url('/')}}/userUpdate" class="form-horizontal">
                                {!! csrf_field() !!}
                                <input type="hidden" name="id" value="{{ $user[0]->id}}">
                                <div class="form-group"><label class="col-sm-2 control-label">Name</label>

                                    <div class="col-sm-10"><input type="text" class="form-control" name="name" value="{{ $user[0]->name}}"></div>
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Surame</label>

                                    <div class="col-sm-10"><input type="text" class="form-control" name="surname" value="{{ $user[0]->surname}}"></div>
                                </div>
                                
                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-2 control-label">Phone</label>

                                    <div class="col-sm-10"><input type="text" class="form-control" value="{{ $user[0]->phone}}" name="phone"></div>
                                </div>
                                
                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-2 control-label">Email</label>

                                    <div class="col-sm-10"><input type="text" class="form-control" name="email" value="{{ $user[0]->email}}"></div>
                                </div>
                                
                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-2 control-label">Address</label>

                                    <div class="col-sm-10"><input type="text" class="form-control" name="address" value="{{ $user[0]->address}}"></div>
                                </div>
                                
                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-2 control-label">Additional Address</label>

                                   @if($user[0]->additional_address == "")
                                   <div class="col-sm-10"><input  name="additional_address" type="text" class="form-control" placeholder="Data Not Found"></div>
                                   @else
                                   <div class="col-sm-10"><input  name="additional_address" type="text" class="form-control" placeholder="Additional Address" value="{{ $user[0]->additional_address}}"></div>
                                   @endif
                                    
                                </div>
                                
                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-2 control-label">Place</label>
                                  @if($user[0]->place == "")
                                  <div class="col-sm-10"><input type="text" name="place" class="form-control" placeholder="Data Not Found"></div>
                                  @else
                                  <div class="col-sm-10"><input type="text" name="place" class="form-control" placeholder="Address" value="{{ $user[0]->place}}"></div>
                                  @endif
                                    
                                </div>
                                
                                <div class="hr-line-dashed"></div>
                                
                                
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-white" type="submit">Cancel</button>
                                        <button class="btn btn-primary" type="submit">Save changes</button>
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