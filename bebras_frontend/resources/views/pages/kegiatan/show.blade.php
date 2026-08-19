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

        {{-- Kegiatan Cards Grid --}}
        @if($menu->kegiatans->isNotEmpty())
            @if($menu->kegiatans->first()->kota)
                {{-- Workshop style: badge kota --}}
                <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($menu->kegiatans as $kegiatan)
                        @php
                            $colorMap = [
                                'Bogor'    => 'blue',
                                'Semarang' => 'green',
                                'Lampung'  => 'yellow',
                                'Bandung'  => 'pink',
                                'Samarinda'=> 'purple',
                                'Bali'     => 'red',
                                'Pekanbaru'=> 'indigo',
                                'Jakarta'  => 'teal',
                            ];
                            $color = $colorMap[$kegiatan->kota] ?? 'blue';
                        @endphp
                        <div class="group bg-gray-50 rounded-xl shadow hover:shadow-2xl transition duration-300 overflow-hidden">
                            @if($kegiatan->gambar)
                                <div class="overflow-hidden">
                                    <img src="{{ (str_starts_with($kegiatan->gambar, 'img/')) ? asset($kegiatan->gambar) : asset('storage/' . $kegiatan->gambar) }}"
                                         alt="{{ $kegiatan->judul }}"
                                         class="w-full h-48 object-cover transform group-hover:scale-105 transition duration-500">
                                </div>
                            @endif
                            <div class="p-5">
                                @if($kegiatan->kota)
                                    <span class="text-xs font-medium text-{{ $color }}-600 bg-{{ $color }}-100 px-2 py-1 rounded-full">
                                        {{ $kegiatan->kota }}
                                    </span>
                                @endif
                                <h5 class="mt-3 text-lg font-bold text-gray-800 line-clamp-2">
                                    {{ $kegiatan->judul }}
                                </h5>
                                @if($kegiatan->tanggal_lokasi)
                                    <p class="text-xs text-gray-500 mt-1">📅 {{ $kegiatan->tanggal_lokasi }}</p>
                                @endif
                                @if($kegiatan->speaker)
                                    <p class="text-xs text-gray-500 mt-1">🎤 {{ $kegiatan->speaker }}</p>
                                @endif
                                <div class="text-gray-600 text-sm mt-2 leading-relaxed">
                                    {!! $kegiatan->deskripsi !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Generic list style (no kota) --}}
                <div class="space-y-6">
                    @foreach($menu->kegiatans as $kegiatan)
                        <div class="flex gap-4 p-4 bg-gray-50 rounded-xl border border-gray-100 hover:shadow transition duration-300">
                            @if($kegiatan->gambar)
                                <img src="{{ (str_starts_with($kegiatan->gambar, 'img/')) ? asset($kegiatan->gambar) : asset('storage/' . $kegiatan->gambar) }}"
                                     alt="{{ $kegiatan->judul }}"
                                     class="w-24 h-24 object-cover rounded-lg flex-shrink-0">
                            @endif
                            <div>
                                <h5 class="text-lg font-bold text-gray-800">{{ $kegiatan->judul }}</h5>
                                @if($kegiatan->tanggal_lokasi)
                                    <p class="text-xs text-gray-500 mt-1">📅 {{ $kegiatan->tanggal_lokasi }}</p>
                                @endif
                                @if($kegiatan->speaker)
                                    <p class="text-xs text-gray-500 mt-1">🎤 {{ $kegiatan->speaker }}</p>
                                @endif
                                <div class="text-gray-600 text-sm mt-2 leading-relaxed">
                                    {!! $kegiatan->deskripsi !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @else
            <div class="text-center py-16 text-gray-400">
                <svg class="w-16 h-16 mx-auto mb-4 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="text-lg font-medium">Belum ada kegiatan untuk halaman ini.</p>
                <p class="text-sm mt-1">Tambahkan kegiatan melalui halaman admin.</p>
            </div>
        @endif
    </div>
</div>
@endsection
