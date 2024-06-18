<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Produk::orderBy('created_at', 'desc')->get();

        return view('pages/user/produk/produk', ['data' => $data]);
    }

    public function dataProduk()
    {
        $data = Produk::orderBy('created_at', 'desc')->get();

        return view('pages/admin/produk/produk', ['data' => $data]);
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
        // $validate = Validator::make($request->all(), [
        //     'nama_produk' => 'required',
        //     'gambar' => 'image',
        //     'harga' => 'required',
        //     'deskripsi' => 'required',
        // ]);
        // if ($validate->fails()) {
        //     return redirect('/data-produk')->with('failed', 'Tidak boleh kosong!');
        // }

        // $file = $request->file('gambar');
        // $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        // $data['gambar'] = $file->storeAs('gambar-produk', $fileName);
        // $data['gambar'] = $fileName;

        // $create = Produk::create([
        //     'nama_produk' => $request->get('nama_produk'),
        //     'gambar' => $request->get('gambar'),
        //     'harga' => $request->get('harga'),
        //     'deskripsi' => $request->get('deskripsi')
        // ]);

        $data = $request->validate([
            'nama_produk' => 'required',
            'gambar' => 'image',
            'harga' => 'required',
            'deskripsi' => 'required',
        ]);

        $file = $request->file('gambar');
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $data['gambar'] = $file->storeAs('produk-images', $fileName);
        $data['gambar'] = $fileName;


        $create = Produk::create($data);

        if ($create) {
            return redirect('/data-produk')->with('success', 'Tambah data produk sukses.');
        } else {
            return redirect('/data-produk')->with('failed', 'Tambah data produk gagal.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Produk::where('id_produk', $id)->get();

        return view('pages/user/produk/viewProduk', ['data' => $data]);
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
    public function update(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama_produk' => 'required',
            'gambar' => 'image',
            'harga' => 'required',
            'deskripsi' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors()->toJson());
        }
        $create = Produk::where('id_produk', $request->id)->update([
            'nama_produk' => $request->get('nama_produk'),
            'harga' => $request->get('harga'),
            'deskripsi' => $request->get('deskripsi')
        ]);
        if ($create) {
            return redirect('/data-produk')->with('success', 'Edit data produk sukses.');
        } else {
            return redirect('/data-produk')->with('failed', 'Edit data produk gagal.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Storage::delete('produk-images/' . $request->gambarLama);
        $delete = Produk::where('id_produk', $request->id_hapus)->delete();
        if ($delete) {
            return redirect('/data-produk')->with('success', 'Hapus data produk sukses.');
        } else {
            return redirect('/data-produk')->with('failed', 'Hapus data produk gagal.');
        }
    }
}
