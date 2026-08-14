@extends('app')

@section('title', 'Sejarah Bebras Indonesia')

@section('content')
    <div class="w-full px-4 py-10 bg-gradient-to-br from-[#F8FAFC] to-[#EEF2FF] dark:from-gray-900 dark:to-gray-800">
        <div class="max-w-5xl mx-auto">

            <!-- Header -->
            <div class="text-center mb-10">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-gray-100">
                    {{ $page->judul }}
                </h2>
                <p class="mt-2 text-gray-600 dark:text-gray-300 text-sm md:text-base">
                    {{ $page->konten }}
                </p>
            </div>

            <!-- Timeline -->
            <div class="relative border-l-4 border-indigo-500 pl-6 space-y-8">
                @foreach ($page->items->where('tipe', 'timeline')->sortBy('urutan') as $item)
                <!-- Item -->
                <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-md hover:shadow-lg transition">
                    <span class="absolute -left-3 top-6 w-6 h-6 rounded-full bg-indigo-500 ring-4 ring-indigo-200"></span>
                    <h3 class="text-lg md:text-xl font-semibold text-gray-800 dark:text-gray-100">
                        {{ $item->judul }}
                    </h3>
                    <div class="mt-2 text-gray-700 dark:text-gray-300 text-justify">
                        {!! $item->deskripsi !!}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
