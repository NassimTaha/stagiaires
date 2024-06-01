<?php

namespace App\Http\Controllers;

use App\Models\Signataire;
use App\Models\Stagiaire;
use Exception;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class AttestationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $stagiaires = Stagiaire::join('stages', 'stagiaires.stage_id', '=', 'stages.id')
            ->join('structures_affectations', 'stages.structuresAffectation_id', '=', 'structures_affectations.id')
            ->where('structures_affectations.structuresIAP_id', $user->structuresIAP_id)
            ->where('stages.stage_annule', '=', 0)
            ->where('stages.memoire', '=', 1)
            ->where('stages.cloture', '=', 1)
            ->where('stagiaires.quitus', '=', 1)
            ->orderBy('stagiaires.last_name')
            ->orderBy('stagiaires.first_name')
            ->select('stagiaires.*')
            ->paginate(20);
        $signataires = Signataire::where('structuresIAP_id', Auth::user()->structuresIAP_id)
            ->orderBy('last_name')->orderBy('first_name')->get();

        return view('admin.attestation', compact('stagiaires', 'signataires'));
    }

    public function imprimer(Request $request, Stagiaire $stagiaire)
    {
        $userStructuresIAPId = Auth::user()->structuresIAP_id;
        try {
            $infostagiaire = Stagiaire::with('stage')->find($stagiaire->id);
            $fullName = $infostagiaire->last_name . '_' . str_replace(' ', '_', $infostagiaire->first_name);
            $signataire = Signataire::find($request->signataire_id);
            $pdf = PDF::loadView('partials.attestation', compact('infostagiaire', 'signataire'))->setPaper('a4', 'portrait');

            $stagiaire = Stagiaire::findOrFail($stagiaire->id);
            $stagiaire->attestation_date = now();
            $stagiaire->save();

            return $pdf->download('attestation_' . $fullName . '.pdf');
        } catch (Exception $e) {
            throw new Exception("erreur lors de telechargement");
        }
    }
}
