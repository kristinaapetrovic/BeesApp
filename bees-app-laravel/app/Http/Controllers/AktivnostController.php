<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Aktivnost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\AktivnostRequest;
use App\Http\Resources\AktivnostResource;
use Illuminate\Auth\Access\AuthorizationException;

class AktivnostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $filteri = request()->only('tip', 'status', 'pocetak', 'drustvo');
        $aktivnosti = Aktivnost::with(['user', 'drustvo', 'komentars', 'sugestijas'])
            ->filter($filteri, $user)
            ->latest()
            ->paginate();
        return AktivnostResource::collection($aktivnosti);
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

        if (Gate::allows('view', $aktivnosti)) {
            $aktivnosti->load(['drustvo', 'user', 'komentars', 'sugestijas']);
            return new AktivnostResource($aktivnosti);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Nemate dozvolu da pregledate ovu aktivnost.',
            ], 403);
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

        if (Gate::allows('delete', $aktivnosti)) {
            $aktivnosti->delete();

            return response()->json([
                'message' => 'Aktivnost uspešno obrisana.',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Nemate dozvolu da obrišete ovu aktivnost.',
            ], 403);
        }
    }
}
