@extends('app')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-breadcrumbs :items="$breadcrumbs" />

        <div class="row justify-content-center">
            <div class="col-md-9">

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <strong>Error!</strong>
                        <ul class="mb-0">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- ── FORM UTAMA MENU ── --}}
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">{{ isset($data) ? 'Edit' : 'Tambah' }} Menu Kegiatan</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST"
                              action="{{ isset($data) ? route('menu_kegiatan.update', $data->id) : route('menu_kegiatan.store') }}"
                              enctype="multipart/form-data">
                            @csrf
                            @if(isset($data)) @method('PUT') @endif

                            <div class="row g-3">

                                {{-- Parent Menu --}}
                                <div class="col-md-6">
                                    <label for="parent_id" class="form-label">Parent Menu</label>
                                    <select id="parent_id" name="parent_id"
                                            class="form-select @error('parent_id') is-invalid @enderror">
                                        <option value="">-- Tidak Ada (Menu Induk) --</option>
                                        @foreach ($menuList as $menu)
                                            <option value="{{ $menu->id }}"
                                                {{ old('parent_id', $data->parent_id ?? '') == $menu->id ? 'selected' : '' }}>
                                                {{ $menu->nama_menu }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Biarkan kosong untuk menu tingkat pertama (muncul di dropdown Kegiatan).</small>
                                </div>

                                {{-- Nama Menu --}}
                                <div class="col-md-6">
                                    <label for="nama_menu" class="form-label">Nama Menu <span class="text-danger">*</span></label>
                                    <input type="text" id="nama_menu" name="nama_menu"
                                           class="form-control @error('nama_menu') is-invalid @enderror"
                                           value="{{ old('nama_menu', $data->nama_menu ?? '') }}"
                                           placeholder="Contoh: Workshop 2017" required>
                                    @error('nama_menu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                {{-- Slug --}}
                                <div class="col-md-6">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" id="slug" name="slug"
                                           value="{{ old('slug', $data->slug ?? '') }}"
                                           class="form-control @error('slug') is-invalid @enderror"
                                           placeholder="Otomatis dari Nama Menu">
                                    @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                {{-- Urutan --}}
                                <div class="col-md-6">
                                    <label for="urutan" class="form-label">Urutan <span class="text-danger">*</span></label>
                                    <input type="number" id="urutan" name="urutan"
                                           value="{{ old('urutan', $data->urutan ?? 0) }}"
                                           class="form-control @error('urutan') is-invalid @enderror"
                                           min="0" required>
                                    @error('urutan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                {{-- URL Eksternal (opsional) --}}
                                <div class="col-md-12">
                                    <label for="url" class="form-label">URL Eksternal <small class="text-muted">(opsional – isi jika menu ini menuju situs lain)</small></label>
                                    <input type="url" id="url" name="url"
                                           class="form-control @error('url') is-invalid @enderror"
                                           value="{{ old('url', $data->url ?? '') }}"
                                           placeholder="https://contoh.com">
                                    @error('url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                {{-- Judul Konten --}}
                                <div class="col-md-12">
                                    <label class="form-label">Judul Konten <small class="text-muted">(judul halaman yang ditampilkan)</small></label>
                                    <input type="text" name="judul" class="form-control"
                                           value="{{ old('judul', $data->judul ?? '') }}"
                                           placeholder="Contoh: Workshop Bebras 2017">
                                </div>

                                {{-- Body Konten --}}
                                <div class="col-md-12">
                                    <label class="form-label">Deskripsi / Body Konten</label>
                                    <textarea name="body" class="form-control tinymce-editor"
                                              rows="5">{{ old('body', $data->body ?? '') }}</textarea>
                                    <small class="text-muted">Konten ini ditampilkan di atas daftar kartu kegiatan pada halaman frontend.</small>
                                </div>

                                {{-- Gambar --}}
                                <div class="col-md-12">
                                    <label class="form-label">Gambar (opsional)</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="flex-grow-1">
                                            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
                                            <small class="text-muted">Maks 4 MB (jpg, png, webp)</small>
                                        </div>
                                        <div>
                                            @if(isset($data) && $data->gambar)
                                                <div class="border rounded overflow-hidden"
                                                     style="width:120px;height:120px;display:flex;justify-content:center;align-items:center;">
                                                    <img src="{{ Storage::url($data->gambar) }}" alt="Preview"
                                                         class="img-fluid" style="max-width:100%;max-height:100%;">
                                                </div>
                                                <p class="mt-1 text-center text-muted small">Preview</p>
                                            @else
                                                <div class="border rounded bg-light d-flex justify-content-center align-items-center"
                                                     style="width:120px;height:120px;">
                                                    <i class="bx bx-image-add fs-2 text-secondary"></i>
                                                </div>
                                                <p class="mt-1 text-center text-muted small">Belum ada gambar</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- Tombol --}}
                                <div class="d-flex justify-content-between mt-2">
                                    <a href="{{ route('menu_kegiatan.index') }}" class="btn btn-secondary">Kembali</a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bx bx-save me-1"></i> Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- ── PANEL: DAFTAR KEGIATAN (item kartu) — hanya tampil saat EDIT --}}
                @if(isset($data))
                <div class="card mt-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">🎯 Daftar Kegiatan (Kartu)</h5>
                        <a href="{{ route('kegiatan.create') }}?menu_kegiatan_id={{ $data->id }}"
                           class="btn btn-sm btn-primary">
                            <i class="bx bx-plus me-1"></i> Tambah Kegiatan
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info py-2 mb-3">
                            <small>Kegiatan di bawah ini ditampilkan sebagai <strong>kartu grid</strong> pada halaman
                            <code>/kegiatan/{{ $data->slug }}</code> di Frontend.</small>
                        </div>

                        @if($data->kegiatans->isEmpty())
                            <div class="alert alert-warning mb-0">
                                Belum ada kegiatan untuk menu ini.
                                <a href="{{ route('kegiatan.create') }}?menu_kegiatan_id={{ $data->id }}">Tambah kegiatan →</a>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-sm table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Judul</th>
                                            <th>Kota</th>
                                            <th>Urutan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data->kegiatans as $i => $kg)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>
                                                @if($kg->gambar)
                                                    @php $imgUrl = str_starts_with($kg->gambar, 'img/') ? asset($kg->gambar) : asset('storage/' . $kg->gambar); @endphp
                                                    <img src="{{ $imgUrl }}" width="60" height="45"
                                                         style="object-fit:cover;border-radius:4px;">
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $kg->judul }}</td>
                                            <td>{{ $kg->kota ?? '-' }}</td>
                                            <td>{{ $kg->urutan }}</td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <a href="{{ route('kegiatan.edit', $kg->id) }}"
                                                       class="btn btn-sm btn-warning">
                                                        <i class="bx bx-edit"></i>
                                                    </a>
                                                    <form action="{{ route('kegiatan.destroy', $kg->id) }}"
                                                          method="POST" onsubmit="return confirm('Hapus kegiatan ini?')">
                                                        @csrf @method('DELETE')
                                                        <button class="btn btn-sm btn-danger">
                                                            <i class="bx bx-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
    <div class="content-backdrop fade"></div>
</div>
@endsection

@push('js')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const namaMenuInput = document.getElementById('nama_menu');
        const slugInput     = document.getElementById('slug');
        let isManuallyEdited = slugInput.value.trim() !== '';

        namaMenuInput.addEventListener('input', function () {
            if (!isManuallyEdited) slugInput.value = generateSlug(this.value);
        });
        slugInput.addEventListener('input', function () { isManuallyEdited = true; });

        function generateSlug(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')
                .replace(/[^\w\-]+/g, '')
                .replace(/\-\-+/g, '-')
                .replace(/^-+/, '')
                .replace(/-+$/, '');
        }
    });
</script>
@endpush
