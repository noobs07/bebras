@extends('app')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-breadcrumbs :items="$breadcrumbs" />

        <div class="row">
            <div class="col-md-12">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Sukses!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{ $errors->first() }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Tabs Nav --}}
                <ul class="nav nav-pills flex-column flex-md-row mb-3" id="berandaTabs" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" id="about-tab" data-bs-toggle="pill" data-bs-target="#tab-about" type="button" role="tab">
                            <i class="bx bx-info-circle me-1"></i> Tentang Bebras
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="cta-tab" data-bs-toggle="pill" data-bs-target="#tab-cta" type="button" role="tab">
                            <i class="bx bx-link me-1"></i> CTA Section
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="kegiatan-tab" data-bs-toggle="pill" data-bs-target="#tab-kegiatan" type="button" role="tab">
                            <i class="bx bx-calendar-event me-1"></i> Kegiatan Beranda
                        </button>
                    </li>
                </ul>

                {{-- Tabs Content --}}
                <div class="tab-content p-0 bg-transparent shadow-none">

                    {{-- Tab 1: Tentang Bebras --}}
                    <div class="tab-pane fade show active" id="tab-about" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Ubah Section Tentang Bebras</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('beranda.about.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label class="form-label">Logo / Gambar Tentang Bebras</label>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="flex-grow-1">
                                                <input type="file" name="home_about_logo" class="form-control" accept="image/*">
                                                <small class="text-muted">Maks 2 MB (jpg, png, webp)</small>
                                            </div>
                                            <div>
                                                @if($aboutLogo)
                                                    @php $logoUrl = str_starts_with($aboutLogo, 'img/') ? asset($aboutLogo) : asset('storage/' . $aboutLogo); @endphp
                                                    <div class="border rounded overflow-hidden p-2" style="width:100px; height:100px; display:flex; justify-content:center; align-items:center;">
                                                        <img src="{{ $logoUrl }}" alt="Logo saat ini" class="img-fluid" style="max-height:100%; max-width:100%;">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Konten Tentang Bebras</label>
                                        <textarea name="home_about_content" class="form-control tinymce-editor" rows="8">{{ $aboutContent }}</textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary">
                                        <i class="bx bx-save me-1"></i> Simpan Tentang Bebras
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Tab 2: CTA Section --}}
                    <div class="tab-pane fade" id="tab-cta" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Ubah CTA Banner Beranda</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('beranda.cta.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label class="form-label">Judul CTA <span class="text-danger">*</span></label>
                                        <input type="text" name="home_cta_title" class="form-control" value="{{ $ctaTitle }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi CTA</label>
                                        <textarea name="home_cta_description" class="form-control" rows="3">{{ $ctaDescription }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Link CTA / URL Info Lengkap</label>
                                        <input type="text" name="home_cta_link" class="form-control" value="{{ $ctaLink }}">
                                    </div>

                                    <button type="submit" class="btn btn-primary">
                                        <i class="bx bx-save me-1"></i> Simpan CTA
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Tab 3: Kegiatan Beranda --}}
                    <div class="tab-pane fade" id="tab-kegiatan" role="tabpanel">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Daftar Kegiatan Beranda (Kartu)</h5>
                                <a href="{{ route('beranda.kegiatan.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bx bx-plus me-1"></i> Tambah Kegiatan Beranda
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="table-kegiatan-beranda" class="table table-striped table-borderless border-bottom" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Gambar</th>
                                                <th>Judul</th>
                                                <th>Urutan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Data AJAX -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="content-backdrop fade"></div>
</div>
@endsection

@push('js')
<script>
$(function () {
    $('#table-kegiatan-beranda').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('beranda.kegiatan.list') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'gambar', name: 'gambar', orderable: false, searchable: false },
            { data: 'judul', name: 'judul' },
            { data: 'urutan', name: 'urutan' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        order: [[3, 'asc']]
    });
});
</script>
@endpush
