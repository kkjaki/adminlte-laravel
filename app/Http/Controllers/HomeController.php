<?php

namespace App\Http\Controllers;

use App\Models\GoodsReceipt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
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
            DB::raw('DATE(tanggal_terima) as date'), // Mengubah format ke daily
            DB::raw('count(*) as total')
        )
            ->whereRaw('tanggal_terima >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)') // Mengambil data 30 hari terakhir
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->map(function ($item) {
                return [
                    'date' => Carbon::parse($item->date)->format('d M Y'), // Format tanggal menjadi lebih readable
                    'total' => $item->total
                ];
            });

        // Render the dashboard view with the data
        return view('home', compact('supplierData', 'kondisiData', 'monthlyData'));
    }
}
