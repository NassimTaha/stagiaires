<?php

use App\Http\Controllers\AdminEncadrantController;
use App\Http\Controllers\AttestationController;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\EncadrantController;
use App\Http\Controllers\EtablissementController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SignataireController;
use App\Http\Controllers\SpecialiteController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\StagiaireController;
use App\Http\Controllers\StatistiquesController;
use App\Http\Controllers\StructuresIAPController;
use App\Http\Controllers\StructuresAffectationController;
use App\Http\Controllers\SuperadminController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'subadmin'])->prefix('subadmin')->group(function () {
    Route::get('index', [HomeController::class, 'subadmin'])->name('subadmin');
});



Route::get('user/index', [HomeController::class, 'user'])
    ->middleware(['auth', 'user'])
    ->name('user');

Route::get('security/index', [HomeController::class, 'security'])
    ->middleware(['auth', 'security'])
    ->name('security');


require __DIR__ . '/auth.php';



Route::middleware(['auth', 'security'])->prefix('security')->group(function () {
    Route::get('/stagiaires', [StagiaireController::class, 'indexSecurity'])->name('indexSecurity');
    Route::post('/stagiaires/resultat', [StagiaireController::class, 'searchSecurity'])->name('searchSecurity');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('index', [HomeController::class, 'admin'])->name('admin');

    Route::resource('stagiares', StagiaireController::class);
    Route::match(['get', 'post'], 'searchResultsStagiares1', [SearchController::class, 'searchResultsStagiares1'])->name('searchResultsStagiares1');
    Route::post('/stagiaires/{id}/validerQuitus', [StagiaireController::class, 'validerQuitus'])->name('stagiaires.validerQuitus');
    Route::post('/stagiaires/{id}/invaliderQuitus', [StagiaireController::class, 'invaliderQuitus'])->name('stagiaires.invaliderQuitus');
    Route::get('/attestation', [AttestationController::class, 'index'])->name('attestation');
    Route::match(['get', 'post'], 'searchResultsStagiares2', [SearchController::class, 'searchResultsStagiares2'])->name('searchResultsStagiares2');
    Route::post('/attestation/download/{stagiaire}', [AttestationController::class, 'imprimer'])->name('attestation.download');

    Route::resource('stages', StageController::class);
    Route::post('/quotaVerification', [StageController::class, 'quotaVerification'])->name('quotaVerification');
    Route::get('searchStages', [SearchController::class, 'searchStages'])->name('stages.searchStages');
    Route::match(['get', 'post'], 'searchResults1', [SearchController::class, 'searchResults1'])->name('stages.searchResults1');
    Route::match(['get', 'post'], 'searchResults2', [SearchController::class, 'searchResults2'])->name('stages.searchResults2');
    Route::get('/stage/{stage}/cloture', [StageController::class, 'cloture'])->name('Stage.cloture');
    Route::post('/stage/done/{stage}', [StageController::class, 'done'])->name('stage.done');
    Route::post('/stage/annuler/{stage}', [StageController::class, 'annuler'])->name('stage.annuler');

    Route::resource('encadrants', EncadrantController::class);
    Route::match(['get', 'post'], 'searchEncadrant', [SearchController::class, 'searchEncadrant'])->name('encadrants.searchEncadrant');

    Route::resource('structuresAffectation', StructuresAffectationController::class);
    Route::match(['get', 'post'], 'searchAffectation', [SearchController::class, 'searchAffectation'])->name('structuresAffectation.searchAffectation');

    Route::resource('etablissements', EtablissementController::class);
    Route::match(['get', 'post'], 'searchEtablissement', [SearchController::class, 'searchEtablissement'])->name('etablissements.searchEtablissement');

    Route::resource('domaines', DomaineController::class);
    Route::match(['get', 'post'], 'searchDomaine', [SearchController::class, 'searchDomaine'])->name('domaines.searchDomaine');

    Route::resource('specialites', SpecialiteController::class);
    Route::match(['get', 'post'], 'searchSpecialite', [SearchController::class, 'searchSpecialite'])->name('specialites.searchSpecialite');

    Route::resource('signataires', SignataireController::class);
    Route::match(['get', 'post'], 'searchSignataire', [SearchController::class, 'searchSignataire'])->name('signataires.searchSignataire');

    Route::get('/statistiques', [StatistiquesController::class, 'index'])->name('statistiquesAdmin');
    Route::post('/statistique/search', [StatistiquesController::class, 'search'])->name('statistique.search');
});







Route::middleware(['auth', 'superadmin'])->prefix('superadmin')->group(function () {
    Route::get('index', [HomeController::class, 'superadmin'])->name('superadmin');



    Route::resource('comptes', CompteController::class);
    Route::match(['get', 'post'], 'searchComptes', [SearchController::class, 'searchComptes'])->name('comptes.searchComptes');

    Route::resource('structuresIAP', StructuresIAPController::class);
    Route::match(['get', 'post'], 'searchIAP', [SearchController::class, 'searchIAP'])->name('structuresIAP.searchIAP');

    Route::get('domaines', [SuperadminController::class, 'domaines'])->name('domaines');
    Route::match(['get', 'post'], 'searchDomaine2', [SearchController::class, 'searchDomaine2'])->name('domaines.searchDomaine2');

    Route::get('structuresAffectation', [SuperadminController::class, 'structuresAffectation'])->name('structuresAffectation');
    Route::match(['get', 'post'], '/search-affectation', [SearchController::class, 'searchAffectation2'])->name('structuresAffectation.searchAffectation2');

    Route::get('etablissements', [SuperadminController::class, 'etablissements'])->name('etablissements');
    Route::match(['get', 'post'], 'searchEtablissement2', [SearchController::class, 'searchEtablissement2'])->name('etablissements.searchEtablissement2');

    Route::get('encadrants', [SuperadminController::class, 'encadrants'])->name('encadrants');
    Route::match(['get', 'post'], 'searchEncadrant2', [SearchController::class, 'searchEncadrant2'])->name('encadrants.searchEncadrant2');

    Route::get('specialites', [SuperadminController::class, 'specialites'])->name('specialites');
    Route::match(['get', 'post'], 'searchSpecialite2', [SearchController::class, 'searchSpecialite2'])->name('specialites.searchSpecialite2');

    Route::get('stagiaires', [SuperadminController::class, 'stagiaires'])->name('stagiaires');
    Route::match(['get', 'post'], 'searchStagiaire', [SearchController::class, 'searchStagiaire'])->name('stagiaires.searchStagiaire');

    Route::get('signataires', [SuperadminController::class, 'signataires'])->name('signataires');
    Route::match(['get', 'post'], 'searchSignataire2', [SearchController::class, 'searchSignataire2'])->name('signataires.searchSignataire2');

    Route::get('stages', [SuperadminController::class, 'stages'])->name('stages');
    Route::match(['get', 'post'], 'searchStage', [SearchController::class, 'searchStage'])->name('stages.searchStage');

    Route::get('rechercheStage', [SuperadminController::class, 'rechercheStage'])->name('rechercheStage');
    Route::match(['get', 'post'], 'searchStage2', [SearchController::class, 'searchStage2'])->name('stages.searchStage2');
});
