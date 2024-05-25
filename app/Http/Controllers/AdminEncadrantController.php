<?php

namespace App\Http\Controllers;

use App\Models\Encadrant;
use App\Models\StructuresAffectation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminEncadrantController extends Controller
{
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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'registration_id' => [
                'required',
                'regex:/^[a-zA-Z0-9]+$/',
                'max:255',
            ],
            'fibre_sh' => 'required|unique:encadrants,fibre_sh',
            'function' => 'required',
            'email' => 'required|email|max:255',
            'structuresAffectation_id' => 'required|exists:structures_affectations,id',
        ]);

        Encadrant::create($validatedData);

        return to_route('encadrants2.index')->with('success', 'Encadrant ajouté.');
    }

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
            ->paginate(10); // This might not be needed if you're focusing on editing one encadrant

        $structuresAffectations = StructuresAffectation::where('structuresIAP_id', $userStructuresIAPId)
            ->orderby('type')->orderBy('name')->get();

        return view('admin.encadrants', compact('encadrants', 'structuresAffectations', 'encadrant'));
    }

    public function update(Request $request, Encadrant $encadrant)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'registration_id' => [
                'required',
                'regex:/^[a-zA-Z0-9]+$/',
                'max:255',
            ],
            'fibre_sh' => 'required|unique:encadrants,fibre_sh,' . $encadrant->id,
            'function' => 'required',
            'email' => 'required|email|max:255',
            'structuresAffectation_id' => 'required|exists:structures_affectations,id',
        ]);

        $encadrant->fill($validatedData)->save();
        return redirect()->route('encadrants2.index')->with('success', 'Modification effectuée avec succès');
    }


    public function destroy(Encadrant $encadrant)
    {
        $encadrant->delete();
        return redirect()->route('encadrants2.index')->with('success', 'Encadrant désactivé.');
    }
}
