@extends('main.layouts.app', ['title' => 'Artikel'])

@section('content')
    <!--================Blog Area =================-->
    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post">
                        <div class="feature-img">
                            <img class="img-fluid w-100 rounded" src="{{ $article->image }}" alt="">
                        </div>
                        <div class="blog_details">
                            <h2>{{ $article->title }}
                            </h2>

                            {!! $article->content !!}
                        </div>
                    </div>
                    <div class="navigation-top">
                        <div class="navigation-area">
                            <div class="row">
                                <div
                                    class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                    @if ($articleBefore)
                                        <div class="thumb">
                                            <a href="{{ route('main.articles.detail', $articleBefore->slug) }}">
                                                <img class="object-fit-cover" width="50px" height="50px"
                                                    src="{{ asset($articleBefore->image) }}" alt="">
                                            </a>
                                        </div>
                                        <div class="arrow">
                                            <a href="{{ route('main.articles.detail', $articleBefore->slug) }}">
                                                <span class="lnr text-white ti-arrow-left"></span>
                                            </a>
                                        </div>
                                        <div class="detials">
                                            <p>Sebelumnya</p>
                                            <a href="{{ route('main.articles.detail', $articleBefore->slug) }}">
                                                <h4>{{ substr($articleBefore->title, 0, 45) . '...' }}</h4>
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                <div
                                    class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                    @if ($articleAfter)
                                        <div class="detials">
                                            <p>Selanjutnya</p>
                                            <a href="{{ route('main.articles.detail', $articleAfter->slug) }}">
                                                <h4>{{ substr($articleAfter->title, 0, 45) . '...' }} </h4>
                                            </a>
                                        </div>
                                        <div class="arrow">
                                            <a href="{{ route('main.articles.detail', $articleAfter->slug) }}">
                                                <span class="lnr text-white ti-arrow-right"></span>
                                            </a>
                                        </div>
                                        <div class="thumb">
                                            <a href="{{ route('main.articles.detail', $articleAfter->slug) }}">
                                                <img class="object-fit-cover" width="50px" height="50px"
                                                    src="{{ asset($articleAfter->image) }}" alt="">
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form action="#">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder='Search Keyword'
                                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'">
                                        <div class="input-group-append">
                                            <button class="btn" type="button"><i class="ti-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                    type="submit">Search</button>
                            </form>
                        </aside>
                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Artikel Terbaru</h3>
                            @foreach ($articles as $article)
                                <div class="media post_item">
                                    <img src="{{ $article->image }}" width="50px" height="50px"
                                        class="object-fit-cover mt-2" alt="post">
                                    <div class="media-body">
                                        <a href="{{ route('main.articles.detail', $article->slug) }}">
                                            <h3>{{ substr($article->title, 0, 45) . '...' }}</h3>
                                        </a>
                                        <p>{{ $article->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Blog Area end =================-->
@endsection
