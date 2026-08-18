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
                            <a class="nav-link {{ request()->routeIs('tentang_bebras.index') ? 'active' : '' }}"
                                href="{{ route('tentang_bebras.index') }}">
                                <i class="bx bx-table me-1"></i> Table
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('form-tentang-bebras') ? 'active' : '' }}"
                                href="{{ route('form-tentang-bebras') }}">
                                <i class="bx bx-edit me-1"></i>Form
                            </a>
                        </li>
                    </ul>

                    <div class="card">
                        <h5 class="card-header">Form</h5>
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
                                action="{{ isset($data) ? route('tentang_bebras.update', $data->id) : route('tentang_bebras.store') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($data))
                                    @method('PUT')
                                @endif

                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <label for="judul" class="form-label">Judul</label>
                                        <input type="text" id="judul" name="judul"
                                            class="form-control @error('judul') is-invalid @enderror"
                                            value="{{ old('judul', $data->judul ?? '') }}" placeholder="Masukkan judul"
                                            required>
                                        @error('judul')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="urutan" class="form-label">Urutan</label>
                                        <input type="number" id="urutan" name="urutan"
                                            value="{{ old('urutan', $data->urutan ?? '-') }}"
                                            class="form-control @error('urutan') is-invalid @enderror"
                                            placeholder="Contoh: 1" required>
                                        @error('urutan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label for="template" class="form-label">Gaya Tampilan (Template) <span class="text-danger">*</span></label>
                                        @php
                                            $hasItems = isset($data) && $data->items->count() > 0;
                                        @endphp
                                        <select name="template" id="template" class="form-select @error('template') is-invalid @enderror" required {{ $hasItems ? 'disabled' : '' }}>
                                            @php
                                                $templates = [
                                                    'dd_1' => 'Gaya 1 — Teks + Gambar (tanpa item pendukung)',
                                                    'dd_2' => 'Gaya 2 — Teks + Dua Kolom (tanpa item pendukung)',
                                                    'dd_3' => 'Gaya 3 — Teks + Grid Tujuan (dengan item: Tujuan)',
                                                    'dd_4' => 'Gaya 4 — Teks + Grid Ruang Lingkup (dengan item: Ruang Lingkup)',
                                                    'dd_5' => 'Gaya 5 — Teks + List Kegiatan & Kategori (dengan item: Kegiatan / Kategori)',
                                                    'dd_6' => 'Gaya 6 — Teks + Timeline Sejarah (dengan item: Timeline)',
                                                ];
                                                $selectedTemplate = old('template', $data->template ?? 'dd_1');
                                            @endphp
                                            @foreach($templates as $val => $label)
                                            <option value="{{ $val }}" {{ $selectedTemplate === $val ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @if($hasItems)
                                            <input type="hidden" name="template" value="{{ $data->template }}">
                                        @endif
                                        @error('template')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Pilihan template tidak dapat diubah setelah ada item pendukung yang ditambahkan.</small>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" id="slug" name="slug" value="{{ old('slug', $data->slug ?? '') }}"
                                            class="form-control @error('slug') is-invalid @enderror"
                                            placeholder="Ketik judul untuk otomatisasi, atau buat kustom">
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label for="konten" class="form-label">
                                            Konten
                                            <span class="badge bg-label-warning ms-1" id="konten-warning" style="display:none;">Tidak ditampilkan di Frontend untuk Gaya ini</span>
                                        </label>
                                        <textarea id="konten" name="konten" class="form-control tinymce-editor @error('konten') is-invalid @enderror" rows="6">{{ old('konten', $data->konten ?? '-') }}</textarea>
                                        @error('konten')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label for="gambar" class="form-label fw-bold">
                                            Gambar
                                            <span class="badge bg-label-warning ms-1" id="gambar-warning" style="display:none;">Tidak ditampilkan di Frontend untuk Gaya ini</span>
                                        </label>
                                        <div class="d-flex align-items-center p-3 border rounded shadow-sm bg-light gap-4" id="gambar_container">

                                            {{-- Input File --}}
                                            <div class="flex-grow-1">
                                                <input type="file" id="gambar" name="gambar"
                                                    class="form-control @error('gambar') is-invalid @enderror"
                                                    accept="image/*">
                                                @error('gambar')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">Format: JPG, PNG, JPEG</small>
                                            </div>

                                            {{-- Preview Gambar --}}
                                            <div class="text-center">
                                                @if (!empty($data->gambar))
                                                    <img src="{{ asset('storage/' . $data->gambar) }}" alt="Gambar lama"
                                                        class="img-thumbnail border"
                                                        style="width: 120px; height: 120px; object-fit: cover; border-radius: 8px;">
                                                    <p class="mt-2 text-muted small">Preview</p>
                                                @else
                                                    <div class="d-flex justify-content-center align-items-center bg-white border rounded"
                                                        style="width: 120px; height: 120px;">
                                                        <i class="bx bx-image-add fs-1 text-secondary"></i>
                                                    </div>
                                                    <p class="mt-2 text-muted small">Belum ada gambar</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between mt-4">
                                        <a href="{{ route('tentang_bebras.index') }}" class="btn btn-secondary">Kembali</a>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                                    @if(!isset($data))
                     <!-- Info Box for Create Mode -->
                     <div class="card mt-4" id="item-manager-info-wrapper" style="display:none;">
                         <div class="card-body">
                             <div class="alert alert-info mb-0 d-flex align-items-center">
                                 <i class="bx bx-info-circle me-2 fs-4"></i>
                                 <div>
                                     <strong>Info Item Pendukung:</strong> Halaman dengan template/gaya yang dipilih mendukung penambahan item pendukung (seperti daftar tujuan, ruang lingkup, kegiatan, atau timeline sejarah). Anda dapat mulai mengelola dan menambahkan item pendukung setelah menyimpan halaman ini pertama kali.
                                 </div>
                             </div>
                         </div>
                     </div>
                     @endif

                     @if(isset($data))
                     <!-- Item Manager for Edit Mode -->
                     <div id="item-manager-wrapper" class="card mt-4" style="display:none;">
                         <div class="card-header d-flex justify-content-between align-items-center">
                             <h5 class="mb-0">Item Pendukung Halaman</h5>
                             <button type="button" class="btn btn-primary btn-sm" onclick="openCreateItemModal()">
                                 <i class="bx bx-plus me-1"></i> Tambah Item
                             </button>
                         </div>
                         <div class="card-body">
                             <div class="table-responsive">
                                 <table class="table table-striped table-bordered">
                                     <thead>
                                         <tr>
                                             <th>Tipe</th>
                                             <th>Icon</th>
                                             <th>Judul</th>
                                             <th>Deskripsi</th>
                                             <th>Bg Color</th>
                                             <th>Urutan</th>
                                             <th>Aksi</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         @forelse($data->items->sortBy('urutan') as $item)
                                             <tr>
                                                 <td><span class="badge bg-label-info">{{ $item->tipe }}</span></td>
                                                 <td><code>{{ $item->icon }}</code></td>
                                                 <td><strong>{{ $item->judul }}</strong></td>
                                                 <td>{!! Str::limit($item->deskripsi, 50) !!}</td>
                                                 <td><code>{{ $item->bg_color }}</code></td>
                                                 <td>{{ $item->urutan }}</td>
                                                 <td>
                                                     <div class="d-flex gap-1">
                                                         <button type="button" class="btn btn-sm btn-warning" onclick="openEditItemModal({{ json_encode($item) }})">
                                                             <i class="bx bx-edit"></i>
                                                         </button>
                                                         <form action="{{ route('tentang_bebras.items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin?')">
                                                             @csrf
                                                             @method('DELETE')
                                                             <button class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>
                                                         </form>
                                                     </div>
                                                 </td>
                                             </tr>
                                         @empty
                                             <tr>
                                                 <td colspan="7" class="text-center">Belum ada item pendukung untuk halaman ini.</td>
                                             </tr>
                                         @endforelse
                                     </tbody>
                                 </table>
                             </div>
                         </div>
                     </div>

                     <!-- Modal Tambah/Edit Item Pendukung -->
                     <div class="modal fade" id="itemModal" tabindex="-1" aria-hidden="true">
                         <div class="modal-dialog">
                             <form id="itemForm" method="POST" action="">
                                 @csrf
                                 <input type="hidden" name="_method" id="itemFormMethod" value="POST">
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         <h5 class="modal-title" id="itemModalTitle">Tambah Item Pendukung</h5>
                                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                     </div>
                                     <div class="modal-body">
                                         <div class="mb-3">
                                             <label class="form-label">Tipe <span class="text-danger">*</span></label>
                                             <select name="tipe" id="item_tipe" class="form-select" required>
                                                 <!-- Options populated dynamically based on active template in JavaScript -->
                                             </select>
                                         </div>
                                         <div class="mb-3">
                                             <label class="form-label">Icon / Emoji / Path SVG</label>
                                             <input type="text" name="icon" id="item_icon" class="form-control" placeholder="🌱 atau path SVG">
                                         </div>
                                         <div class="mb-3">
                                             <label class="form-label">Judul</label>
                                             <input type="text" name="judul" id="item_judul" class="form-control" placeholder="Judul item">
                                         </div>
                                         <div class="mb-3">
                                             <label class="form-label">Deskripsi / Detail</label>
                                             <textarea name="deskripsi" id="item_deskripsi" class="form-control" rows="3" placeholder="Gunakan tag HTML jika diperlukan"></textarea>
                                         </div>
                                         <div class="mb-3">
                                             <label class="form-label">Warna Latar Belakang (Class Tailwind)</label>
                                             <select name="bg_color" id="item_bg_color" class="form-select">
                                                 <option value="">Default (Transparan / Putih)</option>
                                                 
                                                 <!-- Solid / Pastel Backgrounds -->
                                                 <option value="bg-[#F8FAE5]">Hijau Muda Pastel</option>
                                                 <option value="bg-[#EAF4FC]">Biru Muda Pastel</option>
                                                 <option value="bg-[#FFF2F2]">Merah Muda Pastel</option>
                                                 <option value="bg-[#F0F4FF]">Indigo Muda Pastel</option>
                                                 
                                                 <!-- Gradient Backgrounds (Light) -->
                                                 <option value="from-amber-100 to-yellow-200">Gradasi Kuning (Light)</option>
                                                 <option value="from-green-100 to-emerald-200">Gradasi Hijau (Light)</option>
                                                 <option value="from-sky-100 to-blue-200">Gradasi Biru (Light)</option>
                                                 <option value="from-pink-100 to-rose-200">Gradasi Merah Muda (Light)</option>
                                                 
                                                 <!-- Gradient Backgrounds (Vibrant) -->
                                                 <option value="from-indigo-500 via-fuchsia-500 to-pink-500">Gradasi Indigo-Pink (Vibrant)</option>
                                                 <option value="from-emerald-500 via-teal-500 to-cyan-500">Gradasi Hijau-Biru (Vibrant)</option>
                                                 <option value="from-amber-500 via-orange-500 to-red-500">Gradasi Orange-Red (Vibrant)</option>
                                                 <option value="from-sky-500 via-blue-500 to-indigo-500">Gradasi Sky-Blue (Vibrant)</option>
                                                 <option value="from-fuchsia-500 via-purple-500 to-violet-500">Gradasi Ungu-Fuchsia (Vibrant)</option>
                                             </select>
                                         </div>
                                         <div class="mb-3">
                                             <label class="form-label">Urutan <span class="text-danger">*</span></label>
                                             <input type="number" name="urutan" id="item_urutan" class="form-control" value="0" required>
                                         </div>
                                     </div>
                                     <div class="modal-footer">
                                         <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                         <button type="submit" class="btn btn-primary">Simpan Item</button>
                                     </div>
                                 </div>
                             </form>
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
            const judulInput = document.getElementById('judul');
            const slugInput = document.getElementById('slug');
            const templateSelect = document.getElementById('template');
            const kontenWarning = document.getElementById('konten-warning');
            const gambarWarning = document.getElementById('gambar-warning');
            let isManuallyEdited = slugInput.value.trim() !== '';

            judulInput.addEventListener('input', function() {
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

            const TEMPLATE_ITEM_TYPES = {
                dd_3: [{value: 'tujuan', label: 'Tujuan'}],
                dd_4: [{value: 'ruang_lingkup', label: 'Ruang Lingkup'}],
                dd_5: [
                    {value: 'kegiatan_list', label: 'List Kegiatan'},
                    {value: 'kategori_tantangan', label: 'Kategori Tantangan'}
                ],
                dd_6: [{value: 'timeline', label: 'Timeline Sejarah'}]
            };

            function setTinyMceReadonly(id, isReadonly) {
                let editor = tinymce.get(id);
                if (editor) {
                    editor.mode.set(isReadonly ? 'readonly' : 'design');
                    let container = editor.getContainer();
                    if (container) {
                        container.style.opacity = isReadonly ? '0.5' : '1';
                        container.style.pointerEvents = isReadonly ? 'none' : 'auto';
                    }
                } else {
                    setTimeout(function() {
                        setTinyMceReadonly(id, isReadonly);
                    }, 100);
                }
            }

            function updateWarnings(templateValue) {
                // dd_4: Konten and Gambar are NOT used in Frontend
                if (templateValue === 'dd_4') {
                    kontenWarning.style.display = '';
                    gambarWarning.style.display = '';
                } 
                // dd_6: Gambar is NOT used in Frontend, Konten IS used
                else if (templateValue === 'dd_6') {
                    kontenWarning.style.display = 'none';
                    gambarWarning.style.display = '';
                } 
                // All other templates use both Konten and Gambar
                else {
                    kontenWarning.style.display = 'none';
                    gambarWarning.style.display = 'none';
                }

                // Toggle Konten TinyMCE input
                const isKontenDisabled = (templateValue === 'dd_4');
                setTinyMceReadonly('konten', isKontenDisabled);

                // Toggle Gambar file input
                const isGambarDisabled = ['dd_4', 'dd_6'].includes(templateValue);
                const gambarInput = document.getElementById('gambar');
                const gambarContainer = document.getElementById('gambar_container');
                if (gambarInput) {
                    gambarInput.disabled = isGambarDisabled;
                }
                if (gambarContainer) {
                    gambarContainer.style.opacity = isGambarDisabled ? '0.5' : '1';
                    gambarContainer.style.pointerEvents = isGambarDisabled ? 'none' : 'auto';
                }

                // Show/hide item manager wrappers based on support
                const supportsItems = ['dd_3', 'dd_4', 'dd_5', 'dd_6'].includes(templateValue);
                
                const itemInfoWrapper = document.getElementById('item-manager-info-wrapper');
                if (itemInfoWrapper) {
                    itemInfoWrapper.style.display = supportsItems ? '' : 'none';
                }

                const itemManagerWrapper = document.getElementById('item-manager-wrapper');
                if (itemManagerWrapper) {
                    itemManagerWrapper.style.display = supportsItems ? '' : 'none';
                }

                // Populate modal tipe options dynamically
                const itemTipeSelect = document.getElementById('item_tipe');
                if (itemTipeSelect) {
                    itemTipeSelect.innerHTML = '';
                    const allowedTypes = TEMPLATE_ITEM_TYPES[templateValue] || [];
                    allowedTypes.forEach(function(type) {
                        const opt = document.createElement('option');
                        opt.value = type.value;
                        opt.innerText = type.label;
                        itemTipeSelect.appendChild(opt);
                    });
                }
            }

            if (templateSelect) {
                updateWarnings(templateSelect.value);
                templateSelect.addEventListener('change', function() {
                    updateWarnings(this.value);
                });
            }
        });

        function openCreateItemModal() {
            $('#itemModalTitle').text('Tambah Item Pendukung');
            $('#itemFormMethod').val('POST');
            $('#itemForm').attr('action', "{{ isset($data) ? route('tentang_bebras.items.store', $data->id) : '' }}");
            
            // Set first option value from the dynamically populated list
            const firstOptVal = $('#item_tipe option:first').val();
            $('#item_tipe').val(firstOptVal || 'tujuan');
            $('#item_icon').val('');
            $('#item_judul').val('');
            $('#item_deskripsi').val('');
            $('#item_bg_color').val('');
            $('#item_urutan').val('0');
            
            $('#itemModal').modal('show');
        }

        function openEditItemModal(item) {
            $('#itemModalTitle').text('Edit Item Pendukung');
            $('#itemFormMethod').val('PUT');
            $('#itemForm').attr('action', "/tentang-bebras/items/" + item.id);
            
            $('#item_tipe').val(item.tipe);
            $('#item_icon').val(item.icon || '');
            $('#item_judul').val(item.judul || '');
            $('#item_deskripsi').val(item.deskripsi || '');
            $('#item_bg_color').val(item.bg_color || '');
            $('#item_urutan').val(item.urutan);
            
            $('#itemModal').modal('show');
        }
    </script>
@endpush
