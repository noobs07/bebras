@extends('app')
@section('title', 'Tujuan Kami')

@section('content')
    <div class="w-full p-4">
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12 p-6 rounded-lg shadow flex flex-col md:flex-row w-full bg-[#A8F1FF]">

                <!-- Kiri: Konten -->
                <div class="flex-1 md:pr-6">
                    <div class="flex flex-col md:flex-row items-center md:items-start md:justify-between gap-4 mb-5">
                        <div class="flex-1">
                            <h1 class="text-3xl md:text-4xl font-bold mb-4 mt-3">
                                Tujuan Kami
                            </h1>
                        </div>
                        <div class="flex-shrink-0">
                            <img src="{{ asset('img/goal.png') }}" alt="Tujuan"
                                class="w-full max-w-[90px] h-auto object-cover rounded-lg">
                        </div>
                    </div>

                    <!-- Paragraf -->
                    <p class="text-gray-700 text-justify text-md">
                        Tujuan utamanya adalah untuk mempromosikan informatika dan berpikir komputasi kepada para guru dan
                        anak-anak muda khususnya, di kalangan pengambil keputusan di bidang pendidikan, dan masyarakat luas.
                    </p>
                    <p class="text-gray-700 text-justify text-md mt-4">
                        Komputer dan perangkat teknologi lainnya saat ini menjadi penting untuk membuat masyarakat umum
                        mengetahui komputasi atau informatika, tidak hanya sebagai teknologi, tetapi juga sebagai ilmu untuk
                        mendidik mereka dan membuat pengalaman mereka dengan teknologi yang lebih baik.
                    </p>

                    <!-- Daftar Tujuan -->
                    <ul class="grid gap-4 sm:grid-cols-2 mt-6">
                        <li
                            class="group relative overflow-hidden rounded-xl border border-gray-300 bg-white p-4 shadow-sm transition hover:shadow-md">
                            <h3 class="font-semibold text-gray-800">🌱 Menumbuhkan kreativitas & berpikir komputasi</h3>
                            <p class="mt-1 text-sm text-gray-600">
                                Mendorong cara berpikir terstruktur, eksploratif, dan berbasis data.
                            </p>
                        </li>
                        <li
                            class="group relative overflow-hidden rounded-xl border border-gray-300 bg-white p-4 shadow-sm transition hover:shadow-md">
                            <h3 class="font-semibold text-gray-800">💡 Pemahaman teknologi informasi</h3>
                            <p class="mt-1 text-sm text-gray-600">
                                Konsep dipetakan ke praktik agar lebih mudah diserap.
                            </p>
                        </li>
                        <li
                            class="group relative overflow-hidden rounded-xl border border-gray-300 bg-white p-4 shadow-sm transition hover:shadow-md">
                            <h3 class="font-semibold text-gray-800">🚀 Antusiasme dalam belajar</h3>
                            <p class="mt-1 text-sm text-gray-600">
                                Aktivitas berbasis proyek membuat siswa lebih semangat.
                            </p>
                        </li>
                        <li
                            class="group relative overflow-hidden rounded-xl border border-gray-300 bg-white p-4 shadow-sm transition hover:shadow-md">
                            <h3 class="font-semibold text-gray-800">🖥️ Literasi digital sejak dini</h3>
                            <p class="mt-1 text-sm text-gray-600">
                                Melibatkan siswa memanfaatkan komputer & aplikasi sejak sekolah dasar.
                            </p>
                        </li>
                        <li
                            class="group relative overflow-hidden rounded-xl border border-gray-300 bg-white p-4 shadow-sm transition hover:shadow-md sm:col-span-2">
                            <h3 class="font-semibold text-gray-800">📘 Manfaat TI untuk semua mata pelajaran</h3>
                            <p class="mt-1 text-sm text-gray-600">
                                Membantu memahami, menganalisis, dan mempresentasikan berbagai pelajaran.
                            </p>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

@endsection
