@extends('app')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-breadcrumbs :items="$breadcrumbs" />

        <div class="row justify-content-center">
            <div class="col-md-8">

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <strong>Error!</strong> {{ $errors->first() }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">{{ isset($data) ? 'Edit Kegiatan' : 'Tambah Kegiatan' }}</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST"
                              action="{{ isset($data) ? route('kegiatan.update', $data->id) : route('kegiatan.store') }}"
                              enctype="multipart/form-data">
                            @csrf
                            @if(isset($data))
                                @method('PUT')
                            @endif

                            <div class="mb-3">
                                <label class="form-label">Tipe <span class="text-danger">*</span></label>
                                <select name="tipe" class="form-select" required>
                                    <option value="">-- Pilih Tipe --</option>
                                    <option value="kegiatan_utama" {{ old('tipe', $data->tipe ?? '') === 'kegiatan_utama' ? 'selected' : '' }}>
                                        Kegiatan Utama (Beranda)
                                    </option>
                                    <option value="workshop_2017" {{ old('tipe', $data->tipe ?? '') === 'workshop_2017' ? 'selected' : '' }}>
                                        Workshop 2017
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Judul <span class="text-danger">*</span></label>
                                <input type="text" name="judul" class="form-control"
                                       value="{{ old('judul', $data->judul ?? '') }}" placeholder="Judul kegiatan" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="4"
                                          placeholder="Deskripsi kegiatan...">{{ old('deskripsi', $data->deskripsi ?? '') }}</textarea>
                            </div>

                            <div class="mb-3" id="kota-field">
                                <label class="form-label">Kota <small class="text-muted">(untuk Workshop 2017)</small></label>
                                <input type="text" name="kota" class="form-control"
                                       value="{{ old('kota', $data->kota ?? '') }}" placeholder="Nama kota">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Urutan <span class="text-danger">*</span></label>
                                <input type="number" name="urutan" class="form-control"
                                       value="{{ old('urutan', $data->urutan ?? 1) }}" min="0" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Gambar</label>
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
                                <a href="{{ route('kegiatan.index') }}" class="btn btn-outline-secondary">Batal</a>
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
