@extends('main.layouts.app', ['title' => 'Artikel'])

@section('content')
    <!-- bradcam_area_start  -->
    <div class="bradcam_area breadcam_bg overlay d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>Program Donasi</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bradcam_area_end  -->
    <!-- popular_causes_area_start  -->
    <div class="popular_causes_area pt-120 pt-5 mt-0 mb-4">
        <div class="container">
            <div class="row">
                @foreach ($programs as $program)
                    <div class="col-lg-4 col-md-6">
                        <div class="single_cause">
                            <div class="thumb">
                                <img src="{{ $program->image }}" alt="">
                            </div>
                            <div class="causes_content">
                                <div class="custom_progress_bar">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar"
                                            style="width: {{ $program->funding_progress_percentage }}%;"
                                            aria-valuenow="{{ $program->funding_progress_percentage }}" aria-valuemin="0"
                                            aria-valuemax="100">
                                            <span class="progres_count">
                                                {{ $program->funding_progress_percentage }}%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="balance d-flex justify-content-between align-items-center">
                                    <span><small>Terkumpul</small>
                                        <br><span
                                            class="text-success">{{ \Number::currency($program->collected_fund, 'IDR', 'id-ID') }}</span>
                                    </span>
                                    <span><small>Target</small><br><span
                                            class="text-success">{{ \Number::currency($program->target_fund, 'IDR', 'id-ID') }}
                                        </span></span>
                                </div>
                                <a href="{{ route('main.programs.detail', $program->id) }}">
                                    <h4>{{ $program->name }}</h4>
                                </a>
                                <p>{{ $program->short_description }}</p>
                                <div class="w-100 text-center">
                                    <a class="btn btn-sm btn-success"
                                        href="{{ route('main.programs.detail', $program->id) }}">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <nav class="blog-pagination justify-content-center d-flex mt-0">
            {!! $programs->links() !!}
        </nav>
    </div>
    <!-- popular_causes_area_end  -->
@endsection
