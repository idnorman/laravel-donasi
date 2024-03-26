@extends('layouts.app')
@push('head-scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@endpush
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        @if (url()->previous() != url()->current())
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-primary"><i
                                    class="fa-solid fa-arrow-left"></i> Kembali</a>
                        @endif
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8 d-flex justify-content-center mb-3 mb-lg-0">

                                <div class="card">
                                    <div class="card-header m-0 p-0">
                                        <img src="{{ asset($program->image) }}" alt="{{ $program->name }}"
                                            class="img-fluid rounded-top w-100">
                                    </div>
                                    <div class="card-body p-0 m-0">
                                        <div class="program-name-wrapper mb-3 px-3 pt-3">
                                            <span class="h3">{{ $program->name }}</span>
                                        </div>
                                        <div class="program-funding-wrapper mb-2 px-3">
                                            <div class="program-funding-header mb-2">
                                                <span
                                                    class="h4 text-primary">{{ \Number::currency($program->collected_fund, 'IDR', 'id_ID') }}</span>
                                                <span class="h6 fw-normal">terkumpul dari
                                                    <strong>{{ \Number::currency($program->target_fund, 'IDR', 'id_ID') }}</strong></span>
                                            </div>
                                            <div class="program-funding-bar mb-3">
                                                <div class="progress" role="progressbar" aria-label="Progress Pendanaan"
                                                    aria-valuenow="{{ $program->funding_progress_percentage }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar"
                                                        style="width: {{ $program->funding_progress_percentage }}%">
                                                        {{ $program->funding_progress_percentage }}%</div>
                                                </div>
                                            </div>
                                            {{-- <div class="progress-bar-label d-flex justify-content-between">
                                                <small class="text-muted fst-italic">Rp 0</small>
                                                <small
                                                    class="text-muted fst-italic">{{ \Number::currency($program->target_fund, 'IDR', 'id_ID') }}</small>
                                            </div> --}}
                                            <div class="program-funding-footer d-flex justify-content-between">
                                                <div class="program-total-donation border-end w-100 text-center">
                                                    <i
                                                        class="fa-solid fa-hand-holding-heart text-primary d-lg-inline d-block mb-2 mb-lg-0"></i>
                                                    <small
                                                        class="text-muted fw-bold">&nbsp;{{ $program->donations->count() }}
                                                    </small>
                                                    <br><small class="text-muted">Donasi</small>
                                                </div>
                                                <div class="program-used-funding border-end w-100 text-center">
                                                    <i
                                                        class="fa-solid fa-money-bill-transfer text-primary d-lg-inline d-block mb-2 mb-lg-0"></i>
                                                    <small
                                                        class="text-muted fw-bold">&nbsp;{{ \Number::currency($program->used_fund, 'IDR', 'id_ID') }}
                                                    </small>
                                                    <br><small class="text-muted">Tersalurkan</small>
                                                </div>
                                                <div class="program-used-funding border-end w-100 text-center ">
                                                    <i
                                                        class="fa-solid fa-money-bill text-primary d-lg-inline d-block mb-2 mb-lg-0"></i>
                                                    <small
                                                        class="text-muted fw-bold">&nbsp;{{ \Number::currency($program->current_fund, 'IDR', 'id_ID') }}
                                                    </small>
                                                    <br><small class="text-muted">Dana Saat Ini</small>
                                                </div>
                                                <div class="program-used-funding w-100 text-center">
                                                    <i
                                                        class="fa-solid fa-newspaper text-primary d-lg-inline d-block mb-2 mb-lg-0"></i>
                                                    <small
                                                        class="text-muted fw-bold">&nbsp;{{ $program->programActivities->count() }}
                                                    </small>
                                                    <br><small class="text-muted">Kegiatan</small>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="w-100">
                                        <div class="program-description-wrapper px-3 mb-3">
                                            {!! $program->description !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card mb-3">
                                    <div class="card-header text-center">
                                        <span class="h5">Donatur</span>
                                    </div>
                                    <div class="card-body p-0">
                                        <ul class="list-group list-group-flush">
                                            @foreach ($donations as $donation)
                                                <li class="list-group-item">
                                                    <span class="h6">{{ $donation->donatur_name }}</span>
                                                    <span class="d-block">Mendonasikan
                                                        <strong>{{ \Number::currency($donation->amount, 'IDR', 'id_ID') }}</strong>
                                                    </span>
                                                    <small
                                                        class="d-block text-muted">{{ $donation->created_at->diffForHumans() }}</small>
                                                </li>
                                            @endforeach
                                            <div class="d-flex justify-content-center my-2">
                                                {{ $donations->appends(['program_activities' => $programActivities->currentPage()])->links() }}
                                            </div>
                                        </ul>

                                    </div>

                                </div>
                                <div class="card">
                                    <div class="card-header text-center">
                                        <span class="h5">Kegiatan Terbaru</span>
                                    </div>
                                    <div class="card-body p-0">
                                        <ul class="list-group list-group-flush">
                                            @foreach ($programActivities as $programActivity)
                                                <li class="list-group-item">
                                                    <span class="h6"><a
                                                            href="#">{{ $programActivity->title }}</a></span>
                                                    <small
                                                        class="d-block text-muted">{{ $programActivity->created_at->diffForHumans() }}</small>
                                                </li>
                                            @endforeach
                                            <div class="d-flex justify-content-center my-2">
                                                {{ $programActivities->appends(['donations' => $donations->currentPage()])->links() }}
                                            </div>
                                        </ul>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('body-scripts')
@endpush
