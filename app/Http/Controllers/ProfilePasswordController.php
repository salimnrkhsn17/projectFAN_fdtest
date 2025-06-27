<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfilePasswordController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }
        // Cek current password
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['success' => false, 'errors' => ['Kata sandi lama salah.']]);
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json(['success' => true, 'message' => 'Password berhasil diubah!']);
    }
}
