<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\StructuresAffectation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatistiquesController extends Controller
{
    public function index()
    {
        $operation = 0;
        $userStructuresIAPId = Auth::user()->structuresIAP_id;
        $currentYear = date('Y');

        $stages = Stage::join('structures_affectations', function ($join) use ($userStructuresIAPId) {
            $join->on('stages.structuresAffectation_id', '=', 'structures_affectations.id')
                ->where('structures_affectations.structuresIAP_id', '=', $userStructuresIAPId);
        })
            ->where('stages.year', $currentYear)
            ->where('stages.stage_annule', 0)
            ->select('stages.*')
            ->get();

        $affectations = StructuresAffectation::where('structuresIAP_id', $userStructuresIAPId)->get();

        $quota_dispos_pfe = [];
        $quota_dispos_im = [];
        $pourcentage_dispos_pfe = [];
        $pourcentage_dispos_im = [];
        $affectationStagesCount_pfe = [];
        $affectationStagesCount_im = [];

        foreach ($affectations as $affectation) {
            $stageCountPFE = $stages->where('stage_type', 'pfe')
                ->where('structuresAffectation_id', $affectation->id)
                ->count();

            $quota_dispo_pfe = $affectation->quota_pfe - $stageCountPFE;
            $quota_dispo_pfe = max($quota_dispo_pfe, 0);
            $pourcentage_dispo_pfe = $affectation->quota_pfe > 0 ? round(($quota_dispo_pfe * 100) / $affectation->quota_pfe, 1) : 0;

            $quota_dispos_pfe[] = $quota_dispo_pfe;
            $pourcentage_dispos_pfe[] = $pourcentage_dispo_pfe;
            $affectationStagesCount_pfe[$affectation->id] = $stageCountPFE;

            $stageCountImm = $stages->where('stage_type', 'immersion')
                ->where('structuresAffectation_id', $affectation->id)
                ->count();

            $quota_dispo_im = $affectation->quota_im - $stageCountImm;
            $quota_dispo_im = max($quota_dispo_im, 0);
            $pourcentage_dispo_im = $affectation->quota_im > 0 ? round(($quota_dispo_im * 100) / $affectation->quota_im, 1) : 0;

            $quota_dispos_im[] = $quota_dispo_im;
            $pourcentage_dispos_im[] = $pourcentage_dispo_im;
            $affectationStagesCount_im[$affectation->id] = $stageCountImm;
        }


        return view('admin.statistiques', compact(
            'affectations',
            'quota_dispos_pfe',
            'quota_dispos_im',
            'pourcentage_dispos_pfe',
            'pourcentage_dispos_im',
            'stages',
            'affectationStagesCount_pfe',
            'affectationStagesCount_im',
            'operation'
        ));
    }

    public function search(Request $request)
    {
        if ($request->input('structuresAffectation_id') == 0) {
            return redirect()->route('statistiquesAdmin');
        }

        $operation = 1;
        $affectationID = $request->input('structuresAffectation_id');
        $userStructuresIAPId = Auth::user()->structuresIAP_id;
        $currentYear = date('Y');

        $stages = Stage::join('structures_affectations', function ($join) use ($userStructuresIAPId) {
            $join->on('stages.structuresAffectation_id', '=', 'structures_affectations.id')
                ->where('structures_affectations.structuresIAP_id', '=', $userStructuresIAPId);
        })
            ->where('stages.year', $currentYear)
            ->where('stages.stage_annule', 0)
            ->select('stages.*')
            ->get();

        $affectations = StructuresAffectation::where('structuresIAP_id', $userStructuresIAPId)->get();

        $quota_dispos_pfeR = 0;
        $quota_dispos_imR = 0;
        $pourcentage_dispos_pfeR = 0;
        $pourcentage_dispos_imR = 0;
        $affectationStagesCount_pfeR = 0;
        $affectationStagesCount_imR = 0;

        foreach ($affectations as $affectation) {
            if ($affectation->id == $affectationID) {
                $stageCountPFE = $stages->where('stage_type', 'pfe')
                    ->where('structuresAffectation_id', $affectation->id)
                    ->count();

                $quota_dispo_pfeR = $affectation->quota_pfe - $stageCountPFE;
                $quota_dispo_pfeR = max($quota_dispo_pfeR, 0);
                $pourcentage_dispos_pfeR = $affectation->quota_pfe > 0 ? round(($quota_dispo_pfeR * 100) / $affectation->quota_pfe, 1) : 0;

                $affectationStagesCount_pfeR = $stageCountPFE;

                $stageCountImm = $stages->where('stage_type', 'immersion')
                    ->where('structuresAffectation_id', $affectation->id)
                    ->count();

                $quota_dispo_imR = $affectation->quota_im - $stageCountImm;
                $quota_dispo_imR = max($quota_dispo_imR, 0);
                $pourcentage_dispos_imR = $affectation->quota_im > 0 ? round(($quota_dispo_imR * 100) / $affectation->quota_im, 1) : 0;

                $affectationStagesCount_imR = $stageCountImm;
            }
        }

        return view('admin.statistiques', compact(
            'affectations',
            'quota_dispos_pfeR',
            'quota_dispos_imR',
            'pourcentage_dispos_pfeR',
            'pourcentage_dispos_imR',
            'stages',
            'affectationStagesCount_pfeR',
            'affectationStagesCount_imR',
            'operation',
            'affectationID'
        ));
    }
}
