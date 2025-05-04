<?php

namespace App\Http\Controllers\Api;

use App\Models\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|min:3',
            'password' => 'required|string|min:6|confirmed',
            'username' => 'required|string|min:3|max:15|unique:m_user',
            'level_id' => 'required|integer|min:1'
        ]);
        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }
        $user = UserModel::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'level_id' => $request->level_id,
        ]);
        if ($user) {
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil disimpan',
                'user' => $user
            ],201);
        }
        return response()->json([
            'status' => false,
            'message' => 'Data gagal disimpan'
        ],409);
    }
}
