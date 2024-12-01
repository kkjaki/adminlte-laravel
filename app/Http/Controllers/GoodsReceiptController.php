<?php

namespace App\Http\Controllers;

use App\Models\GoodsReceipt;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Controller for managing Goods Receipts.
 * This includes operations such as listing receipts, creating new receipts, and displaying dashboards.
 */
class GoodsReceiptController extends Controller
{
    /**
     * Apply authentication middleware to all routes in this controller.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a list of goods receipts.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $receipts = GoodsReceipt::with('supplier')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('goods_receipt.index', compact('receipts'));
    }

    /**
     * Show the form for creating a new goods receipt.
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $suppliers = Supplier::all();
        return view('goods_receipt.create', compact('suppliers'));
    }

    /**
     * Store a newly created goods receipt in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate input data
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,s_no',
            'tanggal_terima' => 'required|date',
            'nama_barang' => 'required|string',
            'jumlah' => 'required|integer|min:1',
            'kondisi' => 'required|in:baik,rusak',
            'catatan' => 'nullable|string',
        ]);

        // Create a new goods receipt
        GoodsReceipt::create([
            'user_id' => auth()->id(),
            'supplier_id' => $request->supplier_id,
            'tanggal_terima' => $request->tanggal_terima,
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'kondisi' => $request->kondisi,
            'catatan' => $request->catatan,
        ]);

        // Redirect to the index page with a success message
        return redirect()->route('goods-receipts.index')
            ->with('success', 'Data penerimaan barang berhasil disimpan');
    }
    /**
     * Show the form for editing the specified goods receipt.
     *
     * @param  \App\Models\GoodsReceipt  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Ambil data goods receipt beserta relasinya
        $goodsReceipt = GoodsReceipt::with(['supplier', 'user'])->findOrFail($id);
        
        // Ambil semua supplier untuk dropdown
        $suppliers = Supplier::all();
        
        return view('goods_receipt.edit', compact('goodsReceipt', 'suppliers'));
    }

    /**
     * Update the specified goods receipt in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GoodsReceipt  $goodsReceipt
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,s_no',
            'tanggal_terima' => 'required|date',
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'kondisi' => 'required|in:baik,rusak',
            'catatan' => 'nullable|string'
        ]);

        // Update data
        $goodsReceipt = GoodsReceipt::findOrFail($id);
        $goodsReceipt->update($request->all());

        return redirect()->route('goods-receipts.index')
                        ->with('success', 'Data penerimaan barang berhasil diperbarui');
    }

    /**
     * Remove the specified goods receipt from storage.
     *
     * @param  \App\Models\GoodsReceipt  $goodsReceipt
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            // Delete the goods receipt
            DB::table('goods_receipts')->where('id',$id)->delete();

            return redirect()->route('goods-receipts.index')
                ->with('success', 'Data penerimaan barang berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('goods-receipts.index')
                ->with('error', 'Gagal menghapus data penerimaan barang');
        }
    }
    /**
     * Display the dashboard with summarized data.
     * Includes data for:
     * - Total receipts per supplier
     * - Item conditions (good/damaged)
     * - Monthly receipt trends
     * - Admin-only feature
     * 
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        // Data for total receipts per supplier
        $supplierData = GoodsReceipt::with('supplier')
            ->select('supplier_id', DB::raw('count(*) as total'))
            ->groupBy('supplier_id')
            ->get()
            ->map(function ($item) {
                return [
                    'label' => $item->supplier->nama,
                    'value' => $item->total,
                ];
            });

        // Data for item conditions (good/damaged)
        $kondisiData = GoodsReceipt::select('kondisi', DB::raw('count(*) as total'))
            ->groupBy('kondisi')
            ->get();

        // Data for monthly receipt trends
        $monthlyData = GoodsReceipt::select(
            DB::raw('DATE_FORMAT(tanggal_terima, "%Y-%m") as month'),
            DB::raw('count(*) as total')
        )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Render the dashboard view with the data
        return view('goods_receipt.dashboard', compact('supplierData', 'kondisiData', 'monthlyData'));
    }
}
