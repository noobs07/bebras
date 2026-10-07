@extends('app')

@section('title', $menu->judul ?? $menu->nama_menu)

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-10">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between border-b pb-6 mb-8">
            <div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight mb-2">
                    {{ $menu->judul ?? $menu->nama_menu }}
                </h1>
                @if($menu->body)
                    <div class="text-gray-600 mt-2 prose max-w-none">
                        {!! $menu->body !!}
                    </div>
                @endif
            </div>
            @if($menu->gambar)
                <img src="{{ asset('storage/' . $menu->gambar) }}"
                     alt="{{ $menu->nama_menu }}"
                     class="w-20 h-20 object-contain mx-auto md:mx-0 mt-4 md:mt-0">
            @else
                <img src="{{ asset('img/done.png') }}" alt="Bebras"
                     class="w-16 h-16 mx-auto md:mx-0 mt-4 md:mt-0">
            @endif
        </div>

        {{-- Daftar Pengumuman Hasil --}}
        @if($menu->kegiatans->isNotEmpty())
            <div class="flex flex-col gap-8">
                @foreach($menu->kegiatans as $kegiatan)
                    <div class="bg-gray-50 rounded-xl shadow hover:shadow-lg transition duration-300 overflow-hidden border border-gray-200 p-6 md:p-8">

                        {{-- Gambar Opsional --}}
                        @if($kegiatan->gambar)
                            <div class="overflow-hidden rounded-lg mb-6">
                                <img src="{{ asset('storage/' . $kegiatan->gambar) }}"
                                     alt="{{ $kegiatan->judul }}"
                                     class="w-full h-64 object-cover">
                            </div>
                        @endif

                        {{-- Subjudul Pengumuman --}}
                        <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-4 border-b pb-3">
                            {{ $kegiatan->judul }}
                        </h2>

                        {{-- Content & Embedded File Preview --}}
                        <div class="prose max-w-none text-gray-700 leading-relaxed embed-iframe-container">
                            {!! $kegiatan->deskripsi !!}
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 text-gray-400">
                <svg class="w-16 h-16 mx-auto mb-4 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <p class="text-lg font-medium">Belum ada pengumuman untuk halaman ini.</p>
                <p class="text-sm mt-1">Tambahkan konten melalui halaman admin.</p>
            </div>
        @endif
    </div>
</div>

<style>
    .embed-iframe-container iframe {
        width: 100% !important;
        min-height: 600px !important;
        border-radius: 8px;
        border: 1px solid #d1d5db;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        margin-top: 1rem;
        margin-bottom: 1rem;
    }
</style>
@endsection
