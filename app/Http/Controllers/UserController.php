<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get("search");
        $title = 'Hapus petugas!';
        $text = "Apakah kamu yakin ingin menghapus Petugas tersebut";
        confirmDelete($title, $text);
        $users = User::search($search)->latest()->paginate(8);
        return view('user.index', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        User::create($request->all());
        Alert::toast('Data Berhasil Ditambah', 'success');
        return redirect()->route('petugas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $petuga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $petuga)
    {
        $petugas = $petuga;
        return view('user.edit', compact('petugas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $petuga)
    {
        if (!$request->password) {
            $petuga->update([
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'level' => $request->level,
            ]);
        } else {
            $petuga->update($request->all());
        }
        Alert::toast('Petugas Berhasil Diubah', 'success');
        return redirect()->route('petugas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $petuga)
    {
        $petuga->delete();
        Alert::toast('Petugas Berhasil Dihapus', 'success');
        return redirect()->route('petugas.index');
    }
}
