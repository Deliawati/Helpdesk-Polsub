@extends('layouts.main')

@section('title', 'Dahsboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card h-100">
                    <div class="d-flex align-items-end row my-auto mx-auto">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Dashboard! 👋</h5>
                                <p class="mb-4">
                                    Kamu punya <span class="fw-bold">{{ $tiket_belum_dibalas }}</span> tiket pertanyaan yang
                                    perlu dibalas.
                                </p>

                                <a href="{{ route('modul-tiket.index') }}" class="btn btn-sm btn-outline-primary">Lihat
                                    Tiket</a>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140"
                                    alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png')}}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 order-1 mb-4">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                <div class="card-title mb-0">
                                    <h5 class="m-0 me-2">Tiket Pertanyaan</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex flex-column align-items-center gap-1">
                                        <h2 class="mb-2">{{ $tiket_dibalas + $tiket_belum_dibalas }}</h2>
                                        <span>Total Tiket Masuk</span>
                                    </div>
                                    <div id="orderStatisticsChart1"></div>
                                </div>
                                <ul class="p-0 m-0">
                                    <li class="d-flex mb-4">
                                        <div class="avatar flex-shrink-0 me-3">
                                            <span class="avatar-initial rounded bg-label-warning"><i
                                                    class="bx bx-mobile-alt"></i></span>
                                        </div>
                                        <div
                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <h6 class="mb-0">Belum Dijawab</h6>
                                            </div>
                                            <div class="user-progress">
                                                <small class="fw-semibold">{{ $tiket_belum_dibalas }}</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="d-flex mb-4">
                                        <div class="avatar flex-shrink-0 me-3">
                                            <span class="avatar-initial rounded bg-label-success"><i
                                                    class="bx bx-mobile-alt"></i></span>
                                        </div>
                                        <div
                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <h6 class="mb-0">Selesai</h6>
                                            </div>
                                            <div class="user-progress">
                                                <small class="fw-semibold">{{ $tiket_dibalas }}</small>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let cardColor, headingColor, axisColor, shadeColor, borderColor;

        cardColor = config.colors.white;
        headingColor = config.colors.headingColor;
        axisColor = config.colors.axisColor;
        borderColor = config.colors.borderColor;
        // Order Statistics Chart
        // --------------------------------------------------------------------
        const chartOrderStatistics = document.querySelector('#orderStatisticsChart1'),
            orderChartConfig = {
                chart: {
                    height: 165,
                    width: 130,
                    type: 'donut'
                },
                labels: ['Belum Dibalas', 'Selesai'],
                series: [{{ $tiket_belum_dibalas }}, {{ $tiket_dibalas }}],
                colors: [config.colors.warning, config.colors.success],
                stroke: {
                    width: 5,
                    colors: cardColor
                },
                dataLabels: {
                    enabled: false,
                    formatter: function(val, opt) {
                        return parseInt(val) + '%';
                    }
                },
                legend: {
                    show: false
                },
                grid: {
                    padding: {
                        top: 0,
                        bottom: 0,
                        right: 15
                    }
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '75%',
                            labels: {
                                show: true,
                                value: {
                                    fontSize: '1.5rem',
                                    fontFamily: 'Public Sans',
                                    color: headingColor,
                                    offsetY: -15,
                                    formatter: function(val) {
                                        return parseInt(val) + 'Tiket';
                                    }
                                },
                                name: {
                                    offsetY: 20,
                                    fontFamily: 'Public Sans'
                                },
                                total: {
                                    show: true,
                                    fontSize: '0.8125rem',
                                    color: axisColor,
                                    label: 'Selesai',
                                    formatter: function(w) {
                                        return '{{round(($tiket_dibalas/($tiket_dibalas+$tiket_belum_dibalas))*100)}}%';
                                    }
                                }
                            }
                        }
                    }
                }
            };
        if (typeof chartOrderStatistics !== undefined && chartOrderStatistics !== null) {
            const statisticsChart = new ApexCharts(chartOrderStatistics, orderChartConfig);
            statisticsChart.render();
        }
    </script>
@endsection
