<?php

namespace App\Http\Controllers;

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

            $products['products'] = DB::table('keranjang')
                ->join('produk', 'keranjang.id_produk', '=', 'produk.id_produk')
                ->where('keranjang.id_customer', '=', $idUser)
                ->get();

            return view('pages/user/pesanan/pesanan')->with($products);
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
            'total_harga' => 'require',
            'id_produk' => 'required',
            'qty' => 'required',
            'id_customers' => 'required',
        ]);

        DB::beginTransaction();

        try {
           
            $pesanan = new Pesanan();
            $pesanan->total_harga = $request->total_harga;
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

            return redirect()->route('/pesanan')->with('success', 'Berhasil checkout. Silahkan lanjutkan proses');

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
}
