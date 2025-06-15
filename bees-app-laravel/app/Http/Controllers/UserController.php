<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if (Gate::authorize('view', $user)) { 
            return new UserResource($user);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();
        $user->update($data);

        return response()->json([
            'message' => 'Korisnik uspešno ažurirana',
            'model' => new UserResource($user)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
        
    // }
}
