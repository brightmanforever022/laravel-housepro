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
                            <form method="post" action="{{url('/')}}/pressRow1Update" class="form-horizontal">
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
                                <div class="row">
                                    <div class="col-sm-4">
                                        <button class="btn btn-white" type="submit">Cancel</button>
                                        <button class="btn btn-primary" type="submit">Save changes</button>
                                    </div>
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
                            <form method="post" action="{{url('/')}}/pressRow2Update" class="form-horizontal">
                                {!! csrf_field() !!}
                                
                                @foreach($rows as $key=>$value)
                                @if($value['rows'] == 2)
                                <input type="hidden" name="id{{$key}}" value="{!! $value['id'] !!}">
                                <input type="hidden" name="title{{$key}}" value="{!! $value['title'] !!}">
                                <div class="form-group"><label class="col-sm-2 control-label">Description</label>

                                    <div class="col-sm-10"><textarea class="form-control" name="description{{$key}}">{!! $value['description'] !!}</textarea></div>
                                </div>
                                @endif
                                @endforeach
                                
                                <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <button class="btn btn-white" type="submit">Cancel</button>
                                        <button class="btn btn-primary" type="submit">Save changes</button>
                                    </div>
                                </div>
                                </div>
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
                            <h5>Row3</small></h5>
                            <div class="ibox-tools">
                                   <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form method="post" action="{{url('/')}}/pressRow3Update" class="form-horizontal">
                                {!! csrf_field() !!}
                                
                                @foreach($rows as $key=>$value)
                                @if($value['rows'] == 3)
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
                                <div class="row">
                                    <div class="col-sm-4">
                                        <button class="btn btn-white" type="submit">Cancel</button>
                                        <button class="btn btn-primary" type="submit">Save changes</button>
                                    </div>
                                </div>
                                </div>
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
                            <h5>Row4</small></h5>
                            <div class="ibox-tools">
                                   <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form method="post" action="{{url('/')}}/pressRow4Update" class="form-horizontal" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                
                                @foreach($rows as $key=>$value)
                                @if($value['rows'] == 4)
                                <input type="hidden" name="id_image" value="{!! $value['id'] !!}">
                                <div class="form-group">
                                    <div class="row" style="">
                                        <div class="col-md-6">
                                            <h4>Preview Logo</h4>
                                            <div class="img-preview-logo">
                                            <img src="{{url('/')}}/images/{{$value['title']}}" style="max-width: 100% !important;"/>    

                                            </div>
                                            <div class="btn-group">
                                                <label title="Upload image file" for="inputImageLogo" class="btn btn-primary">
                                                    <input type="file" accept="image/*" name="file_logo" id="inputImageLogo" class="hide">
                                                    Upload Logo
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row" style="">
                                        <div class="col-md-6">
                                            <h4>Preview Management</h4>
                                            <div class=" img-preview-management">
                                            <img src="{{url('/')}}/images/{{$value['description']}}" style="max-width: 100% !important;"/>    

                                            </div>
                                            <div class="btn-group">
                                                <label title="Upload image file" for="inputImageManagement" class="btn btn-primary">
                                                    <input type="file" accept="image/*" name="file_management" id="inputImageManagement" class="hide">
                                                    Upload Management
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="row" style="">
                                        <div class="col-md-6">
                                            <h4>Preview Press</h4>
                                            <div class=" img-preview-press">
                                            <img src="{{url('/')}}/images/{{$value['logo']}}" style="max-width: 100% !important;"/>    

                                            </div>
                                            <div class="btn-group">
                                                <label title="Upload image file" for="inputImagePress" class="btn btn-primary">
                                                    <input type="file" accept="image/*" name="file_press" id="inputImagePress" class="hide">
                                                    Upload Press
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endif
                                @endforeach
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <button class="btn btn-white" type="submit">Cancel</button>
                                            <button class="btn btn-primary" type="submit">Save changes</button>
                                        </div>
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
        <style>
            .btn.btn-primary, .btn.btn-white {
                margin-top: 20px;
            }
        </style>
    <script>
        $(document).ready(function(){

            
            
            var $inputImage = $("#inputImageLogo");
            if (window.FileReader) {
                $inputImage.change(function() {
                    var fileReader = new FileReader(),
                            files = this.files,
                            file;

                    if (!files.length) {
                        return;
                    }

                    file = files[0];

                    if (/^image\/\w+$/.test(file.type)) {
                        fileReader.readAsDataURL(file);
                        fileReader.onload = function () {
                            $('.img-preview-logo').html('<img src="'+this.result+'" style="max-width: 100% !important;"/>');
                            //$inputImage.val("");
                            //$image.cropper("reset", true).cropper("replace", this.result);
                            //console.log("Come");
                            //$('.cropper-container').remove();
                        };
                    } else {
                        showMessage("Please choose an image file.");
                    }
                });
            } else {
                $inputImage.addClass("hide");
            }


             var $inputImage = $("#inputImageManagement");
            if (window.FileReader) {
                $inputImage.change(function() {
                    var fileReader = new FileReader(),
                            files = this.files,
                            file;

                    if (!files.length) {
                        return;
                    }

                    file = files[0];

                    if (/^image\/\w+$/.test(file.type)) {
                        fileReader.readAsDataURL(file);
                        fileReader.onload = function () {
                            $('.img-preview-management').html('<img src="'+this.result+'" style="max-width: 100% !important;"/>');
                            //$inputImage.val("");
                            //$image.cropper("reset", true).cropper("replace", this.result);
                            //console.log("Come");
                            //$('.cropper-container').remove();
                        };
                    } else {
                        showMessage("Please choose an image file.");
                    }
                });
            } else {
                $inputImage.addClass("hide");
            }


             var $inputImage = $("#inputImagePress");
            if (window.FileReader) {
                $inputImage.change(function() {
                    var fileReader = new FileReader(),
                            files = this.files,
                            file;

                    if (!files.length) {
                        return;
                    }

                    file = files[0];

                    if (/^image\/\w+$/.test(file.type)) {
                        fileReader.readAsDataURL(file);
                        fileReader.onload = function () {
                            $('.img-preview-press').html('<img src="'+this.result+'" style="max-width: 100% !important;"/>');
                            //$inputImage.val("");
                            //$image.cropper("reset", true).cropper("replace", this.result);
                            //console.log("Come");
                            //$('.cropper-container').remove();
                        };
                    } else {
                        showMessage("Please choose an image file.");
                    }
                });
            } else {
                $inputImage.addClass("hide");
            }

           
        });    

           

    </script>

@endsection  