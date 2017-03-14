
@extends('backend.layout.master')

    @section('content')

        <script type="text/javascript">
            $(document).ready(function() {

                $('#form_vedio').validate({
                    rules: {
                        video_file: {
                            required: true,
                            extension: "mp4"
                        },
                        video_mov_file: {
                            required: true,
                            extension: "mov"
                        },
                        video_ogv_file: {
                            required: true,
                            extension: "ogv"
                        },
                        video_webm_file: {
                            required: true,
                            extension: "webm"
                        },
                        video_jpg_file: {
                            required: true,
                             extension: "jpg"
                        }
                    },
                    messages: {
                        video_file: {
                            required: "<h6 style='color:red'>Please upload .mp4 file.</h6>",
                            extension: "<h6 style='color:red'>Please upload .mp4 file.</h6>"
                        },
                        video_mov_file: {
                            required: "<h6 style='color:red'>Please upload .mov file.</h6",
                            extension: "<h6 style='color:red'>Please upload .mov file.</h6>"
                        },
                        video_ogv_file: {
                            required: "<h6 style='color:red'>Please upload .ogv file</h6>",
                            extension: "<h6 style='color:red'>Please upload .ogv file.</h6>"
                        },
                        video_webm_file: {
                            required: "<h6 style='color:red'>Please upload .webm file</h6",
                            extension: "<h6 style='color:red'>Please upload .webm file.</h6>"
                        },
                        video_jpg_file: {
                            required: "<h6 style='color:red'>Please upload .jpg file</h6>",
                            extension: "<h6 style='color:red'>Please upload .jpg file.</h6>"
                        }
                    },
                  errorPlacement: function(error, element) {
                        if (element.attr("name") == "fname" || element.attr("name") == "lname" ) {
                          error.insertAfter("#lastname");
                        } else {
                          error.insertAfter(element);
                        }
                      },
                    submitHandler: function (form) {
                       //Handle Ajax Method and success  / error here
                        //form.submit();
                    }
                });

               $('#form_vedio').submit(function(event){
                    event.preventDefault();
                    //console.log($('#form_login').serialize());
                    if($('#form_vedio').valid())
                    {
                      document.getElementById('form_vedio').submit();
                    }else 
                    {
                      return false;
                    }
                });
            });   

        </script>
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                @include('backend.includes.nav-each') 
            </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Basic Form</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="javascript:void(0);">Home</a>
                        </li>
                        <li>
                            <a>Forms</a>
                        </li>
                        <li class="active">
                            <strong>>Upload Fronend Video/Image</strong>
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
                                <!--h5>All form elements <small>With custom checbox and radion elements.</small></h5-->
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
                                <form action="{{url('/')}}/uploadVideo" method="post" id="form_vedio" enctype="multipart/form-data" class="form-horizontal">
                                {!! csrf_field() !!}
                              
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <span class="btn btn-default btn-file"><span class="fileinput-new">Mp4 input</span>
                                        <span class="fileinput-exists">Change</span><input type="file" name="video_file" id="exampleInputFile"/></span>
                                        <span class="fileinput-filename"></span>
                                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a>
                                    </div> 
                                    Upload .mp4 file only.
                                    <div class="hr-line-dashed"></div>

                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <span class="btn btn-default btn-file"><span class="fileinput-new">Mov input</span>
                                        <span class="fileinput-exists">Change</span><input type="file" name="video_mov_file" id="exampleInputFilemov"/></span>
                                        <span class="fileinput-filename"></span>
                                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a>
                                    </div>
                                    Upload .mov file only. 
                                    <div class="hr-line-dashed"></div>
                                

                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <span class="btn btn-default btn-file"><span class="fileinput-new">Ogv input</span>
                                        <span class="fileinput-exists">Change</span><input type="file" name="video_ogv_file" id="exampleInputFileogv"/></span>
                                        <span class="fileinput-filename"></span>
                                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a>
                                    </div> 
                                    Upload .ogv file only.
                                    <div class="hr-line-dashed"></div>


                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <span class="btn btn-default btn-file"><span class="fileinput-new">Webm input</span>
                                        <span class="fileinput-exists">Change</span><input type="file" name="video_webm_file" id="exampleInputFilewebm"/></span>
                                        <span class="fileinput-filename"></span>
                                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a>
                                    </div>
                                    Upload .webm file only.     
                                    <div class="hr-line-dashed"></div>

                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <span class="btn btn-default btn-file"><span class="fileinput-new">Image input</span>
                                        <span class="fileinput-exists">Change</span><input type="file" name="video_jpg_file" id="exampleInputFilejpg"/></span>
                                        <span class="fileinput-filename"></span>
                                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a>
                                    </div>
                                    Upload .jpg file only.    
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