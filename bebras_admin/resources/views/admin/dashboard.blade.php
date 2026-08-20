@extends('app')

@section('content')
<div class="col-lg-8 mb-4 order-0">
    <div class="card h-100">
        <div class="d-flex align-items-end row">
            <div class="col-sm-7">
                <div class="card-body">
                    <h5 class="card-title text-primary">Selamat Datang, {{ Auth::user()->name }}! 🎉</h5>
                    <p class="mb-4">
                        Anda masuk sebagai administrator CMS Bebras Indonesia. Di sini Anda dapat mengelola Banner, Kegiatan, halaman Tentang Bebras, Kumpulan Soal Bebras, Buku Pembahasan, Latihan, hingga data Kontak.
                    </p>
                    <a href="{{ route('soal_bebras.index') }}" class="btn btn-sm btn-outline-primary">Kelola Soal Bebras</a>
                </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                    <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-4 col-md-4 order-1">
    <div class="row h-100">
        <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-book-open"></i></span>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Soal</span>
                    <h3 class="card-title mb-2">{{ $stats['total_soal'] }}</h3>
                    <small class="text-muted">Soal tantangan aktif</small>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-success"><i class="bx bx-book"></i></span>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Buku Soal</span>
                    <h3 class="card-title mb-2">{{ $stats['total_buku'] }}</h3>
                    <small class="text-muted">File PDF pembahasan</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-12 mb-4">
    <div class="row">
        <div class="col-md-3 col-6 mb-4 mb-md-0">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-3">
                            <span class="avatar-initial rounded bg-label-info"><i class="bx bx-calendar-event"></i></span>
                        </div>
                        <h4 class="mb-0">{{ $stats['total_kegiatan'] }}</h4>
                    </div>
                    <span class="text-muted small">Total Kegiatan</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-4 mb-md-0">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-3">
                            <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-phone"></i></span>
                        </div>
                        <h4 class="mb-0">{{ $stats['total_kontak'] }}</h4>
                    </div>
                    <span class="text-muted small">Kontak Masuk</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-3">
                            <span class="avatar-initial rounded bg-label-danger"><i class="bx bx-image"></i></span>
                        </div>
                        <h4 class="mb-0">{{ $stats['total_banner'] }}</h4>
                    </div>
                    <span class="text-muted small">Banner Carousel</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-3">
                            <span class="avatar-initial rounded bg-label-secondary"><i class="bx bx-link-external"></i></span>
                        </div>
                        <h4 class="mb-0">{{ $stats['total_latihan'] }}</h4>
                    </div>
                    <span class="text-muted small">Link Latihan</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-6 mb-4">
    <div class="card h-100">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Distribusi Soal per Tingkat</h5>
            <small class="text-muted">SD, SMP, SMA</small>
        </div>
        <div class="card-body">
            <div id="soalTingkatChart" class="mx-auto"></div>
        </div>
    </div>
</div>

<div class="col-md-6 mb-4">
    <div class="card h-100">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Tingkat Kesulitan Soal</h5>
            <small class="text-muted">Mudah, Menengah, Sulit</small>
        </div>
        <div class="card-body">
            <div id="soalKesulitanChart" class="mx-auto"></div>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center border-bottom pb-3">
            <h5 class="mb-0"><i class="bx bx-phone me-2 text-primary"></i>Kontak Masuk Terbaru</h5>
            <a href="{{ route('kontak.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Institusi</th>
                        <th>Alamat</th>
                        <th>Kontak</th>
                        <th>Tanggal Masuk</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($latestKontak as $kontak)
                    <tr>
                        <td><strong>{{ $kontak->nama }}</strong></td>
                        <td>{{ $kontak->institusi ?: '-' }}</td>
                        <td>{{ $kontak->alamat ? \Illuminate\Support\Str::limit($kontak->alamat, 40) : '-' }}</td>
                        <td>
                            @foreach($kontak->details as $detail)
                                @if($detail->tipe == 'email')
                                    <span class="badge bg-label-primary me-1" title="Email"><i class="bx bx-envelope me-1"></i>{{ $detail->nilai }}</span>
                                @elseif($detail->tipe == 'telepon')
                                    <span class="badge bg-label-success me-1" title="Telepon"><i class="bx bx-phone me-1"></i>{{ $detail->nilai }}</span>
                                @else
                                    <span class="badge bg-label-secondary me-1" title="{{ ucfirst($detail->tipe) }}">{{ $detail->nilai }}</span>
                                @endif
                            @endforeach
                            @if($kontak->details->isEmpty())
                                -
                            @endif
                        </td>
                        <td>{{ $kontak->created_at ? $kontak->created_at->diffForHumans() : '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Belum ada kontak masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
document.addEventListener("DOMContentLoaded", function() {
    // 1. Chart Distribusi Soal per Tingkat (Donut Chart)
    var tingkatOptions = {
        series: [
            {{ $soalPerTingkat['SD'] }},
            {{ $soalPerTingkat['SMP'] }},
            {{ $soalPerTingkat['SMA'] }}
        ],
        labels: ['SD', 'SMP', 'SMA'],
        chart: {
            type: 'donut',
            height: 300
        },
        colors: ['#696cff', '#03c3ec', '#ff3e1d'], // Sneat palette colors
        stroke: {
            width: 5,
            colors: ['#fff']
        },
        legend: {
            show: true,
            position: 'bottom',
            horizontalAlign: 'center',
            labels: {
                colors: '#566a7f',
                useSeriesColors: false
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function (val, opts) {
                return opts.w.config.series[opts.seriesIndex];
            }
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '70%',
                    labels: {
                        show: true,
                        value: {
                            show: true,
                            fontSize: '18px',
                            fontWeight: '600',
                            color: '#566a7f',
                            offsetY: -5,
                            formatter: function (val) {
                                return val;
                            }
                        },
                        total: {
                            show: true,
                            label: 'Total Soal',
                            fontSize: '13px',
                            color: '#a1acb8',
                            formatter: function (w) {
                                return w.globals.seriesTotals.reduce(function (a, b) {
                                    return a + b;
                                }, 0);
                            }
                        }
                    }
                }
            }
        }
    };
    var tingkatChart = new ApexCharts(document.querySelector("#soalTingkatChart"), tingkatOptions);
    tingkatChart.render();

    // 2. Chart Tingkat Kesulitan Soal (Bar/Column Chart)
    var kesulitanOptions = {
        series: [{
            name: 'Jumlah Soal',
            data: [
                {{ $soalPerKesulitan['Mudah'] }},
                {{ $soalPerKesulitan['Menengah'] }},
                {{ $soalPerKesulitan['Sulit'] }}
            ]
        }],
        chart: {
            type: 'bar',
            height: 300,
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                borderRadius: 5,
                horizontal: false,
                columnWidth: '45%',
                distributed: true
            }
        },
        colors: ['#71dd37', '#ffab00', '#ff3e1d'], // Green, Orange, Red
        dataLabels: {
            enabled: true,
            style: {
                fontSize: '12px',
                colors: ['#fff']
            }
        },
        legend: {
            show: false
        },
        xaxis: {
            categories: ['Mudah', 'Menengah', 'Sulit'],
            labels: {
                style: {
                    colors: '#566a7f',
                    fontSize: '12px'
                }
            },
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: '#566a7f',
                    fontSize: '12px'
                }
            }
        },
        grid: {
            borderColor: '#eceef1',
            strokeDashArray: 5,
            xaxis: {
                lines: {
                    show: false
                }
            }
        }
    };
    var kesulitanChart = new ApexCharts(document.querySelector("#soalKesulitanChart"), kesulitanOptions);
    kesulitanChart.render();
});
</script>
@endpush