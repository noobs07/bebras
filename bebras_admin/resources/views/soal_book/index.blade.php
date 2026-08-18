@extends('app')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-breadcrumbs :items="$breadcrumbs" />

        <div class="row">
            <div class="col-md-12">

                {{-- Alert --}}
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
                        <h5 class="mb-0">📚 Sumber Buku Pembahasan Soal</h5>
                        <a href="{{ route('soal_book.create') }}" class="btn btn-primary btn-sm">
                            <i class="bx bx-plus me-1"></i> Tambah Buku
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table-soal-book" class="table table-striped table-borderless border-bottom">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Cover</th>
                                        <th>Kategori</th>
                                        <th>Judul</th>
                                        <th>Urutan</th>
                                        <th>PDF</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
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
    $('#table-soal-book').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('soal_book.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'cover_preview', name: 'cover_preview', orderable: false, searchable: false },
            { data: 'kategori_label', name: 'kategori' },
            { data: 'judul', name: 'judul' },
            { data: 'urutan', name: 'urutan' },
            { data: 'pdf_link_short', name: 'pdf_link', orderable: false, searchable: false },
            {
                data: 'id',
                name: 'aksi',
                orderable: false,
                searchable: false,
                render: function(id) {
                    let editUrl   = "{{ route('soal_book.edit', ':id') }}".replace(':id', id);
                    let deleteUrl = "{{ route('soal_book.destroy', ':id') }}".replace(':id', id);
                    return `
                        <div class="d-flex gap-1">
                            <a href="${editUrl}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="${deleteUrl}" method="POST" onsubmit="return confirm('Yakin hapus buku ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    `;
                }
            }
        ],
        order: [[2, 'asc'], [4, 'asc']]
    });
});
</script>
@endpush
