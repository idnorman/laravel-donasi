@extends('layouts.app')
@push('head-scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@endpush
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{-- {{ __('Program') }} --}}
                        @if (url()->previous() != url()->current())
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-primary"><i
                                    class="fa-solid fa-arrow-left"></i> Kembali</a>
                        @endif
                        <a href="{{ route('program_activities.create', ['programId' => $programId]) }}"
                            class="btn btn-outline-primary btn-sm">
                            <i class="fa-solid fa-pen-to-square"></i>&nbsp;&nbsp;Buat Kegiatan</a>

                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><i class="fa-solid fa-check"></i>&nbsp;Sukses!</strong> {{ session('success') }}.
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><i class="fa-solid fa-exclamation"></i>&nbsp;Gagal!</strong> {{ session('error') }}.
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="col-12 table-responsive">
                            <table class="table table-bordered program_activity_datatable">
                                <thead>
                                    <tr>
                                        <th>Kegiatan</th>
                                        <th>Penggunaan Dana</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="" method="POST" id="deleteForm">
        @csrf
        @method('delete')
    </form>
@endsection
@push('body-scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript">
        $(function() {
            var table = $('.program_activity_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('program_activities.index', ['programId' => $programId]) }}",
                columns: [{
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'amount',
                        name: 'amount',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
    <script>
        function deleteProgramActivity(id) {
            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Data yang di hapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#deleteForm").attr("action", "/program/{{ $programId }}/kegiatan/" + id);
                    $("#deleteForm").submit();
                }
            });
        }
    </script>
@endpush
