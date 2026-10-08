@extends('app')

@section('title', 'Halaman Tidak Ditemukan - Bebras Indonesia')

@section('content')
<div class="w-full px-4 py-12 flex items-center justify-center min-h-[60vh]">
    <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 max-w-xl w-full text-center border border-gray-100">
        <!-- 404 Icon Illustration -->
        <div class="w-24 h-24 mx-auto mb-6 bg-red-50 rounded-full flex items-center justify-center text-red-500 shadow-inner">
            <i class="fas fa-search-minus text-4xl"></i>
        </div>

        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-3">
            Halaman Tidak Ditemukan
        </h1>

        @if(!empty($query))
            <p class="text-gray-600 mb-6">
                Maaf, tidak ada hasil atau halaman yang cocok dengan kata kunci: 
                <span class="font-semibold text-bebrasDarkBlue bg-blue-50 px-2.5 py-1 rounded-md border border-blue-100">"{{ $query }}"</span>
            </p>
        @else
            <p class="text-gray-600 mb-6">
                Maaf, halaman yang Anda cari tidak dapat ditemukan atau telah dipindahkan.
            </p>
        @endif

        <!-- Search input inside 404 page -->
        <form action="{{ route('search') }}" method="GET" class="mb-8">
            <div class="relative max-w-md mx-auto">
                <input type="text" name="search" value="{{ $query ?? '' }}"
                    class="w-full pl-10 pr-24 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-bebrasBlue focus:border-transparent text-gray-800 shadow-sm"
                    placeholder="Coba kata kunci lain..." required>
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                    <i class="fas fa-search"></i>
                </div>
                <button type="submit"
                    class="absolute right-1.5 top-1.5 bottom-1.5 px-4 bg-bebrasDarkBlue text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow">
                    Cari
                </button>
            </div>
        </form>

        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('home') }}"
                class="inline-flex items-center justify-center px-6 py-3 bg-bebrasBlue text-white font-semibold rounded-xl hover:bg-bebrasDarkBlue transition duration-200 shadow-md">
                <i class="fas fa-home mr-2"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection
