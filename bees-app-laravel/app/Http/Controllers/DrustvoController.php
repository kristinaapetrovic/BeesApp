<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Drustvo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\DrustvoRequest;
use App\Http\Resources\DrustvoResource;

class DrustvoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { //drustvo-kosnica-pcelinjak-user
        $user = Auth::user();
        $drustva = Drustvo::with('kosnice')
            ->whereHas('kosnice.pcelinjak', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->latest()
            ->paginate();
        return DrustvoResource::collection($drustva);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DrustvoRequest $request)
    {
        $data = $request->validated();

        $drustvo = Drustvo::create($data);

        return response()->json([
            'message' => 'Društvo uspešno kreirano',
            'model' => new DrustvoResource($drustvo)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Drustvo $drustva)
    {
       
            if (Gate::allows('view', $drustva)) {
                $drustva->load(['kosnica']);

                return response()->json([
                    'data' => new DrustvoResource($drustva),
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Nemate dozvolu da pregledate ovo društvo.',
                ], 403);
            }
        
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(DrustvoRequest $request, Drustvo $drustva)
    {
        $data = $request->validated();
        $drustva->update($data);

        return response()->json([
            'message' => 'Društvo uspešno ažurirano',
            'model' => new DrustvoResource($drustva)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Drustvo $drustva)
    {
            if (Gate::allows('delete', $drustva)) {
                $drustva->delete();

                return response()->json([
                    'message' => 'Društvo uspešno obrisano.',
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Nemate dozvolu da obrišete ovo društvo.',
                ], 403);
            }
       
    }
}
