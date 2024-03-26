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
                        <form action="{{ route('articles.update', $article->slug) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="title">Judul</label>
                                <input type="text" name="title" id="title"
                                    class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"
                                    value="{{ old('title') ? old('title') : $article->title }}">
                                @if ($errors->has('title'))
                                    <small class="invalid feedback text-danger" role="alert">
                                        {{ $errors->first('title') }}
                                    </small>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">Deskripsi</label>
                                <textarea name="description" id="description" rows="5"
                                    class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}">{{ old('description') ? old('description') : $article->description }}</textarea>
                                @if ($errors->has('description'))
                                    <small class="invalid feedback text-danger" role="alert">
                                        {{ $errors->first('description') }}
                                    </small>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="image">Thumbnail</label>
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
                                <label for="content">Konten</label>
                                <textarea name="content" id="content" class="form-control">
                                    {!! old('content') ? old('content') : $article->content !!}
                                </textarea>
                                @if ($errors->has('content'))
                                    <small class="invalid feedback text-danger" role="alert">
                                        {{ $errors->first('content') }}
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
            $('#content').summernote({
                height: 400
            });
        });
    </script>
    <script src="{{ asset('js/validation.js') }}"></script>
@endpush
