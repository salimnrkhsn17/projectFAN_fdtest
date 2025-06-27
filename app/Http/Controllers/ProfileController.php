<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $user->name = $validated['name'];
        $user->save();

        // Jika request AJAX, balikan JSON
        if ($request->ajax()) {
            return response()->json(['success' => 'Nama berhasil diperbarui!']);
        }
        return back()->with('success', 'Nama berhasil diperbarui!');
    }
}
