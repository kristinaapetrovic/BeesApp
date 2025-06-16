<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Pcelinjak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\PcelinjakRequest;
use App\Http\Resources\PcelinjakResource;

class PcelinjakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $filteri = request()->only('lokacija');
        $pcelinjaci = Pcelinjak::with('user')->filter($filteri, $user);
        return PcelinjakResource::collection($pcelinjaci->latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PcelinjakRequest $request)
    {
        $user = Auth::user();

        $data = $request->validated();
        $data['user_id'] = $user->id;

        $pcelinjak = Pcelinjak::create($data);

        return response()->json([
            'message' => 'Pčelinjak uspešno kreiran',
            'model' => new PcelinjakResource($pcelinjak)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pcelinjak $pcelinjaci)
    {

        if (Gate::allows('view', $pcelinjaci)) {
            return response()->json([
                'data' => new PcelinjakResource($pcelinjaci),
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Nemate dozvolu da pregledate ovaj pčelinjak.',
            ], 403);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(PcelinjakRequest $request, Pcelinjak $pcelinjaci)
    {
        $data = $request->validated();
        $pcelinjaci->update($data);

        return response()->json([
            'message' => 'Pčelinjak uspešno ažuriran',
            'model' => new PcelinjakResource($pcelinjaci)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pcelinjak $pcelinjaci)
    {
        if (Gate::allows('delete', $pcelinjaci)) {
            $pcelinjaci->delete();

            return response()->json([
                'message' => 'Pčelinjak uspešno obrisan.',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Nemate dozvolu da obrišete ovaj pčelinjak.',
            ], 403);
        }
    }
}
