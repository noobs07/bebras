@extends('app')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-breadcrumbs :items="$breadcrumbs" />

        <div class="row">
            <div class="col-md-12">

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Terjadi kesalahan!</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">{{ isset($data) ? 'Edit' : 'Tambah' }} Buku Pembahasan Soal</h5>
                    </div>
                    <div class="card-body">

                        <form action="{{ isset($data) ? route('soal_book.update', $data->id) : route('soal_book.store') }}"
                              method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(isset($data)) @method('PUT') @endif

                            <div class="row g-3">

                                {{-- Kategori --}}
                                <div class="col-md-6">
                                    <label for="kategori" class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                                    <select id="kategori" name="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach([
                                            'sikecil'    => '🟣 SiKecil (PAUD/TK)',
                                            'siaga'      => '🟢 Siaga (SD/MI)',
                                            'penggalang' => '🟡 Penggalang (SMP/MTs)',
                                            'penegak'    => '🔴 Penegak (SMA/SMK/MA)',
                                        ] as $val => $label)
                                            <option value="{{ $val }}" {{ old('kategori', $data->kategori ?? '') == $val ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Urutan --}}
                                <div class="col-md-6">
                                    <label for="urutan" class="form-label fw-semibold">Urutan Tampil</label>
                                    <input type="number" id="urutan" name="urutan"
                                           value="{{ old('urutan', $data->urutan ?? 0) }}"
                                           class="form-control @error('urutan') is-invalid @enderror"
                                           min="0" placeholder="Contoh: 1">
                                    @error('urutan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Judul --}}
                                <div class="col-md-12">
                                    <label for="judul" class="form-label fw-semibold">Judul Buku <span class="text-danger">*</span></label>
                                    <input type="text" id="judul" name="judul"
                                           value="{{ old('judul', $data->judul ?? '') }}"
                                           class="form-control @error('judul') is-invalid @enderror"
                                           placeholder="Contoh: Buku Soal Bebras 2023 – Siaga" required>
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- PDF Link --}}
                                <div class="col-md-12">
                                    <label for="pdf_link" class="form-label fw-semibold">
                                        Link PDF <span class="text-danger">*</span>
                                        <small class="text-muted fw-normal ms-1">(URL Google Drive, Dropbox, atau direct link)</small>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bx bx-link"></i></span>
                                        <input type="text" id="pdf_link" name="pdf_link"
                                               value="{{ old('pdf_link', $data->pdf_link ?? '') }}"
                                               class="form-control @error('pdf_link') is-invalid @enderror"
                                               placeholder="https://drive.google.com/..." required>
                                    </div>
                                    @error('pdf_link')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    @if(isset($data) && $data->pdf_link)
                                        <div class="mt-1">
                                            <a href="{{ $data->pdf_link }}" target="_blank" class="btn btn-sm btn-outline-info mt-1">
                                                <i class="bx bx-file-pdf me-1"></i> Buka PDF Saat Ini
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                {{-- Cover Image --}}
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold">Gambar Cover Buku</label>
                                    <div class="d-flex align-items-start gap-3 flex-wrap">
                                        <div class="flex-grow-1">
                                            <input type="file" name="cover_image" id="cover_image"
                                                   class="form-control @error('cover_image') is-invalid @enderror"
                                                   accept="image/*" onchange="previewCover(event)">
                                            <small class="text-muted">Format: JPG/PNG, maks 2MB. Rasio ideal: 3:4 (portrait)</small>
                                            @error('cover_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- Cover Preview --}}
                                        <div class="text-center">
                                            <div id="cover-preview-wrapper" class="border rounded overflow-hidden bg-light d-flex justify-content-center align-items-center"
                                                 style="width:100px;height:130px;">
                                                @if(isset($data) && $data->cover_image)
                                                    @php
                                                        $coverSrc = str_starts_with($data->cover_image, 'img/')
                                                            ? asset($data->cover_image)
                                                            : Storage::url($data->cover_image);
                                                    @endphp
                                                    <img id="cover-preview-img" src="{{ $coverSrc }}" alt="Cover"
                                                         style="width:100%;height:100%;object-fit:cover;">
                                                @else
                                                    <i class="bx bx-image-add fs-1 text-secondary" id="cover-preview-icon"></i>
                                                    <img id="cover-preview-img" src="" alt="Cover"
                                                         style="width:100%;height:100%;object-fit:cover;display:none;">
                                                @endif
                                            </div>
                                            <small class="text-muted">Preview</small>
                                        </div>
                                    </div>
                                </div>

                                {{-- Tombol --}}
                                <div class="d-flex justify-content-between mt-4">
                                    <a href="{{ route('soal_book.index') }}" class="btn btn-secondary">
                                        <i class="bx bx-arrow-back me-1"></i> Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bx bx-save me-1"></i> Simpan
                                    </button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
function previewCover(event) {
    const file = event.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        const img = document.getElementById('cover-preview-img');
        const icon = document.getElementById('cover-preview-icon');
        img.src = e.target.result;
        img.style.display = 'block';
        if (icon) icon.style.display = 'none';
    };
    reader.readAsDataURL(file);
}
</script>
@endpush
