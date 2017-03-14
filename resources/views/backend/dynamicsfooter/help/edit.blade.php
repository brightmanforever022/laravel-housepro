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
                            <h5>Row1</small></h5>
                            <div class="ibox-tools">
                                   <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form method="post" action="{{url('/')}}/bookRow1Update" class="form-horizontal">
                                {!! csrf_field() !!}
                                 @foreach($rows as $key=>$value)
                                 @if($value['rows'] == 1)
                                <input type="hidden" name="id" value="{{ $value['id'] }}">
                                <div class="form-group"><label class="col-sm-2 control-label">Title</label>

                                    <div class="col-sm-10"><input type="text" class="form-control" name="title" value="{!! $value['title'] !!}"></div>
                                </div>

                                <div class="form-group"><label class="col-sm-2 control-label">Description</label>

                                    <div class="col-sm-10"><textarea class="form-control" name="description">{!! $value['description'] !!}</textarea></div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-white" type="submit">Cancel</button>
                                        <button class="btn btn-primary" type="submit">Save changes</button>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </form>
                        </div>
                    </div>
                </div>
               
            </div>
            
        
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
            <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Row2</small></h5>
                            <div class="ibox-tools">
                                   <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form method="post" action="{{url('/')}}/bookRow2Update" class="form-horizontal">
                                {!! csrf_field() !!}
                                
                                @foreach($rows as $key=>$value)
                                @if($value['rows'] == 2)
                                <input type="hidden" name="id{{$key}}" value="{!! $value['id'] !!}">
                                <div class="form-group"><label class="col-sm-2 control-label">Title</label>

                                    <div class="col-sm-10"><input type="text" class="form-control" name="title{{$key}}" value="{!! $value['title'] !!}"></div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Description</label>

                                    <div class="col-sm-10"><textarea class="form-control" name="description{{$key}}">{!! $value['description'] !!}</textarea></div>
                                </div>
                                @endif
                                @endforeach
                                
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


        <

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