@extends('app')

@section('title', 'Beranda - Bebras Indonesia')

@section('content')
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Carousel -->
        <div id="default-carousel" class="relative" data-carousel="static">
            <div class="overflow-hidden relative h-56 rounded-lg sm:h-64 xl:h-80 m-2">
                @foreach ($banners as $index => $banner)
                <!-- Item {{ $index + 1 }} -->
                <div class="carousel-item duration-700 ease-in-out absolute inset-0 transition-all transform {{ $index === 0 ? 'opacity-1 z-10' : 'opacity-0' }}"
                    data-carousel-item>
                    <img src="{{ (strpos($banner->gambar, 'img/') === 0) ? asset($banner->gambar) : asset('storage/' . $banner->gambar) }}"
                        class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2 h-full"
                        alt="{{ $banner->judul }}">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                        <div class="text-center text-white px-4">
                            <h2 class="text-2xl md:text-3xl font-bold mb-2">{{ $banner->judul }}</h2>
                            <p class="max-w-2xl">{{ $banner->deskripsi }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Slider indicators -->
            <div class="flex absolute bottom-5 left-1/2 z-30 space-x-3 -translate-x-1/2">
                @foreach ($banners as $index => $banner)
                <button type="button" class="w-3 h-3 rounded-full {{ $index === 0 ? 'bg-white' : 'bg-white/50' }}" aria-label="Slide {{ $index + 1 }}"
                    data-carousel-slide-to="{{ $index }}"></button>
                @endforeach
            </div>

            <!-- Slider controls -->
            <button type="button"
                class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                data-carousel-prev>
                <span
                    class="inline-flex justify-center items-center w-8 h-8 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white">
                    <i class="fas fa-chevron-left text-white"></i>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button"
                class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                data-carousel-next>
                <span
                    class="inline-flex justify-center items-center w-8 h-8 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white">
                    <i class="fas fa-chevron-right text-white"></i>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>

    </div>

    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 md:p-8">
                    <div class="flex flex-row justify-between">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6 flex items-center">
                            <div class="h-1 w-24 bg-bebrasBlue mr-3"></div>
                            Tentang Bebras
                        </h2>
                        <div class=" items-start mid:w-1/5 ms-5">
                            <img src="{{ (strpos($aboutLogo, 'img/') === 0) ? asset($aboutLogo) : asset('storage/' . $aboutLogo) }}" alt="" class="w-20 h-20">
                        </div>
                    </div>


                    <div class="flex flex-col md:flex-row">

                        <div class="w-full md:w-4/5 pr-0 md:pr-8">
                            {!! $aboutContent !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 bg-bebrasLightBlue rounded-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl md:text-3xl font-bold text-center text-gray-800 mb-12">Kegiatan Bebras Indonesia?</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 place-items-center">
                @foreach ($kegiatans as $kegiatan)
                <div class="bg-white w-80 p-6 rounded-xl shadow-md text-center card-hover">
                    <div class="w-full h-48 mb-4 overflow-hidden rounded-lg">
                        <img src="{{ (strpos($kegiatan->gambar, 'img/') === 0) ? asset($kegiatan->gambar) : asset('storage/' . $kegiatan->gambar) }}" alt="{{ $kegiatan->judul }}"
                            class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $kegiatan->judul }}</h3>
                    <p class="text-gray-600 text-sm">
                        {{ $kegiatan->deskripsi }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="flex flex-col md:flex-row items-center p-6 mt-4 rounded-md">

        <div class="w-full md:w-4/4 text-center md:text-left md:pl-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800">{{ $ctaTitle }}</h1>
            <p class="mt-2 text-lg text-gray-600">{{ $ctaDescription }}</p>
            <div class="mt-4 flex flex-wrap justify-center md:justify-start gap-3">
                <a href="{{ $ctaLink }}"
                    class="border border-bebrasBlue text-bebrasBlue px-5 py-2 rounded-full text-sm font-semibold inline-flex items-center hover:text-[#F97A00] hover:border-[#F97A00] active:scale-95 active:text-[#F97A00] active:border-[#F97A00]">
                    <span>Info Lengkap</span>
                    <i class="fas fa-info-circle ml-2 text-xs"></i>
                </a>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('js/script.js') }}"></script>
    @endpush

@endsection
