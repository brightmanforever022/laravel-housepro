
@extends('backend.layout.master')

@section('content')

<div id="page-wrapper" class="gray-bg">
  <div class="row border-bottom">
    @include('backend.includes.nav-each')
  </div>
  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
      <h2>Messages</h2>
      <ol class="breadcrumb">
        <li>
          <a href="javascript:void(0);">Home</a>
        </li>

        <li class="active">
          <strong>Messages</strong>
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
            <h5>All Messages 
              <small>
                  @if(Session::has('message'))
                        <span style="color: #fff; padding: 5px 10px; background-color: #1ab394">{{ Session::get('message') }}</span>
                  @endif
              </small>
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
          </div>
          <div class="ibox-content">
          <form method="post" action="{{ url('/global-messages') }}" class="form-horizontal">
           {!! csrf_field() !!}
              <div class="form-group"><label class="col-sm-2 control-label"></label>
                <div class="col-sm-12">
                  <div style="height:250px; overflow-y: scroll ">
                        @if($messages)
                        @foreach($messages as $message)
                          <p style="padding:10px 5px; background-color: #F5F5F5; border-radius: 3px;">{{$message->message}} <a onclick="return confirm('Are you sure?')" href="{{ route('global-message.delete',$message->id) }}"><i class="fa fa-trash"></i></a></p>
                        @endforeach
                        @else
                          <p style="padding:10px 5px; background-color: #F5F5F5; border-radius: 3px;">Sorry, There are no messages.</p>
                        @endif
                       </div>
                     </div>

                     <div class="form-group" style="padding:0 15px;">
                      <label class="col-sm-12">Message</label>
                      <div class="col-sm-12">
                        <textarea class="form-control" required="true"  name="message"></textarea>
                      </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group" style="padding:0 15px;">
                      <div class="col-sm-4 ">
                        <button class="btn btn-primary" type="submit">Send</button>
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



