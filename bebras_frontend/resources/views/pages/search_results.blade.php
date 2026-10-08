@extends('app')

@section('title', 'Hasil Pencarian: ' . $keyword)

@section('content')
</div> {{-- Close default app.blade.php container header --}}
</section>
</main>

{{-- ══════════════════════════════════════════════════════ --}}
{{-- HERO HEADER — warna Bebras biru/cyan                   --}}
{{-- ══════════════════════════════════════════════════════ --}}
<div class="relative overflow-hidden bg-gradient-to-r from-[#063B5C] via-[#087E9B] to-[#00CAFF] py-12 px-4 shadow-xl">
    {{-- Decorative bubbles --}}
    <div class="absolute -left-16 -top-16 h-52 w-52 rounded-full bg-white/10 pointer-events-none"></div>
    <div class="absolute -right-10 -bottom-20 h-64 w-64 rounded-full bg-[#F7C948]/20 pointer-events-none"></div>

    <div class="relative z-10 max-w-5xl mx-auto text-center space-y-3">
        {{-- Badge --}}
        <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-md border border-white/20 px-4 py-1 rounded-full mb-1">
            <i class="fa-solid fa-magnifying-glass text-xs text-[#F7C948]"></i>
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-cyan-100">Hasil Pencarian</span>
        </div>

        <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight text-white leading-tight drop-shadow-sm">
            Hasil untuk: <span class="text-[#F7C948]">{{ $keyword }}</span>
        </h1>

        {{-- Breadcrumb --}}
        <div class="flex items-center justify-center gap-1.5 text-sm text-sky-100/80 pt-1">
            <a href="{{ route('home') }}" class="hover:text-white font-medium transition-colors">Home</a>
            <span class="text-white/40">/</span>
            <span>Pencarian &ldquo;{{ $keyword }}&rdquo;</span>
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════════════════ --}}
{{-- RESULTS SECTION                                         --}}
{{-- ══════════════════════════════════════════════════════ --}}
<div class="bg-gradient-to-br from-[#F7FBFF] via-white to-[#EAF4FC] py-10 min-h-[50vh]">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        @if(count($results) > 0)
            {{-- Result count info --}}
            <div class="flex items-center gap-2 mb-6">
                <span class="w-1.5 h-5 rounded-full bg-[#00CAFF] inline-block"></span>
                <p class="text-sm text-slate-500 font-medium">
                    Ditemukan <span class="font-bold text-[#063B5C]">{{ count($results) }}</span> hasil
                    untuk kata kunci <span class="font-semibold text-[#087E9B] bg-[#E6F7FF] px-1.5 py-0.5 rounded">&ldquo;{{ $keyword }}&rdquo;</span>
                </p>
            </div>

            <div class="space-y-4">
                @foreach($results as $item)
                    <div class="group bg-white rounded-2xl border border-cyan-100 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                        {{-- Top accent bar --}}
                        <div class="h-1 bg-gradient-to-r from-[#063B5C] via-[#087E9B] to-[#00CAFF] w-0 group-hover:w-full transition-all duration-500"></div>

                        <div class="p-6 md:p-8">
                            {{-- Title --}}
                            <h2 class="text-xl md:text-2xl font-bold text-[#063B5C] hover:text-[#087E9B] transition-colors mb-2 leading-snug">
                                <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>
                            </h2>

                            {{-- URL breadcrumb --}}
                            <div class="flex items-center gap-1.5 text-xs text-slate-400 mb-3">
                                <i class="fa-solid fa-link text-[#00CAFF]"></i>
                                <span class="truncate max-w-xs md:max-w-lg">{{ $item['url'] }}</span>
                            </div>

                            {{-- Excerpt --}}
                            <p class="text-slate-600 text-sm md:text-base leading-relaxed mb-5">
                                {{ $item['excerpt'] }}
                            </p>

                            {{-- CTA --}}
                            <a href="{{ $item['url'] }}"
                               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-[#E6F7FF] hover:bg-[#063B5C] text-[#087E9B] hover:text-white font-semibold text-sm border border-[#bae6fd] hover:border-[#063B5C] transition-all duration-200 group/btn">
                                <span>Buka Halaman</span>
                                <i class="fa-solid fa-arrow-right text-xs group-hover/btn:translate-x-1 transition-transform duration-200"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        @else
            {{-- ══ Empty / Not Found State ══ --}}
            <div class="relative overflow-hidden bg-white rounded-3xl border border-cyan-100 shadow-lg max-w-2xl mx-auto">
                <div class="h-1.5 bg-gradient-to-r from-[#063B5C] via-[#087E9B] to-[#F7C948]"></div>

                <div class="px-10 py-14 text-center">
                    {{-- Animated icon --}}
                    <div class="relative inline-flex items-center justify-center mb-6">
                        <div class="absolute w-20 h-20 rounded-full bg-[#E6F7FF] animate-pulse opacity-70"></div>
                        <div class="relative w-16 h-16 rounded-full bg-gradient-to-br from-[#E6F7FF] to-[#bae6fd] flex items-center justify-center shadow-md">
                            <i class="fa-solid fa-magnifying-glass text-2xl text-[#087E9B]"></i>
                        </div>
                    </div>

                    <h3 class="text-xl font-extrabold text-slate-800 mb-2">Hasil Tidak Ditemukan</h3>
                    <p class="text-sm text-slate-500 leading-relaxed max-w-sm mx-auto mb-2">
                        Tidak ada halaman yang cocok dengan kata kunci
                    </p>
                    <span class="inline-block text-sm font-semibold text-[#087E9B] bg-[#E6F7FF] px-3 py-1 rounded-full border border-sky-200 mb-6">
                        &ldquo;{{ $keyword }}&rdquo;
                    </span>

                    {{-- Search form --}}
                    <form action="{{ route('search') }}" method="GET" class="max-w-md mx-auto">
                        <div class="flex gap-2 shadow-sm">
                            <div class="relative flex-1">
                                <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-magnifying-glass text-slate-400 text-xs"></i>
                                </div>
                                <input
                                    type="text"
                                    name="search"
                                    value="{{ $keyword }}"
                                    placeholder="Coba kata kunci lain..."
                                    class="w-full pl-9 pr-4 py-2.5 border border-cyan-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#00CAFF]/50 focus:border-[#00CAFF] text-sm text-slate-800 bg-[#F7FBFF] transition">
                            </div>
                            <button
                                type="submit"
                                class="px-5 py-2.5 bg-[#087E9B] hover:bg-[#063B5C] text-white font-semibold rounded-xl text-sm transition-colors shadow-sm">
                                Cari
                            </button>
                        </div>
                    </form>

                    {{-- Tips --}}
                    <div class="mt-8 text-left bg-[#F7FBFF] rounded-xl border border-cyan-100 px-5 py-4">
                        <p class="text-xs font-semibold text-[#087E9B] mb-2 uppercase tracking-wide">Tips pencarian:</p>
                        <ul class="text-xs text-slate-500 space-y-1.5">
                            <li class="flex items-start gap-2"><i class="fa-solid fa-circle-check text-[#00CAFF] mt-0.5 shrink-0"></i> Periksa ejaan kata kunci Anda</li>
                            <li class="flex items-start gap-2"><i class="fa-solid fa-circle-check text-[#00CAFF] mt-0.5 shrink-0"></i> Gunakan kata yang lebih umum (mis. &ldquo;challenge&rdquo; bukan &ldquo;bc2024&rdquo;)</li>
                            <li class="flex items-start gap-2"><i class="fa-solid fa-circle-check text-[#00CAFF] mt-0.5 shrink-0"></i> Coba dengan jumlah kata yang lebih sedikit</li>
                        </ul>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>

<main class="hidden"><div><section class="hidden">
@endsection
