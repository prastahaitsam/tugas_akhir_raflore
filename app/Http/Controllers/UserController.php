<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::all();

        return view('pages/admin/user/user', ['data' => $data]);
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
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'level' => 'required',
        ]);

        $user = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'level' => $request->level,
        ];

        User::create($user);

        return redirect('/data-user')->with('success', 'Tambah data user sukses.');
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
    public function update(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'level' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors()->toJson());
        }
        $update = User::where('id', $request->id)->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'level' => $request->get('level')
        ]);
        if ($update) {
            return redirect('/data-user')->with('success', 'Edit data user sukses.');
        } else {
            return redirect('/data-user')->with('failed', 'Edit data user gagal.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $delete = User::where('id', $request->id_hapus)->delete();
        if ($delete) {
            return redirect('/data-user')->with('success', 'Hapus data user sukses.');
        } else {
            return redirect('/data-user')->with('failed', 'Hapus data user gagal.');
        }
    }
}
