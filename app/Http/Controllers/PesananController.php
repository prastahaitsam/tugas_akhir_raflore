<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DetPesanan;
use App\Models\Keranjang;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::guard('customer')->check()) {
            $idUser = Auth::guard('customer')->user()->id;

            $pesanan['pesanan'] = DB::table('pesanan')
                ->join('det_pesanan', 'det_pesanan.id_pesanan', '=', 'pesanan.id')
                ->join('produk', 'det_pesanan.id_produk', '=', 'produk.id_produk')
                ->where('det_pesanan.id_customer', '=', $idUser)
                ->get();

            return view('pages/user/pesanan/pesanan')->with($pesanan);
        } else {
            return redirect('/login')->with('failed', 'Untuk melihat pesanan, silahkan login.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'total_harga' => 'required',
            'id_produk' => 'required',
            'qty' => 'required',
            'id_customers' => 'required',
        ]);

        DB::beginTransaction();

        try {

            $pesanan = new Pesanan();
            $pesanan->total_harga = $request->total_harga;

            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = config('midtrans.serverKey');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;

            $params = array(
                'transaction_details' => array(
                    'order_id' => rand(),
                    'gross_amount' => $request->total_harga,
                ),
                'customer_details' => array(
                    'first_name' => Auth::guard('customer')->user()->name,
                    'email' => Auth::guard('customer')->user()->email,
                ),
            );

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            $pesanan->snap_token = $snapToken;
            $pesanan->status = 'Menunggu Pembayaran';
            $pesanan->save();

            $idPesanan = $pesanan->id;

            $idProduks = explode(',', $request->id_produk);
            $quantities = explode(',', $request->qty);

            foreach ($idProduks as $index => $idProduk) {
                $detPesanan = new DetPesanan();
                $detPesanan->id_pesanan = $idPesanan;
                $detPesanan->id_produk = $idProduk;
                $detPesanan->qty = $quantities[$index];
                $detPesanan->id_customer = $request->id_customers;
                $detPesanan->save();

                Keranjang::where('id_produk', $idProduk)
                    ->where('id_customer', $request->id_customers)
                    ->delete();
            }

            DB::commit();

            return redirect('/pesanan')->with('success', 'Berhasil checkout. Silahkan lakukan pembayaran');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('An error occurred while placing the order: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateStatusTransaksi(Request $request){
        $payment = Pesanan::find($request->id);

        if ($payment) {
            $payment->status = "Sedang Diproses";
            $payment->save();

            return redirect('/pesanan');
        }

        return response()->json(['message' => 'Payment not found'], 404);
    }

    public function showPesanan(){

        $level = Auth::guard('user')->user()->level;

        if ($level == "produksi") {
            $data = DB::table('pesanan')
                ->join('det_pesanan', 'det_pesanan.id_pesanan', '=', 'pesanan.id')
                ->join('produk', 'det_pesanan.id_produk', '=', 'produk.id_produk')
                ->join('customers', 'det_pesanan.id_customer', '=', 'customers.id')
                ->where('pesanan.status', "Sedang Diproses")
                ->get();
        } else {
            $data = DB::table('pesanan')
                ->join('det_pesanan', 'det_pesanan.id_pesanan', '=', 'pesanan.id')
                ->join('produk', 'det_pesanan.id_produk', '=', 'produk.id_produk')
                ->join('customers', 'det_pesanan.id_customer', '=', 'customers.id')
                ->get();
        }

        return view('pages/admin/pesanan/pesanan', ['data' => $data]);
    }
}
