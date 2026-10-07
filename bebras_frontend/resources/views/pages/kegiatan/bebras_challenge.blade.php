@extends('app')

@section('title', $menu->judul ?? $menu->nama_menu)

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-10">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between border-b pb-6 mb-8 gap-4">
            <div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">
                    {{ $menu->judul ?? $menu->nama_menu }}
                </h1>
                @if($menu->body)
                    <div class="text-gray-600 mt-3 prose tiny-content max-w-none">
                        {!! $menu->body !!}
                    </div>
                @endif
            </div>
            @if($menu->gambar)
                <img src="{{ (strpos($menu->gambar, 'img/') === 0) ? asset($menu->gambar) : asset('storage/' . $menu->gambar) }}"
                     alt="{{ $menu->nama_menu }}"
                     class="w-20 h-20 object-contain mx-auto md:mx-0 shrink-0 rounded-lg">
            @else
                <img src="{{ asset('img/done.png') }}" alt="Bebras"
                     class="w-16 h-16 mx-auto md:mx-0 shrink-0">
            @endif
        </div>

        {{-- Kegiatan Cards --}}
        @if($menu->kegiatans->isNotEmpty())
            <div class="space-y-10">
                @foreach($menu->kegiatans as $kegiatan)
                    @php
                        $gambarUrl = null;
                        if ($kegiatan->gambar) {
                            $gambarUrl = str_starts_with($kegiatan->gambar, 'img/')
                                ? asset($kegiatan->gambar)
                                : asset('storage/' . $kegiatan->gambar);
                        }

                        $tglFormatted = null;
                        if ($kegiatan->tanggal_lokasi) {
                            try {
                                $tglFormatted = \Carbon\Carbon::parse($kegiatan->tanggal_lokasi)->translatedFormat('d F Y');
                            } catch (\Exception $e) {
                                $tglFormatted = $kegiatan->tanggal_lokasi;
                            }
                        }
                    @endphp

                    <div class="bg-gray-50/60 rounded-2xl shadow-sm hover:shadow-md transition duration-300 overflow-hidden border border-gray-200/80">

                        {{-- Tampilan Banner (Lebar menyesuaikan panjang/dimensi img yang diupload) --}}
                        @if($gambarUrl)
                            <div class="w-full bg-slate-100/70 p-4 md:p-6 flex justify-center items-center border-b border-gray-200/60 overflow-hidden">
                                <img src="{{ $gambarUrl }}"
                                     alt="{{ $kegiatan->judul }}"
                                     class="max-w-full h-auto object-contain rounded-xl shadow-sm transition-transform duration-300 hover:scale-[1.01]">
                            </div>
                        @endif

                        <div class="p-6 md:p-8">
                            {{-- Metadata opsional (Kota, Tanggal, Speaker) --}}
                            @if($kegiatan->kota || $tglFormatted || $kegiatan->speaker)
                                <div class="flex flex-wrap items-center gap-3 text-xs md:text-sm text-gray-600 mb-4 pb-3 border-b border-gray-200/60">
                                    @if($kegiatan->kota)
                                        <span class="font-semibold text-bebrasDarkBlue bg-bebrasLightBlue px-3 py-1 rounded-full border border-sky-200">
                                            📍 {{ $kegiatan->kota }}
                                        </span>
                                    @endif
                                    @if($tglFormatted)
                                        <span class="font-medium flex items-center gap-1 text-gray-600 bg-white px-3 py-1 rounded-full border border-gray-200">
                                            📅 {{ $tglFormatted }}
                                        </span>
                                    @endif
                                    @if($kegiatan->speaker)
                                        <span class="font-medium flex items-center gap-1 text-gray-700 bg-white px-3 py-1 rounded-full border border-gray-200">
                                            🎤 {{ $kegiatan->speaker }}
                                        </span>
                                    @endif
                                </div>
                            @endif

                            {{-- Judul --}}
                            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-5 leading-snug">
                                {{ $kegiatan->judul }}
                            </h2>

                            {{-- Deskripsi Rich-Text TinyMCE --}}
                            <div class="prose tiny-content max-w-none text-gray-700 leading-relaxed">
                                {!! $kegiatan->deskripsi !!}
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @else
            {{-- Empty State --}}
            <div class="text-center py-16 text-gray-400">
                <svg class="w-16 h-16 mx-auto mb-4 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <p class="text-lg font-medium">Belum ada konten untuk halaman ini.</p>
                <p class="text-sm mt-1">Tambahkan konten melalui halaman admin.</p>
            </div>
        @endif

    </div>
</div>
@endsection

