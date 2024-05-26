<x-masterAdmin title="Stagiaires">  
        @if(request()->has('recherche'))
        @if ($stagiaires->isEmpty())
        <div>
            <a onclick="goBack()" class="btn btn-danger my-2">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
        </div>
        <p class="h3 text-center my-3">Aucun stagiaire trouvé.</p>
        @else
        <div>
            <a onclick="goBack()" class="btn btn-danger my-2">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-sm table-dark table-bordered table-striped table-hover">
                <tr>
                    <th>Nom</th>
                    <th>N° de tel</th>
                    <th>Email</th>
                    {{--<th>Durée du stage</th>--}}
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th>Jours de réception</th>
                    <th>Clôture</th>
                    <th>Quitus</th>
        
                </tr>   
                @foreach ($stagiaires as $stagiaire)
                <tr>
                    <td>{{$stagiaire->last_name}} {{$stagiaire->first_name}}</td>
                    <td>{{$stagiaire->phone_number}}</td>
                    <td>{{$stagiaire->email}}</td>
                    {{-- <td>
                        <?php
                            $start_date = new DateTime($stagiaire->Stage->start_date);
                            $cloture_date = new DateTime($stagiaire->Stage->cloture_date);
                            $duration = $start_date->diff($cloture_date)->format("%m mois");
                            if ($start_date->diff($cloture_date)->days < 30) {
                                $duration = $start_date->diff($cloture_date)->days . " jours";
                            }
                            echo $duration;
                        ?>
                    </td>--}}
                    <td>{{$stagiaire->Stage->start_date}}</td>
                    <td>{{$stagiaire->Stage->cloture_date}}</td>
                    <td>{{$stagiaire->Stage->reception_days}}</td>
                    <td style="text-align: center;">
                        @if ($stagiaire->Stage->cloture == 1)
                        <a class="btn btn-sm">
                            <i class="bi bi-check-circle-fill text-light"></i>
                        </a>                         
                        @else
                        <a class="btn btn-sm">
                            <i class="bi bi-x-circle-fill text-warning"></i>
                        </a>
                        @endif
                    </td>
                    <td style="text-align: center;">
                        @if ($stagiaire->quitus == 1)
                        <a class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#invaliderModal{{$stagiaire->id}}">
                            <i class="bi bi-check-circle-fill text-light"></i>
                        </a>                        
                        @else
                            @if ($stagiaire->Stage->cloture == 1)
                                    <a class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$stagiaire->id}}">
                                        <i class="bi bi-x-circle-fill text-warning"></i>
                                    </a>
                            @else
                                    <a class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#cloture0modal" >
                                        <i class="bi bi-x-circle-fill text-warning"></i>
                                    </a>
                            @endif
                                
                        @endif
                    </td>
                    <div class="modal fade" id="exampleModal{{$stagiaire->id}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$stagiaire->id}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel{{$stagiaire->id}}">Validation Quitus</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Voulez-vous vraiment valider le quitus de <strong>{{$stagiaire->last_name}} {{$stagiaire->first_name}}</strong> ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                                    <form action="{{ route('stagiaires.validerQuitus', $stagiaire->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-warning">Oui</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="invaliderModal{{$stagiaire->id}}" tabindex="-1" aria-labelledby="invaliderModalLabel{{$stagiaire->id}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="invaliderModalLabel{{$stagiaire->id}}">Annuler Quitus</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Voulez-vous vraiment annuler le quitus de <strong>{{$stagiaire->last_name}} {{$stagiaire->first_name}}</strong> ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                                    <form action="{{ route('stagiaires.invaliderQuitus', $stagiaire->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-warning">Oui</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </tr>
                   @endforeach
            </table>
            </div>
            <div class="paginator">
                {{ $stagiaires->links() }}
            </div>
        @endif
        @else
        <div class="d-flex">
            <div class="col">
                <div class="title">
                    <h1>Liste des Stagiares</h1>
                  </div>
            </div>
            <form  method="POST" action="{{ route('searchResultsStagiares1')}}">
                @csrf
            <div class="col d-flex">
                <div style="width: 350px">
                    <input name="name"  placeholder="Nom" class="form-control form-control-sm" type="text" aria-label=".form-control-sm example" autocomplete="off" required>
                </div>
                <div>
                    <button name="recherche" type="submit" class="btn btn-sm btn-warning mx-1">
                        <i class="bi bi-search"></i> Rechercher
                    </button>
                </div>         
            </div>
            </form>
        </div>
        <div class="table-responsive">
        <table class="table table-sm table-dark table-bordered table-striped table-hover">
                <tr>
                    <th>Nom</th>
                    <th>N° de tel</th>
                    <th>Email</th>
                    {{--<th>Durée du stage</th>--}}
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th>Jours de réception</th>
                    <th>Clôture</th>
                    <th>Quitus</th>
        
                </tr>   
                @foreach ($stagiaires as $stagiaire)
                <tr>
                    <td>{{$stagiaire->last_name}} {{$stagiaire->first_name}}</td>
                    <td>{{$stagiaire->phone_number}}</td>
                    <td>{{$stagiaire->email}}</td>
                    {{-- <td>
                        <?php
                            $start_date = new DateTime($stagiaire->Stage->start_date);
                            $cloture_date = new DateTime($stagiaire->Stage->cloture_date);
                            $duration = $start_date->diff($cloture_date)->format("%m mois");
                            if ($start_date->diff($cloture_date)->days < 30) {
                                $duration = $start_date->diff($cloture_date)->days . " jours";
                            }
                            echo $duration;
                        ?>
                    </td>--}}
                    <td>{{$stagiaire->Stage->start_date}}</td>
                    <td>{{$stagiaire->Stage->cloture_date}}</td>
                    <td>{{$stagiaire->Stage->reception_days}}</td>
                    <td style="text-align: center;">
                        @if ($stagiaire->Stage->cloture == 1)
                        <a class="btn btn-sm">
                            <i class="bi bi-check-circle-fill text-light"></i>
                        </a>                         
                        @else
                        <a class="btn btn-sm">
                            <i class="bi bi-x-circle-fill text-warning"></i>
                        </a>
                        @endif
                    </td>
                    <td style="text-align: center;">
                        @if ($stagiaire->quitus == 1)
                        <a class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#invaliderModal{{$stagiaire->id}}">
                            <i class="bi bi-check-circle-fill text-light"></i>
                        </a>                        
                        @else
                            @if ($stagiaire->Stage->cloture == 1)
                                    <a class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$stagiaire->id}}">
                                        <i class="bi bi-x-circle-fill text-warning"></i>
                                    </a>
                            @else
                                    <a class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#cloture0modal" >
                                        <i class="bi bi-x-circle-fill text-warning"></i>
                                    </a>
                            @endif
                                
                        @endif
                    </td>
                    <div class="modal fade" id="exampleModal{{$stagiaire->id}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$stagiaire->id}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel{{$stagiaire->id}}">Validation Quitus</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Voulez-vous vraiment valider le quitus de <strong>{{$stagiaire->last_name}} {{$stagiaire->first_name}}</strong> ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                                    <form action="{{ route('stagiaires.validerQuitus', $stagiaire->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-warning">Oui</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="invaliderModal{{$stagiaire->id}}" tabindex="-1" aria-labelledby="invaliderModalLabel{{$stagiaire->id}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="invaliderModalLabel{{$stagiaire->id}}">Annuler Quitus</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Voulez-vous vraiment annuler le quitus de <strong>{{$stagiaire->last_name}} {{$stagiaire->first_name}}</strong> ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                                    <form action="{{ route('stagiaires.invaliderQuitus', $stagiaire->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-warning">Oui</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </tr>
                   @endforeach
            </table>
        </div>
        <div class="paginator">
            {{ $stagiaires->links() }}
        </div>
        @endif
        

</x-masterAdmin>

<div class="modal fade" id="cloture0modal" tabindex="-1" aria-labelledby="cloture0modalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cloture0modalLabel">Alerte</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Le stage doit être clôturé d'abord.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>

  