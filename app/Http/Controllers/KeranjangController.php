<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KeranjangController extends Controller
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

            return view('pages/user/keranjang/keranjang')->with($products);
        } else {
            return redirect('/login')->with('failed', 'Untuk melihat keranjang, silahkan login.');
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
        if (Auth::guard('customer')->check()) {
            $idCustomer = Auth::guard('customer')->user()->id;

            if ($idCustomer > 0) {
                $data = $request->validate([
                    'id_customer' => 'required',
                    'id_produk' => 'required',
                    'sub_total' => 'required',
                    'qty' => 'required',
                ]);

                $create = Keranjang::create($data);

                if ($create) {
                    return redirect('/keranjang')->with('success', 'Silahkan cek keranjang anda.');
                } else {
                    return redirect('/viewproduk')->with('failed', 'Proses gagal.');
                }
            } else {
                echo "data tidak ada";
            }
        } else {
            return redirect('/login')->with('failed', 'Untuk melanjutkan proses, silahkan login.');
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
    public function destroy(Request $request)
    {
        $idProduk = $request->id_produk;
        $idCustomer = Auth::guard('customer')->user()->id;

        Keranjang::where('id_produk', $idProduk)
            ->where('id_customer', $idCustomer)
            ->delete();

        return redirect('/keranjang')->with('success', 'Hapus data produk sukses.');
    }
}
