@extends('app')

@section('title', $menu?->judul ?? 'Pembahasan Soal')
@section('content')
    <div class="w-full px-4 py-10">
        <div class="bg-gradient-to-br from-blue-50 via-white to-purple-50 rounded-3xl shadow-xl p-8 max-w-7xl mx-auto">

            <!-- Header -->
            <div class="border-b pb-6 mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight">
                        {{ $menu?->judul ?? '📚 Pembahasan Soal Bebras' }}
                    </h1>
                    @if($menu?->body)
                    <div class="mt-3 text-gray-600 text-base leading-relaxed max-w-2xl">
                        {!! $menu->body !!}
                    </div>
                    @endif
                </div>
                @php
                    $logoSrc = $menu?->gambar
                        ? ((str_starts_with($menu->gambar, 'img/')) ? asset($menu->gambar) : asset('storage/' . $menu->gambar))
                        : asset('img/bebras.png');
                @endphp
                <img src="{{ $logoSrc }}" alt="Logo Bebras"
                    class="w-32 h-24 object-contain rounded-2xl shadow-md hover:scale-105 transition-transform duration-300">
            </div>

            <!-- Grid Container -->
            <div class="grid md:grid-cols-2 gap-10">

                <!-- SiKecil -->
                <div class="bg-white border border-gray-100 rounded-2xl shadow-md hover:shadow-xl transition-all p-6">
                    <div class="flex items-center gap-4 mb-5">
                        @php
                            $sikecilBooks = $books->get('sikecil', collect());
                            $sikecilCover = $sikecilBooks->first()?->cover_image ?? 'img/buku2020-sikecil.jpg';
                        @endphp
                        <img src="{{ (strpos($sikecilCover, 'img/') === 0) ? asset($sikecilCover) : asset('storage/' . $sikecilCover) }}" alt="SiKecil Logo"
                            class="w-16 h-16 object-contain rounded-lg bg-blue-50 p-2">
                        <h2 class="text-2xl font-bold text-bebrasBlue">Bebras SiKecil (PAUD/TK)</h2>
                    </div>
                    <ul class="space-y-3 pl-2 text-lg">
                        @foreach ($sikecilBooks as $book)
                        <li>
                            📘 <a
                                href="{{ $book->pdf_link }}"
                                target="_blank"
                                class="text-blue-600 font-medium hover:text-blue-800 hover:underline transition">
                                {{ $book->judul }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Siaga -->
                <div class="bg-white border border-gray-100 rounded-2xl shadow-md hover:shadow-xl transition-all p-6">
                    <div class="flex items-center gap-4 mb-5">
                        @php
                            $siagaBooks = $books->get('siaga', collect());
                            $siagaCover = $siagaBooks->first()?->cover_image ?? 'img/buku2020-sd.jpg';
                        @endphp
                        <img src="{{ (strpos($siagaCover, 'img/') === 0) ? asset($siagaCover) : asset('storage/' . $siagaCover) }}" alt="Siaga Logo"
                            class="w-16 h-16 object-contain rounded-lg bg-green-50 p-2">
                        <h2 class="text-2xl font-bold text-bebrasBlue">Bebras Siaga (SD/MI)</h2>
                    </div>
                    <ul class="space-y-3 pl-2 text-lg">
                        @foreach ($siagaBooks as $book)
                        <li>📘 <a href="{{ $book->pdf_link }}"
                                target="_blank" class="text-blue-600 font-medium hover:text-blue-800 hover:underline transition">{{ $book->judul }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <!-- Penggalang -->
                <div class="bg-white border border-gray-100 rounded-2xl shadow-md hover:shadow-xl transition-all p-6">
                    <div class="flex items-center gap-4 mb-5">
                        @php
                            $penggalangBooks = $books->get('penggalang', collect());
                            $penggalangCover = $penggalangBooks->first()?->cover_image ?? 'img/buku2020-smp.jpg';
                        @endphp
                        <img src="{{ (strpos($penggalangCover, 'img/') === 0) ? asset($penggalangCover) : asset('storage/' . $penggalangCover) }}" alt="Penggalang Logo"
                            class="w-16 h-16 object-contain rounded-lg bg-yellow-50 p-2">
                        <h2 class="text-2xl font-bold text-bebrasBlue">Bebras Penggalang (SMP/MTs)</h2>
                    </div>
                    <ul class="space-y-3 pl-2 text-lg">
                        @foreach ($penggalangBooks as $book)
                        <li>📘 <a href="{{ $book->pdf_link }}"
                                target="_blank" class="text-blue-600 font-medium hover:text-blue-800 hover:underline transition">{{ $book->judul }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <!-- Penegak -->
                <div class="bg-white border border-gray-100 rounded-2xl shadow-md hover:shadow-xl transition-all p-6">
                    <div class="flex items-center gap-4 mb-5">
                        @php
                            $penegakBooks = $books->get('penegak', collect());
                            $penegakCover = $penegakBooks->first()?->cover_image ?? 'img/buku2020-sma.jpg';
                        @endphp
                        <img src="{{ (strpos($penegakCover, 'img/') === 0) ? asset($penegakCover) : asset('storage/' . $penegakCover) }}" alt="Penegak Logo"
                            class="w-16 h-16 object-contain rounded-lg bg-red-50 p-2">
                        <h2 class="text-2xl font-bold text-bebrasBlue">Bebras Penegak (SMA/SMK/MA/MAK)</h2>
                    </div>
                    <ul class="space-y-3 pl-2 text-lg">
                        @foreach ($penegakBooks as $book)
                        <li>📘 <a href="{{ $book->pdf_link }}"
                                target="_blank" class="text-blue-600 font-medium hover:text-blue-800 hover:underline transition">{{ $book->judul }}</a></li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection
