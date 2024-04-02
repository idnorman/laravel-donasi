@extends('layouts.app')
@push('head-scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css"
        integrity="sha512-ngQ4IGzHQ3s/Hh8kMyG4FC74wzitukRMIcTOoKT3EyzFZCILOPF0twiXOQn75eDINUfKBYmzYn2AA8DkAk8veQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('programs.update', $program->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="name">Nama Program</label>
                                <input type="text" name="name" id="name"
                                    class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    value="{{ old('name') ? old('name') : $program->name }}">
                                @if ($errors->has('name'))
                                    <small class="invalid feedback text-danger" role="alert">
                                        {{ $errors->first('name') }}
                                    </small>
                                @endif
                            </div>
                            <label for="target_fund">Target Pendanaan</label>
                            <div class="input-group mb-3 has-validation">
                                <span class="input-group-text" id="target_fund_rp_text">Rp.</span>
                                <input type="number" name="target_fund" id="target_fund" min="10000" step="any"
                                    class="form-control {{ $errors->has('target_fund') ? ' is-invalid' : '' }}"
                                    value="{{ old('target_fund') ? old('target_fund') : $program->target_fund }}"
                                    aria-describedby="target_fund_rp_text validationTargetFundFeedback">
                                @if ($errors->has('target_fund'))
                                    <small id="validationTargetFundFeedback" class="invalid-feedback text-danger"
                                        role="alert">
                                        {{ $errors->first('target_fund') }}
                                    </small>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="image">Gambar Thumbnail</label>
                                <input type="file" name="image" id="image"
                                    class="form-control
                                    {{ $errors->has('image') ? ' is-invalid' : '' }}">
                                @if ($errors->has('image'))
                                    <small class="invalid feedback text-danger" role="alert">
                                        {{ $errors->first('image') }}
                                    </small>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">Deskripsi</label>
                                <textarea name="description" id="description" class="form-control">
                                    {!! old('description') ? old('description') : $program->description !!}
                                </textarea>
                                @if ($errors->has('description'))
                                    <small class="invalid feedback text-danger" role="alert">
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
        });
    </script>
    <script src="{{ asset('js/validation.js') }}"></script>
@endpush
