@extends('app')

@section('title', 'Alamat Kontak')
@section('content')
    <div class="w-full px-4 py-8">
       <div class="bg-white rounded-2xl shadow-lg p-8 max-w-6xl mx-auto">


            <!-- Header -->
            <div class="border-b pb-6 mb-8 flex justify-between">
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">
                    Alamat Kontak
                </h1>
                <img src="{{ asset('img/contacts-book.png') }}" alt="" class="w-16 h-16">
            </div>

            <!-- Kontak List -->
            <div class="space-y-6">

                <!-- Kontak 1 -->
                <div class="bg-gray-50 rounded-xl shadow-sm hover:shadow-md transition p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-2">Dr. Inggriani Liem</h2>
                    <p class="text-gray-700">
                        STEI Institut Teknologi Bandung <br>
                        Jl. Ganesha 10, Bandung 40135, Indonesia
                    </p>
                </div>

                <!-- Kontak 2 -->
                <div class="bg-gray-50 rounded-xl shadow-sm hover:shadow-md transition p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-2">Dr. Suryana Setiawan</h2>
                    <p class="text-gray-700">
                        Fasilkom Universitas Indonesia <br>
                        Kampus UI, Depok 16424, Indonesia
                    </p>
                </div>

                <!-- Kontak 3 -->
                <div class="bg-gray-50 rounded-xl shadow-sm hover:shadow-md transition p-6">
                    <h2 class="text-xl font-bold text-gray-900">Bebras Biro</h2>
                </div>

                <!-- Kontak 4 -->
                <div class="bg-gray-50 rounded-xl shadow-sm hover:shadow-md transition p-6 flex items-center gap-3">
                    <span class="text-bebrasBlue font-semibold">E-mail:</span>
                    <a href="mailto:mail@bebras.or.id" class="text-blue-600 hover:underline">
                        mail@bebras.or.id
                    </a>
                </div>

                <!-- Kontak 5 -->
                <div class="bg-gray-50 rounded-xl shadow-sm hover:shadow-md transition p-6 flex items-center gap-3">
                    <span class="text-bebrasBlue font-semibold">URL:</span>
                    <a href="http://bebras.or.id" target="_blank" class="text-blue-600 hover:underline">
                        http://bebras.or.id
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection
