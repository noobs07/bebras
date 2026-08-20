@extends('app')

@section('title', 'Workshop 2017')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-10">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between border-b pb-6 mb-8">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight mb-4 md:mb-0">
                Workshop 2017
            </h1>
            <img src="{{ asset('img/done.png') }}" alt="Workshop Bebras" class="w-16 h-16 mx-auto md:mx-0 ">
        </div>

        <!-- Deskripsi -->
        <div class="mb-6 text-gray-700">
            <h4 class="text-lg md:text-xl font-semibold mb-3">
                Kegiatan Workshop Bebras 2017 adalah sebagai berikut:
            </h4>
        </div>

        <!-- Grid Kegiatan -->
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">

            <!-- Card 1 -->
            <div class="group bg-gray-50 rounded-xl shadow hover:shadow-2xl transition duration-300 overflow-hidden">
                <div class="overflow-hidden">
                    <img src="{{ asset('img/workshop_a1.jpeg') }}" alt="Workshop Bebras"
                        class="w-full h-48 object-cover transform group-hover:scale-105 transition duration-500">
                </div>
                <div class="p-5">
                    <span class="text-xs font-medium text-blue-600 bg-blue-100 px-2 py-1 rounded-full">Bogor</span>
                    <h5 class="mt-3 text-lg font-bold text-gray-800 line-clamp-2">
                        Institut Pertanian Bogor, 25 Oktober 2017
                    </h5>
                    <p class="text-gray-600 text-sm mt-2 leading-relaxed">
                        "Workshop Computational Thinking and Bebras Challenge 2017"
                        <br><span class="font-semibold">NBO Bebras Indonesia, Julio Adisantoso</span>
                    </p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="group bg-gray-50 rounded-xl shadow hover:shadow-2xl transition duration-300 overflow-hidden">
                <div class="overflow-hidden">
                    <img src="{{ asset('img/workshop_a2.jpg') }}" alt="Workshop Bebras"
                        class="w-full h-48 object-cover transform group-hover:scale-105 transition duration-500">
                </div>
                <div class="p-5">
                    <span class="text-xs font-medium text-green-600 bg-green-100 px-2 py-1 rounded-full">Semarang</span>
                    <h5 class="mt-3 text-lg font-bold text-gray-800 line-clamp-2">
                        Universitas Dian Nuswantoro, 12 Oktober 2017
                    </h5>
                    <p class="text-gray-600 text-sm mt-2 leading-relaxed">
                        Workshop Computational Thinking Guru-guru Semarang
                        <br><span class="font-semibold">Dr. Inggriani</span>
                    </p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="group bg-gray-50 rounded-xl shadow hover:shadow-2xl transition duration-300 overflow-hidden">
                <div class="overflow-hidden">
                    <img src="{{ asset('img/workshop_a3.jpg') }}" alt="Workshop Bebras"
                        class="w-full h-48 object-cover transform group-hover:scale-105 transition duration-500">
                </div>
                <div class="p-5">
                    <span class="text-xs font-medium text-yellow-600 bg-yellow-100 px-2 py-1 rounded-full">Lampung</span>
                    <h5 class="mt-3 text-lg font-bold text-gray-800 line-clamp-2">
                        Institut Teknologi Sumatera, 23 September 2017
                    </h5>
                    <p class="text-gray-600 text-sm mt-2 leading-relaxed">
                        Workshop Computational Thinking Initiative
                        <br><span class="font-semibold">Dr. Inggriani</span>
                    </p>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="group bg-gray-50 rounded-xl shadow hover:shadow-2xl transition duration-300 overflow-hidden">
                <div class="overflow-hidden">
                    <img src="{{ asset('img/workshop_a4.jpg') }}" alt="Workshop Bebras"
                        class="w-full h-48 object-cover transform group-hover:scale-105 transition duration-500">
                </div>
                <div class="p-5">
                    <span class="text-xs font-medium text-pink-600 bg-pink-100 px-2 py-1 rounded-full">Bandung</span>
                    <h5 class="mt-3 text-lg font-bold text-gray-800 line-clamp-2">
                        Universitas Kristen Maranatha, 22 September 2017
                    </h5>
                    <p class="text-gray-600 text-sm mt-2 leading-relaxed">
                        Bebras Indonesia CT Challenge, Teacher Workshop
                        <br><span class="font-semibold">Dr. Inggriani</span>
                    </p>
                </div>
            </div>

            <!-- Card 5 -->
            <div class="group bg-gray-50 rounded-xl shadow hover:shadow-2xl transition duration-300 overflow-hidden">
                <div class="overflow-hidden">
                    <img src="{{ asset('img/workshop_a5.jpg') }}" alt="Workshop Bebras"
                        class="w-full h-48 object-cover transform group-hover:scale-105 transition duration-500">
                </div>
                <div class="p-5">
                    <span class="text-xs font-medium text-purple-600 bg-purple-100 px-2 py-1 rounded-full">Samarinda</span>
                    <h5 class="mt-3 text-lg font-bold text-gray-800 line-clamp-2">
                        Universitas Lambung Mangkurat, 18 Juli 2017
                    </h5>
                    <p class="text-gray-600 text-sm mt-2 leading-relaxed">
                        Workshop Bebras CT & Competitive Programming
                        <br><span class="font-semibold">Dr. Inggriani</span>
                    </p>
                </div>
            </div>

            <!-- Card 6 -->
            <div class="group bg-gray-50 rounded-xl shadow hover:shadow-2xl transition duration-300 overflow-hidden">
                <div class="overflow-hidden">
                    <img src="{{ asset('img/workshop_a6.jpg') }}" alt="Workshop Bebras"
                        class="w-full h-48 object-cover transform group-hover:scale-105 transition duration-500">
                </div>
                <div class="p-5">
                    <span class="text-xs font-medium text-red-600 bg-red-100 px-2 py-1 rounded-full">Bali</span>
                    <h5 class="mt-3 text-lg font-bold text-gray-800 line-clamp-2">
                        Universitas Udayana, 13 Juli 2017
                    </h5>
                    <p class="text-gray-600 text-sm mt-2 leading-relaxed">
                        Kuliah Tamu Computational Thinking
                        <br><span class="font-semibold">Prof. Dr. Valentina Dagiene</span>
                    </p>
                </div>
            </div>

            <!-- Card 7 -->
            <div class="group bg-gray-50 rounded-xl shadow hover:shadow-2xl transition duration-300 overflow-hidden">
                <div class="overflow-hidden">
                    <img src="{{ asset('img/workshop_a7.jpg') }}" alt="Workshop Bebras"
                        class="w-full h-48 object-cover transform group-hover:scale-105 transition duration-500">
                </div>
                <div class="p-5">
                    <span class="text-xs font-medium text-indigo-600 bg-indigo-100 px-2 py-1 rounded-full">Pekanbaru</span>
                    <h5 class="mt-3 text-lg font-bold text-gray-800 line-clamp-2">
                        Politeknik Caltex Riau, 6 Juli 2017
                    </h5>
                    <p class="text-gray-600 text-sm mt-2 leading-relaxed">
                        Professor & Expert visit series 2017: Bebras CT
                        <br><span class="font-semibold">Prof. Dr. Valentina Dagiene</span>
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
