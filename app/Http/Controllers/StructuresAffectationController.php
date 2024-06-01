<?php

namespace App\Http\Controllers;

use App\Models\StructuresAffectation;
use App\Models\StructuresIAP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StructuresAffectationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $structuresAffectations = StructuresAffectation::where('structuresIAP_id', Auth::user()->structuresIAP_id)
            ->orderby('type')->orderBy('name')->paginate(10);
        $directions = StructuresAffectation::where('structuresIAP_id', Auth::user()->structuresIAP_id)
            ->where(function ($query) {
                $query->where('type', 'Direction')
                    ->orWhere('type', 'Sous-direction');
            })
            ->orderBy('type')
            ->orderBy('name')
            ->get();
        return view('admin.structuresAffectation', compact('structuresAffectations', 'directions'));
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
        $type = $request->type;
        $parent_id = $request->parent_id;
        $quota_pfe = $request->quota_pfe;
        $quota_im = $request->quota_im;
        $structuresIAP_id = Auth::user()->structuresIAP_id;
        $year = date('Y');
        $created_by = Auth::user()->id;
        $updated_by = Auth::user()->id;

        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:Direction,Sous-direction,Departement',
            'quota_pfe' => 'required|integer|sometimes|between:0,99',
            'quota_im' => 'required|integer|sometimes|between:0,99',
            'parent_id' => 'exists:structures_affectations,id',
        ]);

        StructuresAffectation::create([
            'name' => $name,
            'type' => $type,
            'parent_id' => $parent_id,
            'quota_pfe' => $quota_pfe,
            'quota_im' => $quota_im,
            'year' => $year,
            'structuresIAP_id' => $structuresIAP_id,
            'created_by' => $created_by,
            'updated_by' => $updated_by,
        ]);

        return to_route('structuresAffectation.index')->with('success', 'Structures D\'Affectation ajoutée.');
    }

    /**
     * Display the specified resource.
     */
    public function show(StructuresAffectation $structuresAffectation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StructuresAffectation $structuresAffectation)
    {

        $structuresAffectations = StructuresAffectation::where('structuresIAP_id', Auth::user()->structuresIAP_id)
            ->orderby('type')->orderBy('name')->paginate(10);
        $directions = StructuresAffectation::where('structuresIAP_id', Auth::user()->structuresIAP_id)
            ->where(function ($query) {
                $query->where('type', 'Direction')
                    ->orWhere('type', 'Sous-direction');
            })
            ->orderBy('type')
            ->orderBy('name')
            ->get();
        return view('admin.structuresAffectation', compact('structuresAffectations', 'directions', 'structuresAffectation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StructuresAffectation $structuresAffectation)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:Direction,Sous-direction,Departement',
            'quota_pfe' => 'required|integer|sometimes|between:0,99',
            'quota_im' => 'required|integer|sometimes|between:0,99',
            'parent_id' => 'exists:structures_affectations,id',
        ]);
        $validatedData['year'] = date('Y');
        $validatedData['updated_by'] = Auth::user()->id;
        if ($request->input('type') === 'Direction' || $request->input('type') === 'Sous-direction') {
            $validatedData['parent_id'] = null;
        }
        $structuresAffectation->fill($validatedData)->save();
        return to_route('structuresAffectation.index')->with('success', 'Modification effectuée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StructuresAffectation $structuresAffectation)
    {
        $structuresAffectation->deleted_by = Auth::user()->id;
        $structuresAffectation->save();
        $structuresAffectation->delete();
        return to_route('structuresAffectation.index')->with('success', 'Structures D\'Affectation désactivée.');
    }
}
