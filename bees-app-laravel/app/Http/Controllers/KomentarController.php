<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\KomentarRequest;
use App\Http\Resources\KomentarResource;

class KomentarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=Auth::user();
        $komentari=Komentar::with('user')->where('user_id',$user->id);
        return KomentarResource::collection($komentari->latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KomentarRequest $request)
    {
        $user = Auth::user();

        $data = $request->validated();
        $data['user_id'] = $user->id;

        $komentar = Komentar::create($data);

        return response()->json([
            'message' => 'Komentar uspešno kreiran',
            'model' => new KomentarResource($komentar)
        ]);
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
        
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Komentar $komentari)
    {
        if (Gate::authorize('delete', $komentari)) {
            $komentari->delete();
            return response()->json([
                'message' => 'Komentar uspešno obrisan',
            ]);
        }
    }
}
