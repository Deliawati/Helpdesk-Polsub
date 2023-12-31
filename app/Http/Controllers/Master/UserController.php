<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\KategoriLayanan;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all users except login user
        if(auth()->user()->role == 'superadmin'){
            $data['users'] = User::where('id', '!=', auth()->user()->id)
                ->where('role', '!=', 'user')
                ->get();
        }else{
            $data['users'] = User::where('id', '!=', auth()->user()->id)
                ->where('role', '!=', 'superadmin')
                ->where('role', '!=', 'user')
                ->get();
        }
        $data['permissions'] = KategoriLayanan::all();
        return view('master.user.index', $data);
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
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15|unique:users',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string',
            'permissions' => 'nullable|array',
        ]);

        $user = User::create([
            'name' => $request->name,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'role' => 'admin',
            'password' => bcrypt($request->password),            
        ]);

        foreach($request->permissions as $permission){
            $user->permissions()->create([
                'kategori_id' => $permission,
            ]);
        }

        return redirect()->route('master-users.index')->with('success', 'User berhasil ditambahkan');
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
        $request->validate([
            'name' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15|unique:users,no_telp,'.$id,
            'email' => 'required|string|max:255|unique:users,email,' . $id,
            'permissions' => 'nullable|array',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
        ]);

        // if password is not empty, update password
        if (!empty($request->password)) {
            $user->update([
                'password' => bcrypt($request->password),
            ]);
        }

        // delete all permissions
        $user->permissions()->delete();

        // add new permissions
        foreach($request->permissions as $permission){
            $user->permissions()->create([
                'kategori_id' => $permission,
            ]);
        }

        return redirect()->route('master-users.index')->with('success', 'User berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('master-users.index')->with('success', 'User berhasil dihapus');
    }
}
