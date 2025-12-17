<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function index()
    {
        $members = User::where('role', 'member')->get();
        return view('admin.members.index', compact('members'));
    }

    public function create()
    {
        return view('admin.members.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'password' => Hash::make($validated['password']),
            'role' => 'member',
            'saldo_simpanan' => 0
        ]);

        return redirect()->route('admin.members.index')
            ->with('success', 'Anggota berhasil ditambahkan!');
    }

    public function edit(User $member)
    {
        if ($member->role !== 'member') {
            abort(404);
        }

        return view('admin.members.edit', compact('member'));
    }

    public function update(Request $request, User $member)
    {
        if ($member->role !== 'member') {
            abort(404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $member->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $member->update($data);

        return redirect()->route('admin.members.index')
            ->with('success', 'Data anggota berhasil diupdate!');
    }

    public function destroy(User $member)
    {
        if ($member->role !== 'member') {
            abort(404);
        }

        $member->delete();

        return redirect()->route('admin.members.index')
            ->with('success', 'Anggota berhasil dihapus!');
    }
}
