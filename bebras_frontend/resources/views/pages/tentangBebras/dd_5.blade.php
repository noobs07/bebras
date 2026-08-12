@extends('app')
@section('title', 'Kegiatan Bebras')

@section('content')
    <div class="w-full p-4">
        <div class="col-span-12 p-6 rounded-lg shadow bg-white dark:bg-gray-900">
            <!-- Header -->
            <div class="flex flex-col md:flex-row items-center md:justify-between gap-4 mb-6">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-gray-100">
                    Kegiatan Bebras Indonesia
                </h2>
                <img src="{{ asset('img/logo.jpg') }}" alt="Kegiatan" class="w-full max-w-[90px] h-auto object-contain">
            </div>

            <!-- Intro -->
            <p class="text-gray-700 dark:text-gray-300 text-justify mb-6">
                Kegiatan Bebras Indonesia terdiri dari beberapa agenda rutin dan tambahan untuk
                mendukung pengembangan berpikir komputasional bagi guru, siswa, dan masyarakat luas.
            </p>

            <!-- List Kegiatan -->
            <ul class="grid gap-4 sm:grid-cols-2">
                <li class="p-5 rounded-xl border border-gray-200 bg-[#F8FAE5] shadow-sm hover:shadow-md transition">
                    <h3 class="font-semibold text-lg text-gray-800">📌 Lokakarya Nasional</h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Dilaksanakan setahun sekali untuk koordinasi komite nasional dengan mitra,
                        sekaligus menetapkan soal-soal nasional.
                    </p>
                </li>
                <li class="p-5 rounded-xl border border-gray-200 bg-[#EAF4FC] shadow-sm hover:shadow-md transition">
                    <h3 class="font-semibold text-lg text-gray-800">👩‍🏫 Lokakarya untuk Guru</h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Membekali guru agar dapat memperkenalkan konsep komputasi dan tantangan Bebras ke siswa.
                    </p>
                </li>
                <li class="p-5 rounded-xl border border-gray-200 bg-[#FFF2F2] shadow-sm hover:shadow-md transition">
                    <h3 class="font-semibold text-lg text-gray-800">🧩 Tantangan Bebras</h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Diselenggarakan sesuai jadwal komite internasional (Bebras Week), biasanya minggu kedua atau ketiga
                        November.
                    </p>
                </li>
                <li class="p-5 rounded-xl border border-gray-200 bg-[#F0F4FF] shadow-sm hover:shadow-md transition">
                    <h3 class="font-semibold text-lg text-gray-800">🔄 Kegiatan Tambahan</h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Misalnya putaran kedua tingkat nasional, pengumpulan data, pengembangan makalah penelitian, dan
                        lainnya.
                    </p>
                </li>
            </ul>

            <!-- Kategori Peserta -->
            <div class="mt-10 bg-bebras">
                <h3 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-gray-100">
                    📚 Kategori Tantangan Bebras
                </h3>
                <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-4">
                    <div
                        class="p-4 rounded-xl bg-gradient-to-br from-amber-100 to-yellow-200 shadow hover:scale-105 transition">
                        <h4 class="font-bold text-gray-800">SiKecil</h4>
                        <p class="text-sm text-gray-700">Untuk siswa hingga kelas 3 SD/MI</p>
                    </div>
                    <div
                        class="p-4 rounded-xl bg-gradient-to-br from-green-100 to-emerald-200 shadow hover:scale-105 transition">
                        <h4 class="font-bold text-gray-800">Siaga</h4>
                        <p class="text-sm text-gray-700">Untuk siswa kelas 4–6 SD/MI</p>
                    </div>
                    <div
                        class="p-4 rounded-xl bg-gradient-to-br from-sky-100 to-blue-200 shadow hover:scale-105 transition">
                        <h4 class="font-bold text-gray-800">Penggalang</h4>
                        <p class="text-sm text-gray-700">Untuk siswa SMP/MTs</p>
                    </div>
                    <div
                        class="p-4 rounded-xl bg-gradient-to-br from-pink-100 to-rose-200 shadow hover:scale-105 transition">
                        <h4 class="font-bold text-gray-800">Penegak</h4>
                        <p class="text-sm text-gray-700">Untuk siswa SMA/MA/SMK/MAK</p>
                    </div>
                </div>
            </div>

            <div class="flex-1 md:pr-6 mt-8 border p-2 rounded-lg bg-bebrasLightBlue">
                <p class="mt-2 text-md text-gray-600">
                    Banyak kegiatan tambahan yang dilaksanakan di antara kegiatan-kegiatan tersebut. Di tahun mendatang,
                    Bebras
                    Indonesia berencana untuk menyelenggarakan kegiatan-kegiatan yang dilakukan oleh negara anggota lainnya,
                    misalnya tantangan putaran kedua di tingkat nasional, mengumpulkan data dan mengembangkan makalah
                    penelitian, dan lain-lain.
                </p>
            </div>
        </div>
    </div>

@endsection
