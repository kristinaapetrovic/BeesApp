<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Kosnica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\KosnicaRequest;
use App\Http\Resources\KosnicaResource;

class KosnicaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { //kosnica-pcelinjak-user
        $user = Auth::user();
        $filteri = request()->only('tip', 'status', 'pcelinjak');
        $kosnice = Kosnica::with('pcelinjak')->filter($filteri, $user);
        return KosnicaResource::collection($kosnice->latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KosnicaRequest $request)
    {
        $data = $request->validated();

        $kosnica = Kosnica::create($data);

        return response()->json([
            'message' => 'Košnica uspešno kreirana',
            'model' => new KosnicaResource($kosnica)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kosnica $kosnice)
    {
            if (Gate::allows('view', $kosnice)) {
                $kosnice->load(['pcelinjak']);

                return response()->json([
                    'data' => new KosnicaResource($kosnice),
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Nemate dozvolu da pregledate ovu košnicu.',
                ], 403);
            }
        
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(KosnicaRequest $request, Kosnica $kosnice)
    {
        $data = $request->validated();
        $kosnice->update($data);
        return response()->json([
            'message' => 'Košnica uspešno ažurirana',
            'model' => new KosnicaResource($kosnice)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kosnica $kosnice)
    {
        
            if (Gate::allows('delete', $kosnice)) {
                $kosnice->delete();

                return response()->json([
                    'message' => 'Košnica uspešno obrisana.',
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Nemate dozvolu da obrišete ovu košnicu.',
                ], 403);
            }
        
    }
}
