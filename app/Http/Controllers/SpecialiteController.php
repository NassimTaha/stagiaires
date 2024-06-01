<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use App\Models\Specialite;
use App\Models\StructuresIAP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpecialiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $domaines = Domaine::where('structuresIAP_id', Auth::user()->structuresIAP_id)
            ->orderBy('name')->get();
        $specialites = Specialite::join('domaines', 'specialites.domaine_id', '=', 'domaines.id')
            ->where('domaines.structuresIAP_id', Auth::user()->structuresIAP_id)
            ->orderBy('domaines.name')
            ->orderBy('specialites.name')
            ->select('specialites.*')
            ->paginate(10);
        return view('admin.specialites', compact('domaines', 'specialites'));
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
        $name = $request->name;
        $domaine_id = $request->domaine_id;
        $created_by = Auth::user()->id;
        $updated_by = Auth::user()->id;
        $request->validate([
            'name' => 'required|string',
            'domaine_id' => 'required|exists:domaines,id',
        ]);
        Specialite::create([
            'name' => $name,
            'domaine_id' => $domaine_id,
            'created_by' => $created_by,
            'updated_by' => $updated_by,
        ]);

        return to_route('specialites.index')->with('success', 'Spécialité ajouté.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Specialite $specialite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Specialite $specialite)
    {
        $domaines = Domaine::where('structuresIAP_id', Auth::user()->structuresIAP_id)
            ->orderBy('name')->get();
        $specialites = Specialite::join('domaines', 'specialites.domaine_id', '=', 'domaines.id')
            ->where('domaines.structuresIAP_id', Auth::user()->structuresIAP_id)
            ->orderBy('domaines.name')
            ->orderBy('specialites.name')
            ->select('specialites.*')
            ->paginate(10);
        return view('admin.specialites', compact('domaines', 'specialites', 'specialite'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Specialite $specialite)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'domaine_id' => 'required|exists:domaines,id',
        ]);
        $validatedData['updated_by'] = Auth::user()->id;
        $specialite->fill($validatedData)->save();
        return to_route('specialites.index')->with('success', 'Modification effectuée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialite $specialite)
    {
        $specialite->deleted_by = Auth::user()->id;
        $specialite->save();
        $specialite->delete();
        return to_route('specialites.index')->with('success', 'Spécialité désactivé');
    }
}
