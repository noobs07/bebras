@extends('app')
@section('title', 'Contoh Soal Penegak untuk Siswa SMA')
@section('content')
    <div class="w-full px-4 py-10 ">
        <div class="bg-white rounded-lg  shadow-xl p-8  mx-auto">

            <!-- Header -->
            <div class="flex flex-col md:flex-row md:justify-between md:items-center border-b pb-6 mb-8 gap-6">
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 leading-tight">
                    Contoh Soal <span class="text-blue-600">Penegak</span> untuk Siswa SMA
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
                    <img src="{{ (strpos($challenge->gambar_soal_2, 'img/') === 0) ? asset($challenge->gambar_soal_2) : asset('storage/' . $challenge->gambar_soal_2) }}" alt="Graf Pertemanan"
                        class="rounded-xl shadow-md w-full md:w-[600px] h-auto mx-auto">
                    @endif

                    <div class="text-justify text-gray-800 leading-relaxed">
                        {!! \App\Models\Setting::getByKey('sma_question_part_2') !!}
                    </div>

                    <div class="mt-14">
                        <h3 class="text-2xl font-extrabold text-gray-900 mb-6 text-center">🔎 Pilihan Jawaban</h3>
                        <ul class="grid grid-cols-2 sm:grid-cols-4 mb-4 gap-1">
                            @foreach ($challenge->options as $option)
                            <!-- Jawaban {{ $option->label }} -->
                            <li class="flex flex-col items-center">
                                <span class="text-lg font-bold text-blue-700 mb-2">{{ $option->label }}</span>
                                @if ($option->gambar)
                                <img src="{{ (strpos($option->gambar, 'img/') === 0) ? asset($option->gambar) : asset('storage/' . $option->gambar) }}" alt="Jawaban {{ $option->label }}"
                                    class="w-28 h-28 object-contain rounded-xl shadow-lg hover:scale-110 hover:shadow-2xl transition-transform duration-300 border-4 border-blue-200">
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div
                        class="mt-8 sm:mt-16 bg-gradient-to-br from-blue-50 to-green-50 p-4 sm:p-8 rounded-2xl shadow-xl space-y-5">

                        <!-- Judul Solusi -->
                        <h4 class="text-xl sm:text-2xl font-extrabold text-blue-900 mb-2 flex items-center gap-2">
                            ✅ Solusi
                        </h4>
                        <div class="text-gray-800 leading-relaxed text-sm sm:text-base">
                            {!! $challenge->solusi !!}
                        </div>

                        <!-- Sub Judul -->
                        <h5 class="text-lg sm:text-xl font-bold text-gray-800 flex items-center gap-2">
                            💡 Ini Informatika
                        </h5>
                        <div class="bg-white p-4 sm:p-6 rounded-xl shadow space-y-4">
                            <div class="text-gray-800 leading-relaxed text-sm sm:text-base">
                                {!! $challenge->ini_informatika !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
