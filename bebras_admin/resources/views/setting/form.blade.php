@extends('app')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-breadcrumbs :items="$breadcrumbs" />

        <div class="row justify-content-center">
            <div class="col-md-8">

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <strong>Error!</strong> {{ $errors->first() }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">{{ isset($data) ? 'Edit Pengaturan' : 'Tambah Pengaturan' }}</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST"
                              action="{{ isset($data) ? route('setting.update', $data->id) : route('setting.store') }}">
                            @csrf
                            @if(isset($data))
                                @method('PUT')
                            @endif

                            <div class="mb-3">
                                <label class="form-label">Key <span class="text-danger">*</span></label>
                                <input type="text" name="key" class="form-control"
                                       value="{{ old('key', $data->key ?? '') }}"
                                       placeholder="cth: home_cta_title"
                                       {{ isset($data) ? '' : 'required' }}>
                                <div class="form-text">Gunakan huruf kecil dan underscore. Tidak boleh duplikat.</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nilai</label>
                                <textarea name="nilai" class="form-control" rows="8"
                                          placeholder="Isi nilai pengaturan (boleh HTML)">{{ old('nilai', $data->nilai ?? '') }}</textarea>
                                <div class="form-text">Boleh mengandung HTML. Akan dirender langsung di frontend.</div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bx bx-save me-1"></i> Simpan
                                </button>
                                <a href="{{ route('setting.index') }}" class="btn btn-outline-secondary">Batal</a>
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
