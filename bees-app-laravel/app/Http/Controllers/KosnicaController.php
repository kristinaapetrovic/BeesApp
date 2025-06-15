<?php

namespace App\Http\Controllers;

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
        if (Gate::authorize('view', $kosnice)) { 
            $kosnice->load(['pcelinjak']);
            return new KosnicaResource($kosnice);
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
        if (Gate::authorize('delete', $kosnice)) {
            $kosnice->delete();
            return response()->json([
                'message' => 'Košnica uspešno obrisana',
            ]);
        }
    }
}
