{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
@extends('layouts.backend.master')
@section('title')
    Beranda
@endsection
@section('css')
    @php
        $asset = asset('assets/');
    @endphp
    <link href="{{ $asset }}/css/light/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <link href="{{ $asset }}/css/dark/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/src/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    {{-- <link href="{{ $asset }}/css/light/apps/notes.css" rel="stylesheet" type="text/css" />
    <link href="{{ $asset }}/css/dark/apps/notes.css" rel="stylesheet" type="text/css" /> --}}
@endsection
@section('content')
    <div class="layout-px-spacing">
        <div class="middle-content container-xxl p-0">

            <!-- BREADCRUMB -->
            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
            <!-- /BREADCRUMB -->
            <div class="row layout-top-spacing">
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 layout-spacing">
                    <div class="widget widget-t-sales-widget widget-m-sales">
                        <div class="media">
                            <div class="icon ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-activity">
                                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                                </svg>
                            </div>
                            <div class="media-body">
                                <p class="widget-text">Nomor Antrian</p>
                                <p class="widget-numeric-value" id="no_antrian">{{ $no_antrian }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 layout-spacing">
                    <div class="widget widget-t-sales-widget widget-m-orders">
                        <div class="media">
                            <div class="icon ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-globe">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="2" y1="12" x2="22" y2="12"></line>
                                    <path
                                        d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                    </path>
                                </svg>
                            </div>
                            <div class="media-body">
                                <p class="widget-text">Sisa Antrian Hari Ini</p>
                                <p class="widget-numeric-value" id="sisa_antrian_hari_ini">{{ $sisa_antrian_hari_ini }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="row row-cols-2 layout-top-spacing">
                        <div class="col layout-spacing">
                            <a class="card bg-secondary" onclick="window.location.href='{{ !\Auth::check() ? route('login') : route('f.form_ijin_keluar_masuk') }}'">
                                <div class="card-body text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="4em" height="4em" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M7 2a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2h4.174A6.5 6.5 0 0 1 11 17.5H7a.5.5 0 0 1-.5-.5V4a.5.5 0 0 1 .5-.5h5.5v3.25c0 .966.784 1.75 1.75 1.75h3.25V11q.776.002 1.5.174V7.768a2 2 0 0 0-.586-1.414l-3.768-3.768A2 2 0 0 0 13.232 2zm7 4.75V4.06L16.94 7h-2.69a.25.25 0 0 1-.25-.25M6.5 20.5h5.232A6.5 6.5 0 0 0 12.81 22H6.5A4.5 4.5 0 0 1 2 17.5v-1.75a.75.75 0 0 1 1.5 0v1.75a3 3 0 0 0 3 3M8 5.75A.75.75 0 0 1 8.75 5h1.5a.75.75 0 0 1 0 1.5h-1.5A.75.75 0 0 1 8 5.75M8.75 8a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5zm0 3a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5zM23 17.5a5.5 5.5 0 1 0-11 0a5.5 5.5 0 0 0 11 0m-5 .5l.001 2.503a.5.5 0 1 1-1 0V18h-2.505a.5.5 0 0 1 0-1H17v-2.5a.5.5 0 1 1 1 0V17h2.497a.5.5 0 0 1 0 1z" />
                                    </svg>
                                    <h5 class="card-title text-center" style="font-weight: bold">SURAT IJIN KELUAR MASUK</h5>
                                </div>
                            </a>
                        </div>
                        <div class="col layout-spacing">
                            <a class="card bg-danger" onclick="window.location.href='{{ !\Auth::check() ? route('login') : route('f.form_ijin_absen') }}'">
                                <div class="card-body text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="4em" height="4em" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M7 2a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2h4.174A6.5 6.5 0 0 1 11 17.5H7a.5.5 0 0 1-.5-.5V4a.5.5 0 0 1 .5-.5h5.5v3.25c0 .966.784 1.75 1.75 1.75h3.25V11q.776.002 1.5.174V7.768a2 2 0 0 0-.586-1.414l-3.768-3.768A2 2 0 0 0 13.232 2zm7 4.75V4.06L16.94 7h-2.69a.25.25 0 0 1-.25-.25M6.5 20.5h5.232A6.5 6.5 0 0 0 12.81 22H6.5A4.5 4.5 0 0 1 2 17.5v-1.75a.75.75 0 0 1 1.5 0v1.75a3 3 0 0 0 3 3M8 5.75A.75.75 0 0 1 8.75 5h1.5a.75.75 0 0 1 0 1.5h-1.5A.75.75 0 0 1 8 5.75M8.75 8a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5zm0 3a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5zM23 17.5a5.5 5.5 0 1 0-11 0a5.5 5.5 0 0 0 11 0m-5 .5l.001 2.503a.5.5 0 1 1-1 0V18h-2.505a.5.5 0 0 1 0-1H17v-2.5a.5.5 0 1 1 1 0V17h2.497a.5.5 0 0 1 0 1z" />
                                    </svg>
                                    <h5 class="card-title text-center" style="font-weight: bold">SURAT IJIN ABSEN</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-chart-three">
                        <div class="widget-heading">
                            <div class="">
                                <h5 class="">Data Ijin Karyawan</h5>
                            </div>
                        </div>

                        <div class="widget-content">
                            <div id="uniqueVisits1"></div>
                        </div>
                    </div>
                </div>
                {{-- @if (!$ijin_keluar_masuks->isEmpty())
                    <h5 class="mt-3"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 28 28">
                            <path fill="currentColor"
                                d="M6 20h5v2H6c-1.11 0-2-.89-2-2V4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v6.3c-.22.12-.43.26-.61.44L18 12.13V4h-5v8l-2.5-2.25L8 12V4H6zm16.85-6.53l-1.32-1.32c-.2-.2-.53-.2-.72 0l-.98.98l2.04 2.04l.98-.98c.2-.19.2-.52 0-.72M13 19.96V22h2.04l6.13-6.12l-2.04-2.05z" />
                        </svg> Ijin Keluar Masuk</h5>
                    <div class="row">
                        @foreach ($ijin_keluar_masuks as $ijin_keluar_masuk)
                            @switch($ijin_keluar_masuk->status)
                                @case('Waiting')
                                    @php
                                        $color = 'badge-warning';
                                    @endphp
                                @break

                                @case('Approved')
                                    @php
                                        $color = 'badge-success';
                                    @endphp
                                @break

                                @case('Rejected')
                                    @php
                                        $color = 'badge-danger';
                                    @endphp
                                @break

                                @default
                                    @php
                                        $color = null;
                                    @endphp
                            @endswitch
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <a href="javascript:void()" class="card"
                                        onclick="window.location.href='{{ route('b_ijin_keluar_masuk.detail', ['id' => $ijin_keluar_masuk->id]) }}'">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                {{ $ijin_keluar_masuk->no . '-' . $ijin_keluar_masuk->created_at->format('Ymd') }}
                                                <span
                                                    class="badge {{ $color }}">{{ $ijin_keluar_masuk->status }}</span>
                                            </h5>
                                            <p class="mb-0">Nama :
                                                {{ $ijin_keluar_masuk->nik . ' - ' . $ijin_keluar_masuk->nama }}</p>
                                            <p class="mb-0">Jabatan : {{ $ijin_keluar_masuk->jabatan }}</p>
                                            <p class="mb-0">Unit Kerja : {{ $ijin_keluar_masuk->unit_kerja }}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                @endif
                @if (!$ijin_absens->isEmpty())
                    <h5 class="mt-3"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 28 28">
                            <path fill="currentColor"
                                d="M6 20h5v2H6c-1.11 0-2-.89-2-2V4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v6.3c-.22.12-.43.26-.61.44L18 12.13V4h-5v8l-2.5-2.25L8 12V4H6zm16.85-6.53l-1.32-1.32c-.2-.2-.53-.2-.72 0l-.98.98l2.04 2.04l.98-.98c.2-.19.2-.52 0-.72M13 19.96V22h2.04l6.13-6.12l-2.04-2.05z" />
                        </svg> Ijin Absen</h5>
                    @foreach ($ijin_absens as $ijin_absen)
                        @switch($ijin_absen->status)
                            @case('Waiting')
                                @php
                                    $color = 'badge-warning';
                                @endphp
                            @break

                            @case('Approved')
                                @php
                                    $color = 'badge-success';
                                @endphp
                            @break

                            @case('Rejected')
                                @php
                                    $color = 'badge-danger';
                                @endphp
                            @break

                            @default
                                @php
                                    $color = null;
                                @endphp
                        @endswitch
                        <div class="col-md-4">
                            <div class="mb-3">
                                <a href="javascript:void()" class="card"
                                    onclick="window.location.href='{{ route('b_ijin_absen.detail', ['id' => $ijin_absen->id]) }}'">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            {{ $ijin_absen->no . '-' . $ijin_absen->created_at->format('Ymd') }}
                                            <span class="badge {{ $color }}">{{ $ijin_absen->status }}</span>
                                        </h5>
                                        <p class="mb-0">Nama : {{ $ijin_absen->nik . ' - ' . $ijin_absen->nama }}
                                        </p>
                                        <p class="mb-0">Jabatan : {{ $ijin_absen->jabatan }}</p>
                                        <p class="mb-0">Unit Kerja : {{ $ijin_absen->unit_kerja }}</p>
                                        <p class="mb-0">Jenis Izin : {{ $ijin_absen->kategori_izin == 'CT' ? 'Cuti' : $ijin_absen->kategori_izin == 'IP' ? 'Ijin Pribadi' : $ijin_absen->kategori_izin == 'IS' ? 'Ijin Sakit' : '-' }}</p>
                                        <p class="mb-0">Tanggal Dibuat : {{ $ijin_absen->created_at->isoFormat('LLL') }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif --}}
            </div>
            {{-- <div class="row layout-top-spacing">

                <div class="col-12">
                    <div class="alert alert-arrow-right alert-icon-right alert-light-success alert-dismissible fade show mb-4"
                        role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-alert-circle">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12" y2="16"></line>
                        </svg>
                        <strong>Kick Start you new project with ease!</strong> Learn more about Starter Kit by refering to
                        the <a target="_blank"
                            href="https://designreset.com/equation/documentation/getting-started.html">Documentation</a>
                    </div>
                </div>

                <div class="col-md-12">
                </div>

            </div> --}}
            <!-- CONTENT AREA -->

        </div>

    </div>
@endsection
@section('script')
    {{-- <script src="{{ $asset }}/js/dashboard/dash_1.js"></script> --}}
    <script src="{{ asset('plugins/src/apex/apexcharts.min.js') }}"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    {{-- <script src="{{ $asset }}/js/apps/notes.js"></script> --}}
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
        });

        var channel = pusher.subscribe('notification');
        channel.bind('App\\Events\\FrontendNotification', function(data) {
            // alert(JSON.stringify(data));
            // alert('OK');
            document.getElementById('no_antrian').innerHTML = data.antrian;
            document.getElementById('sisa_antrian_hari_ini').innerHTML = data.sisa_antrian_hari_ini;
        });
    </script>
    <script>
        window.addEventListener("load", function() {
            try {
                getequationThemeObject = localStorage.getItem("theme");
                getParseObject = JSON.parse(getequationThemeObject)
                ParsedObject = getParseObject;

                if (ParsedObject.settings.layout.darkMode) {
                    var Theme = 'dark';
                    Apex.tooltip = {
                        theme: Theme
                    }
                    /**
                      ==============================
                      |    @Options Charts Script   |
                      ==============================
                    */
                    /*
                      ======================================
                          Visitor Statistics | Options
                      ======================================
                    */
                    // Total Visits
                    var spark1 = {
                        chart: {
                            id: 'unique-visits',
                            group: 'sparks2',
                            type: 'line',
                            height: 80,
                            sparkline: {
                                enabled: true
                            },
                            dropShadow: {
                                enabled: true,
                                top: 1,
                                left: 1,
                                blur: 2,
                                color: '#e2a03f',
                                opacity: 0.7,
                            }
                        },
                        series: [{
                            data: [21, 9, 36, 12, 44, 25, 59, 41, 66, 25]
                        }],
                        stroke: {
                            curve: 'smooth',
                            width: 2,
                        },
                        markers: {
                            size: 0
                        },
                        grid: {
                            padding: {
                                top: 35,
                                bottom: 0,
                                left: 40
                            }
                        },
                        colors: ['#e2a03f'],
                        tooltip: {
                            x: {
                                show: false
                            },
                            y: {
                                title: {
                                    formatter: function formatter(val) {
                                        return '';
                                    }
                                }
                            }
                        },
                        responsive: [{
                                breakpoint: 1351,
                                options: {
                                    chart: {
                                        height: 95,
                                    },
                                    grid: {
                                        padding: {
                                            top: 35,
                                            bottom: 0,
                                            left: 0
                                        }
                                    },
                                },
                            },
                            {
                                breakpoint: 1200,
                                options: {
                                    chart: {
                                        height: 80,
                                    },
                                    grid: {
                                        padding: {
                                            top: 35,
                                            bottom: 0,
                                            left: 40
                                        }
                                    },
                                },
                            },
                            {
                                breakpoint: 576,
                                options: {
                                    chart: {
                                        height: 95,
                                    },
                                    grid: {
                                        padding: {
                                            top: 45,
                                            bottom: 0,
                                            left: 0
                                        }
                                    },
                                },
                            }

                        ]
                    }
                    // Paid Visits
                    var spark2 = {
                        chart: {
                            id: 'total-users',
                            group: 'sparks1',
                            type: 'line',
                            height: 80,
                            sparkline: {
                                enabled: true
                            },
                            dropShadow: {
                                enabled: true,
                                top: 3,
                                left: 1,
                                blur: 3,
                                color: '#009688',
                                opacity: 0.7,
                            }
                        },
                        series: [{
                            data: [22, 19, 30, 47, 32, 44, 34, 55, 41, 69]
                        }],
                        stroke: {
                            curve: 'smooth',
                            width: 2,
                        },
                        markers: {
                            size: 0
                        },
                        grid: {
                            padding: {
                                top: 35,
                                bottom: 0,
                                left: 40
                            }
                        },
                        colors: ['#009688'],
                        tooltip: {
                            x: {
                                show: false
                            },
                            y: {
                                title: {
                                    formatter: function formatter(val) {
                                        return '';
                                    }
                                }
                            }
                        },
                        responsive: [{
                                breakpoint: 1351,
                                options: {
                                    chart: {
                                        height: 95,
                                    },
                                    grid: {
                                        padding: {
                                            top: 35,
                                            bottom: 0,
                                            left: 0
                                        }
                                    },
                                },
                            },
                            {
                                breakpoint: 1200,
                                options: {
                                    chart: {
                                        height: 80,
                                    },
                                    grid: {
                                        padding: {
                                            top: 35,
                                            bottom: 0,
                                            left: 40
                                        }
                                    },
                                },
                            },
                            {
                                breakpoint: 576,
                                options: {
                                    chart: {
                                        height: 95,
                                    },
                                    grid: {
                                        padding: {
                                            top: 35,
                                            bottom: 0,
                                            left: 0
                                        }
                                    },
                                },
                            }
                        ]
                    }
                    /*
                      ===================================
                          Unique Visitors | Options
                      ===================================
                    */
                    var d_1options1 = {
                        chart: {
                            height: 350,
                            type: 'bar',
                            toolbar: {
                                show: false,
                            }
                        },
                        colors: ['#622bd7', '#ffbb44', '#ed090d', '#04db08'],
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '55%',
                                endingShape: 'rounded',
                                borderRadius: 10,

                            },
                        },
                        dataLabels: {
                            enabled: false
                        },
                        legend: {
                            position: 'bottom',
                            horizontalAlign: 'center',
                            fontSize: '14px',
                            markers: {
                                width: 10,
                                height: 10,
                                offsetX: -5,
                                offsetY: 0
                            },
                            itemMargin: {
                                horizontal: 10,
                                vertical: 8
                            }
                        },
                        grid: {
                            borderColor: '#191e3a',
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ['transparent']
                        },
                        series: [
                            {
                                name: 'Ijin Terlambat',
                                data: @json($total_ijin_terlambat)
                            }, {
                                name: 'Ijin Keluar Masuk',
                                data: @json($total_ijin_keluar_masuk)
                            }, {
                                name: 'Ijin Pribadi',
                                data: @json($total_ijin_pulang_awal)
                            }, {
                                name: 'Ijin Absen',
                                data: @json($total_ijin_absen)
                            }
                        ],
                        xaxis: {
                            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
                                'Nov', 'Dec'
                            ],
                        },
                        fill: {
                            type: 'gradient',
                            gradient: {
                                shade: Theme,
                                type: 'vertical',
                                shadeIntensity: 0.3,
                                inverseColors: false,
                                opacityFrom: 1,
                                opacityTo: 0.8,
                                stops: [0, 100]
                            }
                        },
                        tooltip: {
                            marker: {
                                show: false,
                            },
                            theme: Theme,
                            y: {
                                formatter: function(val) {
                                    return val
                                }
                            }
                        },
                        responsive: [{
                            breakpoint: 767,
                            options: {
                                plotOptions: {
                                    bar: {
                                        borderRadius: 0,
                                        columnWidth: "50%"
                                    }
                                }
                            }
                        }, ]
                    }
                    /*
                      ==============================
                          Statistics | Options
                      ==============================
                    */
                    // Followers
                    var d_1options3 = {
                        chart: {
                            id: 'sparkline1',
                            type: 'area',
                            height: 160,
                            sparkline: {
                                enabled: true
                            },
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 2,
                        },
                        series: [{
                            name: 'Sales',
                            data: [38, 60, 38, 52, 36, 40, 28]
                        }],
                        labels: ['1', '2', '3', '4', '5', '6', '7'],
                        yaxis: {
                            min: 0
                        },
                        colors: ['#4361ee'],
                        tooltip: {
                            x: {
                                show: false,
                            }
                        },
                        grid: {
                            show: false,
                            xaxis: {
                                lines: {
                                    show: false
                                }
                            },
                            padding: {
                                top: 5,
                                right: 0,
                                left: 0
                            },
                        },
                        fill: {
                            type: "gradient",
                            gradient: {
                                type: "vertical",
                                shadeIntensity: 1,
                                inverseColors: !1,
                                opacityFrom: .30,
                                opacityTo: .05,
                                stops: [100, 100]
                            }
                        }
                    }
                    // Referral
                    var d_1options4 = {
                        chart: {
                            id: 'sparkline1',
                            type: 'area',
                            height: 160,
                            sparkline: {
                                enabled: true
                            },
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 2,
                        },
                        series: [{
                            name: 'Sales',
                            data: [60, 28, 52, 38, 40, 36, 38]
                        }],
                        labels: ['1', '2', '3', '4', '5', '6', '7'],
                        yaxis: {
                            min: 0
                        },
                        colors: ['#e7515a'],
                        tooltip: {
                            x: {
                                show: false,
                            }
                        },
                        grid: {
                            show: false,
                            xaxis: {
                                lines: {
                                    show: false
                                }
                            },
                            padding: {
                                top: 5,
                                right: 0,
                                left: 0
                            },
                        },
                        fill: {
                            type: "gradient",
                            gradient: {
                                type: "vertical",
                                shadeIntensity: 1,
                                inverseColors: !1,
                                opacityFrom: .30,
                                opacityTo: .05,
                                stops: [100, 100]
                            }
                        }
                    }
                    // Engagement Rate
                    var d_1options5 = {
                        chart: {
                            id: 'sparkline1',
                            type: 'area',
                            height: 160,
                            sparkline: {
                                enabled: true
                            },
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 2,
                        },
                        fill: {
                            opacity: 1,
                        },
                        series: [{
                            name: 'Sales',
                            data: [28, 50, 36, 60, 38, 52, 38]
                        }],
                        labels: ['1', '2', '3', '4', '5', '6', '7'],
                        yaxis: {
                            min: 0
                        },
                        colors: ['#00ab55'],
                        tooltip: {
                            x: {
                                show: false,
                            }
                        },
                        grid: {
                            show: false,
                            xaxis: {
                                lines: {
                                    show: false
                                }
                            },
                            padding: {
                                top: 5,
                                right: 0,
                                left: 0
                            },
                        },
                        fill: {
                            type: "gradient",
                            gradient: {
                                type: "vertical",
                                shadeIntensity: 1,
                                inverseColors: !1,
                                opacityFrom: .30,
                                opacityTo: .05,
                                stops: [100, 100]
                            }
                        }
                    }
                } else {
                    var Theme = 'dark';
                    Apex.tooltip = {
                        theme: Theme
                    }
                    /**
                      ==============================
                      |    @Options Charts Script   |
                      ==============================
                    */
                    /*
                      ======================================
                          Visitor Statistics | Options
                      ======================================
                    */
                    // Total Visits
                    var spark1 = {
                        chart: {
                            id: 'unique-visits',
                            group: 'sparks2',
                            type: 'line',
                            height: 80,
                            sparkline: {
                                enabled: true
                            },
                            dropShadow: {
                                enabled: true,
                                top: 1,
                                left: 1,
                                blur: 2,
                                color: '#e2a03f',
                                opacity: 0.7,
                            }
                        },
                        series: [{
                            data: [21, 9, 36, 12, 44, 25, 59, 41, 66, 25]
                        }],
                        stroke: {
                            curve: 'smooth',
                            width: 2,
                        },
                        markers: {
                            size: 0
                        },
                        grid: {
                            padding: {
                                top: 35,
                                bottom: 0,
                                left: 40
                            }
                        },
                        colors: ['#e2a03f'],
                        tooltip: {
                            x: {
                                show: false
                            },
                            y: {
                                title: {
                                    formatter: function formatter(val) {
                                        return '';
                                    }
                                }
                            }
                        },
                        responsive: [{
                                breakpoint: 1351,
                                options: {
                                    chart: {
                                        height: 95,
                                    },
                                    grid: {
                                        padding: {
                                            top: 35,
                                            bottom: 0,
                                            left: 0
                                        }
                                    },
                                },
                            },
                            {
                                breakpoint: 1200,
                                options: {
                                    chart: {
                                        height: 80,
                                    },
                                    grid: {
                                        padding: {
                                            top: 35,
                                            bottom: 0,
                                            left: 40
                                        }
                                    },
                                },
                            },
                            {
                                breakpoint: 576,
                                options: {
                                    chart: {
                                        height: 95,
                                    },
                                    grid: {
                                        padding: {
                                            top: 45,
                                            bottom: 0,
                                            left: 0
                                        }
                                    },
                                },
                            }

                        ]
                    }
                    // Paid Visits
                    var spark2 = {
                        chart: {
                            id: 'total-users',
                            group: 'sparks1',
                            type: 'line',
                            height: 80,
                            sparkline: {
                                enabled: true
                            },
                            dropShadow: {
                                enabled: true,
                                top: 3,
                                left: 1,
                                blur: 3,
                                color: '#009688',
                                opacity: 0.7,
                            }
                        },
                        series: [{
                            data: [22, 19, 30, 47, 32, 44, 34, 55, 41, 69]
                        }],
                        stroke: {
                            curve: 'smooth',
                            width: 2,
                        },
                        markers: {
                            size: 0
                        },
                        grid: {
                            padding: {
                                top: 35,
                                bottom: 0,
                                left: 40
                            }
                        },
                        colors: ['#009688'],
                        tooltip: {
                            x: {
                                show: false
                            },
                            y: {
                                title: {
                                    formatter: function formatter(val) {
                                        return '';
                                    }
                                }
                            }
                        },
                        responsive: [{
                                breakpoint: 1351,
                                options: {
                                    chart: {
                                        height: 95,
                                    },
                                    grid: {
                                        padding: {
                                            top: 35,
                                            bottom: 0,
                                            left: 0
                                        }
                                    },
                                },
                            },
                            {
                                breakpoint: 1200,
                                options: {
                                    chart: {
                                        height: 80,
                                    },
                                    grid: {
                                        padding: {
                                            top: 35,
                                            bottom: 0,
                                            left: 40
                                        }
                                    },
                                },
                            },
                            {
                                breakpoint: 576,
                                options: {
                                    chart: {
                                        height: 95,
                                    },
                                    grid: {
                                        padding: {
                                            top: 35,
                                            bottom: 0,
                                            left: 0
                                        }
                                    },
                                },
                            }
                        ]
                    }
                    /*
                      ===================================
                          Unique Visitors | Options
                      ===================================
                    */
                    var d_1options1 = {
                        chart: {
                            height: 350,
                            type: 'bar',
                            toolbar: {
                                show: false,
                            }
                        },
                        colors: ['#622bd7', '#ffbb44', '#ed090d', '#04db08'],
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '55%',
                                endingShape: 'rounded',
                                borderRadius: 10,

                            },
                        },
                        dataLabels: {
                            enabled: false
                        },
                        legend: {
                            position: 'bottom',
                            horizontalAlign: 'center',
                            fontSize: '14px',
                            markers: {
                                width: 10,
                                height: 10,
                                offsetX: -5,
                                offsetY: 0
                            },
                            itemMargin: {
                                horizontal: 10,
                                vertical: 8
                            }
                        },
                        grid: {
                            borderColor: '#e0e6ed',
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ['transparent']
                        },
                        series: [
                        {
                            name: 'Ijin Terlambat',
                            data: @json($total_ijin_terlambat)
                        }, {
                            name: 'Ijin Keluar Masuk',
                            data: @json($total_ijin_keluar_masuk)
                        }, {
                            name: 'Ijin Pribadi',
                            data: @json($total_ijin_pulang_awal)
                        }, {
                            name: 'Ijin Absen',
                            data: @json($total_ijin_absen)
                        }
                        ],
                        xaxis: {
                            // categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
                            //     'Nov', 'Dec'
                            // ],
                            categories: @json($periode),
                        },
                        fill: {
                            type: 'gradient',
                            gradient: {
                                shade: Theme,
                                type: 'vertical',
                                shadeIntensity: 0.3,
                                inverseColors: false,
                                opacityFrom: 1,
                                opacityTo: 0.8,
                                stops: [0, 100]
                            }
                        },
                        tooltip: {
                            marker: {
                                show: false,
                            },
                            theme: Theme,
                            y: {
                                formatter: function(val) {
                                    return val
                                }
                            }
                        },
                        responsive: [{
                            breakpoint: 767,
                            options: {
                                plotOptions: {
                                    bar: {
                                        borderRadius: 0,
                                        columnWidth: "50%"
                                    }
                                }
                            }
                        }, ]
                    }
                    /*
                      ==============================
                          Statistics | Options
                      ==============================
                    */
                    // Followers
                    var d_1options3 = {
                        chart: {
                            id: 'sparkline1',
                            type: 'area',
                            height: 160,
                            sparkline: {
                                enabled: true
                            },
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 2,
                        },
                        series: [{
                            name: 'Sales',
                            data: [38, 60, 38, 52, 36, 40, 28]
                        }],
                        labels: ['1', '2', '3', '4', '5', '6', '7'],
                        yaxis: {
                            min: 0
                        },
                        colors: ['#4361ee'],
                        tooltip: {
                            x: {
                                show: false,
                            }
                        },
                        grid: {
                            show: false,
                            xaxis: {
                                lines: {
                                    show: false
                                }
                            },
                            padding: {
                                top: 5,
                                right: 0,
                                left: 0
                            },
                        },
                        fill: {
                            type: "gradient",
                            gradient: {
                                type: "vertical",
                                shadeIntensity: 1,
                                inverseColors: !1,
                                opacityFrom: .40,
                                opacityTo: .05,
                                stops: [100, 100]
                            }
                        }
                    }
                    // Referral
                    var d_1options4 = {
                        chart: {
                            id: 'sparkline1',
                            type: 'area',
                            height: 160,
                            sparkline: {
                                enabled: true
                            },
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 2,
                        },
                        series: [{
                            name: 'Sales',
                            data: [60, 28, 52, 38, 40, 36, 38]
                        }],
                        labels: ['1', '2', '3', '4', '5', '6', '7'],
                        yaxis: {
                            min: 0
                        },
                        colors: ['#e7515a'],
                        tooltip: {
                            x: {
                                show: false,
                            }
                        },
                        grid: {
                            show: false,
                            xaxis: {
                                lines: {
                                    show: false
                                }
                            },
                            padding: {
                                top: 5,
                                right: 0,
                                left: 0
                            },
                        },
                        fill: {
                            type: "gradient",
                            gradient: {
                                type: "vertical",
                                shadeIntensity: 1,
                                inverseColors: !1,
                                opacityFrom: .40,
                                opacityTo: .05,
                                stops: [100, 100]
                            }
                        }
                    }
                    // Engagement Rate
                    var d_1options5 = {
                        chart: {
                            id: 'sparkline1',
                            type: 'area',
                            height: 160,
                            sparkline: {
                                enabled: true
                            },
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 2,
                        },
                        fill: {
                            opacity: 1,
                        },
                        series: [{
                            name: 'Sales',
                            data: [28, 50, 36, 60, 38, 52, 38]
                        }],
                        labels: ['1', '2', '3', '4', '5', '6', '7'],
                        yaxis: {
                            min: 0
                        },
                        colors: ['#00ab55'],
                        tooltip: {
                            x: {
                                show: false,
                            }
                        },
                        grid: {
                            show: false,
                            xaxis: {
                                lines: {
                                    show: false
                                }
                            },
                            padding: {
                                top: 5,
                                right: 0,
                                left: 0
                            },
                        },
                        fill: {
                            type: "gradient",
                            gradient: {
                                type: "vertical",
                                shadeIntensity: 1,
                                inverseColors: !1,
                                opacityFrom: .40,
                                opacityTo: .05,
                                stops: [100, 100]
                            }
                        }
                    }

                }
                /**
                    ==============================
                    |    @Render Charts Script    |
                    ==============================
                */
                /*
                    ======================================
                        Visitor Statistics | Script
                    ======================================
                */
                // Total Visits
                d_1C_1 = new ApexCharts(document.querySelector("#total-users"), spark1);
                d_1C_1.render();

                // Paid Visits
                d_1C_2 = new ApexCharts(document.querySelector("#paid-visits"), spark2);
                d_1C_2.render();
                /*
                    ===================================
                        Unique Visitors | Script
                    ===================================
                */
                var d_1C_3 = new ApexCharts(
                    document.querySelector("#uniqueVisits1"),
                    d_1options1
                );
                d_1C_3.render();
                /*
                    ==============================
                        Statistics | Script
                    ==============================
                */
                // Followers
                var d_1C_5 = new ApexCharts(document.querySelector("#hybrid_followers"), d_1options3);
                d_1C_5.render()
                // Referral
                var d_1C_6 = new ApexCharts(document.querySelector("#hybrid_followers1"), d_1options4);
                d_1C_6.render()
                // Engagement Rate
                var d_1C_7 = new ApexCharts(document.querySelector("#hybrid_followers3"), d_1options5);
                d_1C_7.render()
                /*
                    =============================================
                        Perfect Scrollbar | Notifications
                    =============================================
                */
                const ps = new PerfectScrollbar(document.querySelector('.mt-container'));
                /**
                 * =================================================================================================
                 * |     @Re_Render | Re render all the necessary JS when clicked to switch/toggle theme           |
                 * =================================================================================================
                 */
                document.querySelector('.theme-toggle').addEventListener('click', function() {
                    getequationThemeObject = localStorage.getItem("theme");
                    getParseObject = JSON.parse(getequationThemeObject)
                    ParsedObject = getParseObject;
                    // console.log(ParsedObject.settings.layout.darkMode)
                    if (ParsedObject.settings.layout.darkMode) {
                        /*
                            ==============================
                            |    @Re-Render Charts Script    |
                            ==============================
                        */
                        /*
                            ===================================
                                Unique Visitors | Script
                            ===================================
                        */
                        d_1C_3.updateOptions({
                            grid: {
                                borderColor: '#191e3a',
                            },
                        })
                        /*
                            ==============================
                                Statistics | Script
                            ==============================
                        */
                        // Followers
                        d_1C_5.updateOptions({
                            fill: {
                                type: "gradient",
                                gradient: {
                                    opacityFrom: .30,
                                }
                            }
                        })
                        // Referral
                        d_1C_6.updateOptions({
                            fill: {
                                type: "gradient",
                                gradient: {
                                    opacityFrom: .30,
                                }
                            }
                        })
                        // Engagement Rate
                        d_1C_7.updateOptions({
                            fill: {
                                type: "gradient",
                                gradient: {
                                    opacityFrom: .30,
                                }
                            }
                        })
                    } else {
                        /*
                            ==============================
                            |    @Re-Render Charts Script    |
                            ==============================
                        */

                        /*
                            ===================================
                                Unique Visitors | Script
                            ===================================
                        */
                        d_1C_3.updateOptions({
                            grid: {
                                borderColor: '#e0e6ed',
                            },
                        })
                        /*
                            ==============================
                                Statistics | Script
                            ==============================
                        */
                        // Followers
                        d_1C_5.updateOptions({
                            fill: {
                                type: "gradient",
                                gradient: {
                                    opacityFrom: .40,
                                }
                            }
                        })
                        // Referral
                        d_1C_6.updateOptions({
                            fill: {
                                type: "gradient",
                                gradient: {
                                    opacityFrom: .40,
                                }
                            }
                        })
                        // Engagement Rate
                        d_1C_7.updateOptions({
                            fill: {
                                type: "gradient",
                                gradient: {
                                    opacityFrom: .40,
                                }
                            }
                        })
                    }
                })

            } catch (e) {
                console.log(e);
            }
        })
    </script>
@endsection
