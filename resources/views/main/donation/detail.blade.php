@extends('main.layouts.app', ['title' => 'Artikel'])

@push('head-scripts')
    <script src="{{ asset('build/assets/app-Ducy5sUl.js') }}"></script>
    <style>
        .section-padding {
            padding-top: 70px;
            padding-bottom: 70px;
        }

        .align-top {
            vertical-align: top;
        }
    </style>
@endpush
@section('content')
    <!-- bradcam_area_start  -->
    <div class="bradcam_area breadcam_bg overlay d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>Detail Donasi</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bradcam_area_end  -->
    <!--================Blog Area =================-->
    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <img class="card-img" src="{{ asset($donation->program->image) }}" alt="">
                </div>
                <div class="col-lg-7">
                    <table>
                        <tr>
                            <td class="pb-3 align-top" width="28%">Program</td>
                            <td class="pb-3">: {{ $donation->program->name }}</td>
                        </tr>
                        <tr>
                            <td class="pb-3">Tanggal Donasi</td>
                            <td class="pb-3">:
                                {{ $donation->created_at->locale('id-ID')->translatedFormat('d F Y') }}
                                ({{ $donation->created_at->diffForHumans() }})</td>
                        </tr>
                        <tr>
                            <td class="pb-3">Jumlah Donasi</td>
                            <td class="pb-3">:
                                <span
                                    class="text-success font-weight-bold">{{ \Number::currency($donation->amount, 'IDR', 'id_ID') }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="pb-3">Metode Pembayaran</td>
                            <td class="pb-3">:
                                {{ $donation->payment_method ? strtoupper(str_replace('_', ' ', $donation->payment_method)) : '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="pb-3">Status</td>
                            <td class="pb-3">:
                                @if ($donation->payment_status == '1')
                                    <span class="text-uppercase badge badge-warning">Pending / Menunggu Pembayaran</span>
                                @elseif ($donation->payment_status == '2')
                                    <span class="text-uppercase badge badge-success">Berhasil</span>
                                @elseif ($donation->payment_status == '3')
                                    <span class="text-uppercase badge badge-danger">Gagal / Dibatalkan</span>
                                @endif
                            </td>
                        </tr>
                        @if ($donation->payment_status == 1 && $donation->snap_token != null)
                            <tr>
                                <td></td>
                                <td>&nbsp;&nbsp;<button class="btn btn-success" id="snap-btn">Bayar Sekarang</td>
                            </tr>
                        @endif

                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="program-activity-header mt-4 mb-3">
                        <span class="h4">Kegiatan Program</span>
                    </div>
                    <div class="row row-cols-2">
                        @foreach ($programActivities as $programActivity)
                            <div class="program-activity-list w-100 col-lg-6">
                                <div class="program-activity-item">
                                    <a href="#"><u class="h6 text-dark">{{ $programActivity->title }}</u></a><br>
                                    <small class="text-muted">Dana Yang Digunakan: <span
                                            class="font-weight-bold {{ $programActivity->amount == 0 ? 'text-success' : 'text-danger' }}">{{ \Number::currency($programActivity->amount, 'IDR', 'id_ID') }}</span></small>
                                    <small
                                        class="d-block text-muted">{{ $programActivity->created_at->locale('id-ID')->translatedFormat('d F Y') }}&nbsp;({{ $programActivity->created_at->diffForHumans() }})</small>
                                    <hr>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="program-activity-pagination pb-2">
                        <div class="d-flex justify-content-center my-2">
                            {{ $programActivities->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Blog Area end =================-->
@endsection
@push('body-scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if ($donation->payment_status == 1 && $donation->snap_token != null)
            $(document).ready(function() {
                $('#snap-btn').on('click', () => snapPayment());
            });
            async function snapPayment() {
                let formData = {
                    _method: 'POST',
                    _token: '{{ csrf_token() }}',
                    donation_id: '{{ $donation->id }}',
                };
                await axios.post('{{ route('main.donations.check_donation_status') }}', formData)
                    .then(function(response) {
                        if (response.data.is_paid) {
                            Swal.fire({
                                icon: "info",
                                html: `
                                            <strong>Donasi Telah Dibayar</strong><br>
                                            Muat Ulang Halaman Untuk Memperbarui Status
                                        `,
                                showCancelButton: true,
                                confirmButtonText: "Muat Ulang",
                                cancelButtonText: "Tutup"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        } else {
                            snap.pay('{{ $donation->snap_token }}', {
                                onSuccess: function(result) {
                                    console.log('Sukses');
                                    window.location.reload();
                                    console.log(result);
                                },
                                onPending: function(result) {
                                    console.log('Pending');
                                    console.log(result);
                                },
                                onError: function(result) {
                                    console.log('Error');
                                    // window.location.reload();
                                    console.log(result);
                                }
                            });
                        }
                    }).catch(function(error) {
                        console.log(error);
                    });
            }
        @endif
    </script>
    <script>
        $(document).ready(function() {
            Echo.channel('donation-payment-result-{{ $donation->order_id }}')
                .listen('DonationPaymentEvent', (e) => {
                    Swal.fire({
                        icon: "info",
                        html: `
                <strong>Status Pembayaran Telah Di Update</strong><br>
                Muat Ulang Halaman Untuk Memperbarui Status
            `,
                        showCancelButton: true,
                        confirmButtonText: "Muat Ulang",
                        cancelButtonText: "Tutup"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                });
        })
    </script>
@endpush
