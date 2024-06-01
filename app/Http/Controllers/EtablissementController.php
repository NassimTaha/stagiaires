<?php

namespace App\Http\Controllers;

use App\Models\Etablissement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EtablissementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etablissements = Etablissement::orderBy('wilaya')->paginate(10);
        return view('admin.etablissements', compact('etablissements'));
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
        $wilaya = $request->wilaya;
        $type = $request->type;
        $created_by = Auth::user()->id;
        $updated_by = Auth::user()->id;
        $request->validate([
            'name' => 'required|string|unique:etablissements,name',
            'wilaya' => 'required',
            'type' => 'required|string|in:Univesite,Centre de formation,Institut,Ecole',
        ]);
        Etablissement::create([
            'name' => $name,
            'wilaya' => $wilaya,
            'type' => $type,
            'created_by' => $created_by,
            'updated_by' => $updated_by,
        ]);
        return to_route('etablissements.index')->with('success', 'Établissement ajoutée.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Etablissement $etablissement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etablissement $etablissement)
    {
        $etablissements = Etablissement::orderBy('wilaya')->paginate(10);
        return view('admin.etablissements', compact('etablissements', 'etablissement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Etablissement $etablissement)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:etablissements,name,' . $etablissement->id,
            'wilaya' => 'required',
            'type' => 'required|string|in:Univesite,Centre de formation,Institut,Ecole',
        ]);
        $validatedData['updated_by'] = Auth::user()->id;

        $etablissement->update($validatedData);

        return redirect()->route('etablissements.index')->with('success', 'Modification effectuée avec succès');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etablissement $etablissement)
    {
        $etablissement->deleted_by = Auth::user()->id;
        $etablissement->save();
        $etablissement->delete();
        return to_route('etablissements.index')->with('success', 'Établissement désactivée.');
    }
}
