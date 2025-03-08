<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = UserModel::with('level')->get();
        return view('user', ['data' => $user]);
    }
    function tambah()
    {
        return view('user_tambah');
    }
    function tambah_simpan(Request $req)
    {
        UserModel::create([
            'username' => $req->username,
            'nama' => $req->nama,
            'password' => Hash::make('$req->password'),
            'level_id' => $req->level_id
        ]);
        return redirect('/user');
    }
    public function ubah($id)
    {
        $user = UserModel::find($id);
        return view('user_ubah', ['data' => $user]);
    }
    public function ubah_simpan($id, Request $req)
    {
        $user = UserModel::find($id);
        $user->username = $req->username;
        $user->nama = $req->nama;
        $user->password = Hash::make('$req->password');
        $user->level_id = $req->level_id;
        $user->save();
        return redirect('/user');
    }

    public function hapus($id){
        $user = UserModel::find($id);
        $user->delete();
        return redirect('/user');
    }
}
