@extends('app')

@section('title', 'Search Results for: ' . $keyword)

@section('content')
</div> {{-- Close default app.blade.php container header --}}
</section>
</main>

{{-- Dark Search Results Header Banner --}}
<div class="bg-[#333333] text-white py-12 px-4 shadow-inner">
    <div class="max-w-5xl mx-auto text-center">
        <h1 class="text-3xl md:text-5xl font-bold tracking-tight mb-3">
            <span class="text-orange-500">S</span>earch Results for: {{ $keyword }}
        </h1>
        <div class="flex items-center justify-center text-sm md:text-base space-x-2 text-gray-300">
            <a href="{{ route('home') }}" class="text-orange-400 hover:text-orange-300 font-medium hover:underline">Home</a>
            <span>/</span>
            <span class="text-gray-300">Search results for "{{ $keyword }}"</span>
        </div>
    </div>
</div>

{{-- Main Results Section (No Sidebar) --}}
<div class="bg-[#f8f9fa] py-10 min-h-[55vh]">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="w-full space-y-6">
            @if(count($results) > 0)
                @foreach($results as $item)
                    <div class="bg-white p-6 md:p-8 rounded-sm shadow-sm border border-gray-200/80 hover:shadow-md transition-shadow">
                        <h2 class="text-2xl font-bold text-orange-600 hover:text-orange-700 transition-colors mb-3">
                            <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>
                        </h2>
                        <p class="text-gray-600 text-sm md:text-base leading-relaxed mb-5">
                            {{ $item['excerpt'] }}
                        </p>
                        <a href="{{ $item['url'] }}" class="inline-flex items-center text-orange-600 hover:text-orange-700 font-bold text-sm tracking-wider uppercase transition-colors">
                            LANJUT <i class="fas fa-arrow-circle-right ms-1.5 text-xs"></i>
                        </a>
                    </div>
                @endforeach
            @else
                <div class="bg-white p-8 md:p-12 rounded-sm shadow-sm border border-gray-200 text-center max-w-2xl mx-auto">
                    <div class="w-16 h-16 bg-orange-50 text-orange-500 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Halaman Tidak Ditemukan</h3>
                    <p class="text-gray-600 text-sm md:text-base mb-6">
                        Maaf, tidak ada halaman atau informasi yang cocok dengan kata kunci <span class="font-semibold text-gray-900 bg-orange-50 px-2 py-0.5 rounded border border-orange-100">"{{ $keyword }}"</span>.
                    </p>
                    <form action="{{ route('search') }}" method="GET" class="max-w-md mx-auto">
                        <div class="flex gap-2">
                            <input type="text" name="search" value="{{ $keyword }}" placeholder="Cari kata kunci lain..."
                                class="w-full px-4 py-2.5 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm text-gray-800">
                            <button type="submit" class="px-5 py-2.5 bg-orange-500 text-white font-semibold rounded hover:bg-orange-600 text-sm transition shadow-sm">
                                Cari
                            </button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>

<main class="hidden"><div><section class="hidden">
@endsection
