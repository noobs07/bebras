@extends('app')

@section('title', 'Apa itu Berpikir Komputasional?')

@section('content')
    <div class="w-full p-4">
        <div class="grid grid-cols-12 gap-4">

            <div class="col-span-12 p-6 rounded-lg shadow flex flex-col md:flex-row w-full bg-[#BFD8AF]">

                <div class="flex-1 md:pr-6">
                    <h1 class="text-3xl md:text-4xl font-bold mb-4 mt-3">
                        Apa itu Berpikir Komputasional?
                    </h1>
                    <p class="text-gray-700 text-justify text-xl">
                        Berpikir komputasional (Computational Thinking) adalah metode menyelesaikan persoalan
                        dengan menerapkan teknik ilmu komputer (informatika). Tantangan Bebras menyajikan soal-soal
                        yang mendorong siswa untuk berpikir kreatif dan kritis dalam menyelesaikan persoalan dengan
                        menerapkan konsep-konsep berpikir komputasional.
                    </p>
                </div>

                <div class="mt-4 md:mt-0 md:ml-6 flex justify-center items-center">
                    <img src="{{ asset('img/brain.png') }}" alt="Gambar contoh"
                        class="w-full max-w-[150px] h-auto object-cover rounded-lg ">
                </div>
            </div>
        </div>
    </div>

@endsection
