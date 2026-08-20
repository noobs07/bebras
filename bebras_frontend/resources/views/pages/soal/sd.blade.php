@extends('app')

@section('title', 'Contoh Soal Siaga Siswa SD')
@section('content')
    <div class="w-full px-4 py-10 ">
        <div class="bg-white rounded-lg  shadow-xl p-8  mx-auto">

            <!-- Header -->
            <div class="flex flex-col md:flex-row md:justify-between md:items-center border-b pb-6 mb-8 gap-6">
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 leading-tight">
                    Contoh Soal <span class="text-blue-600">SIAGA</span> untuk Siswa SD
                </h1>
                <img src="{{ asset('./img/b_countdown.jpg') }}" alt="Logo Bebras"
                    class="w-28 h-20 rounded-lg shadow-md object-cover mx-auto md:mx-0">
            </div>

            <!-- Soal -->
            <div class="space-y-6">
                <div>
                    <span class="text-sm font-medium text-orange-600 uppercase tracking-wide">Kategori 11-12</span>
                    <h2 class="text-2xl font-bold text-gray-800 mt-1">
                        Dress code untuk Berang-berang
                    </h2>
                </div>

                <div class="space-y-4">
                    <img src="{{ asset('/img/sd_1.jpg') }}" alt="Soal Berang-berang" class="rounded-lg shadow-md  mx-auto">

                    <p class="text-base font-semibold text-gray-700 bg-gray-100 p-4 rounded-xl shadow text-center">
                        👦 Kelompok Umur: <span class="text-blue-700">SD</span> &nbsp; | &nbsp;
                        🎯 Kesulitan: <span class="text-green-600">Mudah</span> &nbsp; | &nbsp;
                        📌 Kategori: <span class="text-purple-600">ALG, STRUC</span>
                    </p>

                    <p class="text-justify text-gray-800 leading-relaxed">
                        Berang-berang mempunyai sistem aturan berpakaian yang kompleks untuk menentukan penampilannya,
                        yaitu kombinasi dari pakaian. Manfaatkan gambar yang diberikan untuk menentukan aturan berpakaian
                        yang benar. <span class="font-semibold text-blue-700">Berang-berang yang mana yang tidak
                            berpakaian sesuai aturan?</span>
                    </p>

                    <img src="{{ asset('/img/sd_2.png') }}" alt="Pilihan Berang-berang"
                        class="rounded-lg shadow-md w-full md:w-[550px] h-auto mx-auto">
                </div>
            </div>

            <!-- Jawaban -->
            <!-- Jawaban -->
            <div class="mt-14">
                <h3 class="text-2xl font-extrabold text-gray-900 mb-6 text-center">🔎 Pilihan Jawaban</h3>
                <ul class="grid grid-cols-2 sm:grid-cols-4 gap-8">
                    <!-- Jawaban A -->
                    <li class="flex flex-col items-center">
                        <span class="text-lg font-bold text-blue-700 mb-2">A</span>
                        <img src="{{ asset('img/sd_a.png') }}" alt="Jawaban A"
                            class="rounded-xl shadow-lg hover:scale-110 hover:shadow-2xl transition-transform duration-300 border-4 border-blue-200">
                    </li>
                    <!-- Jawaban B -->
                    <li class="flex flex-col items-center">
                        <span class="text-lg font-bold text-blue-700 mb-2">B</span>
                        <img src="{{ asset('img/sd_b.png') }}" alt="Jawaban B"
                            class="rounded-xl shadow-lg hover:scale-110 hover:shadow-2xl transition-transform duration-300 border-4 border-blue-200">
                    </li>
                    <!-- Jawaban C -->
                    <li class="flex flex-col items-center">
                        <span class="text-lg font-bold text-blue-700 mb-2">C</span>
                        <img src="{{ asset('img/sd_c.png') }}" alt="Jawaban C"
                            class="rounded-xl shadow-lg hover:scale-110 hover:shadow-2xl transition-transform duration-300 border-4 border-blue-200">
                    </li>
                    <!-- Jawaban D -->
                    <li class="flex flex-col items-center">
                        <span class="text-lg font-bold text-blue-700 mb-2">D</span>
                        <img src="{{ asset('img/sd_d.png') }}" alt="Jawaban D"
                            class="rounded-xl shadow-lg hover:scale-110 hover:shadow-2xl transition-transform duration-300 border-4 border-blue-200">
                    </li>
                </ul>
            </div>

            <!-- Solusi -->
            <div class="mt-16 bg-white p-8 rounded-2xl shadow-xl">
                <h4 class="text-2xl font-extrabold text-blue-900 mb-4">✅ Solusi</h4>
                <p class="text-gray-800 leading-relaxed text-lg">
                    <span class="font-semibold text-red-600">Berang-berang kedua (jawaban B)</span> berpakaian tidak sesuai
                    aturan.
                    Dia seharusnya memakai <span class="text-blue-700 font-semibold">topi biru</span> dan bukan topi merah.
                </p>

                <p class="mt-6 text-gray-700 leading-relaxed text-lg">
                    <span class="font-semibold text-green-600">💡 Ini Informatika:</span>
                    Soal ini adalah contoh penggunaan <span class="font-semibold">pohon keputusan</span> dan
                    <span class="font-semibold">pengenalan pola</span>.
                    Pohon keputusan berbentuk diagram bercabang untuk menggambarkan kemungkinan hasil dari sebuah aturan.
                    Pada setiap simpul, Anda harus memilih cabang yang sesuai untuk mendapatkan hasil yang benar.
                </p>
            </div>
        </div>
    </div>
@endsection
