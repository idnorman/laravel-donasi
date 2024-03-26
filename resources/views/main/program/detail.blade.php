@extends('main.layouts.app', ['title' => 'Artikel'])

@push('head-scripts')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="{{ asset('build/assets/app-Ducy5sUl.js') }}"></script>
    <style>
        .floating-button {
            position: fixed;
            bottom: 20px;
            left: 50%;
            /* Set left position to center */
            transform: translateX(-50%);
            z-index: 1000;
            /* Ensure the button appears above other content */
        }
    </style>
@endpush
@section('content')
    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list px-0">
                    <!-- popular_causes_area_start  -->
                    <div class="popular_causes_area cause_details ">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="single_cause">
                                        <div class="thumb">
                                            <img src="{{ $program->image }}" alt="">
                                        </div>
                                        <div class="causes_content" style="padding-top: 5rem !important;">
                                            <div class="custom_progress_bar">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar"
                                                        style="width: {{ $program->fundingProgressPercentage }}%;"
                                                        aria-valuenow="{{ $program->fundingProgressPercentage }}"
                                                        aria-valuemin="0" aria-valuemax="100">
                                                        <span class="progres_count">
                                                            {{ $program->fundingProgressPercentage }}%
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="pb-3 my-0 balance d-flex justify-content-between align-items-center">
                                                <span><small>Terkumpul:</small>
                                                    <span
                                                        class="text-success">{{ \Number::currency($program->collected_fund, 'IDR', 'id-ID') }}</span>
                                                </span>
                                                <span><small>Target:</small> <span
                                                        class="text-success">{{ \Number::currency($program->target_fund, 'IDR', 'id-ID') }}</span>
                                                </span>
                                            </div>
                                            <div class="program-funding-footer d-flex justify-content-between">
                                                <div class="program-total-donation border-end w-100 text-center">
                                                    <i
                                                        class="fa-solid fa-hand-holding-heart text-success d-lg-inline d-block mb-2 mb-lg-0"></i>
                                                    <small
                                                        class="text-muted fw-bold">&nbsp;{{ $program->donations()->where('payment_status', 2)->count() }}
                                                    </small>
                                                    <br><small class="text-muted">Donasi</small>
                                                </div>
                                                <div class="program-used-funding border-end w-100 text-center">
                                                    <i
                                                        class="fa-solid fa-money-bill-transfer text-success d-lg-inline d-block mb-2 mb-lg-0"></i>
                                                    <small
                                                        class="text-muted fw-bold">&nbsp;{{ \Number::currency($program->used_fund, 'IDR', 'id_ID') }}
                                                    </small>
                                                    <br><small class="text-muted">Tersalurkan</small>
                                                </div>
                                                <div class="program-used-funding border-end w-100 text-center ">
                                                    <i
                                                        class="fa-solid fa-money-bill text-success d-lg-inline d-block mb-2 mb-lg-0"></i>
                                                    <small
                                                        class="text-muted fw-bold">&nbsp;{{ \Number::currency($program->current_fund, 'IDR', 'id_ID') }}
                                                    </small>
                                                    <br><small class="text-muted">Dana Saat Ini</small>
                                                </div>
                                                <div class="program-used-funding w-100 text-center">
                                                    <i
                                                        class="fa-solid fa-newspaper text-success d-lg-inline d-block mb-2 mb-lg-0"></i>
                                                    <small
                                                        class="text-muted fw-bold">&nbsp;{{ $program->programActivities->count() }}
                                                    </small>
                                                    <br><small class="text-muted">Kegiatan</small>
                                                </div>
                                            </div>
                                            <hr>
                                            <h4>{{ $program->name }}</h4>

                                            {!! $program->description !!}

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- popular_causes_area_end  -->
                    <div class="make_donation_area section_padding pt-0 pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <div class="section_title text-center mb-4">
                                        <h3><span>Donasi Sekarang</span></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <div class="donation_form">
                                        <div class="row align-items-center">
                                            <div class="col-md-12">
                                                <div class="single_amount">
                                                    <div class="input_field">

                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text mr-2"
                                                                    id="basic-addon1">Rp</span>
                                                            </div>
                                                            <input type="hidden" id="program_id" name="program_id"
                                                                value="{{ $program->id }}">
                                                            <input type="number" id="amount" name="amount"
                                                                min="1000" class="form-control rounded"
                                                                placeholder="10.000" aria-label="Username"
                                                                aria-describedby="basic-addon1"
                                                                @guest disabled readonly data-toggle="tooltip" title="Silakan Login Terlebih Dahulu" @endguest>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <input type="checkbox" id="is_hide_name" name="is_hide_name">
                                            <label for="is_hide_name">Sembunyikan nama saya</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-0 pt-0">
                                <div class="col-12">
                                    <div class="donate_now_btn text-center mt-2">
                                        <button class="boxed-btn4" id="btn-donation"
                                            @guest data-toggle="modal"
                                            data-target="#loginRegisterModal" @endguest>Donasi</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget popular_post_widget p-0">
                            <div class="donation-title w-100 text-center pt-3">
                                <h3>Donasi Terbaru</h3>
                                <hr>
                            </div>
                            @foreach ($donations as $donation)
                                <div class="donation-list w-100">
                                    <div class="donation-item mx-4">
                                        <span class="h6">{{ $donation->donatur_name }}</span>
                                        <span class="d-block"><small>Mendonasikan</small>
                                            <strong
                                                class="text-success">{{ \Number::currency($donation->amount, 'IDR', 'id_ID') }}</strong>
                                        </span>
                                        <small
                                            class="d-block text-muted">{{ $donation->created_at->diffForHumans() }}</small>
                                        <hr>
                                    </div>
                                </div>
                            @endforeach
                            <div class="donation-pagination pb-2">
                                <div class="d-flex justify-content-center my-2">
                                    {{ $donations->appends(['kegiatan-terbaru' => $programActivities->currentPage()])->links() }}

                                </div>
                            </div>
                        </aside>

                        <aside class="single_sidebar_widget popular_post_widget p-0">
                            <div class="donation-title w-100 text-center pt-3">
                                <h3>Kegiatan Terbaru</h3>
                                <hr>
                            </div>
                            @foreach ($programActivities as $programActivity)
                                <div class="program-activity-list w-100">
                                    <div class="program-activity-item mx-4">
                                        <a href="#"><u class="h6 text-dark">{{ $programActivity->title }}</u></a>
                                        <small
                                            class="d-block text-muted">{{ $programActivity->created_at->diffForHumans() }}</small>
                                        <hr>
                                    </div>
                                </div>
                            @endforeach
                            <div class="program-activity-pagination pb-2">
                                <div class="d-flex justify-content-center my-2">
                                    {{ $programActivities->appends(['donasi-terbaru' => $donations->currentPage()])->links() }}
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <button id="liveChatButton" class="boxed-btn4 floating-button">Donasi</button>
    <!-- Modal -->
    <div class="modal fade" id="loginRegisterModal" tabindex="-1" role="dialog"
        aria-labelledby="loginRegisterModalLabel" aria-hidden="true" data-backdrop=false>
        <div class="modal-dialog" role="document">
            <div class="modal-content border">

                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="text-center w-100 my-4 h5">Masuk atau Daftar untuk Donasi</div>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item w-50">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#login" role="tab"
                                aria-controls="home" aria-selected="true">Masuk</a>
                        </li>
                        <li class="nav-item w-50">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#register" role="tab"
                                aria-controls="profile" aria-selected="false">Daftar</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="login" role="tabpanel"
                            aria-labelledby="home-tab">
                            <div class="login-tab p-3">
                                <form method="POST" action="{{ route('login') }}">
                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ ucfirst($error) }}</li>
                                                @endforeach
                                            </ul>
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            autocomplete="current-password">

                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" name="remember" class="form-check-input" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">Ingat Saya</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-2">Masuk</button>
                                    <a href="{{ route('auth.google') }}" class="btn btn-outline-primary mt-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="17"
                                            height="17" viewBox="0 0 45 45">
                                            <path fill="#FFC107"
                                                d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z">
                                            </path>
                                            <path fill="#FF3D00"
                                                d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z">
                                            </path>
                                            <path fill="#4CAF50"
                                                d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z">
                                            </path>
                                            <path fill="#1976D2"
                                                d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z">
                                            </path>
                                        </svg>&nbsp;&nbsp;{{ __('Masuk dengan Google') }}
                                    </a>
                                    <button class="btn btn-outline-secondary mt-2" data-dismiss="modal">Batal</button>
                                </form>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="profile-tab">...
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('body-scripts')
    <script src=" https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $('document').ready(function() {

            @auth $('#btn-donation').on('click', () => snapPayment());
        @endauth

        @if ($errors->has('email') || $errors->has('password'))
            $('#loginRegisterModal').modal('show');
        @endif
        });

        async function snapPayment(e) {
            if (!validateNumber($('#amount').val())) return;
            $(this).attr("disabled", "disabled");

            let formData = {
                _method: 'POST',
                _token: '{{ csrf_token() }}',
                program_id: $('#program_id').val(),
                is_hide_name: $('#is_hide_name').val(),
                amount: $('#amount').val(),
            };
            await axios.post('{{ route('main.donations.make_donation') }}', formData)
                .then(function(response) {
                    var order_id = response.data.order_id;
                    var donation_id = response.data.donation_id;
                    // Echo.channel('donation-payment-result-' + response.data.order_id)
                    //     .listen('DonationPaymentEvent', (e) => {
                    //         alert('event bayar axios');
                    //     });
                    let url = "{{ url('/') }}/donasi/saya/" + donation_id;
                    console.log(url);
                    snap.pay(response.data.snap_token, {
                        onSuccess: function(result) {
                            window.location.assign("{{ url('/') }}/donasi/saya/" +
                                donation_id);
                        },
                        onPending: function(result) {
                            window.location.assign("{{ url('/') }}/donasi/saya/" +
                                donation_id);
                        },
                        onError: function(result) {
                            window.location.assign("{{ url('/') }}/donasi/saya/" +
                                donation_id);
                        },
                        onClose: function() {
                            window.location.assign("{{ url('/') }}/donasi/saya/" +
                                donation_id);
                        }
                    });
                })
                .catch(function(error) {
                    console.log(error);
                });
        }

        function updatePaymentMethod($paymentMethod) {

        }
    </script>
    <script>
        $(document).ready(function() {
            // Handle click event
            var elementOffset = $('.make_donation_area').offset();
            elementOffset.top = elementOffset.top - 150;

            var makeDonationAreaHeight = $(".make_donation_area").height();


            $('.floating-button').click(function() {

                $('html, body').animate({
                    scrollTop: elementOffset
                        .top // Change '.container' to your target element selector
                }, 800); // Adjust the scroll speed if necessary
            });
            $(window).scroll(function() {
                var scrollPos = $(window).scrollTop() + makeDonationAreaHeight;

                if (scrollPos >= elementOffset.top) {
                    $('.floating-button').fadeOut(0); // Hide the button
                } else {
                    $('.floating-button').fadeIn(0); // Show the button
                }
            });
        });

        function validateNumber(input) {

            if (input === "" || input === null || input === undefined) {
                Swal.fire({
                    icon: "error",
                    text: "Donasi tidak boleh kosong.",
                });
                return false;
            }

            if (input < 1000) {
                Swal.fire({
                    icon: "error",
                    text: "Donasi minimal Rp. 1000.",
                });
                return false;
            }

            if (!/^[0-9]+$/.test(input)) {
                Swal.fire({
                    icon: "error",
                    text: "Donasi harus berupa angka.",
                });
                return false;
            }

            return true;
        }
    </script>
@endpush
