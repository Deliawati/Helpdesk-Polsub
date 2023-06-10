@extends('layouts.app')

@section('title', 'Home')

@section('head')
    <style>
        .chart-container {
            position: relative;
            margin: auto;
            height: 35vh;
            width: auto;
        }
    </style>
@endsection

@section('content')
    <section id="home" class="home">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="main-banner">
                        <div class="d-sm-flex justify-content-between">
                            <div data-aos="zoom-in-up">
                                <div class="banner-title">
                                    <h3 class="font-weight-medium">
                                        Selamat Datang di Helpdesk Politeknik Negeri Subang
                                    </h3>
                                </div>
                                <p class="mt-3" style="
                                max-width: 500px;
                                ">Kami siap membantu Anda dengan solusi cepat dan ramah untuk segala
                                    pertanyaan dan masalah yang Anda hadapi.
                                </p>
                                <a href="{{route('pertanyaan')}}" class="btn btn-secondary mt-3">Ajukan TIket</a>
                            </div>
                            <div class="mt-5 mt-lg-0">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-dark text-center">Tiket Pertanyaan</h5>
                                        <div class="chart-container">
                                            <canvas id="chart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.1/chart.min.js"></script>

    <script>
        const data = {
            labels: ['Selesai', 'Belum Terjawab'],
            datasets: [{
                label: 'Tiket Pertanyaan',
                data: [{{$tiket_dibalas}}, {{$tiket_belum_dibalas}}],
                backgroundColor: [
                    '#37f713',
                    'rgb(255, 159, 64)',
                ],
            }]
        };

        var options = {
            maintainAspectRatio: false,
        };

        new Chart('chart', {
            type: 'pie',
            options: options,
            data: data
        });
    </script>
@endsection
