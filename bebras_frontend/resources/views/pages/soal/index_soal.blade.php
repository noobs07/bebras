@extends('app')

@section('title', 'Apa itu Soal Bebras?')

@section('content')
    <div class="w-full px-4 py-8">
        <div class="bg-white rounded-2xl shadow-lg p-8 max-w-6xl mx-auto">

            <!-- Header: Judul + Gambar -->
            <div class="flex flex-col md:flex-row md:justify-between md:items-center border-b pb-6 mb-8 gap-4">
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">
                    Soal Bebras
                </h1>
                <img src="{{ asset('./img/pilnas.png') }}" alt="Logo Bebras"
                    class="w-28 h-20 rounded-xl object-contain shadow-md">
            </div>

            <!-- Konten -->
            <div class="text-gray-800 space-y-6 leading-relaxed text-justify">

                <p>
                    Soal Bebras berperan penting bagi siswa (peserta kompetisi) maupun guru (sebagai penyusun soal).
                    Siswa <span class="font-semibold ">didorong</span> untuk berpikir tentang informatika, 
                    sedangkan guru harus berpikir tentang kaitan kehidupan sehari-hari dengan ilmu komputer. 
                    Soal yang kreatif dan menarik adalah tantangan utama dalam penyelenggaraan kompetisi Bebras.
                </p>

                <p>
                    Penyusun soal Bebras berusaha memilih soal yang menarik untuk memotivasi siswa dalam mengidentifikasi
                    persoalan informatika dan berpikir lebih dalam tentang teknologi. Mereka juga ingin menyajikan sebanyak mungkin
                    topik informatika dan pembelajaran komputer. Di bidang informatika, masih ada masalah silabus. Bahkan di
                    sekolah-sekolah di beberapa negara, sampai saat ini belum ada kesepakatan bersama materi apa yang harus
                    dimasukkan dalam silabus informatika yang terpadu, dengan memanfaatkan teknologi informasi.
                </p>

                <p>
                    Karena dirancang untuk siswa mulai kelas SD, Soal Bebras dibuat pendek dan harus mengandung konsep
                    informatika seperti:
                </p>

                <!-- Daftar Konsep -->
                <ul class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 ml-2">
                    <li class="flex items-start gap-3 bg-gray-50 rounded-xl px-4 py-3 shadow-sm">
                        <span class="w-2 h-2 mt-2 bg-bebrasBlue rounded-full"></span>
                        Sequential dan concurrent
                    </li>
                    <li class="flex items-start gap-3 bg-gray-50 rounded-xl px-4 py-3 shadow-sm">
                        <span class="w-2 h-2 mt-2 bg-bebrasBlue rounded-full"></span>
                        Struktur data seperti heaps, stacks, dan queues
                    </li>
                    <li class="flex items-start gap-3 bg-gray-50 rounded-xl px-4 py-3 shadow-sm">
                        <span class="w-2 h-2 mt-2 bg-bebrasBlue rounded-full"></span>
                        Pemodelan status (“states”), control flow, dan data flow
                    </li>
                    <li class="flex items-start gap-3 bg-gray-50 rounded-xl px-4 py-3 shadow-sm">
                        <span class="w-2 h-2 mt-2 bg-bebrasBlue rounded-full"></span>
                        Interaksi manusia-komputer
                    </li>
                    <li class="flex items-start gap-3 bg-gray-50 rounded-xl px-4 py-3 shadow-sm">
                        <span class="w-2 h-2 mt-2 bg-bebrasBlue rounded-full"></span>
                        Grafis; dll
                    </li>
                </ul>

                <p>
                    Serta mencakup juga konsep penggunaan informatika dalam aplikasi komputer yang dihadapi, serta etika
                    terkait penggunaan Teknologi Informasi dan Komunikasi (TIK). Hampir semua aspek ilmu komputer dan teknologi
                    informasi dapat menjadi topik yang menarik untuk dijadikan soal Bebras jika dinyatakan secara tepat. Lokakarya
                    Bebras internasional yang diselenggarakan setiap tahun selalu melahirkan soal-soal baru yang menarik.
                </p>

                <!-- Sub Judul -->
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mt-10 mb-4">
                    Kriteria Soal Bebras yang Baik
                </h2>

                <!-- Daftar Kriteria -->
                <ul class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 ml-2">
                    <li class="flex items-start gap-3 bg-green-50 border border-green-200 rounded-xl px-4 py-3 shadow-sm">
                        <span class="text-green-600 mt-1">✔</span> Mewakili konsep informatika
                    </li>
                    <li class="flex items-start gap-3 bg-green-50 border border-green-200 rounded-xl px-4 py-3 shadow-sm">
                        <span class="text-green-600 mt-1">✔</span> Mudah dimengerti
                    </li>
                    <li class="flex items-start gap-3 bg-green-50 border border-green-200 rounded-xl px-4 py-3 shadow-sm">
                        <span class="text-green-600 mt-1">✔</span> Dapat diselesaikan dalam waktu maksimal 3 menit
                    </li>
                    <li class="flex items-start gap-3 bg-green-50 border border-green-200 rounded-xl px-4 py-3 shadow-sm">
                        <span class="text-green-600 mt-1">✔</span> Pendek, misalnya disajikan pada satu halaman layar
                    </li>
                    <li class="flex items-start gap-3 bg-green-50 border border-green-200 rounded-xl px-4 py-3 shadow-sm">
                        <span class="text-green-600 mt-1">✔</span> Dapat diselesaikan di komputer tanpa alat tambahan
                    </li>
                    <li class="flex items-start gap-3 bg-green-50 border border-green-200 rounded-xl px-4 py-3 shadow-sm">
                        <span class="text-green-600 mt-1">✔</span> Bebas dari sistem tertentu
                    </li>
                    <li class="flex items-start gap-3 bg-green-50 border border-green-200 rounded-xl px-4 py-3 shadow-sm">
                        <span class="text-green-600 mt-1">✔</span> Menarik dan / atau lucu
                    </li>
                </ul>

                <p>
                    Supaya dapat dipecahkan dalam waktu 3 menit, setiap soal kompetisi Bebras fokus pada topik pembelajaran
                    informatika yang kecil. Soal harus memahami prinsip-prinsip, ide-ide dan konsep-konsep yang terlibat
                    dalam sistem informatika. Beberapa soal dibuat <span class="italic">interaktif</span>, di mana siswa
                    berinteraksi dengan objek di layar untuk menyelesaikan soal. Soal-soal interaktif bernuansa permainan dan mudah
                    dimengerti.
                </p>
            </div>
        </div>
    </div>
@endsection
