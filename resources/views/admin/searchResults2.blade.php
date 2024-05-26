<x-masterAdmin title="Stages">
    <div>
        <a href="{{route('stages.searchStages')}}" class="btn btn-danger my-2">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
    </div>
    @if ($stages->isEmpty())
        <p class="h2 text-center my-3">Aucun stage trouvé.</p>
    @else
    <p style="font-family: Montserrat" class="h2">Nombre de stages : {{$nbr_stages}} </p>
    <div class="table-responsive">
        <div class="table-responsive">
            <table class="table table-sm table-bordered border-secondary">                  
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
                            <a href="{{route('Stage.cloture', $stage->id)}}" class="btn btn-sm btn-danger">
                                <i class="bi bi-x-circle-fill"></i> Non
                            </a>
                            @endif
                        </td>                                            
                        @else
                        <td class="table-warning" style="text-align: center;">
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
                        @endif 
                    @endforeach                     
                </tr>  
                <tr>
                    <th class='table-dark'>Modifier / Annuler</th>
                    @foreach ($stages as $key => $stage)
                    @if ($key % 2 == 0)
                        <td class="table-light" style="text-align: center;">
                            <a href="{{route('stages.edit', $stage->id)}}" class="btn btn-sm btn-dark ">
                                <i class="bi bi-pencil-square text-warning"></i>
                            </a>
                            <a data-bs-toggle="modal" data-bs-target="#exampleModal{{$stage->id}}" class="btn btn-sm btn-dark">
                                <i class="bi bi-x-octagon-fill text-warning"></i> 
                            </a>
                        </td>
                    @else
                            <td class="table-warning" style="text-align: center;">
                                <a href="{{route('stages.edit', $stage->id)}}" class="btn btn-sm btn-dark ">
                                    <i class="bi bi-pencil-square text-warning"></i>
                                </a>
                                <a data-bs-toggle="modal" data-bs-target="#exampleModal{{$stage->id}}" class="btn btn-sm btn-dark">
                                    <i class="bi bi-x-octagon-fill text-warning"></i> 
                                </a>
                            </td>
                    @endif
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
            </table>
        </div>        
    </div>
    @endif
    <div class="paginator">
        {{ $stages->links() }}
    </div>
</x-masterAdmin>