<?php

namespace App\Http\Controllers;

use App\Models\StructuresIAP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StructuresIAPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $structuresIAPs = StructuresIAP::paginate(10);
        return view('superadmin.structuresIAP', compact('structuresIAPs'));
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
        $created_by = Auth::user()->id;
        $updated_by = Auth::user()->id;
        $request->validate([
            'name' => 'required|regex:/^[\p{L}\'\s]+$/u|unique:structures_i_a_p_s,name',
        ]);
        StructuresIAP::create([
            'name' => $name,
            'created_by' => $created_by,
            'updated_by' => $updated_by,
        ]);
        return to_route('structuresIAP.index')->with('success', 'Structures IAP ajoutée.');
    }

    /**
     * Display the specified resource.
     */
    public function show(StructuresIAP $structuresIAP)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StructuresIAP $structuresIAP)
    {
        $structuresIAPs = StructuresIAP::paginate(10);
        return view('superadmin.structuresIAP', compact('structuresIAPs', 'structuresIAP'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StructuresIAP $structuresIAP)
    {
        $validatedData = $request->validate([
            'name' => 'required|regex:/^[\p{L}\'\s]+$/u|unique:structures_i_a_p_s,name',
        ]);
        $validatedData['updated_by'] = Auth::user()->id;
        $structuresIAP->fill($validatedData)->save();
        return to_route('structuresIAP.index')->with('success', 'Modification effectuée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StructuresIAP $structuresIAP)
    {
        $structuresIAP->deleted_by = Auth::user()->id;
        $structuresIAP->save();
        $structuresIAP->delete();
        return to_route('structuresIAP.index')->with('success', 'Structures IAP désactivée.');
    }
}
