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
                <img src="{{ asset('./img/b_countdown.jpg') }}" alt="Logo Bebras"
                    class="w-28 h-20 rounded-lg shadow-md object-cover mx-auto md:mx-0">
            </div>

            <!-- Soal -->
            <div class="space-y-6">
                <div>
                    <span class="text-sm font-medium text-orange-600 uppercase tracking-wide">Kategori 17-18</span>
                    <h2 class="text-2xl font-bold text-gray-800 mt-1">
                        Lipatan Kertas
                    </h2>
                </div>

                <div class="space-y-4">
                    <img src="{{ asset('/img/sma_1.jpg') }}" alt="Soal Berang-berang" class="rounded-lg shadow-md  mx-auto">

                    <p class="text-base font-semibold text-gray-700 bg-gray-100 p-4 rounded-xl shadow text-center">
                        👦 Kelompok Umur: <span class="text-blue-700">SMA</span> &nbsp; | &nbsp;
                        🎯 Kesulitan: <span class="text-green-600">Menengah</span> &nbsp; | &nbsp;
                        📌 Kategori: <span class="text-purple-600">ALG, INF</span>
                    </p>

                    <p class="text-justify text-gray-800 leading-relaxed">
                        Berang-berang mengembangkan suatu “bahasa” untuk melipat kertas. Bahasa ini dapat digunakan untuk
                        menjelaskan bagaimana setiap lembaran kertas dapat dilipat dengan sisi-sisi lurus. Salah satu
                        perintah dalam bahasa ini adalah fold.
                    </p>

                    <p class="text-justify text-gray-800 leading-relaxed">
                        <span class="font-semibold text-blue-700">e = folda(a,b) artinya</span>
                        anda melipat sisi a selembar kertas agar menempel pada sisi b. Dengan perintah ini, Anda membuat
                        sisi baru, yaitu sebuah garis yang membentuk lipatan, yang dinamakan <span
                            class="font-bold">e</span>. Contoh:
                    </p>

                    <img src="{{ asset('/img/sma_2.png') }}" alt="Graf Pertemanan"
                        class="rounded-xl shadow-md w-full md:w-[600px] h-auto mx-auto">
                    <p class="text-justify text-gray-800 leading-relaxed">
                        <span class="font-semibold text-blue-700"> Harap dicatat bahwa</span>
                        kertas ada di meja selama pelipatan, dan panjang sisi b adalah dua kali panjang
                        sisi a. Bagaimana tampak bentuk kertas (a, b, c, d) setelah menjalankan ketiga perintah di atas?
                    </p>

                    <span class="font-semibold mt-3">
                        e = fold(c, a); f = fold(c, d); g = fold(a, f)
                    </span>

                    <div class="mt-14">
                        <h3 class="text-2xl font-extrabold text-gray-900 mb-6 text-center">🔎 Pilihan Jawaban</h3>
                        <ul class="grid grid-cols-2 sm:grid-cols-4 mb-4 gap-1">
                            <!-- Jawaban A -->
                            <li class="flex flex-col items-center">
                                <span class="text-lg font-bold text-blue-700 mb-2">A</span>
                                <img src="{{ asset('img/sma_a.png') }}" alt="Jawaban A"
                                    class="w-28 h-28 object-contain rounded-xl shadow-lg hover:scale-110 hover:shadow-2xl transition-transform duration-300 border-4 border-blue-200">
                            </li>
                            <!-- Jawaban B -->
                            <li class="flex flex-col items-center">
                                <span class="text-lg font-bold text-blue-700 mb-2">B</span>
                                <img src="{{ asset('img/sma_b.png') }}" alt="Jawaban B"
                                    class="w-28 h-28 object-contain rounded-xl shadow-lg hover:scale-110 hover:shadow-2xl transition-transform duration-300 border-4 border-blue-200">
                            </li>
                            <!-- Jawaban C -->
                            <li class="flex flex-col items-center">
                                <span class="text-lg font-bold text-blue-700 mb-2">C</span>
                                <img src="{{ asset('img/sma_c.png') }}" alt="Jawaban C"
                                    class="w-28 h-28 object-contain rounded-xl shadow-lg hover:scale-110 hover:shadow-2xl transition-transform duration-300 border-4 border-blue-200">
                            </li>
                            <!-- Jawaban D -->
                            <li class="flex flex-col items-center">
                                <span class="text-lg font-bold text-blue-700 mb-2">D</span>
                                <img src="{{ asset('img/sma_d.png') }}" alt="Jawaban D"
                                    class="w-28 h-28 object-contain rounded-xl shadow-lg hover:scale-110 hover:shadow-2xl transition-transform duration-300 border-4 border-blue-200">
                            </li>
                        </ul>
                    </div>
                    <div
                        class="mt-8 sm:mt-16 bg-gradient-to-br from-blue-50 to-green-50 p-4 sm:p-8 rounded-2xl shadow-xl space-y-5">

                        <!-- Judul Solusi -->
                        <h4 class="text-xl sm:text-2xl font-extrabold text-blue-900 mb-2 flex items-center gap-2">
                            ✅ Solusi
                        </h4>

                        <!-- Sub Judul -->
                        <h5 class="text-lg sm:text-xl font-bold text-gray-800 flex items-center gap-2">
                            💡 Ini Informatika
                        </h5>

                        <!-- Jawaban -->
                        <p class="text-gray-800 leading-relaxed text-sm sm:text-base">
                            <span class="font-semibold text-green-600">Jawaban yang benar adalah A.</span>
                            <br>
                            Gambar berikut menjelaskan eksekusi pelipatan tahap demi tahap:
                        </p>

                        <!-- Gambar Solusi -->
                        <div class="flex justify-center">
                            <img src="{{ asset('img/sma_3.png') }}" alt="Tahap Pelipatan"
                                class="rounded-xl shadow-lg max-w-full sm:max-w-md bg-white p-1 sm:p-2">
                        </div>

                        <!-- Penjelasan Informatika -->
                        <div class="bg-white p-4 sm:p-6 rounded-xl shadow space-y-4">
                            <p class="text-gray-800 leading-relaxed text-sm sm:text-base">
                                Soal ini berkaitan dengan <span class="font-semibold text-blue-700">informatika</span>,
                                yaitu konsep <span class="italic">fungsi</span> yang sangat penting dalam pemrograman.
                            </p>

                            <!-- List dengan styling -->
                            <ul class="space-y-3 sm:space-y-4 text-gray-700 text-sm sm:text-base">
                                <li class="flex items-start gap-3 p-3 rounded-lg bg-blue-50 hover:bg-blue-100 transition">
                                    <span
                                        class="flex-shrink-0 w-6 h-6 flex items-center justify-center rounded-full bg-blue-600 text-white text-xs font-bold">1</span>
                                    <span><span class="font-semibold">Fungsi</span> dipanggil melalui perintah → memulai
                                        serangkaian aktivitas.</span>
                                </li>
                                <li class="flex items-start gap-3 p-3 rounded-lg bg-green-50 hover:bg-green-100 transition">
                                    <span
                                        class="flex-shrink-0 w-6 h-6 flex items-center justify-center rounded-full bg-green-600 text-white text-xs font-bold">2</span>
                                    <span><span class="font-semibold">Parameter</span> (contoh: dua sisi kertas) → menjadi
                                        input fungsi.</span>
                                </li>
                                <li
                                    class="flex items-start gap-3 p-3 rounded-lg bg-purple-50 hover:bg-purple-100 transition">
                                    <span
                                        class="flex-shrink-0 w-6 h-6 flex items-center justify-center rounded-full bg-purple-600 text-white text-xs font-bold">3</span>
                                    <span><span class="font-semibold">Output</span> → hasil pemrosesan, yaitu bentuk
                                        lipatan.</span>
                                </li>
                            </ul>

                            <p class="text-gray-800 leading-relaxed text-sm sm:text-base">
                                Dengan demikian, siswa belajar bahwa fungsi dalam pemrograman bekerja seperti “mesin”:
                                menerima input, memproses, lalu menghasilkan output.
                            </p>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
@endsection
