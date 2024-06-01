<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use App\Models\Encadrant;
use App\Models\Etablissement;
use App\Models\Signataire;
use App\Models\Specialite;
use App\Models\Stage;
use App\Models\Stagiaire;
use App\Models\StructuresAffectation;
use App\Models\StructuresIAP;
use Illuminate\Http\Request;


class SuperadminController extends Controller
{
    public function domaines()
    {

        $domaines = Domaine::orderBY('structuresIAP_id')->paginate(20);
        $structuresIAPs = StructuresIAP::all();
        return view('superadmin.domaines', compact('domaines', 'structuresIAPs'));
    }

    public function structuresAffectation()
    {
        $structuresIAPs = StructuresIAP::all();
        $structuresAffectations = StructuresAffectation::orderBy('structuresIAP_id')->orderby('type')->orderBy('name')->paginate(20);
        return view('superadmin.structuresAffectation', compact('structuresAffectations', 'structuresIAPs'));
    }

    public function etablissements()
    {
        $etablissements = Etablissement::orderBy('wilaya')->paginate(20);
        return view('superadmin.etablissements', compact('etablissements'));
    }

    public function encadrants()
    {
        $encadrants = Encadrant::join('structures_affectations', 'encadrants.structuresAffectation_id', '=', 'structures_affectations.id')
            ->join('structures_i_a_p_s', 'structures_affectations.structuresIAP_id', '=', 'structures_i_a_p_s.id')
            ->orderBy('structures_i_a_p_s.id')
            ->orderBy('structures_affectations.parent_id')
            ->orderBy('encadrants.structuresAffectation_id')
            ->orderBy('encadrants.function')
            ->orderBy('encadrants.last_name')
            ->orderBy('encadrants.first_name')
            ->select('encadrants.*')
            ->paginate(20);
        $structuresAffectations = StructuresAffectation::orderBy('structuresIAP_id')->orderby('type')->orderBy('name')->get();
        $structuresIAPs = StructuresIAP::all();
        return view('superadmin.encadrants', compact('encadrants', 'structuresAffectations', 'structuresIAPs'));
    }

    public function specialites()
    {
        $domaines = Domaine::orderBy('structuresIAP_id')->orderBy('name')->get();
        $specialites = Specialite::join('domaines', 'specialites.domaine_id', '=', 'domaines.id')
            ->orderBy('domaines.structuresIAP_id')
            ->orderBy('domaines.name')
            ->orderBy('specialites.name')
            ->select('specialites.*')
            ->paginate(20);
        $structuresIAPs = StructuresIAP::all();
        return view('superadmin.specialites', compact('domaines', 'specialites', 'structuresIAPs'));
    }

    public function stagiaires()
    {
        $stagiaires = Stagiaire::with(['stage.structureAffectation.structuresIAP'])
            ->join('stages', 'stagiaires.stage_id', '=', 'stages.id')
            ->join('structures_affectations', 'stages.structuresAffectation_id', '=', 'structures_affectations.id')
            ->join('structures_i_a_p_s', 'structures_affectations.structuresIAP_id', '=', 'structures_i_a_p_s.id')
            ->orderBy('structures_i_a_p_s.id')
            ->orderBY('stagiaires.last_name')
            ->orderBY('stagiaires.first_name')
            ->where('stages.stage_annule', 0)
            ->select('stagiaires.*')
            ->paginate(20);
        $structuresIAPs = StructuresIAP::all();
        return view('superadmin.stagiaires', compact('stagiaires', 'structuresIAPs'));
    }

    public function stages()
    {
        $domaines = Domaine::orderBy('structuresIAP_id')->orderBy('name')->get();
        $specialites = Specialite::join('domaines', 'specialites.domaine_id', '=', 'domaines.id')
            ->orderBy('domaines.structuresIAP_id')
            ->orderBy('domaines.name')
            ->orderBy('specialites.name')
            ->select('specialites.*')
            ->get();
        $etablissements = Etablissement::orderBy('name')->get();
        $stages = Stage::with(['stagiaires', 'structureAffectation.structuresIAP'])
            ->join('structures_affectations', 'stages.structuresAffectation_id', '=', 'structures_affectations.id')
            ->join('structures_i_a_p_s', 'structures_affectations.structuresIAP_id', '=', 'structures_i_a_p_s.id')
            ->orderBy('structures_i_a_p_s.id')
            ->orderBy('structures_affectations.parent_id')
            ->orderBy('structures_affectations.type')
            ->orderBy('structures_affectations.name')
            ->orderBy('stages.start_date')
            ->where('stages.year', date('Y'))
            ->where('stages.stage_annule', 0)
            ->select('stages.*')
            ->paginate(5);
        $structuresIAPs = StructuresIAP::all();
        return view('superadmin.stages', compact('stages', 'domaines', 'specialites', 'etablissements', 'structuresIAPs'));
    }

    public function rechercheStage()
    {
        $domaines = Domaine::orderBy('structuresIAP_id')->orderBy('name')->get();
        $specialites = Specialite::join('domaines', 'specialites.domaine_id', '=', 'domaines.id')
            ->orderBy('domaines.structuresIAP_id')
            ->orderBy('domaines.name')
            ->orderBy('specialites.name')
            ->select('specialites.*')
            ->get();
        $etablissements = Etablissement::orderBy('name')->get();
        $structuresIAPs = StructuresIAP::all();
        return view('superadmin.search', compact('domaines', 'specialites', 'etablissements', 'structuresIAPs'));
    }

    public function signataires()
    {
        $signataires = Signataire::orderBy('last_name')->orderBy('first_name')->paginate(20);
        return view('superadmin.signataires', compact('signataires'));
    }
}
