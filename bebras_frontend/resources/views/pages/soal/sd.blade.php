@extends('app')

@section('title', 'Contoh Soal Siaga Siswa SD')
@section('content')
    <div class="w-full px-4 py-10 ">
        <div class="bg-white rounded-lg  shadow-xl p-8  mx-auto">

            <!-- Header -->
            <div class="flex flex-col md:flex-row md:justify-between md:items-center border-b pb-6 mb-8 gap-6">
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 leading-tight">
                    Contoh Soal <span class="text-blue-600">SIAGA</span> untuk Siswa SD
                </h1>
                @if ($menu->gambar)
                <img src="{{ (strpos($menu->gambar, 'img/') === 0) ? asset($menu->gambar) : asset('storage/' . $menu->gambar) }}" alt="Logo Bebras"
                    class="w-28 h-20 rounded-lg shadow-md object-cover mx-auto md:mx-0">
                @endif
            </div>

            <!-- Soal -->
            <div class="space-y-6">
                <div>
                    <span class="text-sm font-medium text-orange-600 uppercase tracking-wide">{{ $challenge->kategori_umur }}</span>
                    <h2 class="text-2xl font-bold text-gray-800 mt-1">
                        {{ $challenge->judul }}
                    </h2>
                </div>

                <div class="space-y-4">
                    @if ($challenge->gambar_soal_1)
                    <img src="{{ (strpos($challenge->gambar_soal_1, 'img/') === 0) ? asset($challenge->gambar_soal_1) : asset('storage/' . $challenge->gambar_soal_1) }}" alt="Soal Berang-berang" class="rounded-lg shadow-md  mx-auto">
                    @endif

                    <p class="text-base font-semibold text-gray-700 bg-gray-100 p-4 rounded-xl shadow text-center">
                        👦 Kelompok Umur: <span class="text-blue-700">{{ $challenge->tingkat }}</span> &nbsp; | &nbsp;
                        🎯 Kesulitan: <span class="text-green-600">{{ $challenge->kesulitan }}</span> &nbsp; | &nbsp;
                        📌 Kategori: <span class="text-purple-600">{{ $challenge->kategori_materi }}</span>
                    </p>

                    <div class="text-justify text-gray-800 leading-relaxed">
                        {!! $challenge->deskripsi_soal !!}
                    </div>

                    @if ($challenge->gambar_soal_2)
                    <img src="{{ (strpos($challenge->gambar_soal_2, 'img/') === 0) ? asset($challenge->gambar_soal_2) : asset('storage/' . $challenge->gambar_soal_2) }}" alt="Pilihan Berang-berang"
                        class="rounded-lg shadow-md w-full md:w-[550px] h-auto mx-auto">
                    @endif
                </div>
            </div>

            <!-- Jawaban -->
            <div class="mt-14">
                <h3 class="text-2xl font-extrabold text-gray-900 mb-6 text-center">🔎 Pilihan Jawaban</h3>
                <ul class="grid grid-cols-2 sm:grid-cols-4 gap-8">
                    @foreach ($challenge->options as $option)
                    <!-- Jawaban {{ $option->label }} -->
                    <li class="flex flex-col items-center">
                        <span class="text-lg font-bold text-blue-700 mb-2">{{ $option->label }}</span>
                        @if ($option->gambar)
                        <img src="{{ (strpos($option->gambar, 'img/') === 0) ? asset($option->gambar) : asset('storage/' . $option->gambar) }}" alt="Jawaban {{ $option->label }}"
                            class="rounded-xl shadow-lg hover:scale-110 hover:shadow-2xl transition-transform duration-300 border-4 border-blue-200">
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Solusi -->
            <div class="mt-16 bg-white p-8 rounded-2xl shadow-xl">
                <h4 class="text-2xl font-extrabold text-blue-900 mb-4">✅ Solusi</h4>
                <div class="text-gray-800 leading-relaxed text-lg">
                    {!! $challenge->solusi !!}
                </div>

                @if ($challenge->ini_informatika)
                <div class="mt-6 text-gray-700 leading-relaxed text-lg">
                    <span class="font-semibold text-green-600">💡 Ini Informatika:</span>
                    {!! $challenge->ini_informatika !!}
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
