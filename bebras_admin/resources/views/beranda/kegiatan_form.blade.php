@extends('app')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-breadcrumbs :items="$breadcrumbs" />

        <div class="row justify-content-center">
            <div class="col-md-8">

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <strong>Error!</strong>
                        <ul class="mb-0">
                            @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">{{ isset($data) ? 'Edit' : 'Tambah' }} Kegiatan Beranda</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST"
                              action="{{ isset($data) ? route('beranda.kegiatan.update', $data->id) : route('beranda.kegiatan.store') }}"
                              enctype="multipart/form-data">
                            @csrf
                            @if(isset($data)) @method('PUT') @endif

                            <div class="mb-3">
                                <label class="form-label">Judul Kegiatan <span class="text-danger">*</span></label>
                                <input type="text" name="judul" class="form-control"
                                       value="{{ old('judul', $data->judul ?? '') }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Deskripsi Singkat</label>
                                <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $data->deskripsi ?? '') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Urutan Tampil <span class="text-danger">*</span></label>
                                <input type="number" name="urutan" class="form-control"
                                       value="{{ old('urutan', $data->urutan ?? 1) }}" min="0" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Gambar Kartu</label>
                                @if(isset($data) && $data->gambar)
                                    @php
                                        $currentImg = str_starts_with($data->gambar, 'img/')
                                            ? asset($data->gambar)
                                            : asset('storage/' . $data->gambar);
                                    @endphp
                                    <div class="mb-2">
                                        <img src="{{ $currentImg }}" alt="Gambar saat ini"
                                             class="img-thumbnail" style="max-height:120px;">
                                        <p class="text-muted small mt-1">Gambar saat ini. Kosongkan jika tidak ingin mengganti.</p>
                                    </div>
                                @endif
                                <input type="file" name="gambar" class="form-control" accept="image/*">
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bx bx-save me-1"></i> Simpan
                                </button>
                                <a href="{{ route('beranda.index') }}" class="btn btn-outline-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="content-backdrop fade"></div>
</div>
@endsection
