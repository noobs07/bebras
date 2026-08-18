@extends('app')

@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <x-breadcrumbs :items="$breadcrumbs" />

            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills flex-column flex-md-row mb-3">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('soal_bebras.index') ? 'active' : '' }}"
                                href="{{ route('soal_bebras.index') }}">
                                <i class="bx bx-table me-1"></i> Table
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('form-soal-bebras') ? 'active' : '' }}"
                                href="{{ route('form-soal-bebras') }}">
                                <i class="bx bx-edit me-1"></i>Form
                            </a>
                        </li>
                    </ul>

                    {{-- Flash messages --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Sukses!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="card">
                        <h5 class="card-header">{{ isset($data) ? 'Edit' : 'Tambah' }} Halaman Soal Bebras</h5>
                        <div class="card-body">
                            {{-- Alert error --}}
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Terjadi kesalahan!</strong>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <form
                                action="{{ isset($data) ? route('soal_bebras.update', $data->id) : route('soal_bebras.store') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($data))
                                    @method('PUT')
                                @endif

                                <div class="row g-3">

                                    <!-- Parent Menu -->
                                    <div class="col-md-6">
                                        <label for="parent_id" class="form-label">Parent Menu</label>
                                        <select id="parent_id" name="parent_id"
                                            class="form-select @error('parent_id') is-invalid @enderror">
                                            <option value="">-- Tidak Ada --</option>
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
                                    </div>

                                    <!-- Nama Menu -->
                                    <div class="col-md-6">
                                        <label for="nama_menu" class="form-label">Nama Menu</label>
                                        <input type="text" id="nama_menu" name="nama_menu"
                                            class="form-control @error('nama_menu') is-invalid @enderror"
                                            value="{{ old('nama_menu', $data->nama_menu ?? '') }}"
                                            placeholder="Masukkan nama menu" required>
                                        @error('nama_menu')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                     <!-- Slug -->
                                     <div class="col-md-6">
                                         <label for="slug" class="form-label">Slug</label>
                                         <input type="text" id="slug" name="slug"
                                             value="{{ old('slug', $data->slug ?? '') }}"
                                             class="form-control @error('slug') is-invalid @enderror"
                                             placeholder="Ketik nama menu untuk otomatisasi, atau buat kustom">
                                         @error('slug')
                                             <div class="invalid-feedback">{{ $message }}</div>
                                         @enderror
                                     </div>

                                    <!-- Urutan -->
                                    <div class="col-md-6">
                                        <label for="urutan" class="form-label">Urutan</label>
                                        <input type="number" id="urutan" name="urutan"
                                            value="{{ old('urutan', $data->urutan ?? 0) }}"
                                            class="form-control @error('urutan') is-invalid @enderror"
                                            placeholder="Contoh: 1">
                                        @error('urutan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Judul Konten -->
                                    <div class="col-md-12">
                                        <label class="form-label">Judul Konten</label>
                                        <input type="text" name="judul" class="form-control"
                                            value="{{ old('judul', $data->judul ?? '') }}">
                                    </div>

                                    <!-- Body Konten -->
                                    <div class="col-md-12">
                                        <label class="form-label">Body Konten</label>
                                        <textarea name="body" class="form-control tinymce-editor">{{ old('body', $data->body ?? '') }}</textarea>
                                    </div>

                                    <!-- Gambar -->
                                    <div class="col-md-12">
                                        <label class="form-label">Gambar</label>
                                        <div class="d-flex align-items-center gap-3">
                                            <!-- Input File -->
                                            <div class="flex-grow-1">
                                                <input type="file" name="gambar" id="gambar" class="form-control"
                                                    accept="image/*">
                                                <small class="text-muted">Pilih file gambar (maks 2MB)</small>
                                            </div>

                                            <!-- Preview Gambar -->
                                            <div>
                                                @if (isset($data) && $data->gambar)
                                                    <div class="border rounded overflow-hidden"
                                                        style="width: 120px; height: 120px; display:flex; justify-content:center; align-items:center;">
                                                        <img src="{{ Storage::url($data->gambar) }}" alt="Preview Gambar"
                                                            class="img-fluid" style="max-width:100%; max-height:100%;">
                                                    </div>
                                                    <p class="mt-2 text-center text-muted small">Preview</p>
                                                @else
                                                    <div class="border rounded bg-light d-flex justify-content-center align-items-center"
                                                        style="width: 120px; height: 120px;">
                                                        <i class="bx bx-image-add fs-2 text-secondary"></i>
                                                    </div>
                                                    <p class="mt-2 text-center text-muted small">Belum ada gambar</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tombol -->
                                    <div class="d-flex justify-content-between mt-4">
                                        <a href="{{ route('soal_bebras.index') }}" class="btn btn-secondary">Kembali</a>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                    {{-- =========================================================
                         PANEL: ITEMS (Konsep & Kriteria) — hanya tampil pada
                         edit halaman yang ber-slug "index-soal"
                    ========================================================= --}}
                    @if(isset($data) && $data->slug === 'index-soal')
                    <div class="card mt-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">📋 Item Konten — Konsep & Kriteria</h5>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddItem">
                                <i class="bx bx-plus me-1"></i> Tambah Item
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info py-2 mb-3">
                                <small>Item di bawah ini akan tampil di halaman <strong>"Apa itu Soal Bebras?"</strong> di Frontend.
                                Tipe <span class="badge bg-primary">Konsep</span> tampil sebagai bullet biru, <span class="badge bg-success">Kriteria</span> sebagai centang hijau.</small>
                            </div>

                            {{-- Tab Konsep / Kriteria --}}
                            <ul class="nav nav-tabs mb-3" id="itemTabs">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tab-konsep">🔵 Konsep</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tab-kriteria">✅ Kriteria</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab-konsep">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover" id="tbl-konsep">
                                            <thead><tr><th>Urutan</th><th>Judul</th><th>Aksi</th></tr></thead>
                                            <tbody>
                                            @foreach($data->items->where('tipe','konsep')->sortBy('urutan') as $item)
                                            <tr id="item-row-{{ $item->id }}">
                                                <td>{{ $item->urutan }}</td>
                                                <td>{{ $item->judul }}</td>
                                                <td>
                                                    <button class="btn btn-xs btn-warning me-1 btn-edit-item"
                                                            style="font-size:.75rem;padding:.2rem .5rem;"
                                                            data-id="{{ $item->id }}"
                                                            data-tipe="{{ $item->tipe }}"
                                                            data-judul="{{ $item->judul }}"
                                                            data-urutan="{{ $item->urutan }}">Edit</button>
                                                    <button class="btn btn-xs btn-danger btn-del-item"
                                                            style="font-size:.75rem;padding:.2rem .5rem;"
                                                            data-id="{{ $item->id }}">Hapus</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-kriteria">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover" id="tbl-kriteria">
                                            <thead><tr><th>Urutan</th><th>Judul</th><th>Aksi</th></tr></thead>
                                            <tbody>
                                            @foreach($data->items->where('tipe','kriteria')->sortBy('urutan') as $item)
                                            <tr id="item-row-{{ $item->id }}">
                                                <td>{{ $item->urutan }}</td>
                                                <td>{{ $item->judul }}</td>
                                                <td>
                                                    <button class="btn btn-xs btn-warning me-1 btn-edit-item"
                                                            style="font-size:.75rem;padding:.2rem .5rem;"
                                                            data-id="{{ $item->id }}"
                                                            data-tipe="{{ $item->tipe }}"
                                                            data-judul="{{ $item->judul }}"
                                                            data-urutan="{{ $item->urutan }}">Edit</button>
                                                    <button class="btn btn-xs btn-danger btn-del-item"
                                                            style="font-size:.75rem;padding:.2rem .5rem;"
                                                            data-id="{{ $item->id }}">Hapus</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- Modal Item --}}
                    <div class="modal fade" id="modalAddItem" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="itemModalTitle">Tambah Item</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="item-id">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Tipe <span class="text-danger">*</span></label>
                                        <select id="item-tipe" class="form-select">
                                            <option value="konsep">🔵 Konsep</option>
                                            <option value="kriteria">✅ Kriteria</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Judul Item <span class="text-danger">*</span></label>
                                        <input type="text" id="item-judul" class="form-control"
                                               placeholder="Contoh: Pemecahan Masalah">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Urutan</label>
                                        <input type="number" id="item-urutan" class="form-control" value="0" min="0">
                                    </div>
                                    <div id="item-error" class="alert alert-danger d-none"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="button" class="btn btn-primary" id="btn-save-item">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- =========================================================
                         PANEL: CHALLENGE — tampil pada edit halaman kecuali index-soal & pembahasan-soal
                    ========================================================= --}}
                    @if(isset($data) && !in_array($data->slug, ['index-soal', 'pembahasan-soal']))
                    <div class="card mt-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">🧩 Contoh Soal</h5>
                            @if($data->challenges->isEmpty())
                                <a href="{{ route('soal_bebras.challenge.create', $data->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bx bx-plus me-1"></i> Tambah Soal
                                </a>
                            @endif
                        </div>
                        <div class="card-body">
                            @if($data->challenges->isEmpty())
                                <div class="alert alert-warning mb-0">
                                    Belum ada contoh soal untuk halaman ini.
                                    <a href="{{ route('soal_bebras.challenge.create', $data->id) }}">Tambah sekarang →</a>
                                </div>
                            @else
                                @php $challenge = $data->challenges->first(); @endphp
                                <div class="d-flex flex-wrap gap-3 align-items-start">
                                    {{-- Info challenge --}}
                                    <div class="flex-grow-1">
                                        <table class="table table-sm table-borderless mb-0">
                                            <tr><th style="width:160px;">Judul</th><td>{{ $challenge->judul }}</td></tr>
                                            <tr><th>Tingkat</th><td><span class="badge bg-info">{{ $challenge->tingkat }}</span></td></tr>
                                            <tr><th>Kesulitan</th><td><span class="badge bg-success">{{ $challenge->kesulitan }}</span></td></tr>
                                            <tr><th>Kategori Materi</th><td>{{ $challenge->kategori_materi }}</td></tr>
                                            <tr><th>Jumlah Opsi</th><td>{{ $challenge->options->count() }} pilihan jawaban</td></tr>
                                        </table>
                                        <div class="mt-2 d-flex gap-2">
                                            <a href="{{ route('soal_bebras.challenge.edit', $challenge->id) }}"
                                               class="btn btn-warning btn-sm">
                                                <i class="bx bx-edit me-1"></i> Edit Soal & Pilihan Jawaban
                                            </a>
                                            <form action="{{ route('soal_bebras.challenge.destroy', $challenge->id) }}"
                                                  method="POST" onsubmit="return confirm('Hapus soal ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bx bx-trash me-1"></i> Hapus Soal
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    {{-- Mini preview gambar --}}
                                    @if($challenge->gambar_soal_1)
                                    <div class="text-center">
                                        <img src="{{ asset('storage/' . $challenge->gambar_soal_1) }}"
                                             alt="preview" class="rounded border shadow-sm"
                                             style="max-height:120px;max-width:180px;object-fit:contain;">
                                        <small class="d-block text-muted mt-1">Gambar Soal 1</small>
                                    </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>


    </div>
@endsection

@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const namaMenuInput = document.getElementById('nama_menu');
            const slugInput = document.getElementById('slug');
            let isManuallyEdited = slugInput.value.trim() !== '';

            namaMenuInput.addEventListener('input', function() {
                if (!isManuallyEdited) {
                    slugInput.value = generateSlug(this.value);
                }
            });

            slugInput.addEventListener('input', function() {
                isManuallyEdited = true;
            });

            function generateSlug(text) {
                return text.toString().toLowerCase()
                    .replace(/\s+/g, '-')           // Replace spaces with -
                    .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                    .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                    .replace(/^-+/, '')             // Trim - from start of text
                    .replace(/-+$/, '');            // Trim - from end of text
            }
        });
    </script>

    {{-- Items CRUD script (index-soal only) --}}
    @if(isset($data) && $data->slug === 'index-soal')
    <script>
    const MENU_ID        = {{ $data->id }};
    const ITEMS_STORE    = "{{ route('soal_bebras.items.store', $data->id) }}";
    const ITEMS_UPD_BASE = "{{ route('soal_bebras.items.update', ':itemId') }}";
    const ITEMS_DEL_BASE = "{{ route('soal_bebras.items.destroy', ':itemId') }}";

    function buildItemRow(item) {
        return `<tr id="item-row-${item.id}">
            <td>${item.urutan}</td>
            <td>${item.judul}</td>
            <td>
                <button class="btn btn-xs btn-warning me-1 btn-edit-item"
                        style="font-size:.75rem;padding:.2rem .5rem;"
                        data-id="${item.id}" data-tipe="${item.tipe}"
                        data-judul="${item.judul}" data-urutan="${item.urutan}">Edit</button>
                <button class="btn btn-xs btn-danger btn-del-item"
                        style="font-size:.75rem;padding:.2rem .5rem;"
                        data-id="${item.id}">Hapus</button>
            </td>
        </tr>`;
    }

    document.getElementById('btn-save-item').addEventListener('click', function () {
        const id     = document.getElementById('item-id').value;
        const tipe   = document.getElementById('item-tipe').value;
        const judul  = document.getElementById('item-judul').value.trim();
        const urutan = document.getElementById('item-urutan').value;
        const errEl  = document.getElementById('item-error');

        if (!judul) { errEl.textContent = 'Judul wajib diisi'; errEl.classList.remove('d-none'); return; }
        errEl.classList.add('d-none');

        const isEdit = id !== '';
        const url    = isEdit ? ITEMS_UPD_BASE.replace(':itemId', id) : ITEMS_STORE;
        const fd     = new FormData();
        if (!isEdit) fd.append('tipe', tipe);
        fd.append('judul', judul);
        fd.append('urutan', urutan);
        if (isEdit) fd.append('_method', 'PUT');
        fd.append('_token', '{{ csrf_token() }}');

        fetch(url, { method: 'POST', body: fd })
            .then(r => r.json())
            .then(data => {
                if (!data.success) { errEl.textContent = 'Gagal'; errEl.classList.remove('d-none'); return; }

                const item   = data.item;
                const tbody  = item.tipe === 'konsep'
                    ? document.querySelector('#tbl-konsep tbody')
                    : document.querySelector('#tbl-kriteria tbody');

                if (isEdit) {
                    const row = document.getElementById('item-row-' + id);
                    if (row) { const tmp = document.createElement('tbody'); tmp.innerHTML = buildItemRow(item); row.replaceWith(tmp.firstElementChild); }
                } else {
                    tbody.insertAdjacentHTML('beforeend', buildItemRow(item));
                }

                // reset
                document.getElementById('item-id').value = '';
                document.getElementById('item-judul').value = '';
                document.getElementById('item-urutan').value = 0;
                document.getElementById('itemModalTitle').textContent = 'Tambah Item';
                bootstrap.Modal.getInstance(document.getElementById('modalAddItem')).hide();
            });
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-edit-item')) {
            document.getElementById('item-id').value     = e.target.dataset.id;
            document.getElementById('item-tipe').value  = e.target.dataset.tipe;
            document.getElementById('item-judul').value = e.target.dataset.judul;
            document.getElementById('item-urutan').value = e.target.dataset.urutan;
            document.getElementById('itemModalTitle').textContent = 'Edit Item';
            new bootstrap.Modal(document.getElementById('modalAddItem')).show();
        }
        if (e.target.classList.contains('btn-del-item')) {
            if (!confirm('Hapus item ini?')) return;
            const id  = e.target.dataset.id;
            const url = ITEMS_DEL_BASE.replace(':itemId', id);
            const fd  = new FormData();
            fd.append('_method', 'DELETE');
            fd.append('_token', '{{ csrf_token() }}');
            fetch(url, { method: 'POST', body: fd })
                .then(r => r.json())
                .then(data => { if (data.success) document.getElementById('item-row-' + id)?.remove(); });
        }
    });
    </script>
    @endif
@endpush
