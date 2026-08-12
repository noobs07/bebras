@extends('app')

@section('title', 'Latihan')
@section('content')
    <div class="w-full px-4 py-8">
        <div class="bg-white rounded-2xl shadow-lg p-8 max-w-6xl mx-auto">

            <!-- Header: Judul + Gambar -->
            <div class="flex flex-col md:flex-row md:justify-between md:items-center border-b pb-6 mb-8 gap-6">
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">
                    Latihan
                </h1>
                <img src="{{ asset('img/task.png') }}" alt="Logo Bebras"
                    class="w-32 h-24 rounded-xl object-contain shadow-md">
            </div>

            <!-- Deskripsi -->
            <p class="text-lg md:text-xl font-semibold text-gray-800 mb-6">
                Untuk latihan Bebras, silakan pilih platform berikut:
            </p>

            <!-- Cards -->
            <div class="grid gap-6 md:grid-cols-2">

                <!-- Card 1 -->
                <div
                    class="bg-gray-50 rounded-xl shadow hover:shadow-lg transition p-6 flex flex-col items-center text-center">
                    <img src="{{ asset('img/gdp-logo.png') }}" alt="Olympia Logo" class="w-28 h-28 object-contain mb-4">
                    <h2 class="text-xl font-bold text-gray-900 mb-2">Olympia.id</h2>
                    <p class="text-gray-600 text-sm mb-4">
                        Silakan unduh panduan latihan bagi akun baru.<br>
                        Olympia powered by <span class="font-semibold">GDP Labs</span>.
                    </p>
                    <a href="https://olympia.id" target="_blank"
                        class="inline-block px-4 py-2 rounded-lg bg-bebrasBlue text-white font-medium hover:bg-blue-700 transition">
                        Kunjungi Olympia
                    </a>
                </div>

                <!-- Card 2 -->
                <div
                    class="bg-gray-50 rounded-xl shadow hover:shadow-lg transition p-6 flex flex-col items-center text-center">
                    <img src="{{ asset('img/logo.jpg') }}" alt="Bebras Logo" class="w-28 h-28 object-contain mb-4">
                    <h2 class="text-xl font-bold text-gray-900 mb-2">latihan.bebras.or.id</h2>
                    <p class="text-gray-600 text-sm mb-4">
                        Platform latihan resmi <span class="font-semibold">Bebras Indonesia</span>.
                    </p>
                    <a href="https://latihan.bebras.or.id" target="_blank"
                        class="inline-block px-4 py-2 rounded-lg bg-bebrasBlue text-white font-medium hover:bg-blue-700 transition">
                        Kunjungi Latihan
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection
