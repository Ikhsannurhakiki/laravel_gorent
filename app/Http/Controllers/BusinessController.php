<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        // abort_unless($business->user_id === $user->id, 403, 'This business does not belong to this user.');

        // Opsional: pastikan user yang login juga sama
        abort_unless(Auth::id() === $user->id, 403, 'You cannot access other user\'s business.');
        return view('dashboard', compact('user'));
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
    public function show(User $user, Business $business)
    {
        // Pastikan business benar milik user yang di-URL
        abort_unless($business->user_id === $user->id, 403, 'This business does not belong to this user.');

        // Opsional: pastikan user yang login juga sama
        abort_unless(Auth::id() === $user->id, 403, 'You cannot access other user\'s business.');

        return view('business-detail', [
            'user' => $user,
            'business' => $business,
            'units' => $business->units()->latest()->paginate(3),
            'title' => 'Business Detail',
        ]);
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
        //
    }
}
