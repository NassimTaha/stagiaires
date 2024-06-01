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
    @endif
    <div class="paginator mt-2">
        {{ $stages->links() }}
    </div>
</x-masterAdmin>