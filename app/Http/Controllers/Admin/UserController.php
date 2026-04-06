<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Tampilkan daftar staff editor.
     */
    public function index()
    {
        // Mengambil semua user kecuali yang sedang login saat ini
        $users = User::where('id', '!=', Auth::id())->get();
        
        return view('admin.users.index', compact('users'));
    }

    /**
     * Proses simpan staff baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'editor',
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Staff Editor baru berhasil ditambahkan!');
    }

    /**
     * Update data staff.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            // Password diset 'nullable' agar boleh kosong, 
            // tapi 'sometimes' & 'min:8' memastikan jika diisi WAJIB minimal 8 karakter.
            'password' => 'nullable|sometimes|min:8',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Data staff berhasil diperbarui!');
    }

    /**
     * Hapus staff.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Staff berhasil dihapus!');
    }
}