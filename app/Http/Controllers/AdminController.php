<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.index', compact('users'));
    }

    /**
     * Toggle admin status for a user.
     */
    public function toggleAdmin($id)
    {
        if (!Auth::user()->is_super_admin) {
            return back();
        }
        
        $user = User::findOrFail($id);
        
        if ($user->id === Auth::id()) {
            return back();
        }
        
        $user->is_admin = !$user->is_admin;
        $user->save();
        
        return back();
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Auth::user()->is_super_admin) {
            return back();
        }

        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return back();
        }

        $user->delete();

        return back();
    }
}
