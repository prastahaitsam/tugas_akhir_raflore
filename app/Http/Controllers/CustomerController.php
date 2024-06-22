<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Customer::orderBy('created_at', 'desc')->get();

        return view('pages/user/customer/customer', ['data' => $data]);
    }

    public function dataCustomer()
    {
        $data = Customer::orderBy('created_at', 'desc')->get();

        return view('pages/admin/customer/customer', ['data' => $data]);
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
        //     'name' => 'required',
        //     'email' => 'required',
        //     'password' => 'required',
        // ]);
        // if ($validate->fails()) {
        //     return redirect('/data-customer')->with('failed', 'Tidak boleh kosong!');
        // }

       

        // $create = Customer::create([
        //     'name' => $request->get('name'),
        //     'email' => $request->get('email'),
        //     'password' => $request->get('password')
        // ]);

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

       


        $create = Customer::create($data);

        if ($create) {
            return redirect('/data-customer')->with('success', 'Tambah data customer sukses.');
        } else {
            return redirect('/data-customer')->with('failed', 'Tambah data customer gagal.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Customer::where('id', $id)->get();

        return view('pages/user/customer/viewCustomer', ['data' => $data]);
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
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors()->toJson());
        }
        $create = Customer::where('id', $request->id)->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ]);
        if ($create) {
            return redirect('/data-customer')->with('success', 'Edit data customer sukses.');
        } else {
            return redirect('/data-customer')->with('failed', 'Edit data customer gagal.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        
        $delete = Customer::where('id', $request->id_hapus)->delete();
        if ($delete) {
            return redirect('/data-customer')->with('success', 'Hapus data customer sukses.');
        } else {
            return redirect('/data-customer')->with('failed', 'Hapus data customer gagal.');
        }
    }
}
