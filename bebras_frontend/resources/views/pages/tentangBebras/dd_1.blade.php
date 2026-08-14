@extends('app')

@section('title', $page->judul)

@section('content')
    <div class="w-full p-4">
        <div class="grid grid-cols-12 gap-4">

            <div class="col-span-12 p-6 rounded-lg shadow flex flex-col md:flex-row w-full bg-[#BFD8AF]">

                <div class="flex-1 md:pr-6">
                    <h1 class="text-3xl md:text-4xl font-bold mb-4 mt-3">
                        {{ $page->judul }}
                    </h1>
                    <div class="text-gray-700 text-justify text-xl">
                        {!! $page->konten !!}
                    </div>
                </div>

                @if ($page->gambar)
                <div class="mt-4 md:mt-0 md:ml-6 flex justify-center items-center">
                    <img src="{{ (strpos($page->gambar, 'img/') === 0) ? asset($page->gambar) : asset('storage/' . $page->gambar) }}" alt="{{ $page->judul }}"
                        class="w-full max-w-[150px] h-auto object-cover rounded-lg ">
                </div>
                @endif
            </div>
        </div>
    </div>

@endsection
