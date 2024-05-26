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
    <div class="d-flex">
        <div class="col">
            <div class="title">
                <h1>Liste des stages en cours</h1>
            </div>
        </div>
        <form  method="POST" action="{{ route('stages.searchStage')}}">
            @csrf
        <div class="col d-flex">
            <select style="width: 210px" id="type_recherche" class="form-select form-select-sm flex-grow-1 me-2" aria-label=".form-select-sm example" required onchange="rechercheType()">
                <option selected disabled value="">-- Choisissez une option --</option>
                <option value="structure">Par structure IAP</option>          
                <option value="type_stage">Par type de stage</option>
                <option value="etablissement">Par établissement</option>
                <option value="niveau">Par niveau</option>
                <option value="domaine">Par domaine</option>
                <option value="specialite">Par spécialité</option>
                <option value="nbr_stag">Par nombre de stagiaires</option>
            </select> 
            <div style="width: 450px">
                <select disabled id="decoy"  class="form-select form-select-sm" aria-label=".form-select-sm example" required></select>
            <select hidden disabled id="structure" name="structuresIAP_id" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                    <option selected value="">-- Choisissez une structure IAP --</option>
                    @foreach ($structuresIAPs as $structuresIAP)
                        <option value="{{ $structuresIAP->id }}">
                            {{ $structuresIAP->name }} 
                        </option>
                    @endforeach
            </select>       
            <select hidden disabled id="type_stage" name="stage_type" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                <option selected value="">-- Choisissez un type de stage --</option>
                <option value="pfe">Projet fin d'étude</option>
                <option value="immersion">Stage immersion</option>
            </select>
            <select hidden disabled id="etablissement" name="etablissement_id" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                <option selected value="">-- Choisissez un établissement --</option>
                @foreach ($etablissements as $etablissement)
                    <option value="{{ $etablissement->id }}">
                        {{ $etablissement->name }} ({{$etablissement->wilaya}})  
                    </option>
                @endforeach
            </select>   
            <select hidden disabled id="niveau" name="level" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                <option selected value="">-- Choisissez un niveau --</option>
                <option value="Licence">Licence</option>
                <option value="Master">Master</option>
                <option value="Doctorat">Doctorat</option>
                <option value="Ingenieur">Ingénieur</option>
                <option value="TS">Technicien supérieur</option>
            </select> 
            <select hidden disabled id="domaine" name="domaine_id" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                <option selected value="">-- Choisissez un domaine --</option>
                @foreach ($domaines as $domaine)
                    <option value="{{ $domaine->id }}">
                        {{$domaine->name}} ({{$domaine->structuresIAP->name}})
                    </option>
                @endforeach
            </select>
            <select hidden disabled id="specialite" name="specialite_id" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                <option selected value="">-- Choisissez une spécialité --</option>
                @foreach ($specialites as $specialite)
                    <option value="{{ $specialite->id }}">
                        {{ $specialite->name }} ({{$specialite->domaine->name}}) ({{$specialite->domaine->structuresIAP->name}})  
                    </option>
                @endforeach
            </select>
            <select hidden disabled id="nbr_stag" name="stagiaire_count" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                <option selected value="">-- Choisissez le nombre de stagiaires --</option>
                <option value="Monome">Monome</option>
                <option value="Binome">Binome</option>
                <option value="Trinome">Trinome</option>
                <option value="Quadrinome">Quadrinome</option>
            </select>
            </div>
            <button type="submit" name="recherche" class="btn btn-sm btn-warning mx-1">
                <i class="bi bi-search"></i> 
            </button>
        </div>
        </form>
        
    </div>
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
        {{ $stages->links() }}
    </div>
    @endif
</x-masterSubadmin>