<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use App\Models\StructuresIAP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DomaineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $domaines = Domaine::where('structuresIAP_id', Auth::user()->structuresIAP_id)
            ->orderBy('name')->paginate(10);
        return view('admin.domaines', compact('domaines'));
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
        $structuresIAP_id = Auth::user()->structuresIAP_id;
        $created_by = Auth::user()->id;
        $updated_by = Auth::user()->id;
        $request->validate([
            'name' => 'required|string',
        ]);
        Domaine::create([
            'name' => $name,
            'structuresIAP_id' => $structuresIAP_id,
            'created_by' => $created_by,
            'updated_by' => $updated_by,
        ]);

        return to_route('domaines.index')->with('success', 'Domaine ajouté.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Domaine $domaine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Domaine $domaine)
    {
        $domaines = Domaine::where('structuresIAP_id', Auth::user()->structuresIAP_id)
            ->orderBy('name')->paginate(10);
        return view('admin.domaines', compact('domaines', 'domaine'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Domaine $domaine)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
        ]);
        $validatedData['updated_by'] = Auth::user()->id;
        $domaine->fill($validatedData)->save();
        return to_route('domaines.index')->with('success', 'Modification effectuée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Domaine $domaine)
    {
        $domaine->deleted_by = Auth::user()->id;
        $domaine->save();
        $domaine->delete();
        return to_route('domaines.index')->with('success', 'Domaine désactivé');
    }
}
