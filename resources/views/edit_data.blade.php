@extends('adminlte::page')

@section('title', 'Edit Supplier')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Data Supplier</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{ url('/supplier/tampil_data') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>

                    @foreach ($supplier as $s)
                        <form action="{{ url('/supplier/update_data') }}" method="post">
                            @csrf
                            <input type="hidden" name="s_no" value="{{ $s->s_no }}">

                            <div class="form-group row">
                                <label for="s_no" class="col-sm-2 col-form-label">Nomor Supplier</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control-plaintext" id="s_no"
                                        value="{{ $s->s_no }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ old('nama', $s->nama) }}" required>
                                    @error('nama')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kota" class="col-sm-2 col-form-label">Kota</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('kota') is-invalid @enderror"
                                        id="kota" name="kota" value="{{ old('kota', $s->kota) }}" required>
                                    @error('kota')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan Data
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Add any JavaScript initialization here
        });
    </script>
@stop
