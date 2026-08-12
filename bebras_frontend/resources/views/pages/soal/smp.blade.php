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
                <img src="{{ asset('./img/b_countdown.jpg') }}" alt="Logo Bebras"
                    class="w-28 h-20 md:w-36 md:h-24 rounded-xl shadow-md object-cover mx-auto md:mx-0">
            </div>

            <!-- Soal -->
            <div class="space-y-6">
                <!-- Judul Soal -->
                <div>
                    <span class="text-sm font-semibold text-orange-600 uppercase tracking-wider">Kategori Usia 15-16</span>
                    <h2 class="text-3xl font-bold text-gray-800 mt-1 text-center">
                        Teman
                    </h2>
                </div>

                <!-- Gambar utama -->
                <div class="space-y-4">
                    <img src="{{ asset('/img/smp_1.png') }}" alt="Soal SMP"
                        class="rounded-2xl shadow-lg mx-auto w-52 h-52 object-contain bg-white">

                    <!-- Info Soal -->

                    <p class="text-base font-semibold text-gray-700 bg-gray-100 p-4 rounded-xl shadow text-center">
                        👦 Kelompok Umur: <span class="text-blue-700">SMP</span> &nbsp; | &nbsp;
                        🎯 Kesulitan: <span class="text-green-600">Menengah</span> &nbsp; | &nbsp;
                        📌 Kategori: <span class="text-purple-600">STRUC, DOC</span>
                    </p>

                    <!-- Narasi -->
                    <p class="text-justify text-gray-800 leading-relaxed">
                        Lucia dan teman-temannya terdaftar di sebuah jaringan media sosial, yang digambarkan sebagai
                        “jaringan” berikut:
                    </p>

                    <!-- Gambar graf -->
                    <img src="{{ asset('/img/smp_2.png') }}" alt="Graf Pertemanan"
                        class="rounded-xl shadow-md w-full md:w-[600px] h-auto mx-auto">
                </div>

                <!-- Pertanyaan -->
                <div class="bg-white p-6 rounded-2xl shadow space-y-4">
                    <p class="text-gray-800 leading-relaxed">
                        Sebuah garis berarti pertemanan antara dua orang. Contohnya Monica adalah teman Lucia tetapi Alex
                        bukan
                        teman Lucia. Aturan yang berlaku adalah:
                    </p>
                    <ul class="list-disc pl-6 text-gray-700 space-y-1">
                        <li>Jika seseorang berbagi foto dengan temannya, maka temannya itu dapat mengomentarinya.</li>
                        <li>Jika seseorang memberi komentar pada sebuah foto, maka semua teman-temannya dapat melihat
                            komentar
                            dan foto tersebut.</li>
                    </ul>
                    <p class="text-gray-800">
                        Lucia mengunggah sebuah foto. Dengan siapa dia harus berbagi agar Jacob tidak dapat melihatnya?
                    </p>

                    <!-- Pilihan Jawaban -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 font-semibold">
                        <button class="p-3 rounded-lg bg-blue-100 hover:bg-blue-200">A. Dana, Michael, Eve</button>
                        <button class="p-3 rounded-lg bg-blue-100 hover:bg-blue-200">B. Dana, Eve, Monica</button>
                        <button class="p-3 rounded-lg bg-blue-100 hover:bg-blue-200">C. Michael, Eve, Jacob</button>
                        <button class="p-3 rounded-lg bg-blue-100 hover:bg-blue-200">D. Michael, Peter, Monica</button>
                    </div>
                </div>

                <!-- Solusi -->
                <div class="bg-gradient-to-r from-purple-100 to-blue-100 p-6 rounded-2xl shadow space-y-4">
                    <h3 class="text-2xl font-extrabold text-purple-700 flex items-center gap-2">
                        💡 Solusi Informatika
                    </h3>

                    <p class="text-gray-800 leading-relaxed">
                        <span class="font-semibold text-blue-700">Ini Informatika!</span><br>
                        Salah satu aspek informatika yang hendak disampaikan melalui soal ini adalah mengenai
                        <span class="font-semibold text-purple-700">struktur</span>.
                    </p>

                    <div class="bg-white p-4 rounded-xl shadow space-y-2">
                        <p class="text-gray-700">
                            Struktur yang digunakan untuk menggambarkan relasi pertemanan dari Lucia disebut
                            <span class="font-semibold text-blue-700">graf</span>.
                        </p>
                        <ul class="list-disc pl-6 text-gray-700 space-y-1">
                            <li><span class="font-semibold">Node</span> → menyatakan orang.</li>
                            <li><span class="font-semibold">Edge (garis)</span> → menyatakan relasi teman.</li>
                        </ul>
                        <p class="text-gray-700">
                            Graf sederhana sering dipakai untuk menggambarkan <span class="italic">jaringan sosial</span>.
                        </p>
                    </div>

                    <div class="bg-white p-4 rounded-xl shadow space-y-2">
                        <h4 class="text-lg font-semibold text-green-700">🌐 Pentingnya Privasi</h4>
                        <p class="text-gray-700 leading-relaxed">
                            Mengelola akses ke informasi pribadi sangat penting saat ini.
                            Ketika seseorang mengunggah foto pribadi ke Internet, ia harus berpikir hati-hati tentang siapa
                            yang mungkin melihat gambar.
                        </p>
                        <p class="text-gray-700 leading-relaxed">
                            Karena sangat sulit untuk benar-benar mengontrol siapa yang bisa melihat gambar, maka
                            <span class="font-semibold text-red-600">yang terbaik adalah tidak pernah meng-upload gambar ke
                                internet</span>
                            kecuali gambar tersebut memang pantas dipajang di ruang publik, misalnya di sekolah atau halte
                            bus.
                        </p>
                    </div>

                    <div class="bg-white p-4 rounded-xl shadow space-y-2">
                        <h4 class="text-lg font-semibold text-indigo-700">⚙️ Analisis Graf dalam Kehidupan Nyata</h4>
                        <p class="text-gray-700">
                            Program komputer dapat menganalisis graf untuk berbagai keperluan, contohnya:
                        </p>
                        <ul class="list-disc pl-6 text-gray-700 space-y-1">
                            <li>📊 <span class="font-semibold">Menganalisis jaringan sosial</span> seperti contoh di atas.
                            </li>
                            <li>🛰️ <span class="font-semibold">Aplikasi GPS</span> → persimpangan jalan sebagai node, jalan
                                sebagai edge.</li>
                            <li>🚗 <span class="font-semibold">Mencari jalur terpendek</span> antara dua tempat.</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
