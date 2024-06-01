<x-master title="Encadrants">
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
            <div class="table-wrapper">
                <table class="fl-table">  
                    <thead>           
                        <tr>
                            <th>Structure d'affectation</th>
                            @foreach ($stages as $stage)                     
                                    <td >{{$stage->structureAffectation->name}}</td>
                            @endforeach                    
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th >Encadrant</th>
                            @foreach ($stages as $stage)                      
                                    <td >{{$stage->encadrant->last_name}} {{$stage->encadrant->first_name}}</td>
                            @endforeach                     
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th >Type de stage</th>
                            @foreach ($stages as $stage)              
                                    <td >{{ $stage->stage_type === 'pfe' ? 'Projet fin d\'étude' : 'Stage immersion' }}</td>
                            @endforeach                     
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th >Date début</th>
                            @foreach ($stages as $stage)
                                    <td >{{$stage->start_date}}</td>
                            @endforeach                     
                        </tr>
                    </thead>
                    <thead>
                        <thead>
                        <tr>
                            <th >Date fin</th>
                            @foreach ($stages as $stage)
                                    <td >{{$stage->end_date}}</td>
                            @endforeach                     
                        </tr>
                        </thead>
                        <thead>
                        <tr>
                            <th >Établissement</th>
                            @foreach ($stages as $stage)                    
                                    <td >{{$stage->etablissement->name}} ({{$stage->etablissement->wilaya}})</td>
                            @endforeach                     
                        </tr>
                        </thead>
                        <thead>
                        <tr>
                            <th >Niveau</th>
                            @foreach ($stages as $stage)               
                                    <td >{{$stage->level}}</td>
                            @endforeach                     
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th >Domaine</th>
                            @foreach ($stages as $stage)
                                    <td >{{$stage->specialite->domaine->name}}</td>
                            @endforeach                     
                        </tr> 
                    </thead>
                    <thead>
                        <tr>
                            <th >Spécialité</th>
                            @foreach ($stages as $stage)
                                    <td >{{$stage->specialite->name}}</td>
                            @endforeach                     
                        </tr>  
                    </thead>
                    <thead>     
                        <tr>
                            <th >Thème</th>
                            @foreach ($stages as $stage)
                                    <td >{{$stage->theme}}</td>
                            @endforeach                     
                        </tr>  
                    </thead>
                    <thead>
                        <tr>
                            <th >Jours de réception</th>
                            @foreach ($stages as $stage)
                                    <td >{{$stage->reception_days}}</td>
                            @endforeach                     
                        </tr>
                    </thead>
                    <thead>  
                        <tr>
                            <th>Stagiares</th>
                            @foreach ($stages as $stage)
                            <td>
                                @foreach ($stage->stagiaires as $stagiaire)    
                                    {{ $stagiaire->last_name }} {{ $stagiaire->first_name }}<br>
                                @endforeach 
                            </td>
                            @endforeach            
                        </tr>   
                    </thead>
                    <thead>       
                        <tr>
                            <th >Stage clôturé </th>
                            @foreach ($stages as $stage)            
                                <td>
                                    @if ($stage->cloture === 1)
                                    <button class="btn btn-sm btn-success">
                                        <i class="bi bi-check-circle-fill"></i> Oui
                                    </button>
                                    @else
                                    <a href="{{route('Stage.cloture', $stage->id)}}" class="btn btn-sm btn-danger">
                                        <i class="bi bi-x-circle-fill"></i> Non
                                    </a>
                                    @endif
                                </td>                                                
                            @endforeach                     
                        </tr>  
                    </thead>
                    <thead>
                        <tr>
                            <th >Modifier / Annuler</th>
                            @foreach ($stages as $stage)
                                    <td style="text-align: center;">
                                        <a href="{{route('stages.edit', $stage->id)}}" class="btn btn-sm btn-dark ">
                                            <i class="bi bi-pencil-square text-warning"></i>
                                        </a>
                                        <a data-bs-toggle="modal" data-bs-target="#exampleModal{{$stage->id}}" class="btn btn-sm btn-dark">
                                            <i class="bi bi-x-octagon-fill text-warning"></i> 
                                        </a>
                                    </td>
                            <div class="modal fade" id="exampleModal{{$stage->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="exampleModalLabel">Annulation stage</h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="h5 text-danger">Voulez-vous vraiment annuler ce stage ?</p>
                                        <form action ="{{route('stage.annuler', $stage->id)}}" method="POST">
                                            @csrf
                                      <p class="h6">Observation</p>
                                      <textarea name="observation" autocomplete="off" class="form-control form-control-sm" aria-label=".form-control-sm example" wrap="soft" required rows="4" style="resize: none;"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>                  
                                      <button type="submit" class="btn btn-warning">Oui</button>
                                        </form>
                                    </div>
                                  </div>
                                </div>
                              </div> 
                            @endforeach  
                        </tr>   
                    </thead>     
                  <thead>
                    <tr>
                        <th>Statut</th>
                        @foreach ($stages as $stage)
                            <td>
                                @if ($stage->stage_annule == 1)
                                <div class="text-center">
                                    <strong>Annulé</strong>
                                </div>
                                <div class="text-left">
                                    <small>
                                        Observation : {{$stage->observation}}
                                    </small>
                                </div>                                 
                                @else
                                <div class="text-center">
                                    <strong>En cours</strong>
                                </div>        
                                @endif
                            </td>                                                
                        @endforeach                     
                    </tr>
                  </thead>
                </table>
            </div>   
            <div class="paginator mt-2">
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
                    <input name="year" min="2000" max="2050" maxlength="4" pattern="[0-9]{4}" maxlength="4" placeholder="XXXX" class="form-control form-control-sm" type="number"  aria-label=".form-control-sm example" autocomplete="off">
                </div>

            </div>

            <div class="d-flex mt-3">
                <button type="submit" name="recherche" class="float-end btn btn-warning mx-1" style="width: 150px">
                    <i class="bi bi-search"></i> Rechercher
                </button>
                <button type="button" onclick="resetForm2()" style="width: 150px" class=" float-end btn btn-dark mx-1">
                    <i class="bi bi-arrow-counterclockwise"></i> Réinitialiser
                </button>

                <p class="h6  mx-3">Annulés ?</p>
                <div class="form-check form-check-inline mt-2">
                    <input class="form-check-input" type="checkbox" name="stage_annuleOui" id="stage_annuleOui" value="1" onchange="handleStageAnnuleOui()">
                    <label class="form-check-label" for="stage_annuleOui">Oui</label>
                </div>
                <div class="form-check form-check-inline mt-2">
                    <input class="form-check-input" type="checkbox" name="stage_annuleNon" id="stage_annuleNon" value="1" onchange="handleStageAnnuleNon()">
                    <label class="form-check-label" for="stage_annuleNon">Non</label>
                </div>

                <p class="h6 mx-3" >Clôturés ?</p>
                <div class="form-check form-check-inline mt-2">
                    <input class="form-check-input" type="checkbox" name="clotureOui" id="clotureOui" value="1" onclick="handleClotureOui()">
                    <label class="form-check-label" for="clotureOui">Oui</label>
                </div>
                <div class="form-check form-check-inline mt-2">
                    <input class="form-check-input" type="checkbox" name="clotureNon" id="clotureNon" value="1" onclick="handleClotureNon()">
                    <label class="form-check-label" for="clotureNon">Non</label>
                </div>
                
            </div>


        </div>
    </form>
    @endif
</x-master>

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

  