<x-masterAdmin title="Recherche"> 
 
        <p class="text-center h1" style="margin-top: 25px">Rechercher un stage</p>


    <form id="search_form" action="{{ route('stages.searchResults2') }}" method="POST" onsubmit="return validateForm()">
        @csrf 
        <div style="margin-top: 25px" id="add_edit_div">
            <p class="h6">Thème</p>
            <select name="theme" class="form-select form-select-sm" aria-label=".form-select-sm example">
                <option selected value="">-- Choisissez un thème --</option>
                @foreach ($themes as $theme)
                    <option value="{{ $theme }}">
                        {{ $theme }} 
                    </option>
                @endforeach
            </select>

            <div class="row mt-2">
                <div class="col-4">
                    <p class="h6">Structure D'Affectation</p>
                    <select name="structuresAffectation_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option selected value="">-- Choisissez une structure d'affectation --</option>
                        @foreach ($structuresAffectations as $structuresAffectation)
                            <option value="{{ $structuresAffectation->id }}">
                                {{ $structuresAffectation->name }} 
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <p class="h6">Encadrant</p>
                    <select name="encadrant_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option selected value="">-- Choisissez un encadrant --</option>
                        @foreach ($encadrants as $encadrant)
                            <option value="{{ $encadrant->id }}">
                                {{ $encadrant->last_name }} {{ $encadrant->first_name }} 
                            </option>
                        @endforeach
                    </select> 
                </div>
                <div class="col-4">
                    <p class="h6">Type de stage</p>
                    <select name="stage_type" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option selected value="">-- Choisissez un type de stage --</option>
                        <option value="pfe">Projet fin d'étude</option>
                        <option value="immersion">Stage immersion</option>
                    </select> 
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-4">
                    <p class="h6">Établissement</p>
                    <select name="etablissement_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option selected value="">-- Choisissez un établissement --</option>
                        @foreach ($etablissements as $etablissement)
                            <option value="{{ $etablissement->id }}">
                                {{ $etablissement->name }} ({{$etablissement->wilaya}})  
                            </option>
                        @endforeach
                    </select> 
                </div>
                <div class="col-4">
                    <p class="h6">Année</p>
                    <input name="year" pattern="[0-9]{4}" maxlength="4" placeholder="YYYY" class="form-control form-control-sm" type="text"  aria-label=".form-control-sm example" autocomplete="off">
                </div>
                <div class="col-4">
                    <p class="h6">Nombre de stagiaires</p>
                    <select name="stagiaire_count" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option selected value="">-- Choisissez le nombre de stagiaires --</option>
                        <option value="Monome">Monome</option>
                        <option value="Binome">Binome</option>
                        <option value="Trinome">Trinome</option>
                        <option value="Quadrinome">Quadrinome</option>
                    </select>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-4">
                    <p class="h6">Niveau</p>
                    <select name="level" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option selected value="">-- Choisissez un niveau --</option>
                        <option value="Licence">Licence</option>
                        <option value="Master">Master</option>
                        <option value="Doctorat">Doctorat</option>
                        <option value="Ingenieur">Ingénieur</option>
                        <option value="TS">Technicien supérieur</option>
                    </select>
                </div>
                <div class="col-4">
                    <p class="h6">Domaine</p>
                    <select name="domaine_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option selected value="">-- Choisissez un domaine --</option>
                        @foreach ($domaines as $domaine)
                            <option value="{{ $domaine->id }}">
                                {{$domaine->name}}  
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <p class="h6">Spécialité</p>
                    <select name="specialite_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option selected value="">-- Choisissez une spécialité --</option>
                        @foreach ($specialites as $specialite)
                            <option value="{{ $specialite->id }}">
                                {{ $specialite->name }} ({{$specialite->domaine->name}})  
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="d-flex mt-3">
                <button type="submit" class="float-end btn btn-warning mx-1" style="width: 150px">
                    <i class="bi bi-search"></i> Rechercher
                </button>
                <button type="button" onclick="resetForm2()" style="width: 150px" class=" float-end btn btn-dark mx-1">
                    <i class="bi bi-arrow-counterclockwise"></i> Réinitialiser
                </button>
                
            </div>

        </div>
    </form>
</x-masterAdmin>

<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="maxDaysModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="maxDaysModalLabel">Alerte</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Veuillez sélectionner au moins un critère de recherche.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>
