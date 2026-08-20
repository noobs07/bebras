@extends('app')

@section('title', 'Apa itu Bebras?')

@section('content')
    <div class="w-full p-4">
        <div class="grid grid-cols-12 gap-4">

            <div class="col-span-12 p-6 rounded-lg shadow flex flex-col md:flex-row w-full bg-[#A8F1FF]">

                <div class="flex-1 md:pr-6">
                    <div class="flex flex-col md:flex-row items-center md:items-start md:justify-between gap-4 mb-5">
                        <div class="flex-1">
                            <h1 class="text-3xl md:text-4xl font-bold mb-4 mt-3">
                                Apa itu Bebras?
                            </h1>
                        </div>

                        <div class="flex-shrink-0">
                            <img src="{{ asset('img/pilnas.png') }}" alt="Gambar contoh"
                                class="w-full max-w-[120px] h-auto object-cover rounded-lg">
                        </div>
                    </div>


                    <p class="text-gray-700 text-justify text-md">
                        Secara harfiah, “Bebras” adalah kata dalam bahasa Lithuania, yang berarti “berang-berang” dalam
                        bahasa Indonesia. Prof. Valentina Dagiene dari Universitas Vilnius, Lithuania adalah yang
                        mencetuskan gagasan Bebras Computational Thinking Challenge, yang saat ini diikuti oleh lebih dari
                        55 negara di dunia.

                        Bebras adalah sebuah inisiatif internasional yang tujuannya adalah untuk mempromosikan Computational
                        Thinking (Berpikir dengan landasan Komputasi atau Informatika), di kalangan guru dan murid mulai
                        tingkat SD, serta untuk masyarakat luas.


                    </p>
                    <p class="text-gray-700 text-justify text-md mt-4">
                        Cara untuk promosi adalah dengan menyelenggarakan kegiatan kompetisi secara daring (on line), yang
                        disebut sebagai “Tantangan Bebras”. Tantangan Bebras bukan hanya sekedar untuk menang. Selain untuk
                        berlomba, tantangan Bebras juga bertujuan agar siswa belajar Computational Thinking selama maupun
                        setelah lomba.

                        Di Indonesia, kompetisi dapat dilaksanakan di sekolah yang mempunyai cukup komputer, atau di
                        universitas pembina.

                        Selama Kompetisi, siswa harus memberikan solusi untuk persoalan yang disebut “Soal Bebras”.
                        Soal-soal yang bertema komputasi/informatika ini dirancang semenarik mungkin, dan seharusnya dapat
                        dijawab oleh siswa tanpa pengetahuan sebelumnya tentang komputasi atau informatika.

                        Setiap soal Bebras mengandung aspek komputasi atau informatika dan dimaksudkan untuk menguji bakat
                        peserta untuk berpikir komputasi atau informatika. Untuk menjawab soal-soal Bebras, secara alamiah,
                        siswa dituntut untuk berpikir terkait dengan informasi, struktur diskrit, komputasi, pengolahan
                        data, serta harus menggunakan konsep algoritmik.
                    </p>
                </div>


            </div>
        </div>
    </div>

@endsection
