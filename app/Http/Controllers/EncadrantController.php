<?php

namespace App\Http\Controllers;

use App\Models\Encadrant;
use App\Models\StructuresAffectation;
use App\Models\StructuresIAP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EncadrantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userStructuresIAPId = Auth::user()->structuresIAP_id;
        $encadrants = Encadrant::join('structures_affectations', 'encadrants.structuresAffectation_id', '=', 'structures_affectations.id')
            ->where('structures_affectations.structuresIAP_id', '=', $userStructuresIAPId)
            ->orderBy('structures_affectations.type')
            ->orderBy('encadrants.structuresAffectation_id')
            ->orderBy('encadrants.function')
            ->orderBy('encadrants.last_name')
            ->orderBy('encadrants.first_name')
            ->select('encadrants.*')
            ->paginate(10);
        $structuresAffectations = StructuresAffectation::where('structuresIAP_id', $userStructuresIAPId)
            ->orderby('type')->orderBy('name')->get();
        return view('admin.encadrants', compact('encadrants', 'structuresAffectations'));
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
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'registration_id' => [
                'required',
                'unique:encadrants,registration_id',
                'regex:/^[a-zA-Z0-9]+$/',
                'max:255',
            ],
            'fibre_sh' => 'required|unique:encadrants,fibre_sh',
            'function' => 'required',
            'email' => 'required|email|max:255|unique:encadrants,email',
            'structuresAffectation_id' => 'required|exists:structures_affectations,id',
        ]);
        $validatedData['created_by'] = Auth::user()->id;
        $validatedData['updated_by'] = Auth::user()->id;
        Encadrant::create($validatedData);

        return to_route('encadrants.index')->with('success', 'Encadrant ajouté.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Encadrant $encadrant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Encadrant $encadrant)
    {

        $userStructuresIAPId = Auth::user()->structuresIAP_id;
        $encadrants = Encadrant::join('structures_affectations', 'encadrants.structuresAffectation_id', '=', 'structures_affectations.id')
            ->where('structures_affectations.structuresIAP_id', '=', $userStructuresIAPId)
            ->orderBy('structures_affectations.type')
            ->orderBy('encadrants.structuresAffectation_id')
            ->orderBy('encadrants.function')
            ->orderBy('encadrants.last_name')
            ->orderBy('encadrants.first_name')
            ->select('encadrants.*')
            ->paginate(10);

        $structuresAffectations = StructuresAffectation::where('structuresIAP_id', $userStructuresIAPId)
            ->orderby('type')->orderBy('name')->get();

        return view('admin.encadrants', compact('encadrants', 'structuresAffectations', 'encadrant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Encadrant $encadrant)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'registration_id' => [
                'required',
                'unique:encadrants,registration_id,' . $encadrant->id,
                'regex:/^[a-zA-Z0-9]+$/',
                'max:255',
            ],
            'fibre_sh' => 'required|unique:encadrants,fibre_sh,' . $encadrant->id,
            'function' => 'required',
            'email' => 'required|email|max:255|unique:encadrants,email,' . $encadrant->id,
            'structuresAffectation_id' => 'required|exists:structures_affectations,id',
        ]);
        $validatedData['updated_by'] = Auth::user()->id;
        $encadrant->fill($validatedData)->save();
        return redirect()->route('encadrants.index')->with('success', 'Modification effectuée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Encadrant $encadrant)
    {
        $encadrant->deleted_by = Auth::user()->id;
        $encadrant->save();
        $encadrant->delete();
        return redirect()->route('encadrants.index')->with('success', 'Encadrant désactivé.');
    }
}
