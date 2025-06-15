<?php

namespace App\Http\Controllers;

use App\Models\Aktivnost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AktivnostRequest;
use App\Http\Resources\AktivnostResource;

class AktivnostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $aktivnosti = Aktivnost::where('user_id', $user->id);
        return AktivnostResource::collection($aktivnosti->latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AktivnostRequest $request)
    {
        $user = Auth::user();

        $data = $request->validated();
        $data['user_id'] = $user->id;

        $aktivnost = Aktivnost::create($data);

        return response()->json([
            'message' => 'Aktivnost uspešno kreirana',
            'model' => new AktivnostResource($aktivnost)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Aktivnost $aktivnosti)
    {
        if (Gate::authorize('view', $aktivnosti)) { 
            return new AktivnostResource($aktivnosti);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AktivnostRequest $request, Aktivnost $aktivnosti)
    {
        $data = $request->validated();
        $aktivnosti->update($data);

        return response()->json([
            'message' => 'Aktivnost uspešno ažurirana',
            'model' => new AktivnostResource($aktivnosti)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aktivnost $aktivnosti)
    {
        if (Gate::authorize('delete', $aktivnosti)) {
            $aktivnosti->delete();
            return response()->json([
                'message' => 'Aktivnost uspešno obrisana',
            ]);
        }
    }
}
