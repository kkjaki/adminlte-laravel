@extends('adminlte::page')

@section('title', 'Tambah Supplier')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Supplier</h1>
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

                    <form action="{{ url('/supplier/simpan_data') }}" method="POST">
                        @csrf

                        <div class="form-group row">
                            <label for="s_no" class="col-sm-2 col-form-label">Nomor Supplier</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">S</span>
                                    </div>
                                    <input type="text" class="form-control @error('s_no') is-invalid @enderror"
                                        id="s_no" name="s_no" value="{{ old('s_no') }}"
                                        placeholder="Masukkan nomor supplier (contoh: 001)" required>
                                    @error('s_no')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">
                                    Format: 3 digit angka (contoh: 001, 002, dst)
                                </small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama Supplier</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" value="{{ old('nama') }}"
                                    placeholder="Masukkan nama supplier" required>
                                @error('nama')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kota" class="col-sm-2 col-form-label">Kota</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('kota') is-invalid @enderror"
                                    id="kota" name="kota" value="{{ old('kota') }}"
                                    placeholder="Masukkan kota supplier" required>
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
                                <button type="reset" class="btn btn-secondary">
                                    <i class="fas fa-undo"></i> Reset
                                </button>
                            </div>
                        </div>
                    </form>
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
            // Auto-format s_no input to ensure 3 digits
            $('#s_no').on('input', function() {
                let value = $(this).val();
                // Remove non-numeric characters
                value = value.replace(/[^0-9]/g, '');

                // Ensure maximum length of 3
                if (value.length > 3) {
                    value = value.substr(0, 3);
                }

                // Pad with zeros if needed
                while (value.length < 3 && value.length > 0) {
                    value = '0' + value;
                }

                $(this).val(value);
            });

            // Form validation before submit
            $('form').on('submit', function(e) {
                const sNo = $('#s_no').val();
                if (sNo.length !== 3) {
                    e.preventDefault();
                    alert('Nomor supplier harus terdiri dari 3 digit angka.');
                    return false;
                }
                return true;
            });
        });
    </script>
@stop
