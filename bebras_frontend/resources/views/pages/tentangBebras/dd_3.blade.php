@extends('app')
@section('title', $page->judul)

@section('content')
    <div class="w-full p-4">
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12 p-6 rounded-lg shadow flex flex-col md:flex-row w-full bg-[#A8F1FF]">

                <!-- Kiri: Konten -->
                <div class="flex-1 md:pr-6">
                    <div class="flex flex-col md:flex-row items-center md:items-start md:justify-between gap-4 mb-5">
                        <div class="flex-1">
                            <h1 class="text-3xl md:text-4xl font-bold mb-4 mt-3">
                                {{ $page->judul }}
                            </h1>
                        </div>
                        @if ($page->gambar)
                        <div class="flex-shrink-0">
                            <img src="{{ (strpos($page->gambar, 'img/') === 0) ? asset($page->gambar) : asset('storage/' . $page->gambar) }}" alt="{{ $page->judul }}"
                                class="w-full max-w-[90px] h-auto object-cover rounded-lg">
                        </div>
                        @endif
                    </div>

                    <!-- Paragraf -->
                    <div class="text-gray-700 text-justify text-md">
                        {!! $page->konten !!}
                    </div>

                    <!-- Daftar Tujuan -->
                    <ul class="grid gap-4 sm:grid-cols-2 mt-6">
                        @foreach ($page->items as $index => $item)
                        <li
                            class="group relative overflow-hidden rounded-xl border border-gray-300 bg-white p-4 shadow-sm transition hover:shadow-md {{ $index === 4 ? 'sm:col-span-2' : '' }}">
                            <h3 class="font-semibold text-gray-800">{{ $item->icon }} {{ $item->judul }}</h3>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ $item->deskripsi }}
                            </p>
                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>

@endsection
