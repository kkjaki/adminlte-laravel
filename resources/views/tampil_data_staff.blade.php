@extends('adminlte::page')

@section('title', 'Data Supplier')

@section('content_header')
    <h1 class="m-0 text-dark">Data Supplier</h1>
@stop

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="supplier-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nomor Supplier</th>
                                <th>Nama</th>
                                <th>Kota</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suppliers as $s)
                                <tr>
                                    <td>{{ $s->s_no }}</td>
                                    <td>{{ $s->nama }}</td>
                                    <td>{{ $s->kota }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#supplier-table').DataTable({
                "language": {
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Data tidak ditemukan",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data tersedia",
                    "infoFiltered": "(difilter dari _MAX_ total data)",
                    "search": "Cari:",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });
        });

        function confirmDelete(s_no) {
            if (confirm('Apakah Anda yakin ingin menghapus supplier ini?')) {
                window.location.href = "{{ url('/supplier/hapus_data') }}/" + s_no;
            }
        }
    </script>
@stop