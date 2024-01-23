<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderByDesc('created_at')->get();
        return view('dashboard.driver.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::get();
        return view('dashboard.driver.tambah', [
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'id_driver' => 'required|unique:users,id_driver',
            'district' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email:dns|unique:users,email',
            'password' => 'required|min:6',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'id_driver.required' => 'ID Driver tidak boleh kosong',
            'district.required' => 'Kecamatan tidak boleh kosong',
            'no_hp.required' => 'Nomor Hp tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ]);
        User::create([
            'name' => $request->name,
            'id_driver' => $request->id_driver,
            'district' => $request->district,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('dashboard.driver.index')->with('success', 'Data Berhasil Disimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::findOrFail($id);
        return view('dashboard.driver.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'id_driver' => 'required',
                'district' => 'required',
                'no_hp' => 'required',
                'email' => 'required',
                'password' => 'nullable|min:6',
            ],
            [
                'name.required' => 'Nama tidak boleh kosong',
                'id_driver.required' => 'Id Driver tidak boleh kosong',
                'district.required' => 'Kecamatan tidak boleh kosong',
                'no_hp.required' => 'Nomor Hp tidak boleh kosong',
                'email.required' => 'Email tidak boleh kosong',
                'password.min' => 'Password harus terdiri dari minimal 6 karakter',
            ]
        );

        $userData = [
            'name' => $request->name,
            'id_driver' => $request->id_driver,
            'district' => $request->district,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $users = User::findOrFail($id);
        $users->update($userData);

        return redirect()->route('dashboard.driver.index')->with('edit', 'Data Berhasil Diupdate!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $users = User::findOrFail($id);
        $users->delete();

        return back();
    }
}
