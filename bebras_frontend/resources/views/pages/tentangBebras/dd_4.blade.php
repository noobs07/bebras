@extends('app')

@section('title', 'Ruang Lingkup')

@section('content')
    <div class="w-full p-4">
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12 p-6 rounded-lg shadow flex flex-col md:flex-row w-full bg-[#]">
                <div class="flex-1 md:pr-6">
                    <h2 class="text-2xl md:text-3xl font-semibold tracking-tight mb-4 text-start">
                        Ruang lingkup kegiatan bebras di antaranya adalah:
                    </h2>
                    <section class="mx-auto max-w-4xl p-6 bg-bebrasLightBlue rounded-lg">

                        <ul class="grid gap-4 sm:grid-cols-2">
                            <!-- Item -->
                            <li
                                class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:shadow-md dark:border-gray-800 dark:bg-gray-900">
                                <div class="flex items-start gap-3">
                                    <!-- Icon -->
                                    <span
                                        class="mt-1 inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500/10 to-indigo-500/20 ring-1 ring-indigo-500/30 group-hover:scale-110 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor">
                                            <path d="M12 3v18M3 12h18" stroke-width="1.5" />
                                        </svg>
                                    </span>
                                    <div>
                                        <h3 class="font-semibold">Menumbuhkan kreativitas, budaya informasi, algoritma &
                                            berpikir komputasi</h3>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                            Mendorong cara berpikir terstruktur, eksploratif, dan berbasis data.
                                        </p>
                                    </div>
                                </div>
                                <!-- Hover accent -->
                                <span
                                    class="pointer-events-none absolute inset-x-0 bottom-0 h-1 bg-gradient-to-r from-indigo-500 via-fuchsia-500 to-pink-500 opacity-0 transition group-hover:opacity-100"></span>
                            </li>

                            <li
                                class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:shadow-md dark:border-gray-800 dark:bg-gray-900">
                                <div class="flex items-start gap-3">
                                    <span
                                        class="mt-1 inline-flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-emerald-500/10 to-emerald-500/20 ring-1 ring-emerald-500/30 group-hover:scale-110 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor">
                                            <path d="M12 6v6l4 2" stroke-width="1.5" />
                                        </svg>
                                    </span>
                                    <div>
                                        <h3 class="font-semibold">Memudahkan pemahaman mendalam teknologi informasi</h3>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                            Materi dipetakan dari konsep ke praktik agar lebih mudah diserap.
                                        </p>
                                    </div>
                                </div>
                                <span
                                    class="pointer-events-none absolute inset-x-0 bottom-0 h-1 bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 opacity-0 transition group-hover:opacity-100"></span>
                            </li>

                            <li
                                class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:shadow-md dark:border-gray-800 dark:bg-gray-900">
                                <div class="flex items-start gap-3">
                                    <span
                                        class="mt-1 inline-flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-amber-500/10 to-amber-500/20 ring-1 ring-amber-500/30 group-hover:scale-110 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor">
                                            <path d="M5 12h14M12 5l7 7-7 7" stroke-width="1.5" />
                                        </svg>
                                    </span>
                                    <div>
                                        <h3 class="font-semibold">Mendorong antusiasme penggunaan TI dalam belajar</h3>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                            Tugas berbasis proyek & aplikasi nyata untuk meningkatkan motivasi.
                                        </p>
                                    </div>
                                </div>
                                <span
                                    class="pointer-events-none absolute inset-x-0 bottom-0 h-1 bg-gradient-to-r from-amber-500 via-orange-500 to-red-500 opacity-0 transition group-hover:opacity-100"></span>
                            </li>

                            <li
                                class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:shadow-md dark:border-gray-800 dark:bg-gray-900">
                                <div class="flex items-start gap-3">
                                    <span
                                        class="mt-1 inline-flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-sky-500/10 to-sky-500/20 ring-1 ring-sky-500/30 group-hover:scale-110 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor">
                                            <path d="M20 7l-8 10L4 12" stroke-width="1.5" />
                                        </svg>
                                    </span>
                                    <div>
                                        <h3 class="font-semibold">Melibatkan anak sejak dini dengan TI, komputer & aplikasi
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                            Aktivitas hands-on di kelas & lab untuk membangun literasi digital awal.
                                        </p>
                                    </div>
                                </div>
                                <span
                                    class="pointer-events-none absolute inset-x-0 bottom-0 h-1 bg-gradient-to-r from-sky-500 via-blue-500 to-indigo-500 opacity-0 transition group-hover:opacity-100"></span>
                            </li>

                            <li
                                class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:shadow-md dark:border-gray-800 dark:bg-gray-900 sm:col-span-2">
                                <div class="flex items-start gap-3">
                                    <span
                                        class="mt-1 inline-flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-fuchsia-500/10 to-fuchsia-500/20 ring-1 ring-fuchsia-500/30 group-hover:scale-110 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor">
                                            <path d="M3 7h18M3 12h14M3 17h10" stroke-width="1.5" />
                                        </svg>
                                    </span>
                                    <div>
                                        <h3 class="font-semibold">Menjelaskan manfaat TI untuk semua mata pelajaran</h3>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                            Menunjukkan bagaimana TI membantu memahami, menganalisis, dan mempresentasikan
                                            materi pelajaran.
                                        </p>
                                    </div>
                                </div>
                                <span
                                    class="pointer-events-none absolute inset-x-0 bottom-0 h-1 bg-gradient-to-r from-fuchsia-500 via-purple-500 to-violet-500 opacity-0 transition group-hover:opacity-100"></span>
                            </li>
                        </ul>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
