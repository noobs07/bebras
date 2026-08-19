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

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Tabel Menu Kegiatan</h5>
                        <a href="{{ route('menu_kegiatan.create') }}" class="btn btn-primary btn-sm">
                            <i class="bx bx-plus me-1"></i> Tambah Menu
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table-menu-kegiatan"
                                   class="table table-striped table-borderless border-bottom">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Menu</th>
                                        <th>Slug</th>
                                        <th>Parent</th>
                                        <th>Judul Konten</th>
                                        <th>Urutan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data via AJAX -->
                                </tbody>
                            </table>
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
    $('#table-menu-kegiatan').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('menu_kegiatan.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nama_menu', name: 'nama_menu' },
            { data: 'slug', name: 'slug' },
            { data: 'parent', name: 'parent', orderable: false, searchable: false },
            { data: 'judul', name: 'judul' },
            { data: 'urutan', name: 'urutan' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        order: [[5, 'asc']]
    });
});
</script>
@endpush
