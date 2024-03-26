@extends('main.layouts.app', ['title' => 'Artikel'])

@section('content')
    <!-- bradcam_area_start  -->
    <div class="bradcam_area breadcam_bg overlay d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>Blog</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bradcam_area_end  -->


    <!--================Blog Area =================-->
    <section class="blog_area section-padding pt-3 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-5 mb-lg-0">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form action="#">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder='Search Keyword'
                                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'">
                                        <div class="input-group-append">
                                            <button class="btn" type="submit"><i class="ti-search"></i></button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </aside>
                    </div>
                    <div class="blog_left_sidebar">
                        <div class="row row-cols-2">
                            @foreach ($articles as $article)
                                <article class="blog_item col-lg-6">
                                    <div class="blog_item_img">
                                        <img class="card-img rounded-0" src="{{ asset($article->image) }}" alt="">
                                        <a href="{{ route('main.articles.detail', $article->slug) }}"
                                            class="blog_item_date">
                                            <h3>{{ $article->splitted_date[0] }}</h3>
                                            <p>{{ $article->splitted_date[1] }}</p>
                                        </a>
                                    </div>

                                    <div class="blog_details">
                                        <a class="d-inline-block"
                                            href="{{ route('main.articles.detail', $article->slug) }}">
                                            <h2>{{ $article->title }}</h2>
                                        </a>
                                        <p>{{ $article->description }}</p>
                                        {{-- <ul class="blog-info-link">
                                        <li><a href="#"><i class="fa fa-user"></i> Travel, Lifestyle</a></li>
                                        <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li>
                                    </ul> --}}
                                    </div>
                                </article>
                            @endforeach
                        </div>


                        <nav class="blog-pagination my-0 justify-content-center d-flex">
                            {!! $articles->links() !!}
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
@endsection
