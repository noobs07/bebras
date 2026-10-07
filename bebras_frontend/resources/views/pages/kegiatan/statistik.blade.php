@extends('app')

@section('title', 'Statistik Bebras Indonesia Challenge')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">

    {{-- Page Header --}}
    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-10 mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between border-b pb-6 mb-2">
            <div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight mb-1">
                    Statistik Bebras Indonesia Challenge
                </h1>
                <p class="text-gray-500 text-sm md:text-base">Rekapitulasi data peserta, sekolah, dan biro per tahun</p>
            </div>
            <img src="{{ asset('img/logo.jpg') }}" alt="Bebras Indonesia" class="w-16 h-16 mx-auto md:mx-0 mt-4 md:mt-0 rounded-md object-cover">
        </div>
    </div>

    {{-- ─────────────────────────────────────────── --}}
    {{-- PART A — Tabel Data (Task 11.1)             --}}
    {{-- ─────────────────────────────────────────── --}}
    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-10 mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
            <div class="h-1 w-10 bg-secondary rounded"></div>
            Tabel Rekapitulasi Data
        </h2>

        @if($statistik->isEmpty())
            <p class="text-center text-gray-500 py-12 text-base">Data statistik belum tersedia.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="bg-[#083944] text-white">
                            <th class="px-4 py-3 text-left font-semibold whitespace-nowrap">Tahun</th>
                            <th class="px-4 py-3 text-right font-semibold whitespace-nowrap">Si Kecil</th>
                            <th class="px-4 py-3 text-right font-semibold whitespace-nowrap">Siaga</th>
                            <th class="px-4 py-3 text-right font-semibold whitespace-nowrap">Penggalang</th>
                            <th class="px-4 py-3 text-right font-semibold whitespace-nowrap">Penegak</th>
                            <th class="px-4 py-3 text-right font-semibold whitespace-nowrap bg-[#00CAFF] text-[#083944]">Total</th>
                            <th class="px-4 py-3 text-right font-semibold whitespace-nowrap">Pria</th>
                            <th class="px-4 py-3 text-right font-semibold whitespace-nowrap">Wanita</th>
                            <th class="px-4 py-3 text-right font-semibold whitespace-nowrap">Sekolah</th>
                            <th class="px-4 py-3 text-right font-semibold whitespace-nowrap">Biro</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($statistik as $row)
                            @php
                                $total = ($row->si_kecil ?? 0) + ($row->siaga ?? 0)
                                       + ($row->penggalang ?? 0) + ($row->penegak ?? 0);
                            @endphp
                            <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-blue-50 transition-colors duration-150">
                                <td class="px-4 py-3 font-semibold text-[#083944] whitespace-nowrap">{{ $row->year }}</td>
                                <td class="px-4 py-3 text-right text-gray-700 whitespace-nowrap">{{ $row->si_kecil !== null ? number_format($row->si_kecil) : '-' }}</td>
                                <td class="px-4 py-3 text-right text-gray-700 whitespace-nowrap">{{ $row->siaga !== null ? number_format($row->siaga) : '-' }}</td>
                                <td class="px-4 py-3 text-right text-gray-700 whitespace-nowrap">{{ $row->penggalang !== null ? number_format($row->penggalang) : '-' }}</td>
                                <td class="px-4 py-3 text-right text-gray-700 whitespace-nowrap">{{ $row->penegak !== null ? number_format($row->penegak) : '-' }}</td>
                                <td class="px-4 py-3 text-right font-bold text-[#083944] whitespace-nowrap bg-blue-50">{{ $total > 0 ? number_format($total) : '-' }}</td>
                                <td class="px-4 py-3 text-right text-gray-700 whitespace-nowrap">{{ $row->pria !== null ? number_format($row->pria) : '-' }}</td>
                                <td class="px-4 py-3 text-right text-gray-700 whitespace-nowrap">{{ $row->wanita !== null ? number_format($row->wanita) : '-' }}</td>
                                <td class="px-4 py-3 text-right text-gray-700 whitespace-nowrap">{{ $row->sekolah !== null ? number_format($row->sekolah) : '-' }}</td>
                                <td class="px-4 py-3 text-right text-gray-700 whitespace-nowrap">{{ $row->biro !== null ? number_format($row->biro) : '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- ─────────────────────────────────────────── --}}
    {{-- PART B-D — 9 Grafik Chart.js               --}}
    {{-- ─────────────────────────────────────────── --}}
    @if($statistik->isNotEmpty())
    <div class="mb-4">
        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            <div class="h-1 w-10 bg-secondary rounded"></div>
            Grafik Statistik Peserta
        </h2>

        {{-- Grid: 4 bar kategori (Tasks 12.2) --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

            {{-- Grafik 1: Si Kecil --}}
            <div class="bg-white rounded-2xl shadow-xl p-6">
                <h3 class="text-base font-semibold text-gray-700 mb-4">Kategori Si Kecil (~Kelas 3 SD/MI)</h3>
                <div class="chart-wrapper">
                    <canvas id="chart-si-kecil" style="max-height: 350px;"></canvas>
                </div>
            </div>

            {{-- Grafik 2: Siaga --}}
            <div class="bg-white rounded-2xl shadow-xl p-6">
                <h3 class="text-base font-semibold text-gray-700 mb-4">Kategori Siaga (Kelas 4~6 SD/MI)</h3>
                <div class="chart-wrapper">
                    <canvas id="chart-siaga" style="max-height: 350px;"></canvas>
                </div>
            </div>

            {{-- Grafik 3: Penggalang --}}
            <div class="bg-white rounded-2xl shadow-xl p-6">
                <h3 class="text-base font-semibold text-gray-700 mb-4">Kategori Penggalang (SMP/MTs)</h3>
                <div class="chart-wrapper">
                    <canvas id="chart-penggalang" style="max-height: 350px;"></canvas>
                </div>
            </div>

            {{-- Grafik 4: Penegak --}}
            <div class="bg-white rounded-2xl shadow-xl p-6">
                <h3 class="text-base font-semibold text-gray-700 mb-4">Kategori Penegak (SMA/MA/SMK)</h3>
                <div class="chart-wrapper">
                    <canvas id="chart-penegak" style="max-height: 350px;"></canvas>
                </div>
            </div>
        </div>

        {{-- Grafik 5: Total Peserta — full width (Task 12.3) --}}
        <div class="bg-white rounded-2xl shadow-xl p-6 mb-6">
            <h3 class="text-base font-semibold text-gray-700 mb-4">Peserta Bebras Indonesia Challenge (Per Tahun)</h3>
            <div class="chart-wrapper">
                <canvas id="chart-total" style="max-height: 350px;"></canvas>
            </div>
        </div>

        {{-- Grafik 6 & 7: Pie charts side by side (Task 12.4) --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

            {{-- Grafik 6: Pie Kategori --}}
            <div class="bg-white rounded-2xl shadow-xl p-6">
                <h3 class="text-base font-semibold text-gray-700 mb-4">Persentase Kategori Peserta</h3>
                <div class="chart-wrapper flex items-center justify-center">
                    <canvas id="chart-pie-kategori" style="max-height: 350px;"></canvas>
                </div>
            </div>

            {{-- Grafik 7: Pie Gender --}}
            <div class="bg-white rounded-2xl shadow-xl p-6">
                <h3 class="text-base font-semibold text-gray-700 mb-4">Rasio Jenis Kelamin Peserta</h3>
                <div class="chart-wrapper flex items-center justify-center">
                    <canvas id="chart-pie-gender" style="max-height: 350px;"></canvas>
                </div>
            </div>
        </div>

        {{-- Grafik 8 & 9: Sekolah dan Biro (Task 12.3) --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Grafik 8: Sekolah --}}
            <div class="bg-white rounded-2xl shadow-xl p-6">
                <h3 class="text-base font-semibold text-gray-700 mb-4">Jumlah Sekolah (Per Tahun)</h3>
                <div class="chart-wrapper">
                    <canvas id="chart-sekolah" style="max-height: 350px;"></canvas>
                </div>
            </div>

            {{-- Grafik 9: Biro --}}
            <div class="bg-white rounded-2xl shadow-xl p-6">
                <h3 class="text-base font-semibold text-gray-700 mb-4">Jumlah Biro (Per Tahun)</h3>
                <div class="chart-wrapper">
                    <canvas id="chart-biro" style="max-height: 350px;"></canvas>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>
@endsection

@push('scripts')
{{-- ─────────────────────────────────────────────────── --}}
{{-- Task 12.1 — Chart.js CDN + PHP @json() data prep   --}}
{{-- ─────────────────────────────────────────────────── --}}
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

    // Accumulated totals for pie charts
    $siKecilAcc    = (int) $statistik->sum('si_kecil');
    $siagaAcc      = (int) $statistik->sum('siaga');
    $penggalangAcc = (int) $statistik->sum('penggalang');
    $penegakAcc    = (int) $statistik->sum('penegak');
    $priaAcc       = (int) $statistik->sum('pria');
    $wanitaAcc     = (int) $statistik->sum('wanita');
@endphp

<script>
    // ── Shared data (Task 12.1) ───────────────────────────────────
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

    // Accumulated values for pie charts
    const siKecilAcc    = {{ $siKecilAcc }};
    const siagaAcc      = {{ $siagaAcc }};
    const penggalangAcc = {{ $penggalangAcc }};
    const penegakAcc    = {{ $penegakAcc }};
    const priaAcc       = {{ $priaAcc }};
    const wanitaAcc     = {{ $wanitaAcc }};

    // ── Helper: build a standard bar chart config ─────────────────
    function barConfig(dataArr, yLabel) {
        return {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: yLabel,
                    data: dataArr,
                    backgroundColor: 'rgba(8, 57, 68, 0.8)',
                    borderColor: 'rgba(8, 57, 68, 1)',
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: { title: { display: true, text: 'Tahun' } },
                    y: { title: { display: true, text: 'Jumlah' }, beginAtZero: true }
                }
            }
        };
    }

    // ── Task 12.2 — 4 bar charts (kategori per tahun) ────────────
    new Chart(document.getElementById('chart-si-kecil'),    barConfig(siKecilData,    'Jumlah Peserta'));
    new Chart(document.getElementById('chart-siaga'),       barConfig(siagaData,      'Jumlah Peserta'));
    new Chart(document.getElementById('chart-penggalang'),  barConfig(penggalangData, 'Jumlah Peserta'));
    new Chart(document.getElementById('chart-penegak'),     barConfig(penegakData,    'Jumlah Peserta'));

    // ── Task 12.3 — 3 bar charts (total, sekolah, biro) ──────────
    new Chart(document.getElementById('chart-total'),   barConfig(totalData,   'Jumlah Peserta'));
    new Chart(document.getElementById('chart-sekolah'), barConfig(sekolahData, 'Jumlah Sekolah'));
    new Chart(document.getElementById('chart-biro'),    barConfig(biroData,    'Jumlah Biro'));

    // ── Task 12.4 — 2 pie charts (kategori & gender) ─────────────

    // Pie 1: Persentase Kategori
    const totalKategori = siKecilAcc + siagaAcc + penggalangAcc + penegakAcc;
    if (totalKategori > 0) {
        new Chart(document.getElementById('chart-pie-kategori'), {
            type: 'pie',
            data: {
                labels: ['Si Kecil', 'Siaga', 'Penggalang', 'Penegak'],
                datasets: [{
                    data: [siKecilAcc, siagaAcc, penggalangAcc, penegakAcc],
                    backgroundColor: ['#083944', '#00CAFF', '#0099CC', '#E6F7FF'],
                    borderColor: ['#ffffff', '#ffffff', '#ffffff', '#ffffff'],
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' },
                    tooltip: {
                        callbacks: {
                            label: function(c) {
                                const total = c.dataset.data.reduce(function(a, b) { return a + b; }, 0);
                                const pct   = total > 0 ? (c.parsed / total * 100).toFixed(1) : 0;
                                return c.label + ': ' + c.parsed.toLocaleString('id-ID') + ' (' + pct + '%)';
                            }
                        }
                    }
                }
            }
        });
    } else {
        document.getElementById('chart-pie-kategori').closest('.chart-wrapper').innerHTML =
            '<p class="text-center text-gray-400 py-8">Data belum tersedia.</p>';
    }

    // Pie 2: Rasio Jenis Kelamin
    const totalGender = priaAcc + wanitaAcc;
    if (totalGender > 0) {
        new Chart(document.getElementById('chart-pie-gender'), {
            type: 'pie',
            data: {
                labels: ['Pria', 'Wanita'],
                datasets: [{
                    data: [priaAcc, wanitaAcc],
                    backgroundColor: ['#083944', '#00CAFF'],
                    borderColor: ['#ffffff', '#ffffff'],
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' },
                    tooltip: {
                        callbacks: {
                            label: function(c) {
                                const total = c.dataset.data.reduce(function(a, b) { return a + b; }, 0);
                                const pct   = total > 0 ? (c.parsed / total * 100).toFixed(1) : 0;
                                return c.label + ': ' + c.parsed.toLocaleString('id-ID') + ' (' + pct + '%)';
                            }
                        }
                    }
                }
            }
        });
    } else {
        document.getElementById('chart-pie-gender').closest('.chart-wrapper').innerHTML =
            '<p class="text-center text-gray-400 py-8">Data belum tersedia.</p>';
    }
</script>
@endif
@endpush
