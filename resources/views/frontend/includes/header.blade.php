<script>
    $(document).ready(function() {

        setTimeout(function() {
            $('#location_search').fadeOut('fast');
            }, 5000);   
        <?php
            $users = DB::table('users')->get();
        ?>

        //$("#block").vide("{{ url('/') }}/video/ocean");

 
        if($( window ).width() >= 748)
        {
            $('#block_video').vide({
                mp4: "{{ url('/') }}/video/ocean_123.mp4",
                webm: "{{ url('/') }}/video/ocean_123.webm",
                ogv: "{{ url('/') }}/video/ocean_123.ogv",
                //poster:"{{ url('/') }}/video/video/ocean_123.jpg",
            });
        }else {
            $('#block_video').vide({
                mp4: "{{ url('/') }}/video/ocean_123.mp4",
                webm: "{{ url('/') }}/video/ocean_123.webm",
                ogv: "{{ url('/') }}/video/ocean_123.ogv",
                //poster:"{{ url('/') }}/video/video/ocean_123.jpg",
            });

        }

        $('#index_search').validate({
            rules: {
                city_where_met: {
                    required: true
                },
            },
            messages: {
                city_where_met: {
                    required: "<h6 style='color:white'>Please Add your location.</h6>"
                },
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
                form.submit();
            }
        });
    });

</script>

<div class="video-banner" id="block_video"  data-vide-options="position: 50% 50%">
    @include('frontend.includes.headerlogin')
    <div class="banner-content">
    	<div class="container">
        	<div class="row">
            	<div class="col-md-12">
                	<h1 id="change-text-specific-page">simply book <br>with deposit</h1>
                </div>
            </div>
            	
            <div class="row" id="close-search-specific-page">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    {!! Form::open(array('url' => '/search', 'id' => 'index_search', 'method' => 'post')) !!}
                	   <!--form class="wow bounceInUp" data-wow-duration="2s"-->
                    	<ul>
                            <li>
                                <?php echo Form::text('city_where_met','', array('id' => 'city_where_met', 'placeholder' => 'e.g. Zurich,Luzern'));
                                ?>
                                <!--input type="text" name="city_where_met" id="city_where_met" placeholder="e.g.. Zurich,Luzern" /-->
                            </li>
                            <li>
                                <div class="select-icon-home">
                                    <!--select>
                                        <option value="">Price</option>
                                        <option value="1-500">1 CHF - 500 CHF</option>
                                        <option value="500-1000">500 CHF - 1000 CHF</option>
                                        <option value="1000-5000">1000 CHF - 5000 CHF</option>
                                        <option value="5000-10000">5000 CHF - 10000 CHF</option>
                                    </select-->
                                    <?php 
                                        echo Form::select('price', array('' => 'Price', '1-500' => '1-500 CHF', '500-1000' => '500-1000 CHF', '1000-5000' => '1000-5000 CHF', '5000-10000' => '5000-10000 CHF'), '');
                                    ?>
                                </div>
                            </li>
                            <li>
                                <div class="select-icon-home">
                                    <!--select>
                                        <option value="">Bedrooms</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                    </select-->
                                    <?php 
                                        echo Form::select('bedroom', array('' => 'Guests', '1' => '1', '2' => '2','3' => '3','4' => '4','5' => '5','6' => '6', '7' => '7',), '');
                                    ?>
                                </div>
                            </li>
                            <li>
                                <div class="select-icon-home">
                                   <?php echo Form::text('datepicker','', array('class' => 'datepicker', 'placeholder' => 'Check In', 'id' => 'date-arrow"', 'data-date-format' => 'dd/mm/yy')); ?>

                                    <!--input type="text" class="datepicker" id="date-arrow" placeholder="Check In"-->
                                </div>
                            </li>
                            <li><button type="submit"><span>SEARCH</span><i class="fa fa-search"></i></button></li>
                        </ul>
                         
                        <h2 style="color:white" id="location_search">
                            @if (Session::has('message1'))
                                {{ Session::get('message1') }}
                            @endif
                        </h2>
                        
                        <div class="clearfix"></div>
                        <!--/form-->
                    {!! Form::close() !!}
                </div>
                <div class="col-md-1"></div>
           </div>
        </div>
    </div>
</div>
