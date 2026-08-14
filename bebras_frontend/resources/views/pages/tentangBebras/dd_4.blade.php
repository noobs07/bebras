@extends('app')

@section('title', 'Ruang Lingkup')

@section('content')
    <div class="w-full p-4">
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12 p-6 rounded-lg shadow flex flex-col md:flex-row w-full bg-[#]">
                <div class="flex-1 md:pr-6">
                    <h2 class="text-2xl md:text-3xl font-semibold tracking-tight mb-4 text-start">
                        {{ $page->judul }}
                    </h2>
                    <section class="mx-auto max-w-4xl p-6 bg-bebrasLightBlue rounded-lg">

                        <ul class="grid gap-4 sm:grid-cols-2">
                            @foreach ($page->items as $index => $item)
                            @php
                                $colorClass = 'indigo';
                                if (str_contains($item->bg_color, 'emerald')) $colorClass = 'emerald';
                                elseif (str_contains($item->bg_color, 'amber')) $colorClass = 'amber';
                                elseif (str_contains($item->bg_color, 'sky')) $colorClass = 'sky';
                                elseif (str_contains($item->bg_color, 'fuchsia')) $colorClass = 'fuchsia';
                            @endphp
                            <!-- Item -->
                            <li
                                class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:shadow-md dark:border-gray-800 dark:bg-gray-900 {{ $index === 4 ? 'sm:col-span-2' : '' }}">
                                <div class="flex items-start gap-3">
                                    <!-- Icon -->
                                    <span
                                        class="mt-1 inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-{{ $colorClass }}-500/10 to-{{ $colorClass }}-500/20 ring-1 ring-{{ $colorClass }}-500/30 group-hover:scale-110 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor">
                                            <path d="{{ $item->icon }}" stroke-width="1.5" />
                                        </svg>
                                    </span>
                                    <div>
                                        <h3 class="font-semibold">{{ $item->judul }}</h3>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                            {{ $item->deskripsi }}
                                        </p>
                                    </div>
                                </div>
                                <!-- Hover accent -->
                                <span
                                    class="pointer-events-none absolute inset-x-0 bottom-0 h-1 bg-gradient-to-r {{ $item->bg_color }} opacity-0 transition group-hover:opacity-100"></span>
                            </li>
                            @endforeach
                        </ul>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
