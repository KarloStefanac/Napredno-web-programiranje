<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'is_admin']);
    // }
    public function index()
    {
        $users = User::orderBy('name')->paginate(20);
        return view('admin.users.index', compact('users'));
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
    public function edit(User $user)
    {
        $roles = ['admin' => 'Admin', 'nastavnik' => 'Nastavnik', 'student' => 'Student'];
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,nastavnik,student',
        ]);

        // zaštite
        if ($user->id === auth()->id() && $request->role !== 'admin') {
            return back()->withErrors(['role' => 'Ne možete sebi oduzeti admin privilegije.']);
        }

        // spriječi uklanjanje posljednjeg admina
        if ($user->role === 'admin' && $request->role !== 'admin') {
            $adminCount = User::where('role', 'admin')->count();
            if ($adminCount <= 1) {
                return back()->withErrors(['role' => 'Ne možete ukloniti posljednjeg admina.']);
            }
        }

        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Uloga ažurirana.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
