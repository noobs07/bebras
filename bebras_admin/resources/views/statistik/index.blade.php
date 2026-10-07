@extends('app')

@section('content')
    <div class="col-12">
        <x-breadcrumbs :items="$breadcrumbs" />
    </div>

    {{-- Form Input --}}
    <div class="col-12 mb-4">
        <div class="card">
            <h5 class="card-header">Input Data Statistik</h5>
            <div class="card-body">

                {{-- Alert Box --}}
                <div id="alert-box" class="alert mb-3" role="alert" style="display:none;"></div>

                <form id="form-statistik">
                    @csrf
                    <div class="row g-3">
                        {{-- Tahun --}}
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Tahun <span class="text-danger">*</span></label>
                            <input type="number" name="year" id="field-year" class="form-control"
                                placeholder="cth. 2024" min="1000" max="9999" required>
                        </div>

                        {{-- Si Kecil --}}
                        <div class="col-md-2">
                            <label class="form-label">Si Kecil</label>
                            <input type="number" name="si_kecil" id="field-si_kecil" class="form-control"
                                placeholder="0" min="0">
                        </div>

                        {{-- Siaga --}}
                        <div class="col-md-2">
                            <label class="form-label">Siaga</label>
                            <input type="number" name="siaga" id="field-siaga" class="form-control"
                                placeholder="0" min="0">
                        </div>

                        {{-- Penggalang --}}
                        <div class="col-md-2">
                            <label class="form-label">Penggalang</label>
                            <input type="number" name="penggalang" id="field-penggalang" class="form-control"
                                placeholder="0" min="0">
                        </div>

                        {{-- Penegak --}}
                        <div class="col-md-2">
                            <label class="form-label">Penegak</label>
                            <input type="number" name="penegak" id="field-penegak" class="form-control"
                                placeholder="0" min="0">
                        </div>

                        {{-- Pria --}}
                        <div class="col-md-2">
                            <label class="form-label">Pria</label>
                            <input type="number" name="pria" id="field-pria" class="form-control"
                                placeholder="0" min="0">
                        </div>

                        {{-- Wanita --}}
                        <div class="col-md-2">
                            <label class="form-label">Wanita</label>
                            <input type="number" name="wanita" id="field-wanita" class="form-control"
                                placeholder="0" min="0">
                        </div>

                        {{-- Sekolah --}}
                        <div class="col-md-2">
                            <label class="form-label">Sekolah</label>
                            <input type="number" name="sekolah" id="field-sekolah" class="form-control"
                                placeholder="0" min="0">
                        </div>

                        {{-- Biro --}}
                        <div class="col-md-2">
                            <label class="form-label">Biro</label>
                            <input type="number" name="biro" id="field-biro" class="form-control"
                                placeholder="0" min="0">
                        </div>
                    </div>

                    <div class="mt-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary" id="btn-simpan">
                            <i class="bx bx-save me-1"></i> Simpan
                        </button>
                        <button type="button" class="btn btn-secondary" id="btn-reset">
                            <i class="bx bx-reset me-1"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Tabel Rekapitulasi --}}
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">Rekapitulasi Data Statistik</h5>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered" id="table-statistik">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tahun</th>
                                <th>Si Kecil</th>
                                <th>Siaga</th>
                                <th>Penggalang</th>
                                <th>Penegak</th>
                                <th>Pria</th>
                                <th>Wanita</th>
                                <th>Sekolah</th>
                                <th>Biro</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- data dimuat via DataTables AJAX --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    const renderNum = function(data) {
        if (data === null || data === undefined || data === '') return '-';
        return Number(data).toLocaleString('id-ID');
    };

    // Inisialisasi DataTables
    var table = $('#table-statistik').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('statistik.list') }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'year',        name: 'year' },
            { data: 'si_kecil',    name: 'si_kecil', render: renderNum },
            { data: 'siaga',       name: 'siaga', render: renderNum },
            { data: 'penggalang',  name: 'penggalang', render: renderNum },
            { data: 'penegak',     name: 'penegak', render: renderNum },
            { data: 'pria',        name: 'pria', render: renderNum },
            { data: 'wanita',      name: 'wanita', render: renderNum },
            { data: 'sekolah',     name: 'sekolah', render: renderNum },
            { data: 'biro',        name: 'biro', render: renderNum },
            { data: 'actions',     name: 'actions', orderable: false, searchable: false },
        ],
    });

    // Submit form via fetch
    document.getElementById('form-statistik').addEventListener('submit', function (e) {
        e.preventDefault();

        const form    = e.target;
        const alertBox = document.getElementById('alert-box');
        const formData = new FormData(form);
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('{{ route('statistik.store') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: formData,
        })
        .then(function (response) {
            return response.json();
        })
        .then(function (json) {
            alertBox.style.display = 'block';
            if (json.success) {
                alertBox.className = 'alert alert-success';
                alertBox.textContent = json.message;
                form.reset();
                table.ajax.reload(null, false);
            } else {
                alertBox.className = 'alert alert-danger';
                alertBox.textContent = json.message ?? 'Terjadi kesalahan.';
            }
            // sembunyikan alert setelah 4 detik
            setTimeout(function () {
                alertBox.style.display = 'none';
            }, 4000);
        })
        .catch(function (err) {
            alertBox.style.display = 'block';
            alertBox.className = 'alert alert-danger';
            alertBox.textContent = 'Gagal menghubungi server: ' + err.message;
        });
    });

    // Tombol Reset — kosongkan semua field form
    document.getElementById('btn-reset').addEventListener('click', function () {
        document.getElementById('form-statistik').reset();
        var alertBox = document.getElementById('alert-box');
        alertBox.style.display = 'none';
        alertBox.textContent   = '';
    });

    // editStatistik(id) — ambil data dari server, isi ulang field form
    function editStatistik(id) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('{{ url('statistik') }}/' + id + '/edit', {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
        })
        .then(function (response) {
            if (!response.ok) {
                throw new Error('Data tidak ditemukan (HTTP ' + response.status + ')');
            }
            return response.json();
        })
        .then(function (data) {
            document.getElementById('field-year').value       = data.year       ?? '';
            document.getElementById('field-si_kecil').value   = data.si_kecil   ?? '';
            document.getElementById('field-siaga').value      = data.siaga      ?? '';
            document.getElementById('field-penggalang').value = data.penggalang ?? '';
            document.getElementById('field-penegak').value    = data.penegak    ?? '';
            document.getElementById('field-pria').value       = data.pria       ?? '';
            document.getElementById('field-wanita').value     = data.wanita     ?? '';
            document.getElementById('field-sekolah').value    = data.sekolah    ?? '';
            document.getElementById('field-biro').value       = data.biro       ?? '';

            // scroll ke form
            document.getElementById('form-statistik').scrollIntoView({ behavior: 'smooth' });
        })
        .catch(function (err) {
            var alertBox = document.getElementById('alert-box');
            alertBox.style.display = 'block';
            alertBox.className     = 'alert alert-danger';
            alertBox.textContent   = 'Gagal memuat data: ' + err.message;
        });
    }

    // deleteStatistik(id) — hapus data statistik dengan konfirmasi SweetAlert / alert
    function deleteStatistik(id) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const doDelete = function () {
            fetch('{{ url('statistik') }}/' + id, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
            })
            .then(function (response) {
                return response.json();
            })
            .then(function (json) {
                if (json.success) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: json.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        alert(json.message);
                    }
                    table.ajax.reload(null, false);
                } else {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire('Gagal!', json.message ?? 'Terjadi kesalahan.', 'error');
                    } else {
                        alert(json.message ?? 'Terjadi kesalahan.');
                    }
                }
            })
            .catch(function (err) {
                if (typeof Swal !== 'undefined') {
                    Swal.fire('Error!', 'Gagal menghubungi server: ' + err.message, 'error');
                } else {
                    alert('Gagal menghubungi server: ' + err.message);
                }
            });
        };

        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data statistik ini akan dihapus!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then(function (result) {
                if (result.isConfirmed) {
                    doDelete();
                }
            });
        } else {
            if (confirm('Apakah Anda yakin ingin menghapus data statistik ini?')) {
                doDelete();
            }
        }
    }
</script>
@endpush
