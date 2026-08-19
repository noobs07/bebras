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
                        <h5 class="mb-0">{{ isset($data) ? 'Edit Kegiatan' : 'Tambah Kegiatan' }}</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST"
                              action="{{ isset($data) ? route('kegiatan.update', $data->id) : route('kegiatan.store') }}"
                              enctype="multipart/form-data">
                            @csrf
                            @if(isset($data)) @method('PUT') @endif

                            {{-- Simpan redirect_menu_id jika ada --}}
                            @if(request()->has('menu_kegiatan_id'))
                                <input type="hidden" name="redirect_menu_id" value="{{ request('menu_kegiatan_id') }}">
                            @endif

                            <div class="mb-3">
                                <label class="form-label">Menu Kegiatan <span class="text-danger">*</span></label>
                                 <select name="menu_kegiatan_id" class="form-select" required>
                                     <option value="">-- Pilih Menu Kegiatan --</option>
                                     <option value="kegiatan_utama"
                                         {{ old('menu_kegiatan_id', $data->menu_kegiatan_id ?? $defaultMenuId ?? '') === 'kegiatan_utama' || (isset($data) && $data->tipe === 'kegiatan_utama') ? 'selected' : '' }}>
                                         Beranda / Kegiatan Utama
                                     </option>
                                     @foreach($menuList as $menu)
                                         <option value="{{ $menu->id }}"
                                             {{ old('menu_kegiatan_id', $data->menu_kegiatan_id ?? $defaultMenuId ?? '') == $menu->id && (!isset($data) || $data->tipe !== 'kegiatan_utama') ? 'selected' : '' }}>
                                             @if($menu->parent_id)
                                                 &nbsp;&nbsp;&nbsp;↳ {{ $menu->parent?->nama_menu }} / {{ $menu->nama_menu }}
                                             @else
                                                 {{ $menu->nama_menu }}
                                             @endif
                                         </option>
                                     @endforeach
                                 </select>
                                <small class="text-muted">Pilih menu kegiatan tempat kegiatan ini akan muncul sebagai kartu.</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Judul <span class="text-danger">*</span></label>
                                <input type="text" name="judul" class="form-control"
                                       value="{{ old('judul', $data->judul ?? '') }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control tinymce-editor"
                                          rows="4">{{ old('deskripsi', $data->deskripsi ?? '') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kota <small class="text-muted">(opsional)</small></label>
                                <input type="text" name="kota" class="form-control"
                                       value="{{ old('kota', $data->kota ?? '') }}" placeholder="Contoh: Jakarta">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal &amp; Lokasi <small class="text-muted">(opsional)</small></label>
                                <input type="text" name="tanggal_lokasi" class="form-control"
                                       value="{{ old('tanggal_lokasi', $data->tanggal_lokasi ?? '') }}"
                                       placeholder="Contoh: 15 Maret 2017, Hotel Santika Jakarta">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Speaker <small class="text-muted">(opsional)</small></label>
                                <input type="text" name="speaker" class="form-control"
                                       value="{{ old('speaker', $data->speaker ?? '') }}"
                                       placeholder="Nama pembicara / narasumber">
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
