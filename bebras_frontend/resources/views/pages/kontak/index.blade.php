@extends('app')

@section('title', 'Alamat Kontak')
@section('content')
    <div class="w-full px-4 py-8">
       <div class="bg-white rounded-2xl shadow-lg p-8 max-w-6xl mx-auto">


            <!-- Header -->
            <div class="border-b pb-6 mb-8 flex justify-between">
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">
                    Alamat Kontak
                </h1>
                <img src="{{ asset('img/contacts-book.png') }}" alt="" class="w-16 h-16">
            </div>

            <!-- Kontak List -->
            <div class="space-y-6">

                @foreach ($contacts as $contact)
                <div class="bg-gray-50 rounded-xl shadow-sm hover:shadow-md transition p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $contact->nama }}</h2>
                    <p class="text-gray-700">
                        @if ($contact->institusi !== '-' && $contact->institusi !== null && $contact->institusi !== '')
                            {{ $contact->institusi }} <br>
                        @endif
                        @if ($contact->alamat !== '-' && $contact->alamat !== null && $contact->alamat !== '')
                            {{ $contact->alamat }}
                        @endif
                    </p>

                    @if($contact->details->isNotEmpty())
                    <div class="mt-4 pt-4 border-t border-gray-200 space-y-2">
                        @foreach ($contact->details as $detail)
                        <div class="flex items-center gap-3 text-sm">
                            <span class="text-bebrasBlue font-semibold min-w-[70px]">{{ $detail->tipe === 'email' ? 'E-mail' : ($detail->tipe === 'url' ? 'URL' : ucfirst($detail->tipe)) }}:</span>
                            <a href="{{ $detail->tipe === 'email' ? 'mailto:' . $detail->nilai : $detail->nilai }}" {{ $detail->tipe === 'url' ? 'target="_blank"' : '' }} class="text-blue-600 hover:underline">
                                {{ $detail->nilai }}
                            </a>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
