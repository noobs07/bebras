@extends('app')

@section('title', 'Contoh Soal Penggalang Siswa SMP')
@section('content')
    <div class="w-full px-4 py-10">
        <div class="bg-white rounded-2xl shadow-xl p-6 md:p-10  mx-auto">

            <!-- Header -->
            <div class="flex flex-col md:flex-row md:justify-between md:items-center border-b-2 pb-6 mb-8 gap-6">
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 leading-snug text-center md:text-left">
                    Contoh Soal <span class="text-blue-600">Penggalang</span> <br class="md:hidden" /> untuk Siswa SMP
                </h1>
                @if ($menu->gambar)
                <img src="{{ (strpos($menu->gambar, 'img/') === 0) ? asset($menu->gambar) : asset('storage/' . $menu->gambar) }}" alt="Logo Bebras"
                    class="w-28 h-20 md:w-36 md:h-24 rounded-xl shadow-md object-cover mx-auto md:mx-0">
                @endif
            </div>

            <!-- Soal -->
            <div class="space-y-6">
                <!-- Judul Soal -->
                <div>
                    <span class="text-sm font-semibold text-orange-600 uppercase tracking-wider">{{ $challenge->kategori_umur }}</span>
                    <h2 class="text-3xl font-bold text-gray-800 mt-1 text-center">
                        {{ $challenge->judul }}
                    </h2>
                </div>

                <!-- Gambar utama -->
                <div class="space-y-4">
                    @if ($challenge->gambar_soal_1)
                    <img src="{{ (strpos($challenge->gambar_soal_1, 'img/') === 0) ? asset($challenge->gambar_soal_1) : asset('storage/' . $challenge->gambar_soal_1) }}" alt="Soal SMP"
                        class="rounded-2xl shadow-lg mx-auto w-52 h-52 object-contain bg-white">
                    @endif

                    <!-- Info Soal -->
                    <p class="text-base font-semibold text-gray-700 bg-gray-100 p-4 rounded-xl shadow text-center">
                        👦 Kelompok Umur: <span class="text-blue-700">{{ $challenge->tingkat }}</span> &nbsp; | &nbsp;
                        🎯 Kesulitan: <span class="text-green-600">{{ $challenge->kesulitan }}</span> &nbsp; | &nbsp;
                        📌 Kategori: <span class="text-purple-600">{{ $challenge->kategori_materi }}</span>
                    </p>

                    <!-- Narasi -->
                    <div class="text-justify text-gray-800 leading-relaxed">
                        {!! $challenge->deskripsi_soal !!}
                    </div>

                    <!-- Gambar graf -->
                    @if ($challenge->gambar_soal_2)
                    <img src="{{ (strpos($challenge->gambar_soal_2, 'img/') === 0) ? asset($challenge->gambar_soal_2) : asset('storage/' . $challenge->gambar_soal_2) }}" alt="Graf Pertemanan"
                        class="rounded-xl shadow-md w-full md:w-[600px] h-auto mx-auto">
                    @endif
                </div>

                <!-- Pertanyaan -->
                <div class="bg-white p-6 rounded-2xl shadow space-y-4">
                    <div class="text-gray-800 leading-relaxed">
                        {!! \App\Models\Setting::getByKey('smp_question_part_2') !!}
                    </div>

                    <!-- Pilihan Jawaban -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 font-semibold">
                        @foreach ($challenge->options as $option)
                        <button class="p-3 rounded-lg bg-blue-100 hover:bg-blue-200">{{ $option->label }}. {{ $option->teks }}</button>
                        @endforeach
                    </div>
                </div>

                <!-- Solusi -->
                <div class="bg-gradient-to-r from-purple-100 to-blue-100 p-6 rounded-2xl shadow space-y-4">
                    <h3 class="text-2xl font-extrabold text-purple-700 flex items-center gap-2">
                        💡 Solusi Informatika
                    </h3>

                    <div class="text-gray-800 leading-relaxed">
                        <span class="font-semibold text-blue-700">Ini Informatika!</span><br>
                        {!! $challenge->solusi !!}
                    </div>

                    @if ($challenge->ini_informatika)
                    <div class="text-gray-800 leading-relaxed">
                        {!! $challenge->ini_informatika !!}
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
