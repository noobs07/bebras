@extends('app')

@section('title', $menu->judul ?? 'Apa itu Soal Bebras?')

@section('content')
    <div class="w-full px-4 py-8">
        <div class="bg-white rounded-2xl shadow-lg p-8 max-w-6xl mx-auto">

            <!-- Header: Judul + Gambar -->
            <div class="flex flex-col md:flex-row md:justify-between md:items-center border-b pb-6 mb-8 gap-4">
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">
                    {{ $menu->judul }}
                </h1>
                @if ($menu->gambar)
                <img src="{{ (strpos($menu->gambar, 'img/') === 0) ? asset($menu->gambar) : asset('storage/' . $menu->gambar) }}" alt="Logo Bebras"
                    class="w-28 h-20 rounded-xl object-contain shadow-md">
                @endif
            </div>

            <!-- Konten -->
            <div class="text-gray-800 space-y-6 leading-relaxed text-justify">

                {!! $menu->body !!}

                <!-- Daftar Konsep -->
                <ul class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 ml-2">
                    @foreach ($menu->items->where('tipe', 'konsep')->sortBy('urutan') as $item)
                    <li class="flex items-start gap-3 bg-gray-50 rounded-xl px-4 py-3 shadow-sm">
                        <span class="w-2 h-2 mt-2 bg-bebrasBlue rounded-full"></span>
                        {{ $item->judul }}
                    </li>
                    @endforeach
                </ul>

                <!-- Sub Judul -->
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mt-10 mb-4">
                    Kriteria Soal Bebras yang Baik
                </h2>

                <!-- Daftar Kriteria -->
                <ul class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 ml-2">
                    @foreach ($menu->items->where('tipe', 'kriteria')->sortBy('urutan') as $item)
                    <li class="flex items-start gap-3 bg-green-50 border border-green-200 rounded-xl px-4 py-3 shadow-sm">
                        <span class="text-green-600 mt-1">✔</span> {{ $item->judul }}
                    </li>
                    @endforeach
                </ul>

                <p>
                    {!! \App\Models\Setting::getByKey('index_soal_footer_text') !!}
                </p>
            </div>
        </div>
    </div>
@endsection
