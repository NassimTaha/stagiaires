<?php

namespace App\Http\Controllers;

use App\Models\StructuresIAP;
use App\Models\User;
use Illuminate\Http\Request;

class CompteController extends Controller
{
    public function index()
    {
        $comptes = User::orderBy('structuresIAP_id')->orderBy('usertype')->orderBy('name')->paginate(10);
        $structuresIAPs = StructuresIAP::all();
        return view('superadmin.comptes', compact('comptes', 'structuresIAPs'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'usertype' => 'required|in:Superadmin,Admin,User,Security',
            'structuresIAP_id' => 'required|exists:structures_i_a_p_s,id',
        ]);


        User::create($validatedData);

        return to_route('comptes.index')->with('success', 'Compte Ajouté.');
    }

    public function edit(User $compte)
    {
        $comptes = User::orderBy('name')->orderBy('usertype')->orderBy('structuresIAP_id')->paginate(10);
        $structuresIAPs = StructuresIAP::all();
        return view('superadmin.comptes', compact('comptes', 'structuresIAPs', 'compte'));
    }

    public function update(Request $request, User $compte)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $compte->id,
            'email' => 'required|email|max:255|unique:users,email,' . $compte->id,
            'password' => 'required|string|min:8|confirmed',
            'usertype' => 'required|in:Superadmin,Admin,User,Security',
            'structuresIAP_id' => 'required|exists:structures_i_a_p_s,id',
        ]);



        $compte->fill($validatedData)->save();

        return to_route('comptes.index')->with('success', 'Modification effectuée avec succès');
    }

    public function destroy(User $compte)
    {
        $compte->delete();
        return to_route('comptes.index')->with('success', 'Compte désactivé.');
    }
}
