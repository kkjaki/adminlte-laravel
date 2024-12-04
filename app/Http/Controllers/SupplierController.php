<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    //
    public function tambah_data()
    {
        return view('tambah_data');
    }

    public function simpan_data(Request $request)
    {
        // insert data ke tabel supplier
        DB::table('suppliers')->insert([
            's_no' => $request->s_no,
            'nama' => $request->nama,
            'kota' => $request->kota,
        ]);
        // alihkan halaman ke halaman tambah data
        return redirect('/supplier/tambah_data');
    }
    public function tampil_data()
    {
        // mengambil data dari tabel supplier
        $suppliers = DB::table('suppliers')->get();

        // mengirim data supplier ke tampil data
        if (Auth::user()->role == 'admin') {
            # code...
            return view('tampil_data', ['suppliers' => $suppliers]);
        } else {
            return view('tampil_data_staff', ['suppliers' => $suppliers]);
        }
    }

    public function edit_data($id)
    {
        // mengambil data supplier berdasarkan id yang dipilih
        $supplier = DB::table('suppliers')->where('s_no', $id)->get();
        // passing data supplier yang didapat ke view edit.blade.php
        return view('edit_data', ['supplier' => $supplier]);
    }


    // update data supplier
    public function update_data(Request $request)
    {
        // update data supplier
        DB::table('suppliers')->where('s_no', $request->s_no)->update([
            'nama' => $request->nama,
            'kota' => $request->kota,
        ]);

        // alihkan halaman ke halaman tampul supplier
        return redirect('/supplier/tampil_data');
    }

    // method untuk hapus data supplier
    public function hapus_data($id)
    {
        try {
            // menghapus data supplier berdasarkan id yang dipilih
            DB::table('suppliers')->where('s_no', $id)->delete();

            return redirect('/supplier/tampil_data')
            ->with('success', 'Data penerimaan barang berhasil dihapus');
        } catch (\Exception $e) {
            return redirect('/supplier/tampil_data')
            ->with('error', 'Gagal menghapus data penerimaan barang');
        }
    }
}
