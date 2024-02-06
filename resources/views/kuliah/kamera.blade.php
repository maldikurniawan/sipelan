@extends('dashboard.index')
@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="/absensi" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Absensi Swafoto</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
    <style>
        .webcam-capture,
        .webcam-capture video {
            display: inline-block;
            width: 100% !important;
            margin: auto;
            height: auto !important;
            border-radius: 15px;
        }
    </style>
@endsection
@section('content')
    <div class="row" style="margin-top:60px">
        <div class="col">
            <div class="webcam-capture">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button id="takeabsen" class="btn btn-primary btn-block">
                <ion-icon name="camera-outline"></ion-icon>
                Absen Masuk
            </button>
        </div>
    </div>
@endsection
@push('myscript')
    <script>
        Webcam.set({
            height: 480,
            width: 640,
            image_format: 'jpeg',
            jpeg_quality: 80
        });
        Webcam.attach('.webcam-capture');

        $("#takeabsen").click(function(e) {
            Webcam.snap(function(uri) {
                image = uri;
            });
            $.ajax({
                type: 'POST',
                url: '/absensi/store',
                data: {
                    _token: "{{ csrf_token() }}",
                    image: image
                },
                cache: false,
                success: function(respond) {
                    var status = respond.split("|");
                    if (status[0] == "success") {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: status[1],
                            icon: 'success'
                        })
                        setTimeout("location.href='/absensi'", 2000);
                    } else {
                        Swal.fire({
                            title: 'Gagal!',
                            text: status[1],
                            icon: 'error'
                        })
                    }
                }
            });
        });
    </script>
@endpush
