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

                    <div class="card-body p-0 m-0">
                        <div class="col-12 mb-3 mb-lg-0">
                            <span class="d-block h3 my-3 mx-3">{{ $programActivity->title }}</span>
                            <div class="row w-100 p-0 m-0 bg-light">
                                <hr class="p-0 m-0">
                                <div class="row p-0 m-0 px-3 my-2">
                                    <div class="h5 p-0 m-0 col-4 col-md-2">Tanggal</div>
                                    <div class="h5 p-0 m-0 col-8 col-md-10">:
                                        {{ \Carbon\Carbon::parse($programActivity->created_at)->translatedFormat('d F Y') }}
                                    </div>
                                </div>
                                <div class="row p-0 m-0 px-3 mb-2">
                                    <div class="h5 p-0 m-0 col-4 col-md-2">Dana Terpakai</div>
                                    <div class="h5 p-0 m-0 col-8 col-md-10">:
                                        {{ \Number::currency($programActivity->amount, 'IDR', 'id_ID') }}</div>
                                </div>
                                <hr class="p-0 m-0">
                            </div>
                            <div class="row w-100 mx-0 px-3 my-3">
                                {!! $programActivity->description !!}
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
