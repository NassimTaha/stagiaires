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
                            <a class="btn btn-sm btn-danger">
                                <i class="bi bi-x-circle-fill"></i> Non
                            </a>
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
                <option selected value="">Options de recherche</option>
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
                            <a class="btn btn-sm btn-danger">
                                <i class="bi bi-x-circle-fill"></i> Non
                            </a>
                            @endif
                        </td>                                                
                    @endforeach                     
                </tr>  
            </thead>            
            </table>
        </div>        
    <div class="paginator mt-2">
        {{ $stages->links() }}
    </div>
    @endif
</x-master>