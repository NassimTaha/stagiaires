<?php

namespace App\Http\Controllers;

use App\Models\Signataire;
use App\Models\StructuresIAP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignataireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $signataires = Signataire::where('structuresIAP_id', Auth::user()->structuresIAP_id)
            ->orderBy('last_name')->orderBy('first_name')->paginate(10);
        return view('admin.signataires', compact('signataires'));
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
            'function' => 'required|in:Directeur Gestion du Personnel,Directeur de l’école'
        ]);
        $validatedData['structuresIAP_id'] = Auth::user()->structuresIAP_id;
        $validatedData['created_by'] = Auth::user()->id;
        $validatedData['updated_by'] = Auth::user()->id;

        Signataire::create($validatedData);

        return redirect()->route('signataires.index')->with('success', 'Signataire ajouté.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Signataire $signataire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Signataire $signataire)
    {
        $signataires = Signataire::where('structuresIAP_id', Auth::user()->structuresIAP_id)
            ->orderBy('last_name')->orderBy('first_name')->paginate(10);
        return view('admin.signataires', compact('signataires', 'signataire'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Signataire $signataire)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'function' => 'required|in:Directeur Gestion du Personnel,Directeur de l’école'
        ]);
        $validatedData['updated_by'] = Auth::user()->id;

        $signataire->fill($validatedData)->save();

        return redirect()->route('signataires.index')->with('success', 'Modification effectuée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Signataire $signataire)
    {
        $signataire->deleted_by = Auth::user()->id;
        $signataire->save();
        $signataire->delete();
        return redirect()->route('signataires.index')->with('success', 'Signataire désactivé.');
    }
}
