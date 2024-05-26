<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use App\Models\Encadrant;
use App\Models\Etablissement;
use App\Models\Specialite;
use App\Models\Stage;
use App\Models\Stagiaire;
use App\Models\StructuresAffectation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
        $themes = Stage::join('structures_affectations', function ($join) use ($userStructuresIAPId) {
            $join->on('stages.structuresAffectation_id', '=', 'structures_affectations.id')
                ->where('structures_affectations.structuresIAP_id', '=', $userStructuresIAPId);
        })
            ->where('stages.year', date('Y'))
            ->where('stages.stage_annule', 0)
            ->orderBy('stages.structuresAffectation_id')
            ->orderBy('stages.encadrant_id')
            ->orderBy('stages.stage_type')
            ->orderBy('stages.start_date')
            ->pluck('stages.theme');
        $stages = Stage::join('structures_affectations', function ($join) use ($userStructuresIAPId) {
            $join->on('stages.structuresAffectation_id', '=', 'structures_affectations.id')
                ->where('structures_affectations.structuresIAP_id', '=', $userStructuresIAPId);
        })
            ->where('stages.year', date('Y'))
            ->where('stages.stage_annule', 0)
            ->orderBy('stages.structuresAffectation_id')
            ->orderBy('stages.encadrant_id')
            ->orderBy('stages.stage_type')
            ->orderBy('stages.start_date')
            ->with('stagiaires')
            ->select('stages.*')
            ->paginate(5);
        return view('admin.stages', compact('stages', 'domaines', 'specialites', 'encadrants', 'etablissements', 'structuresAffectations', 'themes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

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
        return view('admin.create', compact('structuresAffectations', 'etablissements', 'encadrants', 'specialites', 'domaines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $validatedDataStage = $request->validate([
                'stage_type' => 'required|in:pfe,immersion',
                'theme' => 'required|string',
                'specialite_id' => 'required|exists:specialites,id',
                'start_date' => 'required|date',
                'reception_days' => 'required|string',
                'end_date' => 'required|date|after:start_date',
                'level' => 'required|in:Master,Licence,Doctorat,Ingenieur,TS',
                'stagiaire_count' => 'required|in:Monome,Binome,Trinome,Quadrinome',
                'encadrant_id' => 'required|exists:encadrants,id',
                'etablissement_id' => 'required|exists:etablissements,id',
                'structuresAffectation_id' => 'required|exists:structures_affectations,id',
            ]);
            $validatedDataStage['cloture_date'] = $request->end_date;
            $stage = Stage::create($validatedDataStage);

            $count = 0;
            switch ($request->input('stagiaire_count')) {
                case 'Monome':
                    $count = 1;
                    break;
                case 'Binome':
                    $count = 2;
                    break;
                case 'Trinome':
                    $count = 3;
                    break;
                case 'Quadrinome':
                    $count = 4;
                    break;
            }
            for ($i = 1; $i <= $count; $i++) {
                $request->validate([
                    "last_name{$i}" => 'required|string',
                    "first_name{$i}" => 'required|string',
                    "date_of_birth{$i}" => 'required|date',
                    "place_of_birth{$i}" => 'required|string',
                    "phone_number{$i}" => 'required|string',
                    "email{$i}" => 'required|email',
                    "blood_group{$i}" => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
                ]);

                Stagiaire::create([
                    'last_name' => $request->input("last_name{$i}"),
                    'first_name' => $request->input("first_name{$i}"),
                    'date_of_birth' => $request->input("date_of_birth{$i}"),
                    'place_of_birth' => $request->input("place_of_birth{$i}"),
                    'phone_number' => $request->input("phone_number{$i}"),
                    'email' => $request->input("email{$i}"),
                    'blood_group' => $request->input("blood_group{$i}"),
                    'stage_id' => $stage->id,
                ]);
            }

            DB::commit();

            return redirect()->route('stages.index')->with('success', 'Stage ajouté.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('danger', 'Une erreur est survenue lors de l\'enregistrement du stage.');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Stage $stage)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $domaines = Domaine::where('structuresIAP_id', Auth::user()->structuresIAP_id)->get();
        $specialites = Specialite::join('domaines', 'specialites.domaine_id', '=', 'domaines.id')
            ->where('domaines.structuresIAP_id', Auth::user()->structuresIAP_id)
            ->orderBy('domaines.structuresIAP_id')
            ->orderBy('domaines.name')
            ->orderBy('specialites.name')
            ->select('specialites.*')
            ->get();
        $stage = Stage::findOrFail($id);
        $stagiaires = $stage->stagiaires;
        $encadrants = Encadrant::whereHas('structureAffectation.structuresIAP', function ($query) {
            $query->where('id', Auth::user()->structuresIAP_id);
        })->get();
        $etablissements = Etablissement::orderBy('name')->get();
        $structuresAffectations = StructuresAffectation::where('structuresIAP_id', '=', Auth::user()->structuresIAP_id)->get();

        return view('admin.edit', compact('specialites', 'domaines', 'stage', 'stagiaires', 'structuresAffectations', 'etablissements', 'encadrants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stage $stage)
    {

        DB::beginTransaction();

        try {
            $validatedDataStage = $request->validate([
                'stage_type' => 'required|in:pfe,immersion',
                'theme' => 'required|string',
                'specialite_id' => 'required|exists:specialites,id',
                'start_date' => 'required|date',
                'reception_days' => 'required|string',
                'end_date' => 'required|date|after:start_date',
                'level' => 'required|in:Master,Licence,Doctorat,Ingenieur,TS',
                'stagiaire_count' => 'required|in:Monome,Binome,Trinome,Quadrinome',
                'encadrant_id' => 'required|exists:encadrants,id',
                'etablissement_id' => 'required|exists:etablissements,id',
                'structuresAffectation_id' => 'required|exists:structures_affectations,id',
            ]);

            $stage->update($validatedDataStage);

            $count = match ($request->input('stagiaire_count')) {
                'Monome' => 1,
                'Binome' => 2,
                'Trinome' => 3,
                'Quadrinome' => 4,
            };

            foreach ($stage->stagiaires as $key => $stagiaire) {
                $index = $key + 1;
                if ($key < $count) {
                    $request->validate([
                        "last_name{$index}" => 'required|string',
                        "first_name{$index}" => 'required|string',
                        "date_of_birth{$index}" => 'required|date',
                        "place_of_birth{$index}" => 'required|string',
                        "phone_number{$index}" => 'required|string',
                        "email{$index}" => 'required|email',
                        "blood_group{$index}" => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
                    ]);

                    $stagiaire->update([
                        'last_name' => $request->input("last_name{$index}"),
                        'first_name' => $request->input("first_name{$index}"),
                        'date_of_birth' => $request->input("date_of_birth{$index}"),
                        'place_of_birth' => $request->input("place_of_birth{$index}"),
                        'phone_number' => $request->input("phone_number{$index}"),
                        'email' => $request->input("email{$index}"),
                        'blood_group' => $request->input("blood_group{$index}"),
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('stages.index')->with('success', 'Modification effectuée avec succès');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('danger', 'Une Erreur veuillew remplir les champs');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stage $stage)
    {
        //
    }

    public function quotaVerification(Request $request)
    {
        $stageType = $request->input('stage_type');
        $structuresAffectationId = $request->input('structuresAffectation_id');

        try {
            $structuresAffectation = StructuresAffectation::findOrFail($structuresAffectationId);

            $count = $structuresAffectation->stages()
                ->where('stage_type', $stageType)
                ->where('year', $structuresAffectation->year)
                ->where('stage_annule', 0)
                ->count();

            $quota = $stageType === 'pfe' ? $structuresAffectation->quota_pfe : $structuresAffectation->quota_im;

            return response()->json([
                'count' => $count,
                'quota' => $quota,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }
    }

    public function cloture(stage $stage)
    {

        $stages = (stage::all());
        $stagiaires = (stagiaire::all());
        return view('admin.cloture', compact('stages', 'stagiaires', 'stage'));
    }

    public function done(Request $request, Stage $stage)
    {
        $validatedData = $request->validate([
            'memoire' => 'required|boolean',
            'quitus' => 'required|array|min:1',
            'quitus.*' => 'integer|exists:stagiaires,id',
        ]);

        $stagiairesWithQuitus = $validatedData['quitus'];
        $hasQuitus = false;

        foreach ($stagiairesWithQuitus as $stagiaireId) {
            $stagiaire = Stagiaire::find($stagiaireId);
            if ($stagiaire && $stagiaire->stage_id == $stage->id) {
                $stagiaire->quitus = 1;
                $stagiaire->save();
                $hasQuitus = true;
            }
        }

        if ($hasQuitus) {
            $stage->memoire = $validatedData['memoire'];
            $stage->cloture = 1;
            $stage->cloture_date = $request->cloture_date;
            $stage->save();
        } else {
            return back()->withErrors(['quitus' => 'At least one stagiaire must have quitus set.']);
        }

        return redirect()->route('stages.index')->with('success', 'Stage clôturé.');
    }

    public function annuler(Request $request, Stage $stage)
    {
        $stage->stage_annule = 1;
        $stage->observation = $request->observation;
        $stage->save();

        return redirect()->route('stages.index')->with('success', 'Stage annulé.');
    }
}
