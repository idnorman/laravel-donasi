@extends('layouts.app')
@push('head-scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css"
        integrity="sha512-ngQ4IGzHQ3s/Hh8kMyG4FC74wzitukRMIcTOoKT3EyzFZCILOPF0twiXOQn75eDINUfKBYmzYn2AA8DkAk8veQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@php
    // if ($errors->all()) {
    //     dd('true');
    // } else {
    //     dd('false');
    // }
@endphp
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
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('program_activities.store', ['programId' => $programId]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="title">Nama Kegiatan</label>
                                <input type="text" name="title" id="title"
                                    class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"
                                    value="{{ old('title') }}">
                                @if ($errors->has('title'))
                                    <small class="invalid feedback text-danger" role="alert">
                                        {{ $errors->first('title') }}
                                    </small>
                                @endif
                            </div>

                            <label for="amount">Dana yang digunakan</label>
                            <span class="d-block"><small>Maks:</small>
                                <span
                                    class="fw-bold text-primary current_fund">{{ \Number::currency($currentFund, 'IDR', 'id_ID') }}</span></span>
                            <div class="input-group mb-3 has-validation">
                                <span class="input-group-text" id="amount_rp_text">Rp.</span>
                                <input type="number" name="amount" id="amount" step="any" max="{{ $currentFund }}"
                                    class="form-control {{ $errors->has('amount') ? ' is-invalid' : '' }}"
                                    value="{{ old('amount') }}"
                                    aria-describedby="amount_rp_text validationTargetFundFeedback">
                                @if ($errors->has('amount'))
                                    <small id="validationTargetFundFeedback" class="invalid-feedback text-danger"
                                        role="alert">
                                        {{ $errors->first('amount') }}
                                    </small>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">Deskripsi</label>
                                <textarea name="description" id="description"
                                    class="form-control description-textarea {{ $errors->has('description') ? 'is-invalid' : '' }}">
                                    {!! old('description') ? old('description') : 'Tulis deskripsi program di sini...' !!}
                                </textarea>
                                @if ($errors->has('description'))
                                    <small class="invalid feedback text-danger description-textarea-invalid-feedback"
                                        role="alert">
                                        {{ $errors->first('description') }}
                                    </small>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('body-scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js"
        integrity="sha512-6F1RVfnxCprKJmfulcxxym1Dar5FsT/V2jiEUvABiaEiFWoQ8yHvqRM/Slf0qJKiwin6IDQucjXuolCfCKnaJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            $('#description').summernote({
                height: 400
            });

            @if ($errors->all())
                substractFund();
            @endif

            $('#amount').on('keyup', substractFund);



        });



        function substractFund() {
            let currentFund = {{ $currentFund }};
            let amount = document.getElementById('amount').valueAsNumber;
            if (amount >= currentFund) {
                $(this).val(currentFund);
                amount = currentFund;
            }
            amount = isNaN(amount) ? 0 : amount;

            let result = currentFund - amount;

            $('.current_fund').text(new Intl.NumberFormat('id-ID', {
                style: "currency",
                currency: "IDR"
            }).format(result));
        }
    </script>
    <script src="{{ asset('js/validation.js') }}"></script>
@endpush
