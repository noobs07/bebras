@extends('app')

@section('title', $menu->judul ?? $menu->nama_menu)

@section('content')
<section class="w-full px-4 py-8 md:py-12 bg-gradient-to-br from-[#F7FBFF] via-white to-[#EAF4FC] min-h-screen">
    <div class="max-w-6xl mx-auto">

        {{-- Hero Header Section (Inspired by dd_7) --}}
        <header class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[#063B5C] via-[#087E9B] to-[#00CAFF] px-6 py-10 md:px-12 md:py-14 text-center shadow-xl">
            {{-- Decorative Bubble Elements from dd_7 --}}
            <div class="absolute -right-16 -top-20 h-56 w-56 rounded-full bg-white/10 pointer-events-none"></div>
            <div class="absolute -bottom-28 -left-10 h-64 w-64 rounded-full bg-[#F7C948]/25 pointer-events-none"></div>

            <div class="relative z-10 max-w-3xl mx-auto space-y-3">
                <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-md border border-white/20 px-4 py-1 rounded-full">
                    <i class="fa-solid fa-trophy text-xs text-[#F7C948]"></i>
                    <span class="text-xs font-bold uppercase tracking-[0.2em] text-cyan-100">Bebras Challenge</span>
                </div>

                <h1 class="text-3xl md:text-5xl font-extrabold leading-tight text-white drop-shadow-sm">
                    {{ $menu->judul ?? $menu->nama_menu }}
                </h1>

                @if($menu->body)
                    <div class="text-sky-50 text-sm md:text-base prose prose-invert tiny-content max-w-none leading-relaxed pt-2">
                        {!! $menu->body !!}
                    </div>
                @endif
            </div>
        </header>

        {{-- Main Content Section --}}
        <div class="mt-8">
            @if($menu->kegiatans->isNotEmpty())
                <div class="space-y-8">
                    @foreach($menu->kegiatans as $index => $kegiatan)
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

                        <div class="bg-white rounded-2xl border border-cyan-100 shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">
                            {{-- Top Accent Line --}}
                            <div class="h-1.5 bg-gradient-to-r from-[#063B5C] via-[#087E9B] to-[#F7C948]"></div>

                            {{-- Banner Image Section --}}
                            @if($gambarUrl)
                                <div class="w-full bg-slate-50 p-4 md:p-6 flex justify-center items-center border-b border-cyan-100/70 overflow-hidden group">
                                    <img src="{{ $gambarUrl }}"
                                         alt="{{ $kegiatan->judul }}"
                                         class="max-w-full h-auto max-h-[440px] object-contain rounded-xl shadow-xs transition-transform duration-300 group-hover:scale-[1.005]">
                                </div>
                            @endif

                            <div class="p-6 md:p-10">
                                {{-- Card Header & Metadata --}}
                                <div class="flex flex-wrap items-center justify-between gap-3 mb-6 pb-4 border-b border-cyan-100">
                                    @if($kegiatan->kota || $tglFormatted || $kegiatan->speaker)
                                        <div class="flex flex-wrap items-center gap-2">
                                            @if($kegiatan->kota)
                                                <span class="inline-flex items-center gap-1.5 font-semibold text-xs md:text-sm text-[#087E9B] bg-[#E6F7FF] px-3.5 py-1.5 rounded-full border border-sky-200/80">
                                                    <i class="fa-solid fa-location-dot text-xs text-[#087E9B]"></i>
                                                    {{ $kegiatan->kota }}
                                                </span>
                                            @endif
                                            @if($tglFormatted)
                                                <span class="inline-flex items-center gap-1.5 font-medium text-xs md:text-sm text-slate-700 bg-sky-50/70 px-3.5 py-1.5 rounded-full border border-sky-100">
                                                    <i class="fa-regular fa-calendar-days text-xs text-sky-600"></i>
                                                    {{ $tglFormatted }}
                                                </span>
                                            @endif
                                            @if($kegiatan->speaker)
                                                <span class="inline-flex items-center gap-1.5 font-medium text-xs md:text-sm text-slate-700 bg-slate-50 px-3.5 py-1.5 rounded-full border border-slate-200/80">
                                                    <i class="fa-solid fa-user-tie text-xs text-slate-500"></i>
                                                    {{ $kegiatan->speaker }}
                                                </span>
                                            @endif
                                        </div>
                                    @else
                                        <div></div>
                                    @endif

                                    <span class="text-xs font-bold text-[#087E9B] bg-[#E6F7FF] px-3 py-1 rounded-full border border-cyan-200">
                                        Kegiatan #{{ $index + 1 }}
                                    </span>
                                </div>

                                {{-- Judul Kegiatan --}}
                                <h2 class="text-2xl md:text-3xl font-extrabold text-slate-800 leading-snug mb-4">
                                    {{ $kegiatan->judul }}
                                </h2>

                                {{-- Content --}}
                                <div class="prose tiny-content max-w-none text-slate-600 leading-relaxed text-base md:text-lg">
                                    {!! $kegiatan->deskripsi !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Empty State --}}
                <div class="bg-white rounded-2xl p-12 text-center border border-cyan-100 shadow-sm max-w-2xl mx-auto">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-[#E6F7FF] flex items-center justify-center text-[#087E9B]">
                        <i class="fa-regular fa-folder-open text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800">Belum Ada Konten Tantangan</h3>
                    <p class="text-sm text-slate-500 mt-1">Informasi kegiatan Bebras Challenge akan ditampilkan di halaman ini.</p>
                </div>
            @endif
        </div>

    </div>
</section>
@endsection
