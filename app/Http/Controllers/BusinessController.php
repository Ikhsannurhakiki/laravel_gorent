<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Business;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        return view('dashboard', [
            'user' => $user,
            'businesses' => $user->businesses,
            'title' => 'business',
        ]);
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
        // abort_unless($business->user_id === $user->id, 403);

        return view('business-detail', [
            'user' => $user,
            'business' => $business,
            'units' => $business->units()
                ->latest()
                ->paginate(3),
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
