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
                @if ($contact->institusi !== '-' && $contact->institusi !== null && $contact->institusi !== '')
                <!-- Kontak Card with Institution -->
                <div class="bg-gray-50 rounded-xl shadow-sm hover:shadow-md transition p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $contact->nama }}</h2>
                    <p class="text-gray-700">
                        {{ $contact->institusi }} <br>
                        {{ $contact->alamat }}
                    </p>
                </div>
                @else
                <!-- Kontak Card without Institution -->
                <div class="bg-gray-50 rounded-xl shadow-sm hover:shadow-md transition p-6">
                    <h2 class="text-xl font-bold text-gray-900">{{ $contact->nama }}</h2>
                </div>
                @endif

                @foreach ($contact->details as $detail)
                <!-- Detail Card -->
                <div class="bg-gray-50 rounded-xl shadow-sm hover:shadow-md transition p-6 flex items-center gap-3">
                    <span class="text-bebrasBlue font-semibold">{{ $detail->tipe === 'email' ? 'E-mail' : ($detail->tipe === 'url' ? 'URL' : ucfirst($detail->tipe)) }}:</span>
                    <a href="{{ $detail->tipe === 'email' ? 'mailto:' . $detail->nilai : $detail->nilai }}" {{ $detail->tipe === 'url' ? 'target="_blank"' : '' }} class="text-blue-600 hover:underline">
                        {{ $detail->nilai }}
                    </a>
                </div>
                @endforeach
                @endforeach

            </div>
        </div>
    </div>
@endsection
