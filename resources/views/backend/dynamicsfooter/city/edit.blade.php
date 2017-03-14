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
                            <h5>Row4</small></h5>
                            <div class="ibox-tools">
                                   <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form method="post" action="{{url('/')}}/cityRowUpdate" class="form-horizontal" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                
                                @foreach($rows as $key=>$value)
                                
                                <input type="hidden" name="id_image{!! $value['id'] !!}" value="{!! $value['id'] !!}">
                                <div class="form-group"><label class="col-sm-2 control-label">Title</label>

                                    <div class="col-sm-10"><input type="text" class="form-control" name="title{!! $value['id'] !!}" value="{!! $value['title'] !!}"></div>
                                </div>

                                <div class="form-group">
                                    <div class="row" style="text-align: center;">
                                        <div class="col-md-6">
                                            <h4>Preview {!! $value['title'] !!}</h4>
                                            <div class="img-preview img-preview-sm img-preview-{!! $value['id'] !!}">
                                            <img src="{{url('/')}}/cities/{{$value['logo']}}" style="min-width: 0px !important; min-height: 0px !important; max-width: none !important; max-height: none !important; width: 250px; height: 352px; margin-left: -25px; margin-top: -114px;"/>    

                                            </div>
                                            <div class="btn-group">
                                                <label title="Upload image file" for="inputImage{!! $value['id'] !!}" class="btn btn-primary">
                                                    <input type="file" accept="image/*" name="file_logo{!! $value['id'] !!}" id="inputImage{!! $value['id'] !!}" class="hide">
                                                    Upload {!! $value['title'] !!}
                                                </label>
                                            </div>
                                            <div class="btn-group">
                                            <div class="col-sm-4 col-sm-offset-2">
                                            <a class="close-link" href="{{url('/')}}/deleteCityOne/{{$value['id']}}"><i class="fa fa-times"></i></a>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                
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


        <div class="footer">
            <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2017
            </div>
        </div>

        </div>
    <script>
        $(document).ready(function(){

            @foreach($rows as $key=>$value)
            
            var $inputImage = $("#inputImage{!! $value['id'] !!}");
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
                            $('.img-preview-{!! $value['id'] !!}').html('<img src="'+this.result+'" style="min-width: 0px !important; min-height: 0px !important; max-width: none !important; max-height: none !important; width: 250px; height: 352px; margin-left: -25px; margin-top: -114px;"/>');
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
            @endforeach


           
        });    

           

    </script>

@endsection  