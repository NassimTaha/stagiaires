<x-masterSubadmin title="Encadrants">
    @if(request()->has('recherche'))
        @if ($stages->isEmpty())
            <div>
                <a onclick="goBack()" class="btn btn-danger my-2">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>
            </div>
            <p class="h3 text-center my-3">Aucun stage trouvé.</p>
        @else
            <div>
                <a onclick="goBack()" class="btn btn-danger my-2">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>
            </div>
            <p style="font-family: Montserrat" class="h2">Nombre de stages : {{$nbr_stages}}</p>
            <div class="table-responsive">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered border-secondary"> 
                        <tr>
                            <th class='table-dark'>Structure IAP</th>
                            @foreach ($stages as $key => $stage)
                                @if ($key % 2 == 0)
                                    <td class="table-light">{{$stage->structureAffectation->structuresIAP->name}}</td>
                                @else
                                    <td class='table-warning'>{{$stage->structureAffectation->structuresIAP->name}}</td>
                                @endif 
                            @endforeach                    
                        </tr>                 
                        <tr>
                            <th class='table-dark'>Structure d'affectation</th>
                            @foreach ($stages as $key => $stage)
                                @if ($key % 2 == 0)
                                    <td class="table-light">{{$stage->structureAffectation->name}}</td>
                                @else
                                    <td class='table-warning'>{{$stage->structureAffectation->name}}</td>
                                @endif 
                            @endforeach                    
                        </tr>
                        <tr>
                            <th class='table-dark'>Encadrant</th>
                            @foreach ($stages as $key => $stage)
                                @if ($key % 2 == 0)
                                    <td class="table-light">{{$stage->encadrant->last_name}} {{$stage->encadrant->first_name}}</td>
                                @else
                                    <td class='table-warning'>{{$stage->encadrant->last_name}} {{$stage->encadrant->first_name}}</td>
                                @endif 
                            @endforeach                     
                        </tr>
                        <tr>
                            <th class='table-dark'>Type de stage</th>
                            @foreach ($stages as $key => $stage)
                                @if ($key % 2 == 0)
                                    <td class="table-light">{{ $stage->stage_type === 'pfe' ? 'Projet fin d\'étude' : 'Stage immersion' }}</td>
                                @else
                                    <td class='table-warning'>{{ $stage->stage_type === 'pfe' ? 'Projet fin d\'étude' : 'Stage immersion' }}</td>
                                @endif 
                            @endforeach                     
                        </tr>
                        <tr>
                            <th class='table-dark'>Date début</th>
                            @foreach ($stages as $key => $stage)
                                @if ($key % 2 == 0)
                                    <td class="table-light">{{$stage->start_date}}</td>
                                @else
                                    <td class='table-warning'>{{$stage->start_date}}</td>
                                @endif 
                            @endforeach                     
                        </tr>
                        <tr>
                            <th class='table-dark'>Date fin</th>
                            @foreach ($stages as $key => $stage)
                                @if ($key % 2 == 0)
                                    <td class="table-light">{{$stage->end_date}}</td>
                                @else
                                    <td class='table-warning'>{{$stage->end_date}}</td>
                                @endif 
                            @endforeach                     
                        </tr>
                        <tr>
                            <th class='table-dark'>Établissement</th>
                            @foreach ($stages as $key => $stage)
                                @if ($key % 2 == 0)
                                    <td class="table-light">{{$stage->etablissement->name}} ({{$stage->etablissement->wilaya}})</td>
                                @else
                                    <td class='table-warning'>{{$stage->etablissement->name}} ({{$stage->etablissement->wilaya}})</td>
                                @endif 
                            @endforeach                     
                        </tr>
                        <tr>
                            <th class='table-dark'>Niveau</th>
                            @foreach ($stages as $key => $stage)
                                @if ($key % 2 == 0)
                                    <td class="table-light">{{$stage->level}}</td>
                                @else
                                    <td class='table-warning'>{{$stage->level}}</td>
                                @endif 
                            @endforeach                     
                        </tr>
                        <tr>
                            <th class='table-dark'>Domaine</th>
                            @foreach ($stages as $key => $stage)
                                @if ($key % 2 == 0)
                                    <td class="table-light">{{$stage->specialite->domaine->name}}</td>
                                @else
                                    <td class='table-warning'>{{$stage->specialite->domaine->name}}</td>
                                @endif 
                            @endforeach                     
                        </tr> 
                        <tr>
                            <th class='table-dark'>Spécialité</th>
                            @foreach ($stages as $key => $stage)
                                @if ($key % 2 == 0)
                                    <td class="table-light">{{$stage->specialite->name}}</td>
                                @else
                                    <td class='table-warning'>{{$stage->specialite->name}}</td>
                                @endif 
                            @endforeach                     
                        </tr>       
                        <tr>
                            <th class='table-dark'>Thème</th>
                            @foreach ($stages as $key => $stage)
                                @if ($key % 2 == 0)
                                    <td class="table-light">{{$stage->theme}}</td>
                                @else
                                    <td class='table-warning'>{{$stage->theme}}</td>
                                @endif 
                            @endforeach                     
                        </tr>  
                        <tr>
                            <th class='table-dark'>Jours de réception</th>
                            @foreach ($stages as $key => $stage)
                                @if ($key % 2 == 0)
                                    <td class="table-light">{{$stage->reception_days}}</td>
                                @else
                                    <td class='table-warning'>{{$stage->reception_days}}</td>
                                @endif 
                            @endforeach                     
                        </tr>  
                        <tr>
                            <th class='table-dark'>Stagiares</th>
                            @foreach ($stages as $key => $stage)
                            @if ($key % 2 == 0)
                                <td class="table-light">
                                    @foreach ($stage->stagiaires as $stagiaire)    
                                        {{ $stagiaire->last_name }} {{ $stagiaire->first_name }}<br>
                                    @endforeach 
                                </td>
                            @else
                            <td class='table-warning'>
                                @foreach ($stage->stagiaires as $stagiaire)    
                                    {{ $stagiaire->last_name }} {{ $stagiaire->first_name }}<br>
                                @endforeach 
                            </td>
                            @endif
                            @endforeach                     
                        </tr>          
                        <tr>
                            <th class='table-dark'>Stage clôturé </th>
                            @foreach ($stages as $key => $stage)
                                @if ($key % 2 == 0)
                                <td class="table-light" style="text-align: center;">
                                    @if ($stage->cloture === 1)
                                    <button class="btn btn-sm btn-success">
                                        <i class="bi bi-check-circle-fill"></i> Oui
                                    </button>      
                                    @else
                                    <button class="btn btn-sm  btn-danger">
                                        <i class="bi bi-x-circle-fill"></i> Non
                                    </button>
                                    @endif
                                </td>                                            
                                @else
                                <td class="table-warning" style="text-align: center;">
                                    @if ($stage->cloture === 1)
                                    <button class="btn btn-sm btn-success">
                                        <i class="bi bi-check-circle-fill"></i> Oui
                                    </button>
                                    @else
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-x-circle-fill"></i> Non
                                    </button>
                                    @endif
                                </td>                                                
                                @endif 
                            @endforeach                     
                        </tr>  
                        
                        
                    </table>
                </div>        
            </div>
            <div class="paginator">
                {{ $stages->appends(['recherche' => ''])->links() }}
            </div>
        @endif
    @else
    <p class="text-center h1" style="margin-top: 25px">Rechercher un stage</p>

    <form id="search_form" action="{{ route('stages.searchStage2') }}" method="POST" onsubmit="return validateForm()">
        @csrf 
        <div style="margin-top: 25px" id="add_edit_div">

            <div class="row mt-2">

                <div class="col-6">
                    <p class="h6">Structure IAP</p>
                <select  id="structure" name="structuresIAP_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option selected value="">-- Choisissez une structure IAP --</option>
                        @foreach ($structuresIAPs as $structuresIAP)
                            <option value="{{ $structuresIAP->id }}">
                                {{ $structuresIAP->name }} 
                            </option>
                        @endforeach
                </select>    

                </div>

                <div class="col-6">   
                    <p class="h6">Type de stage</p>             
                    <select id="type_stage" name="stage_type" class="form-select form-select-sm" aria-label=".form-select-sm example" >
                        <option selected value="">-- Choisissez un type de stage --</option>
                        <option value="pfe">Projet fin d'étude</option>
                        <option value="immersion">Stage immersion</option>
                    </select>
                </div>

            </div>
            <div class="row mt-2">

                <div class="col-4">
                    <p class="h6">Niveau</p>
                    <select  id="niveau" name="level" class="form-select form-select-sm" aria-label=".form-select-sm example" >
                        <option selected value="">-- Choisissez un niveau --</option>
                        <option value="Licence">Licence</option>
                        <option value="Master">Master</option>
                        <option value="Doctorat">Doctorat</option>
                        <option value="Ingenieur">Ingénieur</option>
                        <option value="TS">Technicien supérieur</option>
                    </select>
                </div>

                <div class="col-4">
                    <p class="h6">Nombre de stagiaires</p>
                    <select id="nbr_stag" name="stagiaire_count" class="form-select form-select-sm" aria-label=".form-select-sm example" >
                        <option selected value="">-- Choisissez le nombre de stagiaires --</option>
                        <option value="Monome">Monome</option>
                        <option value="Binome">Binome</option>
                        <option value="Trinome">Trinome</option>
                        <option value="Quadrinome">Quadrinome</option>
                    </select>
                </div>

                <div class="col-4">
                    <p class="h6">Établissement</p>
                    <select id="etablissement" name="etablissement_id" class="form-select form-select-sm" aria-label=".form-select-sm example" >
                        <option selected value="">-- Choisissez un établissement --</option>
                        @foreach ($etablissements as $etablissement)
                            <option value="{{ $etablissement->id }}">
                                {{ $etablissement->name }} ({{$etablissement->wilaya}})  
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="row mt-2">

                <div class="col-4">
                    <p class="h6">Domaine</p>
                    <select id="domaine" name="domaine_id" class="form-select form-select-sm" aria-label=".form-select-sm example" >
                        <option selected value="">-- Choisissez un domaine --</option>
                        @foreach ($domaines as $domaine)
                            <option value="{{ $domaine->id }}">
                                {{$domaine->name}} ({{$domaine->structuresIAP->name}})
                            </option>
                        @endforeach
                    </select>
                    
                </div>

                <div class="col-4">
                    <p class="h6">Spécialité</p>
                    <select id="specialite" name="specialite_id" class="form-select form-select-sm" aria-label=".form-select-sm example" >
                        <option selected value="">-- Choisissez une spécialité --</option>
                        @foreach ($specialites as $specialite)
                            <option value="{{ $specialite->id }}">
                                {{ $specialite->name }} ({{$specialite->domaine->name}}) ({{$specialite->domaine->structuresIAP->name}})  
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-4">
                    <p class="h6">Année</p>
                    <input name="year" pattern="[0-9]{4}" maxlength="4" placeholder="YYYY" class="form-control form-control-sm" type="text"  aria-label=".form-control-sm example" autocomplete="off">
                </div>

            </div>

            <div class="d-flex mt-3">
                <button type="submit" name="recherche" class="float-end btn btn-warning mx-1" style="width: 150px">
                    <i class="bi bi-search"></i> Rechercher
                </button>
                <button type="button" onclick="resetForm2()" style="width: 150px" class=" float-end btn btn-dark mx-1">
                    <i class="bi bi-arrow-counterclockwise"></i> Réinitialiser
                </button>
                
            </div>


        </div>
    </form>
    @endif
</x-masterSubadmin>


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