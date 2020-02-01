@extends($layout)
@section('stylesheets')

@stop
@section('scripts')

@stop

@section('content')

    <style>

        .blog_post img {

            height: 400px;

        }

    </style>

    <!-- Banner Area Starts -->
    <section class="banner-area banner-bg about-page text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-text">
                        <h3>Blog</h3>
                        <a href="/">home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Area End -->

    <!--================Blog Area =================-->
    <section class="blog_area" style="margin-top: 50px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="blog_left_sidebar">



                      @foreach($blogs as $blog)
                          


                        <article class="row blog_item">
                           <div class="col-md-3">
                               <div class="blog_info text-right">
                                    <div class="post_tag">
                                      @if(isset($blog->keyword))

                                        @foreach($blog->keyword as $k)
                                           
                                                <a href="#">{{$k}}.</a>
                                          
                                        @endforeach
                                      @endif
                                    </div>
                                    <ul class="blog_meta list">
                                        <li><a href="#">Pam<i class="fa fa-user-o"></i></a></li>
                                        <li><a href="#">{{$blog->date}}<i class="fa fa-calendar-o"></i></a></li>
                                    </ul>
                                </div>
                           </div>
                            <div class="col-md-9">
                                <div class="blog_post">
                                    <center><img src="{{$blog->image_src}}" alt=""></center> 
                                    <div class="blog_details">
                                        <a href="blog-details.html"><h4>{{$blog->title}}</h4></a>
                                        <p>{{$blog->description}}</p>
                                        <a href="/view/{{$blog->param_one}}" class="template-btn">View More</a>
                                    </div>
                                </div>
                            </div>
                        </article>


                      @endforeach





                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->

@stop