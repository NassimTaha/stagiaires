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
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{

    public function searchStages()
    {

        $userStructuresIAPId = Auth::user()->structuresIAP_id;

        $domaines = Domaine::where('structuresIAP_id', Auth::user()->structuresIAP_id)->get();
        $specialites = Specialite::join('domaines', 'specialites.domaine_id', '=', 'domaines.id')
            ->where('domaines.structuresIAP_id', Auth::user()->structuresIAP_id)
            ->orderBy('domaines.structuresIAP_id')
            ->orderBy('domaines.name')
            ->orderBy('specialites.name')
            ->select('specialites.*')
            ->get();
        $encadrants = Encadrant::whereHas('structureAffectation.structuresIAP', function ($query) {
            $query->where('id', Auth::user()->structuresIAP_id);
        })->get();
        $etablissements = Etablissement::orderBy('name')->get();
        $structuresAffectations = StructuresAffectation::where('structuresIAP_id', '=', Auth::user()->structuresIAP_id)->get();
        $themes = Stage::pluck('theme');

        return view('admin.search', compact('domaines', 'specialites', 'encadrants', 'etablissements', 'structuresAffectations', 'themes'));
    }

    public function searchResults1(Request $request)
    {
        $query = Stage::query();

        $structuresIAPId = Auth::user()->structuresIAP_id;
        $query->whereHas('structureAffectation', function ($query) use ($structuresIAPId) {
            $query->where('structuresIAP_id', $structuresIAPId);
        });

        $query->where('year', date('Y'));

        $query->where('stage_annule', 0);

        $searchParams = [
            'structuresAffectation_id',
            'encadrant_id',
            'stage_type',
            'etablissement_id',
            'level',
            'theme',
            'stagiaire_count',
            'specialite_id',
        ];

        foreach ($searchParams as $param) {
            $query->when($request->filled($param), function ($query) use ($request, $param) {
                return $query->where($param, $request->input($param));
            });
        }

        if ($request->filled('domaine_id')) {
            $query->whereHas('specialite', function ($subQuery) use ($request) {
                $subQuery->where('domaine_id', $request->input('domaine_id'));
            });
        }

        $nbr_stages = $query->count();
        $stages = $query->paginate(5);
        $stages->appends($request->all());

        return view('admin.searchResults1', compact('stages', 'nbr_stages'));
    }

    public function searchResults2(Request $request)
    {
        $query = Stage::query();

        $structuresIAPId = Auth::user()->structuresIAP_id;
        $query->whereHas('structureAffectation', function ($query) use ($structuresIAPId) {
            $query->where('structuresIAP_id', $structuresIAPId);
        });

        if ($request->filled('stage_annuleOui')) {
            $query->where('stage_annule', 1);
        }
        if ($request->filled('stage_annuleNon')) {
            $query->where('stage_annule', 0);
        }


        if ($request->filled('clotureOui')) {
            $query->where('cloture', 1);
        }
        if ($request->filled('clotureNon')) {
            $query->where('cloture', 0);
        }

        $searchParams = [
            'structuresAffectation_id',
            'encadrant_id',
            'stage_type',
            'etablissement_id',
            'level',
            'theme',
            'stagiaire_count',
            'year',
            'specialite_id',
        ];

        foreach ($searchParams as $param) {
            $query->when($request->filled($param), function ($query) use ($request, $param) {
                return $query->where($param, $request->input($param));
            });
        }

        if ($request->filled('domaine_id')) {
            $query->whereHas('specialite', function ($subQuery) use ($request) {
                $subQuery->where('domaine_id', $request->input('domaine_id'));
            });
        }

        $nbr_stages = $query->count();
        $stages = $query->paginate(5);
        $stages->appends($request->all());


        return view('admin.searchResults2', compact('stages', 'nbr_stages'));
    }

    public function searchIAP(Request $request)
    {
        $query = StructuresIAP::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        $structuresIAPs = $query->paginate(10);
        $structuresIAPs->appends($request->all());

        return view('superadmin.structuresIAP', compact('structuresIAPs'));
    }

    public function searchIAP2(Request $request)
    {
        $query = StructuresIAP::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        $structuresIAPs = $query->paginate(20);
        $structuresIAPs->appends($request->all());

        return view('superadmin.structuresIAP', compact('structuresIAPs'));
    }

    public function searchAffectation(Request $request)
    {
        $query = StructuresAffectation::query();

        $query->where('structuresIAP_id', Auth::user()->structuresIAP_id);

        $searchParams = [
            'type',
        ];

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        foreach ($searchParams as $param) {
            $query->when($request->filled($param), function ($query) use ($request, $param) {
                return $query->where($param, $request->input($param));
            });
        }

        $directions = StructuresAffectation::where('structuresIAP_id', Auth::user()->structuresIAP_id)
            ->where(function ($query) {
                $query->where('type', 'Direction')
                    ->orWhere('type', 'Sous-direction');
            })
            ->orderBy('type')
            ->orderBy('name')
            ->get();
        $structuresAffectations = $query->paginate(10);
        $structuresAffectations->appends($request->all());

        return view('admin.structuresAffectation', compact('structuresAffectations', 'directions'));
    }

    public function searchAffectation2(Request $request)
    {
        $query = StructuresAffectation::query();

        $searchParams = [
            'structuresIAP_id',
            'type',
        ];

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        foreach ($searchParams as $param) {
            $query->when($request->filled($param), function ($query) use ($request, $param) {
                return $query->where($param, $request->input($param));
            });
        }

        $structuresIAPs = StructuresIAP::all();
        $structuresAffectations = $query->paginate(20);
        $structuresAffectations->appends($request->all());

        return view('superadmin.structuresAffectation', compact('structuresAffectations', 'structuresIAPs'));
    }



    public function searchEncadrant(Request $request)
    {
        $query = Encadrant::query();

        $query->whereHas('structureAffectation', function ($query) {
            $query->where('structuresIAP_id', Auth::user()->structuresIAP_id);
        });

        $searchParams = [
            'structuresAffectation_id',
        ];

        if ($request->filled('name')) {
            $query->where(function ($query) use ($request) {
                $name = $request->input('name');
                $query->where(DB::raw("CONCAT(last_name, ' ', first_name)"), 'like', '%' . $name . '%')
                    ->orWhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', '%' . $name . '%');
            });
        }

        foreach ($searchParams as $param) {
            $query->when($request->filled($param), function ($query) use ($request, $param) {
                return $query->where($param, $request->input($param));
            });
        }

        $encadrants = $query->paginate(10);
        $encadrants->appends($request->all());
        $structuresAffectations = StructuresAffectation::where('structuresIAP_id', Auth::user()->structuresIAP_id)
            ->orderby('type')->orderBy('name')->get();

        return view('admin.encadrants', compact('encadrants', 'structuresAffectations'));
    }

    public function searchEncadrant2(Request $request)
    {
        $query = Encadrant::query();

        $searchParams = [
            'structuresAffectation_id',
        ];

        if ($request->filled('name')) {
            $query->where(function ($query) use ($request) {
                $name = $request->input('name');
                $query->where(DB::raw("CONCAT(last_name, ' ', first_name)"), 'like', '%' . $name . '%')
                    ->orWhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', '%' . $name . '%');
            });
        }

        if ($request->filled('structuresIAP_id')) {
            $structuresIAPId = $request->input('structuresIAP_id');
            $query->whereHas('structureAffectation', function ($query) use ($structuresIAPId) {
                $query->where('structuresIAP_id', $structuresIAPId);
            });
        }

        foreach ($searchParams as $param) {
            $query->when($request->filled($param), function ($query) use ($request, $param) {
                return $query->where($param, $request->input($param));
            });
        }

        $encadrants = $query->paginate(20);
        $encadrants->appends($request->all());

        return view('superadmin.encadrants', compact('encadrants'));
    }

    public function searchDomaine(Request $request)
    {
        $query = Domaine::query();

        $query->where('structuresIAP_id', Auth::user()->structuresIAP_id);

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        $domaines = $query->paginate(10);
        $domaines->appends($request->all());

        return view('admin.domaines', compact('domaines'));
    }

    public function searchDomaine2(Request $request)
    {

        $query = Domaine::query();

        $searchParams = [
            'structuresIAP_id',
        ];

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        foreach ($searchParams as $param) {
            $query->when($request->filled($param), function ($query) use ($request, $param) {
                return $query->where($param, $request->input($param));
            });
        }

        $domaines = $query->paginate(20);
        $domaines->appends($request->all());

        return view('superadmin.domaines', compact('domaines'));
    }

    public function searchSpecialite(Request $request)
    {
        $query = Specialite::query();

        $query->whereHas('domaine', function ($query) {
            $query->where('structuresIAP_id', Auth::user()->structuresIAP_id);
        });

        $searchParams = [
            'domaine_id',
        ];

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        foreach ($searchParams as $param) {
            $query->when($request->filled($param), function ($query) use ($request, $param) {
                return $query->where($param, $request->input($param));
            });
        }

        $domaines = Domaine::where('structuresIAP_id', Auth::user()->structuresIAP_id)
            ->orderBy('name')->get();
        $specialites = $query->paginate(10);
        $specialites->appends($request->all());

        return view('admin.specialites', compact('domaines', 'specialites'));
    }

    public function searchSpecialite2(Request $request)
    {
        $query = Specialite::query();

        $searchParams = [
            'domaine_id',
        ];

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        foreach ($searchParams as $param) {
            $query->when($request->filled($param), function ($query) use ($request, $param) {
                return $query->where($param, $request->input($param));
            });
        }

        if ($request->filled('structuresIAP_id')) {
            $structuresIAPId = $request->input('structuresIAP_id');
            $query->whereHas('domaine', function ($query) use ($structuresIAPId) {
                $query->where('structuresIAP_id', $structuresIAPId);
            });
        }


        $specialites = $query->paginate(20);
        $specialites->appends($request->all());

        return view('superadmin.specialites', compact('specialites'));
    }

    public function searchComptes(Request $request)
    {
        $query = User::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        $comptes = $query->paginate(10);
        $comptes->appends($request->all());
        $structuresIAPs = StructuresIAP::all();

        return view('superadmin.comptes', compact('comptes', 'structuresIAPs'));
    }

    public function searchEtablissement(Request $request)
    {
        $query = Etablissement::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        $etablissements = $query->paginate(10);
        $etablissements->appends($request->all());

        return view('admin.etablissements', compact('etablissements'));
    }

    public function searchEtablissement2(Request $request)
    {
        $query = Etablissement::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        $etablissements = $query->paginate(20);
        $etablissements->appends($request->all());

        return view('superadmin.etablissements', compact('etablissements'));
    }

    public function searchResultsStagiares1(Request $request)
    {
        $query = Stagiaire::query();

        $query->whereHas('stage.structureAffectation', function ($query) {
            $structuresIAPId = Auth::user()->structuresIAP_id;
            $query->where('structuresIAP_id', $structuresIAPId);
        });

        if ($request->filled('year')) {
            $query->whereHas('stage', function ($subQuery) use ($request) {
                $subQuery->where('year', $request->input('year'));
            });
        }

        if ($request->filled('name')) {
            $query->where(function ($query) use ($request) {
                $name = $request->input('name');
                $query->where(DB::raw("CONCAT(last_name, ' ', first_name)"), 'like', '%' . $name . '%')
                    ->orWhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', '%' . $name . '%');
            });
        }

        $stagiaires = $query->paginate(20);
        $stagiaires->appends($request->all());

        return view('admin.stagiaires', compact('stagiaires'));
    }

    public function searchResultsStagiares2(Request $request)
    {
        $query = Stagiaire::query();

        $query->join('stages', 'stagiaires.stage_id', '=', 'stages.id')
            ->join('structures_affectations', 'stages.structuresAffectation_id', '=', 'structures_affectations.id')
            ->where('structures_affectations.structuresIAP_id', Auth::user()->structuresIAP_id)
            ->where('stages.memoire', 1)
            ->where('stages.cloture', 1)
            ->where('stages.stage_annule', 0)
            ->where('stagiaires.quitus', 1);

        if ($request->filled('year')) {
            $query->whereHas('stage', function ($subQuery) use ($request) {
                $subQuery->where('year', $request->input('year'));
            });
        }

        if ($request->filled('name')) {
            $name = $request->input('name');
            $query->where(function ($query) use ($name) {
                $query->where(DB::raw("CONCAT(last_name, ' ', first_name)"), 'like', '%' . $name . '%')
                    ->orWhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', '%' . $name . '%');
            });
        }

        $stagiaires = $query->orderBy('stagiaires.last_name')
            ->orderBy('stagiaires.first_name')
            ->select('stagiaires.*')
            ->paginate(20);
        $stagiaires->appends($request->all());
        $signataires = Signataire::where('structuresIAP_id', Auth::user()->structuresIAP_id)
            ->orderBy('last_name')->orderBy('first_name')->get();

        return view('admin.attestation', compact('stagiaires', 'signataires'));
    }

    public function searchStagiaire(Request $request)
    {
        $query = Stagiaire::query();

        $query->whereHas('stage', function ($query) {
            $query->where('stage_annule', 0);
        });

        if ($request->filled('year')) {
            $query->whereHas('stage', function ($subQuery) use ($request) {
                $subQuery->where('year', $request->input('year'));
            });
        }

        if ($request->filled('name')) {
            $name = $request->input('name');
            $query->where(function ($query) use ($name) {
                $query->where(DB::raw("CONCAT(last_name, ' ', first_name)"), 'like', '%' . $name . '%')
                    ->orWhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', '%' . $name . '%');
            });
        }

        if ($request->filled('structuresIAP_id')) {
            $structuresIAPId = $request->input('structuresIAP_id');
            $query->whereHas('stage.structureAffectation', function ($query) use ($structuresIAPId) {
                $query->where('structuresIAP_id', $structuresIAPId);
            });
        }

        $stagiaires = $query->paginate(20);
        $stagiaires->appends($request->all());

        return view('superadmin.stagiaires', compact('stagiaires'));
    }

    public function searchStage(Request $request)
    {
        $query = Stage::query();

        $query->where('year', date('Y'));

        $query->where('stage_annule', 0);

        $searchParams = [
            'stage_type',
            'etablissement_id',
            'level',
            'stagiaire_count',
            'specialite_id',
        ];

        foreach ($searchParams as $param) {
            $query->when($request->filled($param), function ($query) use ($request, $param) {
                return $query->where($param, $request->input($param));
            });
        }

        if ($request->filled('domaine_id')) {
            $query->whereHas('specialite', function ($subQuery) use ($request) {
                $subQuery->where('domaine_id', $request->input('domaine_id'));
            });
        }

        if ($request->filled('structuresIAP_id')) {
            $structuresIAPId = $request->input('structuresIAP_id');
            $query->whereHas('structureAffectation', function ($query) use ($structuresIAPId) {
                $query->where('structuresIAP_id', $structuresIAPId);
            });
        }

        $nbr_stages = $query->count();
        $stages = $query->paginate(5);
        $stages->appends($request->all());

        return view('superadmin.stages', compact('stages', 'nbr_stages'));
    }

    public function searchStage2(Request $request)
    {
        $query = Stage::query();

        if ($request->filled('stage_annuleOui')) {
            $query->where('stage_annule', 1);
        }
        if ($request->filled('stage_annuleNon')) {
            $query->where('stage_annule', 0);
        }


        if ($request->filled('clotureOui')) {
            $query->where('cloture', 1);
        }
        if ($request->filled('clotureNon')) {
            $query->where('cloture', 0);
        }

        $searchParams = [
            'stage_type',
            'etablissement_id',
            'level',
            'stagiaire_count',
            'specialite_id',
            'year',
        ];

        foreach ($searchParams as $param) {
            $query->when($request->filled($param), function ($query) use ($request, $param) {
                return $query->where($param, $request->input($param));
            });
        }

        if ($request->filled('domaine_id')) {
            $query->whereHas('specialite', function ($subQuery) use ($request) {
                $subQuery->where('domaine_id', $request->input('domaine_id'));
            });
        }

        if ($request->filled('structuresIAP_id')) {
            $structuresIAPId = $request->input('structuresIAP_id');
            $query->whereHas('structureAffectation.structuresIAP', function ($query) use ($structuresIAPId) {
                $query->where('structuresIAP_id', $structuresIAPId);
            });
        }

        $nbr_stages = $query->count();
        $stages = $query->paginate(5);
        $stages->appends($request->all());

        return view('superadmin.search', compact('stages', 'nbr_stages'));
    }

    public function searchSignataire(Request $request)
    {
        $query = Signataire::query();

        $query->whereHas('structuresIAP', function ($query) {
            $query->where('structuresIAP_id', Auth::user()->structuresIAP_id);
        });

        if ($request->filled('name')) {
            $name = $request->input('name');
            $query->where(function ($query) use ($name) {
                $query->where(DB::raw("CONCAT(last_name, ' ', first_name)"), 'like', '%' . $name . '%')
                    ->orWhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', '%' . $name . '%');
            });
        }

        $signataires = $query->paginate(10);
        $signataires->appends($request->all());

        return view('admin.signataires', compact('signataires'));
    }

    public function searchSignataire2(Request $request)
    {
        $query = Signataire::query();

        if ($request->filled('name')) {
            $name = $request->input('name');
            $query->where(function ($query) use ($name) {
                $query->where(DB::raw("CONCAT(last_name, ' ', first_name)"), 'like', '%' . $name . '%')
                    ->orWhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', '%' . $name . '%');
            });
        }

        $signataires = $query->paginate(20);
        $signataires->appends($request->all());

        return view('superadmin.signataires', compact('signataires'));
    }
}
