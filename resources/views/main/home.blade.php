@extends('main.layouts.app', ['title' => 'Selamat Datang'])

@section('content')
    <!-- slider_area_start -->
    <div class="slider_area">
        <div class="single_slider  d-flex align-items-center slider_bg_1 overlay2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="slider_text ">
                            <span>Tebarkan Kebaikan Untuk Dunia.</span>
                            <h3>Bantu Kami Menebarkan Kebaikan.</h3>
                            <p>Setiap Langkah Menuju Kebaikan Dimulai Dengan Satu Hati Yang Bersedia Memberi. Dengan
                                Dukungan Anda, Kita Bisa Membuat Dunia Menjadi Tempat Yang Lebih Baik.</p>
                            <a href="About.html" class="boxed-btn3">Tentang Kami
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider_area_end -->
    <!-- popular_causes_area_start  -->
    <div class="popular_causes_area section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section_title text-center mb-55">
                        <h3><span>Berikan Donasi Terbaik</span></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="causes_active owl-carousel owl-carousel-causes">
                        @foreach ($programs as $program)
                            <div class="single_cause mr-3">
                                <a href="{{ route('main.programs.detail', $program->id) }}">
                                    <div class="thumb">
                                        <img src="{{ asset($program->image) }}" alt="">
                                    </div>
                                    <div class="causes_content">
                                        <div class="custom_progress_bar">
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ $program->funding_progress_percentage }}%;"
                                                    aria-valuenow="{{ $program->funding_progress_percentage }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    <span class="progres_count">
                                                        {{ $program->funding_progress_percentage }}%
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="balance d-flex justify-content-center align-items-center">
                                            {{-- <span>Raised: $5000.00 </span> --}}
                                            <span class="text-success"
                                                style="font-size: 1.3rem !important;">{{ \Number::currency($program->collected_fund, 'IDR', 'id-ID') }}</span>
                                            <span class="mt-1">
                                                &nbsp;/&nbsp;{{ \Number::currency($program->target_fund, 'IDR', 'id-ID') }}

                                            </span>
                                        </div>
                                        <h4>{{ $program->name }}</h4>

                                        <p>{{ $program->short_description }}</p>
                                        <div class="d-block text-center">
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('main.programs.detail', $program->id) }}">Donasi</a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- popular_causes_area_end  -->
    <!-- counter_area_start  -->
    <div class="counter_area">
        <div class="container">
            <div class="counter_bg overlay">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="single_counter d-flex align-items-center justify-content-center">
                            <div class="icon">
                                <i class="flaticon-calendar"></i>
                            </div>
                            <div class="events">
                                <h3 class="counter">{{ $counter['total_programs'] }}</h3>
                                <p>Program</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single_counter d-flex align-items-center justify-content-center">
                            <div class="icon">
                                <i class="flaticon-in-love"></i>
                            </div>
                            <div class="events">
                                <h3 class="counter">{{ $counter['total_fully_funded_programs'] }}</h3>
                                <p>Program Tercapai</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single_counter d-flex align-items-center justify-content-center">
                            <div class="icon">
                                <i class="flaticon-heart-beat"></i>
                            </div>
                            <div class="events">
                                <h3 class="counter">{{ $counter['total_donations'] }}</h3>
                                <p>Donasi</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single_counter d-flex align-items-center justify-content-center">
                            <div class="icon">
                                <i class="flaticon-hug"></i>
                            </div>
                            <div class="events">
                                <h3 class="counter">{{ $counter['total_program_activities'] }}</h3>
                                <p>Kegiatan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- counter_area_end  -->
    <!-- news__area_start  -->
    <div class="news__area section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section_title text-center mb-55">
                        <h3><span>Blog</span></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="news_active owl-carousel owl-carousel-articles">
                        @foreach ($articles as $article)
                            <div class="single__blog d-flex align-items-center mx-1 mb-1">
                                <div class="thum">
                                    <img class="object-fit-cover rounded" style="width: 380px; height: 300px;"
                                        src="{{ asset($article->image) }}" alt="">
                                </div>
                                <div class="newsinfo">
                                    <span>{{ $article->created_at->format('M d, Y') }}</span>
                                    <a href="{{ route('main.articles.detail', $article->slug) }}">
                                        <h3>{{ $article->title }}</h3>
                                    </a>
                                    <p>{{ $article->description }}</p>
                                    <a class="read_more"
                                        href="{{ route('main.articles.detail', $article->slug) }}">Selengkapnya</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- news__area_end  -->
@endsection
@push('body-scripts')
    <script>
        owlCauses = $(".owl-carousel-causes");
        owlCauses.owlCarousel({
            loop: true,
            autoplaySpeed: 500,
            items: 3,
            autoplay: true
        });

        owlArticles = $(".owl-carousel-articles");
        owlArticles.owlCarousel({
            loop: true,
            autoplaySpeed: 500,
            items: 1,
            autoplay: true
        });
    </script>
@endpush()
