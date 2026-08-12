@extends('app')

@section('title', 'Pembahasan Soal')
@section('content')
    <div class="w-full px-4 py-10">
        <div class="bg-gradient-to-br from-blue-50 via-white to-purple-50 rounded-3xl shadow-xl p-8 max-w-7xl mx-auto">

            <!-- Header -->
            <div class="border-b pb-6 mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight">
                    📚 Pembahasan Soal Bebras
                </h1>
                <img src="{{ asset('img/bebras.png') }}" alt="Logo Bebras"
                    class="w-32 h-24 object-contain rounded-2xl shadow-md hover:scale-105 transition-transform duration-300">
            </div>

            <!-- Grid Container -->
            <div class="grid md:grid-cols-2 gap-10">

                <!-- SiKecil -->
                <div class="bg-white border border-gray-100 rounded-2xl shadow-md hover:shadow-xl transition-all p-6">
                    <div class="flex items-center gap-4 mb-5">
                        <img src="{{ asset('img/buku2020-sikecil.jpg') }}" alt="SiKecil Logo"
                            class="w-16 h-16 object-contain rounded-lg bg-blue-50 p-2">
                        <h2 class="text-2xl font-bold text-bebrasBlue">Bebras SiKecil (PAUD/TK)</h2>
                    </div>
                    <ul class="space-y-3 pl-2 text-lg">
                        <li>
                            📘 <a
                                href="https://bebras.or.id/v3/wp-content/uploads/2024/10/Bebras-Indonesia-Book-2020-SiKecil-OK-Okt2024.pdf"
                                target="_blank"
                                class="text-blue-600 font-medium hover:text-blue-800 hover:underline transition">
                                Buku Bebras SiKecil 2020
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Siaga -->
                <div class="bg-white border border-gray-100 rounded-2xl shadow-md hover:shadow-xl transition-all p-6">
                    <div class="flex items-center gap-4 mb-5">
                        <img src="{{ asset('img/buku2020-sd.jpg') }}" alt="Siaga Logo"
                            class="w-16 h-16 object-contain rounded-lg bg-green-50 p-2">
                        <h2 class="text-2xl font-bold text-bebrasBlue">Bebras Siaga (SD/MI)</h2>
                    </div>
                    <ul class="space-y-3 pl-2 text-lg">
                        <li>📘 <a href="https://bebras.or.id/v3/wp-content/uploads/2019/10/Bebras-Challenge-2016_Siaga.pdf"
                                target="_blank" class="link-bebras hover:underline hover:text-gray-600">Buku Bebras Siaga 2016</a></li>
                        <li>📘 <a href="https://bebras.or.id/v3/wp-content/uploads/2018/07/BukuBebras2017_SD.pdf"
                                target="_blank" class="link-bebras hover:underline hover:text-gray-600">Buku Bebras Siaga 2017</a></li>
                        <li>📘 <a
                                href="https://bebras.or.id/v3/wp-content/uploads/2019/09/BukuBebras2018%20SD%20v.5%20rev-1.pdf"
                                target="_blank" class="link-bebras hover:underline hover:text-gray-600">Buku Bebras Siaga 2018</a></li>
                        <li>📘 <a
                                href="https://bebras.or.id/v3/wp-content/uploads/2024/10/Bebras-Indonesia-Book-2019-SD-v.Okt_.2024.pdf"
                                target="_blank" class="link-bebras hover:underline hover:text-gray-600">Buku Bebras Siaga 2019</a></li>
                        <li>📘 <a
                                href="https://bebras.or.id/v3/wp-content/uploads/2024/10/Bebras-Indonesia-Book-2020-SD-OK-Okt2024.pdf"
                                target="_blank" class="link-bebras hover:underline hover:text-gray-600">Buku Bebras Siaga 2020</a></li>
                    </ul>
                </div>

                <!-- Penggalang -->
                <div class="bg-white border border-gray-100 rounded-2xl shadow-md hover:shadow-xl transition-all p-6">
                    <div class="flex items-center gap-4 mb-5">
                        <img src="{{ asset('img/buku2020-smp.jpg') }}" alt="Penggalang Logo"
                            class="w-16 h-16 object-contain rounded-lg bg-yellow-50 p-2">
                        <h2 class="text-2xl font-bold text-bebrasBlue">Bebras Penggalang (SMP/MTs)</h2>
                    </div>
                    <ul class="space-y-3 pl-2 text-lg">
                        <li>📘 <a
                                href="https://bebras.or.id/v3/wp-content/uploads/2019/10/Bebras-Challenge-2016_Penggalang.pdf"
                                target="_blank" class="link-bebras hover:underline hover:text-gray-600">Buku Bebras Penggalang 2016</a></li>
                        <li>📘 <a href="https://bebras.or.id/v3/wp-content/uploads/2018/07/BukuBebras2017_SMP.pdf"
                                target="_blank" class="link-bebras hover:underline hover:text-gray-600">Buku Bebras Penggalang 2017</a></li>
                        <li>📘 <a href="https://bebras.or.id/v3/wp-content/uploads/2019/09/BukuBebras2018%20SMP%20v.5.pdf"
                                target="_blank" class="link-bebras hover:underline hover:text-gray-600">Buku Bebras Penggalang 2018</a></li>
                        <li>📘 <a
                                href="https://bebras.or.id/v3/wp-content/uploads/2024/10/Bebras-Indonesia-Book-2019-SMP-v.Okt_.2024.pdf"
                                target="_blank" class="link-bebras hover:underline hover:text-gray-600">Buku Bebras Penggalang 2019</a></li>
                        <li>📘 <a
                                href="https://bebras.or.id/v3/wp-content/uploads/2024/10/Bebras-Indonesia-Book-2020-SMP-OK-Okt2024.pdf"
                                target="_blank" class="link-bebras hover:underline hover:text-gray-600">Buku Bebras Penggalang 2020</a></li>
                    </ul>
                </div>

                <!-- Penegak -->
                <div class="bg-white border border-gray-100 rounded-2xl shadow-md hover:shadow-xl transition-all p-6">
                    <div class="flex items-center gap-4 mb-5">
                        <img src="{{ asset('img/buku2020-sma.jpg') }}" alt="Penegak Logo"
                            class="w-16 h-16 object-contain rounded-lg bg-red-50 p-2">
                        <h2 class="text-2xl font-bold text-bebrasBlue">Bebras Penegak (SMA/SMK/MA/MAK)</h2>
                    </div>
                    <ul class="space-y-3 pl-2 text-lg">
                        <li>📘 <a
                                href="https://bebras.or.id/v3/wp-content/uploads/2019/10/Bebras-Challenge-2016_Penegak.pdf"
                                target="_blank" class="link-bebras hover:underline hover:text-gray-600">Buku Bebras Penegak 2016</a></li>
                        <li>📘 <a href="https://bebras.or.id/v3/wp-content/uploads/2018/07/BukuBebras2017_SMA.pdf"
                                target="_blank" class="link-bebras hover:underline hover:text-gray-600">Buku Bebras Penegak 2017</a></li>
                        <li>📘 <a href="https://bebras.or.id/v3/wp-content/uploads/2019/09/BukuBebras2018%20SMA%20v.5.pdf"
                                target="_blank" class="link-bebras hover:underline hover:text-gray-600">Buku Bebras Penegak 2018</a></li>
                        <li>📘 <a
                                href="https://bebras.or.id/v3/wp-content/uploads/2024/10/Bebras-Indonesia-Book-2019-SMA-v.Okt_.2024.pdf"
                                target="_blank" class="link-bebras hover:underline hover:text-gray-600">Buku Bebras Penegak 2019</a></li>
                        <li>📘 <a
                                href="https://bebras.or.id/v3/wp-content/uploads/2024/10/Bebras-Indonesia-Book-2020-SMA-OK-Okt2024.pdf"
                                target="_blank" class="link-bebras hover:underline hover:text-gray-600">Buku Bebras Penegak 2020</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    {{-- Custom Tailwind for links --}}
    <style>
        .link-bebras {
            @apply text-blue-600 font-medium hover:text-blue-800 hover:underline transition;
        }
    </style>
@endsection
