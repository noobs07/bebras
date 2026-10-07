@extends('app')

@section('title', $menu->judul ?? $menu->nama_menu)

@section('content')
<section class="w-full px-4 py-8 md:py-12 bg-gradient-to-br from-[#F7FBFF] via-white to-[#EAF4FC] min-h-screen">
    <div class="max-w-6xl mx-auto">

        {{-- Hero Header Section (Inspired by dd_7) --}}
        <header class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[#063B5C] via-[#087E9B] to-[#00CAFF] px-6 py-10 md:px-12 md:py-14 text-center shadow-xl">
            {{-- Decorative Bubble Elements from dd_7 --}}
            <div class="absolute -left-16 -top-20 h-56 w-56 rounded-full bg-white/10 pointer-events-none"></div>
            <div class="absolute -bottom-28 -right-10 h-64 w-64 rounded-full bg-[#F7C948]/25 pointer-events-none"></div>

            <div class="relative z-10 max-w-3xl mx-auto space-y-3">
                <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-md border border-white/20 px-4 py-1 rounded-full">
                    <i class="fa-solid fa-bullhorn text-xs text-[#F7C948]"></i>
                    <span class="text-xs font-bold uppercase tracking-[0.2em] text-cyan-100">Pengumuman Hasil</span>
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
                        @endphp

                        <div class="bg-white rounded-2xl border border-cyan-100 shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">
                            
                            {{-- Header Band --}}
                            <div class="bg-gradient-to-r from-[#063B5C] to-[#087E9B] text-white px-6 py-4 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-file-contract text-sky-200"></i>
                                    <h3 class="font-bold text-sm md:text-base text-white tracking-wide">
                                        Pengumuman #{{ $index + 1 }}
                                    </h3>
                                </div>
                                <span class="text-xs font-semibold bg-white/20 text-white px-3 py-1 rounded-full uppercase tracking-wider">
                                    Hasil Resmi
                                </span>
                            </div>

                            <div class="p-6 md:p-10">
                                {{-- Gambar Preview Opsional --}}
                                @if($gambarUrl)
                                    <div class="overflow-hidden rounded-xl mb-6 bg-[#E6F7FF]/50 p-3 border border-cyan-100 flex justify-center">
                                        <img src="{{ $gambarUrl }}"
                                             alt="{{ $kegiatan->judul }}"
                                             class="max-w-full h-auto max-h-[420px] object-contain rounded-lg shadow-xs">
                                    </div>
                                @endif

                                {{-- Judul Pengumuman --}}
                                <h2 class="text-2xl md:text-3xl font-extrabold text-slate-800 leading-snug mb-6">
                                    {{ $kegiatan->judul }}
                                </h2>

                                {{-- Content & Embedded File Preview (PDF/Iframe) --}}
                                <div class="prose tiny-content max-w-none text-slate-600 leading-relaxed text-base md:text-lg embed-iframe-container">
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
                        <i class="fa-regular fa-clipboard text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800">Belum Ada Pengumuman Hasil</h3>
                    <p class="text-sm text-slate-500 mt-1">Hasil pengumuman tantangan Bebras akan ditampilkan di halaman ini.</p>
                </div>
            @endif
        </div>

    </div>
</section>

<style>
    .embed-iframe-container iframe {
        width: 100% !important;
        min-height: 600px !important;
        border-radius: 16px;
        border: 1px solid #bae6fd;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.04);
        margin-top: 1.25rem;
        margin-bottom: 1.25rem;
    }
</style>
@endsection
