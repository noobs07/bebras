@extends('app')

@section('title', 'Sejarah Bebras Indonesia')

@section('content')
    <div class="w-full px-4 py-10 bg-gradient-to-br from-[#F8FAFC] to-[#EEF2FF] dark:from-gray-900 dark:to-gray-800">
        <div class="max-w-5xl mx-auto">

            <!-- Header -->
            <div class="text-center mb-10">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-gray-100">
                    Sejarah Bebras Indonesia
                </h2>
                <p class="mt-2 text-gray-600 dark:text-gray-300 text-sm md:text-base">
                    Perjalanan awal Bebras di Indonesia sejak tahun 2016
                </p>
            </div>

            <!-- Timeline -->
            <div class="relative border-l-4 border-indigo-500 pl-6 space-y-8">

                <!-- Item 1 -->
                <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-md hover:shadow-lg transition">
                    <span class="absolute -left-3 top-6 w-6 h-6 rounded-full bg-indigo-500 ring-4 ring-indigo-200"></span>
                    <h3 class="text-lg md:text-xl font-semibold text-gray-800 dark:text-gray-100">
                        Februari 2016
                    </h3>
                    <p class="mt-2 text-gray-700 dark:text-gray-300 text-justify">
                        Setelah kunjungannya ke Indonesia, <strong>Prof. Valentina Dagienė</strong> (Vilnius University,
                        Lithuania)
                        penggagas Bebras Internasional, mengundang Indonesia menjadi <em>observer</em> pada Workshop
                        Internasional Bebras
                        bulan Mei 2016 di Bodrum, Turki.
                    </p>
                </div>

                <!-- Item 2 -->
                <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-md hover:shadow-lg transition">
                    <span class="absolute -left-3 top-6 w-6 h-6 rounded-full bg-indigo-500 ring-4 ring-indigo-200"></span>
                    <h3 class="text-lg md:text-xl font-semibold text-gray-800 dark:text-gray-100">
                        Mei 2016
                    </h3>
                    <p class="mt-2 text-gray-700 dark:text-gray-300 text-justify">
                        Indonesia mengirimkan <strong>Dr. Inggriani Liem</strong> (Pembina TOKI) dan
                        <strong>Soripada Harahap</strong> (staf Direktorat Pembinaan SMA, Kemdikbud RI) sebagai wakil
                        Indonesia
                        pada Workshop Internasional Bebras di Bodrum, Turki.
                    </p>
                </div>

                <!-- Item 3 -->
                <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-md hover:shadow-lg transition">
                    <span class="absolute -left-3 top-6 w-6 h-6 rounded-full bg-indigo-500 ring-4 ring-indigo-200"></span>
                    <h3 class="text-lg md:text-xl font-semibold text-gray-800 dark:text-gray-100">
                        November 2016
                    </h3>
                    <p class="mt-2 text-gray-700 dark:text-gray-300 text-justify">
                        Untuk pertama kalinya, Indonesia berpartisipasi dalam
                        <strong>Bebras Challenge</strong> sesuai jadwal Komite Internasional Bebras,
                        pada bulan November 2016.
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection
