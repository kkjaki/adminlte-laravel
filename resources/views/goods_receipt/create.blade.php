@extends('adminlte::page')

@section('title', 'Tambah Penerimaan Barang')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Penerimaan Barang</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <a href="{{ route('goods-receipts.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>

                <form action="{{ route('goods-receipts.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <!-- Kolom Kiri -->
                        <div class="col-md-6">
                            <!-- Supplier -->
                            <div class="form-group">
                                <label for="supplier_id">Supplier <span class="text-danger">*</span></label>
                                <select name="supplier_id" id="supplier_id" 
                                        class="form-control select2 @error('supplier_id') is-invalid @enderror" required>
                                    <option value="">Pilih Supplier</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->s_no }}" 
                                                {{ old('supplier_id') == $supplier->s_no ? 'selected' : '' }}>
                                            {{ $supplier->nama }} - {{ $supplier->kota }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Tanggal Terima -->
                            <div class="form-group">
                                <label for="tanggal_terima">Tanggal Terima <span class="text-danger">*</span></label>
                                <div class="input-group date" id="tanggal_terima_picker" 
                                     data-target-input="nearest">
                                    <input type="text" name="tanggal_terima" 
                                           class="form-control datetimepicker-input @error('tanggal_terima') is-invalid @enderror"
                                           data-target="#tanggal_terima_picker"
                                           value="{{ old('tanggal_terima', date('Y-m-d')) }}"
                                           required>
                                    <div class="input-group-append" data-target="#tanggal_terima_picker"
                                         data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fas fa-calendar"></i></div>
                                    </div>
                                </div>
                                @error('tanggal_terima')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Nama Barang -->
                            <div class="form-group">
                                <label for="nama_barang">Nama Barang <span class="text-danger">*</span></label>
                                <input type="text" name="nama_barang" id="nama_barang" 
                                       class="form-control @error('nama_barang') is-invalid @enderror"
                                       value="{{ old('nama_barang') }}" required>
                                @error('nama_barang')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="col-md-6">
                            <!-- Jumlah -->
                            <div class="form-group">
                                <label for="jumlah">Jumlah <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="jumlah" id="jumlah" 
                                           class="form-control @error('jumlah') is-invalid @enderror"
                                           value="{{ old('jumlah') }}" min="1" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Unit</span>
                                    </div>
                                </div>
                                @error('jumlah')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Kondisi -->
                            <div class="form-group">
                                <label for="kondisi">Kondisi <span class="text-danger">*</span></label>
                                <select name="kondisi" id="kondisi" 
                                        class="form-control @error('kondisi') is-invalid @enderror" required>
                                    <option value="">Pilih Kondisi</option>
                                    <option value="baik" {{ old('kondisi') == 'baik' ? 'selected' : '' }}>
                                        Baik
                                    </option>
                                    <option value="baik" {{ old('kondisi') == 'baik' ? 'selected' : '' }}>
                                        Rusak
                                    </option>
                                </select>
                                @error('kondisi')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Catatan -->
                            <div class="form-group">
                                <label for="catatan">Catatan</label>
                                <textarea name="catatan" id="catatan" rows="4" 
                                          class="form-control @error('catatan') is-invalid @enderror">{{ old('catatan') }}</textarea>
                                @error('catatan')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="row">
                        <div class="col-12">
                            <div class="float-right">
                                <button type="reset" class="btn btn-secondary">
                                    <i class="fas fa-undo"></i> Reset
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                            </div>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css" rel="stylesheet">
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize Select2
    $('.select2').select2({
        theme: 'bootstrap4',
        placeholder: 'Pilih Supplier',
        allowClear: true
    });

    // Initialize Datetime Picker
    $('#tanggal_terima_picker').datetimepicker({
        format: 'YYYY-MM-DD',
        locale: 'id',
        icons: {
            time: 'fas fa-clock',
            date: 'fas fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right',
            today: 'fas fa-calendar-check',
            clear: 'fas fa-trash',
            close: 'fas fa-times'
        }
    });

    // Validasi Form
    $('form').submit(function() {
        // Disable tombol submit untuk mencegah double submission
        $(this).find('button[type="submit"]').prop('disabled', true);
        return true;
    });

    // Auto-focus pada select supplier
    $('#supplier_id').focus();
});
</script>
@stop