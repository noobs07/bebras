@extends('app')
@section('title', 'Kegiatan Bebras')

@section('content')
    <div class="w-full p-4">
        <div class="col-span-12 p-6 rounded-lg shadow bg-white dark:bg-gray-900">
            <!-- Header -->
            <div class="flex flex-col md:flex-row items-center md:justify-between gap-4 mb-6">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-gray-100">
                    {{ $page->judul }}
                </h2>
                @if ($page->gambar)
                <img src="{{ (strpos($page->gambar, 'img/') === 0) ? asset($page->gambar) : asset('storage/' . $page->gambar) }}" alt="Kegiatan" class="w-full max-w-[90px] h-auto object-contain">
                @endif
            </div>

            <!-- Intro -->
            <div class="text-gray-700 dark:text-gray-300 text-justify mb-6">
                {!! $page->konten !!}
            </div>

            @php
                $lists = $page->items->where('tipe', 'kegiatan_list')->sortBy('urutan');
                $kategoris = $page->items->where('tipe', 'kategori_tantangan')->sortBy('urutan');
                $footerText = \App\Models\Setting::getByKey('dd5_footer_text');
            @endphp

            <!-- List Kegiatan -->
            <ul class="grid gap-4 sm:grid-cols-2">
                @foreach ($lists as $item)
                <li class="p-5 rounded-xl border border-gray-200 {{ $item->bg_color }} shadow-sm hover:shadow-md transition">
                    <h3 class="font-semibold text-lg text-gray-800">{{ $item->icon }} {{ $item->judul }}</h3>
                    <p class="mt-2 text-sm text-gray-600">
                        {{ $item->deskripsi }}
                    </p>
                </li>
                @endforeach
            </ul>

            <!-- Kategori Peserta -->
            <div class="mt-10 bg-bebras">
                <h3 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-gray-100">
                    📚 Kategori Tantangan Bebras
                </h3>
                <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-4">
                    @foreach ($kategoris as $item)
                    <div
                        class="p-4 rounded-xl bg-gradient-to-br {{ $item->bg_color }} shadow hover:scale-105 transition">
                        <h4 class="font-bold text-gray-800">{{ $item->judul }}</h4>
                        <p class="text-sm text-gray-700">{{ $item->deskripsi }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            @if ($footerText)
            <div class="flex-1 md:pr-6 mt-8 border p-2 rounded-lg bg-bebrasLightBlue">
                <p class="mt-2 text-md text-gray-600">
                    {!! $footerText !!}
                </p>
            </div>
            @endif
        </div>
    </div>

@endsection
