@extends('app')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-breadcrumbs :items="$breadcrumbs" />

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <strong>Sukses!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <strong>Terjadi kesalahan!</strong>
                <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ isset($challenge) ? route('soal_bebras.challenge.update', $challenge->id) : route('soal_bebras.challenge.store', $menu->id) }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($challenge)) @method('PUT') @endif

            <div class="row g-3">

                {{-- ===== INFO SOAL ===== --}}
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">🧩 {{ isset($challenge) ? 'Edit' : 'Tambah' }} Contoh Soal — {{ $menu->nama_menu }}</h5>
                        </div>
                        <div class="card-body row g-3">

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Tingkat <span class="text-danger">*</span></label>
                                <select name="tingkat" class="form-select @error('tingkat') is-invalid @enderror" required>
                                    @foreach(['SD','SMP','SMA'] as $t)
                                        <option value="{{ $t }}" {{ old('tingkat', $challenge->tingkat ?? '') == $t ? 'selected' : '' }}>{{ $t }}</option>
                                    @endforeach
                                </select>
                                @error('tingkat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Kesulitan <span class="text-danger">*</span></label>
                                <select name="kesulitan" class="form-select @error('kesulitan') is-invalid @enderror" required>
                                    @foreach(['Mudah','Menengah','Sulit'] as $k)
                                        <option value="{{ $k }}" {{ old('kesulitan', $challenge->kesulitan ?? '') == $k ? 'selected' : '' }}>{{ $k }}</option>
                                    @endforeach
                                </select>
                                @error('kesulitan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Kategori Umur</label>
                                <input type="text" name="kategori_umur"
                                       value="{{ old('kategori_umur', $challenge->kategori_umur ?? '') }}"
                                       class="form-control" placeholder="Contoh: 6–8 tahun">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Kategori Materi <span class="text-danger">*</span></label>
                                <input type="text" name="kategori_materi"
                                       value="{{ old('kategori_materi', $challenge->kategori_materi ?? '') }}"
                                       class="form-control @error('kategori_materi') is-invalid @enderror"
                                       placeholder="Contoh: Algoritma, Informatika, dll" required>
                                @error('kategori_materi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Judul Soal <span class="text-danger">*</span></label>
                                <input type="text" name="judul"
                                       value="{{ old('judul', $challenge->judul ?? '') }}"
                                       class="form-control @error('judul') is-invalid @enderror"
                                       placeholder="Contoh: Berang-berang yang Sibuk" required>
                                @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                        </div>
                    </div>
                </div>

                {{-- ===== GAMBAR SOAL 1 ===== --}}
                <div class="col-12">
                    <div class="card">
                        <div class="card-header"><h6 class="mb-0">🖼️ Gambar Soal (Bagian 1)</h6></div>
                        <div class="card-body">
                            <div class="d-flex align-items-start gap-3 flex-wrap">
                                <div class="flex-grow-1">
                                    <input type="file" name="gambar_soal_1" id="gambar_soal_1"
                                           class="form-control" accept="image/*"
                                           onchange="previewImg(event, 'prev-g1', 'icon-g1')">
                                    <small class="text-muted">Gambar utama ilustrasi soal. Maks 4MB.</small>
                                </div>
                                <div class="text-center">
                                    <div class="border rounded overflow-hidden bg-light d-flex justify-content-center align-items-center"
                                         style="width:160px;height:120px;">
                                        @if(isset($challenge) && $challenge->gambar_soal_1)
                                            <img id="prev-g1" src="{{ asset('storage/' . $challenge->gambar_soal_1) }}"
                                                 style="width:100%;height:100%;object-fit:contain;">
                                        @else
                                            <i class="bx bx-image fs-1 text-secondary" id="icon-g1"></i>
                                            <img id="prev-g1" src="" style="width:100%;height:100%;object-fit:contain;display:none;">
                                        @endif
                                    </div>
                                    <small class="text-muted">Preview</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== DESKRIPSI SOAL ===== --}}
                <div class="col-12">
                    <div class="card">
                        <div class="card-header"><h6 class="mb-0">📝 Deskripsi / Pertanyaan Soal</h6></div>
                        <div class="card-body">
                            <textarea name="deskripsi_soal" class="form-control tinymce-editor" rows="6">{{ old('deskripsi_soal', $challenge->deskripsi_soal ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- ===== GAMBAR SOAL 2 ===== --}}
                <div class="col-12">
                    <div class="card">
                        <div class="card-header"><h6 class="mb-0">🖼️ Gambar Soal (Bagian 2 / Pilihan Jawaban)</h6></div>
                        <div class="card-body">
                            <div class="d-flex align-items-start gap-3 flex-wrap">
                                <div class="flex-grow-1">
                                    <input type="file" name="gambar_soal_2" id="gambar_soal_2"
                                           class="form-control" accept="image/*"
                                           onchange="previewImg(event, 'prev-g2', 'icon-g2')">
                                    <small class="text-muted">Gambar pilihan jawaban jika berbasis gambar. Maks 4MB.</small>
                                </div>
                                <div class="text-center">
                                    <div class="border rounded overflow-hidden bg-light d-flex justify-content-center align-items-center"
                                         style="width:200px;height:140px;">
                                        @if(isset($challenge) && $challenge->gambar_soal_2)
                                            <img id="prev-g2" src="{{ asset('storage/' . $challenge->gambar_soal_2) }}"
                                                 style="width:100%;height:100%;object-fit:contain;">
                                        @else
                                            <i class="bx bx-image-add fs-1 text-secondary" id="icon-g2"></i>
                                            <img id="prev-g2" src="" style="width:100%;height:100%;object-fit:contain;display:none;">
                                        @endif
                                    </div>
                                    <small class="text-muted">Preview</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== SOLUSI ===== --}}
                <div class="col-12">
                    <div class="card">
                        <div class="card-header"><h6 class="mb-0">✅ Solusi / Jawaban</h6></div>
                        <div class="card-body">
                            <textarea name="solusi" class="form-control tinymce-editor" rows="5">{{ old('solusi', $challenge->solusi ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- ===== INI INFORMATIKA ===== --}}
                <div class="col-12">
                    <div class="card">
                        <div class="card-header"><h6 class="mb-0">💡 Ini Informatika (Opsional)</h6></div>
                        <div class="card-body">
                            <textarea name="ini_informatika" class="form-control tinymce-editor" rows="4">{{ old('ini_informatika', $challenge->ini_informatika ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- ===== TOMBOL ===== --}}
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('soal_bebras.edit', $menu->id) }}" class="btn btn-secondary">
                            <i class="bx bx-arrow-back me-1"></i> Kembali ke Halaman Menu
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save me-1"></i> Simpan Challenge
                        </button>
                    </div>
                </div>

            </div>
        </form>

        {{-- ===== PILIHAN JAWABAN (hanya pada edit) ===== --}}
        @if(isset($challenge))
        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">🔤 Pilihan Jawaban (A/B/C/D)</h5>
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddOption">
                    <i class="bx bx-plus me-1"></i> Tambah Opsi
                </button>
            </div>
            <div class="card-body">
                <div class="row g-3" id="options-container">
                    @foreach($challenge->options->sortBy('urutan') as $opt)
                    <div class="col-md-3" id="opt-card-{{ $opt->id }}">
                        <div class="card h-100 border">
                            <div class="card-body text-center">
                                <span class="badge bg-primary fs-5 mb-2">{{ $opt->label }}</span>
                                @if($opt->gambar)
                                    <img src="{{ asset('storage/' . $opt->gambar) }}" alt="opt"
                                         class="img-fluid rounded mb-2" style="max-height:100px;object-fit:contain;">
                                @endif
                                @if($opt->teks)
                                    <p class="small text-muted">{{ $opt->teks }}</p>
                                @endif
                            </div>
                            <div class="card-footer d-flex gap-1 justify-content-center">
                                <button class="btn btn-sm btn-warning btn-edit-opt"
                                        data-id="{{ $opt->id }}"
                                        data-label="{{ $opt->label }}"
                                        data-teks="{{ $opt->teks }}"
                                        data-urutan="{{ $opt->urutan }}">
                                    Edit
                                </button>
                                <button class="btn btn-sm btn-danger btn-del-opt" data-id="{{ $opt->id }}">Hapus</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @if($challenge->options->isEmpty())
                    <p class="text-muted text-center" id="no-options-msg">Belum ada pilihan jawaban. Klik "Tambah Opsi".</p>
                @endif
            </div>
        </div>

        {{-- Modal Tambah Option --}}
        <div class="modal fade" id="modalAddOption" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="optModalTitle">Tambah Pilihan Jawaban</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="opt-id">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Label <span class="text-danger">*</span></label>
                            <input type="text" id="opt-label" class="form-control" placeholder="A / B / C / D" maxlength="10">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Teks Pilihan</label>
                            <textarea id="opt-teks" class="form-control" rows="2" placeholder="Teks jawaban (kosongkan jika hanya gambar)"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Gambar Pilihan</label>
                            <input type="file" id="opt-gambar" class="form-control" accept="image/*">
                            <small class="text-muted">Gambar untuk pilihan jawaban berbasis gambar</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Urutan</label>
                            <input type="number" id="opt-urutan" class="form-control" value="0" min="0">
                        </div>
                        <div id="opt-error" class="alert alert-danger d-none"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" id="btn-save-opt">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Preview Soal --}}
        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">👁️ Preview Soal (Tampilan FE)</h5>
                <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#preview-panel">
                    Tampilkan / Sembunyikan
                </button>
            </div>
            <div class="collapse" id="preview-panel">
                <div class="card-body" style="background:#f0f4ff;">
                    <div class="bg-white rounded-3 shadow p-4" style="max-width:800px;margin:auto;font-family:sans-serif;">

                        {{-- Header --}}
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                            <h4 style="font-size:1.4rem;font-weight:800;">{{ $menu->judul ?? $menu->nama_menu }}</h4>
                            @if($menu->gambar)
                            <img src="{{ asset('storage/' . $menu->gambar) }}" alt="logo" style="height:60px;object-fit:contain;">
                            @endif
                        </div>

                        {{-- Meta --}}
                        <span class="badge bg-warning text-dark me-1">{{ $challenge->tingkat }}</span>
                        <span class="badge bg-success me-1">{{ $challenge->kesulitan }}</span>
                        <span class="badge bg-purple text-white" style="background:#7c3aed;">{{ $challenge->kategori_materi }}</span>
                        <h5 class="mt-3 fw-bold">{{ $challenge->judul }}</h5>

                        {{-- Gambar Soal 1 --}}
                        @if($challenge->gambar_soal_1)
                        <img src="{{ asset('storage/' . $challenge->gambar_soal_1) }}" alt="soal1"
                             class="img-fluid rounded shadow my-3" style="max-height:300px;object-fit:contain;display:block;margin:auto;">
                        @endif

                        {{-- Deskripsi --}}
                        @if($challenge->deskripsi_soal)
                        <div class="my-3" style="text-align:justify;">{!! $challenge->deskripsi_soal !!}</div>
                        @endif

                        {{-- Gambar Soal 2 --}}
                        @if($challenge->gambar_soal_2)
                        <img src="{{ asset('storage/' . $challenge->gambar_soal_2) }}" alt="soal2"
                             class="img-fluid rounded shadow my-3" style="max-height:250px;object-fit:contain;display:block;margin:auto;">
                        @endif

                        {{-- Pilihan --}}
                        @if($challenge->options->isNotEmpty())
                        <h6 class="fw-bold mt-4">🔎 Pilihan Jawaban</h6>
                        <div class="row g-2">
                            @foreach($challenge->options->sortBy('urutan') as $opt)
                            <div class="col-6 col-sm-3 text-center">
                                <span class="badge bg-primary">{{ $opt->label }}</span>
                                @if($opt->gambar)
                                    <img src="{{ asset('storage/' . $opt->gambar) }}" class="img-fluid rounded border mt-1"
                                         style="max-height:80px;object-fit:contain;">
                                @endif
                                @if($opt->teks)<p class="small mt-1">{{ $opt->teks }}</p>@endif
                            </div>
                            @endforeach
                        </div>
                        @endif

                        {{-- Solusi --}}
                        @if($challenge->solusi)
                        <div class="mt-4 p-3 rounded" style="background:#e0f2fe;">
                            <strong>✅ Solusi</strong>
                            <div class="mt-2">{!! $challenge->solusi !!}</div>
                        </div>
                        @endif

                        {{-- Ini Informatika --}}
                        @if($challenge->ini_informatika)
                        <div class="mt-3 p-3 rounded" style="background:#dcfce7;">
                            <strong>💡 Ini Informatika</strong>
                            <div class="mt-2">{!! $challenge->ini_informatika !!}</div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection

@push('js')
<script>
function previewImg(event, imgId, iconId) {
    const file = event.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        const img  = document.getElementById(imgId);
        const icon = document.getElementById(iconId);
        img.src = e.target.result;
        img.style.display = 'block';
        if (icon) icon.style.display = 'none';
    };
    reader.readAsDataURL(file);
}

// ===== Options CRUD =====
@isset($challenge)
const CHALLENGE_ID = {{ $challenge->id }};
const STORE_URL    = "{{ route('soal_bebras.option.store', $challenge->id) }}";
const UPDATE_BASE  = "{{ route('soal_bebras.option.update', ':oid') }}";
const DELETE_BASE  = "{{ route('soal_bebras.option.destroy', ':oid') }}";

function buildOptCard(opt) {
    let img  = opt.gambar_url ? `<img src="${opt.gambar_url}" class="img-fluid rounded mb-1" style="max-height:80px;object-fit:contain;">` : '';
    let teks = opt.option?.teks ? `<p class="small text-muted">${opt.option.teks}</p>` : '';
    return `
        <div class="col-md-3" id="opt-card-${opt.option?.id ?? opt.id}">
            <div class="card h-100 border">
                <div class="card-body text-center">
                    <span class="badge bg-primary fs-5 mb-2">${opt.option?.label ?? opt.label}</span>
                    ${img}${teks}
                </div>
                <div class="card-footer d-flex gap-1 justify-content-center">
                    <button class="btn btn-sm btn-warning btn-edit-opt"
                            data-id="${opt.option?.id ?? opt.id}"
                            data-label="${opt.option?.label ?? opt.label}"
                            data-teks="${opt.option?.teks ?? ''}"
                            data-urutan="${opt.option?.urutan ?? 0}">Edit</button>
                    <button class="btn btn-sm btn-danger btn-del-opt" data-id="${opt.option?.id ?? opt.id}">Hapus</button>
                </div>
            </div>
        </div>`;
}

document.getElementById('btn-save-opt').addEventListener('click', function () {
    const id     = document.getElementById('opt-id').value;
    const label  = document.getElementById('opt-label').value.trim();
    const teks   = document.getElementById('opt-teks').value;
    const gambar = document.getElementById('opt-gambar').files[0];
    const urutan = document.getElementById('opt-urutan').value;
    const errEl  = document.getElementById('opt-error');

    if (!label) { errEl.textContent = 'Label wajib diisi'; errEl.classList.remove('d-none'); return; }
    errEl.classList.add('d-none');

    const fd = new FormData();
    fd.append('label', label);
    fd.append('teks', teks);
    fd.append('urutan', urutan);
    if (gambar) fd.append('gambar', gambar);

    const isEdit = id !== '';
    const url    = isEdit ? UPDATE_BASE.replace(':oid', id) : STORE_URL;
    if (isEdit) fd.append('_method', 'PUT');
    fd.append('_token', '{{ csrf_token() }}');

    fetch(url, { method: 'POST', body: fd })
        .then(r => r.json())
        .then(data => {
            if (!data.success) { errEl.textContent = data.message || 'Gagal'; errEl.classList.remove('d-none'); return; }

            const noMsg = document.getElementById('no-options-msg');
            if (noMsg) noMsg.remove();

            if (isEdit) {
                const card = document.getElementById('opt-card-' + id);
                const tmp  = document.createElement('div');
                tmp.innerHTML = buildOptCard({option: data.option, gambar_url: data.gambar_url});
                card.replaceWith(tmp.firstElementChild);
            } else {
                const container = document.getElementById('options-container');
                const tmp = document.createElement('div');
                tmp.innerHTML = buildOptCard({option: data.option, gambar_url: data.gambar_url});
                container.appendChild(tmp.firstElementChild);
            }

            // reset modal
            document.getElementById('opt-id').value = '';
            document.getElementById('opt-label').value = '';
            document.getElementById('opt-teks').value = '';
            document.getElementById('opt-gambar').value = '';
            document.getElementById('opt-urutan').value = 0;
            document.getElementById('optModalTitle').textContent = 'Tambah Pilihan Jawaban';
            bootstrap.Modal.getInstance(document.getElementById('modalAddOption')).hide();
        })
        .catch(() => { errEl.textContent = 'Terjadi kesalahan jaringan'; errEl.classList.remove('d-none'); });
});

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('btn-edit-opt')) {
        document.getElementById('opt-id').value     = e.target.dataset.id;
        document.getElementById('opt-label').value  = e.target.dataset.label;
        document.getElementById('opt-teks').value   = e.target.dataset.teks || '';
        document.getElementById('opt-urutan').value = e.target.dataset.urutan || 0;
        document.getElementById('optModalTitle').textContent = 'Edit Pilihan Jawaban';
        new bootstrap.Modal(document.getElementById('modalAddOption')).show();
    }

    if (e.target.classList.contains('btn-del-opt')) {
        if (!confirm('Hapus opsi ini?')) return;
        const id  = e.target.dataset.id;
        const url = DELETE_BASE.replace(':oid', id);
        const fd  = new FormData();
        fd.append('_method', 'DELETE');
        fd.append('_token', '{{ csrf_token() }}');
        fetch(url, { method: 'POST', body: fd })
            .then(r => r.json())
            .then(data => {
                if (data.success) document.getElementById('opt-card-' + id)?.remove();
            });
    }
});
@endisset
</script>
@endpush
