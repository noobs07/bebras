@extends('app')

@section('title', 'Statistik Bebras Indonesia Challenge')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    @php
        $latest = $statistik->last();
        $totalPesertaLatest = $latest ? (($latest->si_kecil ?? 0) + ($latest->siaga ?? 0) + ($latest->penggalang ?? 0) + ($latest->penegak ?? 0)) : 0;
        
        $prev = $statistik->count() > 1 ? $statistik->slice(-2, 1)->first() : null;
        $totalPesertaPrev = $prev ? (($prev->si_kecil ?? 0) + ($prev->siaga ?? 0) + ($prev->penggalang ?? 0) + ($prev->penegak ?? 0)) : 0;
        $growthPct = $totalPesertaPrev > 0 ? round((($totalPesertaLatest - $totalPesertaPrev) / $totalPesertaPrev) * 100, 1) : 0;

        $totalSekolahLatest = $latest ? ($latest->sekolah ?? 0) : 0;
        $totalBiroLatest    = $latest ? ($latest->biro ?? 0) : 0;

        $totalKumulatifPeserta = $statistik->sum(function($s) {
            return ($s->si_kecil ?? 0) + ($s->siaga ?? 0) + ($s->penggalang ?? 0) + ($s->penegak ?? 0);
        });
    @endphp

    {{-- ───────────────────────────────────────────────────────────── --}}
    {{-- 1. Hero Header Banner with Gradient Accent                    --}}
    {{-- ───────────────────────────────────────────────────────────── --}}
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#083944] via-[#0b4d5c] to-[#04242b] p-8 md:p-12 mb-10 shadow-2xl text-white">
        {{-- Background decorative shapes --}}
        <div class="absolute -right-12 -top-12 w-64 h-64 rounded-full bg-cyan-400/10 blur-3xl pointer-events-none"></div>
        <div class="absolute right-1/3 -bottom-20 w-80 h-80 rounded-full bg-blue-500/10 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="space-y-3 text-center md:text-left max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-400/20 border border-cyan-400/30 text-cyan-300 text-xs font-semibold uppercase tracking-wider">
                    <i class="fa-solid fa-chart-pie text-cyan-300"></i> Data Rekapitulasi Nasional
                </div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight text-white leading-tight">
                    Statistik <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#00CAFF] to-cyan-200">Bebras Challenge</span>
                </h1>
                <p class="text-gray-300 text-sm sm:text-base leading-relaxed">
                    Gambaran pertumbuhan partisipasi peserta, sekolah, dan biro mitra Bebras Indonesia dalam mengembangkan <span class="text-cyan-300 font-medium">Computational Thinking</span> dari tahun ke tahun.
                </p>
                <div class="pt-2 flex flex-wrap justify-center md:justify-start gap-3">
                    <a href="#tabel-rekapitulasi" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-[#00CAFF] hover:bg-cyan-400 text-[#083944] font-bold text-sm transition-all shadow-lg shadow-cyan-500/20 hover:scale-105">
                        <i class="fa-solid fa-table"></i> Lihat Tabel Data
                    </a>
                    <a href="#grafik-statistik" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-medium text-sm border border-white/20 backdrop-blur-md transition-all hover:scale-105">
                        <i class="fa-solid fa-chart-column"></i> Analisis Grafik
                    </a>
                </div>
            </div>

            <div class="relative flex-shrink-0">
                <div class="w-28 h-28 md:w-36 md:h-36 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 p-3 shadow-inner flex items-center justify-center transform hover:rotate-3 transition-transform duration-300">
                    <img src="{{ asset('img/logo.jpg') }}" alt="Bebras Indonesia Logo" class="w-full h-full object-cover rounded-xl shadow-md">
                </div>
            </div>
        </div>
    </div>

    @if($statistik->isNotEmpty())
    {{-- ───────────────────────────────────────────────────────────── --}}
    {{-- 2. Highlight KPI Summary Metric Cards                         --}}
    {{-- ───────────────────────────────────────────────────────────── --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-10">
        {{-- Card 1: Total Peserta 2024 --}}
        <div class="group relative bg-white rounded-2xl p-6 shadow-md hover:shadow-xl border border-gray-100 transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-[#00CAFF] to-[#083944]"></div>
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Peserta Challenge ({{ $latest->year }})</span>
                <div class="w-10 h-10 rounded-xl bg-cyan-50 text-[#00CAFF] flex items-center justify-center group-hover:bg-[#00CAFF] group-hover:text-white transition-colors">
                    <i class="fa-solid fa-users text-lg"></i>
                </div>
            </div>
            <div class="text-3xl font-extrabold text-[#083944] tracking-tight">
                {{ number_format($totalPesertaLatest) }}
            </div>
            <div class="mt-2 flex items-center text-xs font-medium {{ $growthPct >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                <i class="fa-solid {{ $growthPct >= 0 ? 'fa-arrow-trend-up' : 'fa-arrow-trend-down' }} me-1.5"></i>
                <span>{{ $growthPct >= 0 ? '+'.$growthPct : $growthPct }}% dari tahun sebelumnya</span>
            </div>
        </div>

        {{-- Card 2: Total Sekolah --}}
        <div class="group relative bg-white rounded-2xl p-6 shadow-md hover:shadow-xl border border-gray-100 transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-emerald-400 to-teal-600"></div>
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Sekolah Terdaftar</span>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                    <i class="fa-solid fa-school text-lg"></i>
                </div>
            </div>
            <div class="text-3xl font-extrabold text-gray-900 tracking-tight">
                {{ number_format($totalSekolahLatest) }}
            </div>
            <div class="mt-2 text-xs font-medium text-gray-500">
                Tersebar di seluruh biro Indonesia
            </div>
        </div>

        {{-- Card 3: Total Biro --}}
        <div class="group relative bg-white rounded-2xl p-6 shadow-md hover:shadow-xl border border-gray-100 transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-amber-400 to-amber-600"></div>
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Biro Bebras Mitra</span>
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center group-hover:bg-amber-600 group-hover:text-white transition-colors">
                    <i class="fa-solid fa-building-columns text-lg"></i>
                </div>
            </div>
            <div class="text-3xl font-extrabold text-gray-900 tracking-tight">
                {{ number_format($totalBiroLatest) }}
            </div>
            <div class="mt-2 text-xs font-medium text-gray-500">
                Perguruan Tinggi Pelaksana
            </div>
        </div>

        {{-- Card 4: Total Partisipasi Kumulatif --}}
        <div class="group relative bg-white rounded-2xl p-6 shadow-md hover:shadow-xl border border-gray-100 transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-indigo-500 to-purple-600"></div>
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Kumulatif Partisipasi</span>
                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                    <i class="fa-solid fa-award text-lg"></i>
                </div>
            </div>
            <div class="text-3xl font-extrabold text-gray-900 tracking-tight">
                {{ number_format($totalKumulatifPeserta) }}
            </div>
            <div class="mt-2 text-xs font-medium text-gray-500">
                Akumulasi peserta sejak 2016
            </div>
        </div>
    </div>

    {{-- ───────────────────────────────────────────────────────────── --}}
    {{-- 3. Modern Rekapitulasi Data Table                              --}}
    {{-- ───────────────────────────────────────────────────────────── --}}
    <div id="tabel-rekapitulasi" class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden mb-12">
        <div class="p-6 md:p-8 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl md:text-2xl font-bold text-[#083944] flex items-center gap-2">
                    <span class="w-2.5 h-6 bg-[#00CAFF] rounded-full"></span>
                    Tabel Rekapitulasi Data Nasional
                </h2>
                <p class="text-gray-500 text-xs sm:text-sm mt-1">Rincian partisipasi berdasarkan jenjang pendidikan, jenis kelamin, serta keikutsertaan institusi per tahun.</p>
            </div>
            <div class="flex items-center gap-2 text-xs font-medium text-gray-500 bg-gray-50 px-3 py-1.5 rounded-lg border border-gray-200 self-start sm:self-auto">
                <i class="fa-solid fa-circle-info text-[#00CAFF]"></i> {{ $statistik->count() }} Tahun Terdata (2016–{{ $latest->year }})
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="bg-gradient-to-r from-[#083944] to-[#0d505f] text-white text-xs uppercase tracking-wider font-bold">
                        <th class="px-5 py-4 whitespace-nowrap">Tahun</th>
                        <th class="px-5 py-4 text-right whitespace-nowrap">
                            <span class="inline-block px-2 py-0.5 rounded bg-amber-500/20 text-amber-300 me-1">~3 SD</span> Si Kecil
                        </th>
                        <th class="px-5 py-4 text-right whitespace-nowrap">
                            <span class="inline-block px-2 py-0.5 rounded bg-pink-500/20 text-pink-300 me-1">4~6 SD</span> Siaga
                        </th>
                        <th class="px-5 py-4 text-right whitespace-nowrap">
                            <span class="inline-block px-2 py-0.5 rounded bg-cyan-500/20 text-cyan-300 me-1">SMP</span> Penggalang
                        </th>
                        <th class="px-5 py-4 text-right whitespace-nowrap">
                            <span class="inline-block px-2 py-0.5 rounded bg-indigo-500/20 text-indigo-300 me-1">SMA</span> Penegak
                        </th>
                        <th class="px-5 py-4 text-right whitespace-nowrap bg-[#00CAFF] text-[#083944] font-black">
                            Total Peserta
                        </th>
                        <th class="px-5 py-4 text-right whitespace-nowrap">Pria</th>
                        <th class="px-5 py-4 text-right whitespace-nowrap">Wanita</th>
                        <th class="px-5 py-4 text-right whitespace-nowrap">Sekolah</th>
                        <th class="px-5 py-4 text-right whitespace-nowrap">Biro</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($statistik as $row)
                        @php
                            $totalRow = ($row->si_kecil ?? 0) + ($row->siaga ?? 0)
                                      + ($row->penggalang ?? 0) + ($row->penegak ?? 0);
                        @endphp
                        <tr class="hover:bg-cyan-50/50 transition-colors duration-200 {{ $loop->even ? 'bg-gray-50/40' : '' }}">
                            <td class="px-5 py-4 font-bold text-[#083944] whitespace-nowrap flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#00CAFF]"></span>
                                {{ $row->year }}
                            </td>
                            <td class="px-5 py-4 text-right text-gray-700 whitespace-nowrap font-medium">
                                {{ $row->si_kecil !== null ? number_format($row->si_kecil) : '-' }}
                            </td>
                            <td class="px-5 py-4 text-right text-gray-700 whitespace-nowrap font-medium">
                                {{ $row->siaga !== null ? number_format($row->siaga) : '-' }}
                            </td>
                            <td class="px-5 py-4 text-right text-gray-700 whitespace-nowrap font-medium">
                                {{ $row->penggalang !== null ? number_format($row->penggalang) : '-' }}
                            </td>
                            <td class="px-5 py-4 text-right text-gray-700 whitespace-nowrap font-medium">
                                {{ $row->penegak !== null ? number_format($row->penegak) : '-' }}
                            </td>
                            <td class="px-5 py-4 text-right font-black text-[#083944] bg-cyan-50/70 whitespace-nowrap">
                                {{ $totalRow > 0 ? number_format($totalRow) : '-' }}
                            </td>
                            <td class="px-5 py-4 text-right text-gray-600 whitespace-nowrap">
                                {{ $row->pria !== null ? number_format($row->pria) : '-' }}
                            </td>
                            <td class="px-5 py-4 text-right text-gray-600 whitespace-nowrap">
                                {{ $row->wanita !== null ? number_format($row->wanita) : '-' }}
                            </td>
                            <td class="px-5 py-4 text-right text-gray-600 whitespace-nowrap">
                                {{ $row->sekolah !== null ? number_format($row->sekolah) : '-' }}
                            </td>
                            <td class="px-5 py-4 text-right text-gray-600 whitespace-nowrap">
                                {{ $row->biro !== null ? number_format($row->biro) : '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-gray-100/80 font-bold text-[#083944] border-t-2 border-gray-200">
                        <td class="px-5 py-4">Total Akumulasi</td>
                        <td class="px-5 py-4 text-right">{{ number_format($statistik->sum('si_kecil')) }}</td>
                        <td class="px-5 py-4 text-right">{{ number_format($statistik->sum('siaga')) }}</td>
                        <td class="px-5 py-4 text-right">{{ number_format($statistik->sum('penggalang')) }}</td>
                        <td class="px-5 py-4 text-right">{{ number_format($statistik->sum('penegak')) }}</td>
                        <td class="px-5 py-4 text-right text-[#083944] bg-cyan-200/50 font-black">{{ number_format($totalKumulatifPeserta) }}</td>
                        <td class="px-5 py-4 text-right">{{ number_format($statistik->sum('pria')) }}</td>
                        <td class="px-5 py-4 text-right">{{ number_format($statistik->sum('wanita')) }}</td>
                        <td class="px-5 py-4 text-right">-</td>
                        <td class="px-5 py-4 text-right">-</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {{-- ───────────────────────────────────────────────────────────── --}}
    {{-- 4. Grafik & Chart Visualizations                              --}}
    {{-- ───────────────────────────────────────────────────────────── --}}
    <div id="grafik-statistik" class="space-y-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl md:text-2xl font-bold text-[#083944] flex items-center gap-2">
                    <span class="w-2.5 h-6 bg-[#00CAFF] rounded-full"></span>
                    Grafik & Visualisasi Tren
                </h2>
                <p class="text-gray-500 text-xs sm:text-sm mt-1">Analisis visual perkembangan jumlah peserta, kategori, gender, serta jangkauan lembaga.</p>
            </div>
        </div>

        {{-- Grafik Utama: Total Pertumbuhan Peserta (Line Chart smooth dengan Gradient) --}}
        <div class="bg-white rounded-3xl p-6 md:p-8 shadow-xl border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Tren Pertumbuhan Total Peserta (Per Tahun)</h3>
                    <p class="text-gray-500 text-xs">Total partisipasi seluruh kategori Bebras Challenge</p>
                </div>
                <span class="px-3 py-1 rounded-full bg-cyan-50 text-[#083944] text-xs font-semibold">2016 - {{ $latest->year }}</span>
            </div>
            <div class="relative w-full" style="height: 380px;">
                <canvas id="chart-total-smooth"></canvas>
            </div>
        </div>

        {{-- Grid 4 Kategori Peserta (2x2) --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Si Kecil --}}
            <div class="bg-white rounded-3xl p-6 shadow-xl border border-gray-100 hover:shadow-2xl transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                        <h3 class="text-base font-bold text-gray-800">Kategori Si Kecil (~Kelas 3 SD/MI)</h3>
                    </div>
                </div>
                <div class="relative w-full" style="height: 280px;">
                    <canvas id="chart-si-kecil"></canvas>
                </div>
            </div>

            {{-- Siaga --}}
            <div class="bg-white rounded-3xl p-6 shadow-xl border border-gray-100 hover:shadow-2xl transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-pink-500"></span>
                        <h3 class="text-base font-bold text-gray-800">Kategori Siaga (Kelas 4~6 SD/MI)</h3>
                    </div>
                </div>
                <div class="relative w-full" style="height: 280px;">
                    <canvas id="chart-siaga"></canvas>
                </div>
            </div>

            {{-- Penggalang --}}
            <div class="bg-white rounded-3xl p-6 shadow-xl border border-gray-100 hover:shadow-2xl transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-cyan-500"></span>
                        <h3 class="text-base font-bold text-gray-800">Kategori Penggalang (SMP/MTs)</h3>
                    </div>
                </div>
                <div class="relative w-full" style="height: 280px;">
                    <canvas id="chart-penggalang"></canvas>
                </div>
            </div>

            {{-- Penegak --}}
            <div class="bg-white rounded-3xl p-6 shadow-xl border border-gray-100 hover:shadow-2xl transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-indigo-500"></span>
                        <h3 class="text-base font-bold text-gray-800">Kategori Penegak (SMA/MA/SMK)</h3>
                    </div>
                </div>
                <div class="relative w-full" style="height: 280px;">
                    <canvas id="chart-penegak"></canvas>
                </div>
            </div>
        </div>

        {{-- Donut Charts: Persentase Kategori & Rasio Gender --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Pie Kategori --}}
            <div class="bg-white rounded-3xl p-6 shadow-xl border border-gray-100">
                <h3 class="text-base font-bold text-gray-800 mb-1">Proporsi Kategori Peserta (Akumulasi)</h3>
                <p class="text-gray-400 text-xs mb-4">Perbandingan persentase antar jenjang sekolah</p>
                <div class="relative flex items-center justify-center" style="height: 300px;">
                    <canvas id="chart-pie-kategori"></canvas>
                </div>
            </div>

            {{-- Pie Gender --}}
            <div class="bg-white rounded-3xl p-6 shadow-xl border border-gray-100">
                <h3 class="text-base font-bold text-gray-800 mb-1">Rasio Jenis Kelamin (Akumulasi)</h3>
                <p class="text-gray-400 text-xs mb-4">Perbandingan jumlah peserta Pria vs Wanita</p>
                <div class="relative flex items-center justify-center" style="height: 300px;">
                    <canvas id="chart-pie-gender"></canvas>
                </div>
            </div>
        </div>

        {{-- Sekolah & Biro --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-3xl p-6 shadow-xl border border-gray-100">
                <h3 class="text-base font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-school text-emerald-500"></i> Partisipasi Sekolah (Per Tahun)
                </h3>
                <div class="relative w-full" style="height: 280px;">
                    <canvas id="chart-sekolah"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 shadow-xl border border-gray-100">
                <h3 class="text-base font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-building-columns text-amber-500"></i> Pertumbuhan Biro Bebras (Per Tahun)
                </h3>
                <div class="relative w-full" style="height: 280px;">
                    <canvas id="chart-biro"></canvas>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="bg-white rounded-3xl p-12 text-center shadow-lg border border-gray-100 my-8">
        <i class="fa-solid fa-chart-line text-5xl text-gray-300 mb-4"></i>
        <h3 class="text-lg font-bold text-gray-700">Data Statistik Belum Tersedia</h3>
        <p class="text-gray-500 text-sm mt-1">Silakan masukkan data melalui panel admin untuk melihat rekapitulasi dan grafik statistik.</p>
    </div>
    @endif

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@if($statistik->isNotEmpty())
@php
    $labels         = $statistik->pluck('year');
    $siKecilData    = $statistik->map(fn($s) => $s->si_kecil   ?? 0)->values();
    $siagaData      = $statistik->map(fn($s) => $s->siaga      ?? 0)->values();
    $penggalangData = $statistik->map(fn($s) => $s->penggalang ?? 0)->values();
    $penegakData    = $statistik->map(fn($s) => $s->penegak    ?? 0)->values();
    $totalData      = $statistik->map(fn($s) => ($s->si_kecil ?? 0) + ($s->siaga ?? 0) + ($s->penggalang ?? 0) + ($s->penegak ?? 0))->values();
    $priaData       = $statistik->map(fn($s) => $s->pria    ?? 0)->values();
    $wanitaData     = $statistik->map(fn($s) => $s->wanita  ?? 0)->values();
    $sekolahData    = $statistik->map(fn($s) => $s->sekolah ?? 0)->values();
    $biroData       = $statistik->map(fn($s) => $s->biro    ?? 0)->values();

    $siKecilAcc    = (int) $statistik->sum('si_kecil');
    $siagaAcc      = (int) $statistik->sum('siaga');
    $penggalangAcc = (int) $statistik->sum('penggalang');
    $penegakAcc    = (int) $statistik->sum('penegak');
    $priaAcc       = (int) $statistik->sum('pria');
    $wanitaAcc     = (int) $statistik->sum('wanita');
@endphp

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const labels         = @json($labels);
        const siKecilData    = @json($siKecilData);
        const siagaData      = @json($siagaData);
        const penggalangData = @json($penggalangData);
        const penegakData    = @json($penegakData);
        const totalData      = @json($totalData);
        const priaData       = @json($priaData);
        const wanitaData     = @json($wanitaData);
        const sekolahData    = @json($sekolahData);
        const biroData       = @json($biroData);

        const siKecilAcc    = {{ $siKecilAcc }};
        const siagaAcc      = {{ $siagaAcc }};
        const penggalangAcc = {{ $penggalangAcc }};
        const penegakAcc    = {{ $penegakAcc }};
        const priaAcc       = {{ $priaAcc }};
        const wanitaAcc     = {{ $wanitaAcc }};

        // Opsi Global Chart.js
        Chart.defaults.font.family = "'Plus Jakarta Sans', 'Inter', system-ui, -apple-system, sans-serif";
        Chart.defaults.color = "#64748B";

        // Helper untuk membuat gradient bar
        function createGradient(ctx, color1, color2) {
            const gradient = ctx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, color1);
            gradient.addColorStop(1, color2);
            return gradient;
        }

        // 1. Total Smooth Line Chart
        const ctxTotal = document.getElementById('chart-total-smooth').getContext('2d');
        const gradTotal = ctxTotal.createLinearGradient(0, 0, 0, 350);
        gradTotal.addColorStop(0, 'rgba(0, 202, 255, 0.45)');
        gradTotal.addColorStop(1, 'rgba(8, 57, 68, 0.0)');

        new Chart(ctxTotal, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Peserta',
                    data: totalData,
                    borderColor: '#00CAFF',
                    borderWidth: 3.5,
                    backgroundColor: gradTotal,
                    fill: true,
                    tension: 0.35,
                    pointBackgroundColor: '#083944',
                    pointBorderColor: '#00CAFF',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: { duration: 1500, easing: 'easeOutQuart' },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#083944',
                        padding: 12,
                        cornerRadius: 10,
                        callbacks: {
                            label: (c) => ` Total Peserta: ${c.parsed.y.toLocaleString('id-ID')}`
                        }
                    }
                },
                scales: {
                    x: { grid: { display: false } },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: (val) => val >= 1000 ? (val / 1000) + 'k' : val
                        }
                    }
                }
            }
        });

        // Helper Bar Chart Generator
        function makeBarChart(canvasId, dataArr, labelName, colorStart, colorEnd) {
            const canvas = document.getElementById(canvasId);
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            const grad = createGradient(ctx, colorStart, colorEnd);

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: labelName,
                        data: dataArr,
                        backgroundColor: grad,
                        borderRadius: 8,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: { duration: 1200, easing: 'easeOutQuart' },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#083944',
                            padding: 10,
                            cornerRadius: 8,
                            callbacks: {
                                label: (c) => ` ${labelName}: ${c.parsed.y.toLocaleString('id-ID')}`
                            }
                        }
                    },
                    scales: {
                        x: { grid: { display: false } },
                        y: { beginAtZero: true }
                    }
                }
            });
        }

        // 4 Kategori Bar Charts
        makeBarChart('chart-si-kecil',   siKecilData,    'Si Kecil',   '#F59E0B', '#D97706');
        makeBarChart('chart-siaga',      siagaData,      'Siaga',      '#EC4899', '#BE185D');
        makeBarChart('chart-penggalang', penggalangData, 'Penggalang', '#06B6D4', '#0284C7');
        makeBarChart('chart-penegak',    penegakData,    'Penegak',    '#6366F1', '#4338CA');

        // Sekolah & Biro
        makeBarChart('chart-sekolah',    sekolahData,    'Sekolah',    '#10B981', '#047857');
        makeBarChart('chart-biro',       biroData,       'Biro',       '#F59E0B', '#B45309');

        // Pie Kategori (Doughnut Style)
        const totalKategori = siKecilAcc + siagaAcc + penggalangAcc + penegakAcc;
        if (totalKategori > 0) {
            new Chart(document.getElementById('chart-pie-kategori'), {
                type: 'doughnut',
                data: {
                    labels: ['Si Kecil', 'Siaga', 'Penggalang', 'Penegak'],
                    datasets: [{
                        data: [siKecilAcc, siagaAcc, penggalangAcc, penegakAcc],
                        backgroundColor: ['#F59E0B', '#EC4899', '#06B6D4', '#6366F1'],
                        borderWidth: 3,
                        borderColor: '#FFFFFF',
                        hoverOffset: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '68%',
                    plugins: {
                        legend: { position: 'bottom', labels: { padding: 16, usePointStyle: true } },
                        tooltip: {
                            backgroundColor: '#083944',
                            padding: 12,
                            cornerRadius: 8,
                            callbacks: {
                                label: (c) => {
                                    const pct = ((c.parsed / totalKategori) * 100).toFixed(1);
                                    return ` ${c.label}: ${c.parsed.toLocaleString('id-ID')} (${pct}%)`;
                                }
                            }
                        }
                    }
                }
            });
        }

        // Pie Gender (Doughnut Style)
        const totalGender = priaAcc + wanitaAcc;
        if (totalGender > 0) {
            new Chart(document.getElementById('chart-pie-gender'), {
                type: 'doughnut',
                data: {
                    labels: ['Pria', 'Wanita'],
                    datasets: [{
                        data: [priaAcc, wanitaAcc],
                        backgroundColor: ['#083944', '#00CAFF'],
                        borderWidth: 3,
                        borderColor: '#FFFFFF',
                        hoverOffset: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '68%',
                    plugins: {
                        legend: { position: 'bottom', labels: { padding: 16, usePointStyle: true } },
                        tooltip: {
                            backgroundColor: '#083944',
                            padding: 12,
                            cornerRadius: 8,
                            callbacks: {
                                label: (c) => {
                                    const pct = ((c.parsed / totalGender) * 100).toFixed(1);
                                    return ` ${c.label}: ${c.parsed.toLocaleString('id-ID')} (${pct}%)`;
                                }
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endif
@endpush
