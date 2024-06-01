<x-masterAdmin title="Imprimer Attestation">
     
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
        <div class="table-wrapper">
            <table class="fl-table ">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Date De Naissance</th>
                        <th>Lieu De Naissance </th>
                        <th>Durée de stage</th>
                        <th>Specialite</th>
                        <th>Date De Debut</th>
                        <th>Date De Fin</th>                   
                        <th>Attestation</th>
                        <th><i class="bi bi-file-earmark-arrow-down-fill"></i></th>
                    </tr> 
                </thead>
                <tbody>  
                    @foreach ($stagiaires as $stagiaire)
                    <tr>
                        <td>{{$stagiaire->last_name}} {{$stagiaire->first_name}}</td>
                        <td>{{$stagiaire->date_of_birth}}</td>
                        <td>{{$stagiaire->place_of_birth}}</td>
                        <td>
                            <?php
                                $start_date = new DateTime($stagiaire->Stage->start_date);
                                $cloture_date = new DateTime($stagiaire->Stage->cloture_date);
                                $duration = $start_date->diff($cloture_date)->format("%m mois");
                                if ($start_date->diff($cloture_date)->days < 30) {
                                    $duration = $start_date->diff($cloture_date)->days . " jours";
                                }
                                echo $duration;
                            ?>
                        </td>
                        <td>{{$stagiaire->stage->specialite->name}}</td>
                        <td>{{$stagiaire->Stage->start_date}}</td>
                        <td>{{$stagiaire->Stage->cloture_date}}</td>
                        <td style="text-align: center;">
                            @if ($stagiaire->attestation_date)
                                <i class="bi bi-check-circle-fill text-dark"></i>
                            @else
                                <i class="bi bi-x-circle-fill text-danger"></i>
                            @endif
                        </td>
                        <td>
                            <a data-bs-toggle="modal" data-bs-target="#attestationModal{{$stagiaire->id}}">
                                <button class="btn btn-sm btn-primary">
                                    <i class="bi bi-file-earmark-arrow-down-fill"></i>
                                </button>
                            </a>
                            <div class="modal fade" id="attestationModal{{$stagiaire->id}}" tabindex="-1" aria-labelledby="attestationModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="attestationModalLabel">Attestation</h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('attestation.download', $stagiaire->id) }}" method="POST">
                                            @csrf
                                      <p class="h6">Signataire</p>
                                      <select name="signataire_id" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                                        <option selected value="">Choisissez un signataire</option>
                                        @foreach ($signataires as $signataire)
                                            <option value="{{$signataire->id}}">{{$signataire->last_name}} {{$signataire->first_name}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>                  
                                      <button type="submit" class="btn btn-warning">Continuer</button>
                                        </form>
                                    </div>
                                  </div>
                                </div>
                              </div>    
                        </td>
                    </tr>
                </tbody>
                       @endforeach
                </table>
            </div>
            <div class="paginator mt-2">
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
            <form  method="POST" action="{{ route('searchResultsStagiares2')}}">
                @csrf
                <div class="col d-flex">
                    <select style="width: 150px" name="year" id="year" class="form-select form-select-sm flex-grow-1 me-2" aria-label=".form-select-sm example">
                        <option selected  value="">Année</option>
                        <?php
                        $currentYear = date('Y');
                        for ($i = 0; $i < 10; $i++) {
                            $year = $currentYear - $i;
                            echo "<option value=\"$year\">$year</option>";
                        }
                        ?>
                    </select> 
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
        <hr>
        <div class="table-wrapper">
            <table class="fl-table">  
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Date De Naissance</th>
                    <th>Lieu De Naissance </th>
                    <th>Durée de stage</th>
                    <th>Specialite</th>
                    <th>Date De Debut</th>
                    <th>Date De Fin</th>
                    <th>Attestation</th>
                    <th><i class="bi bi-file-earmark-arrow-down-fill"></i></th>  
                </tr>  
                </thead>
                <tbody> 
                @foreach ($stagiaires as $stagiaire)
                <tr>
                    <td>{{$stagiaire->last_name}} {{$stagiaire->first_name}}</td>
                    <td>{{$stagiaire->date_of_birth}}</td>
                    <td>{{$stagiaire->place_of_birth}}</td>
                    <td>
                        <?php
                            $start_date = new DateTime($stagiaire->Stage->start_date);
                            $cloture_date = new DateTime($stagiaire->Stage->cloture_date);
                            $duration = $start_date->diff($cloture_date)->format("%m mois");
                            if ($start_date->diff($cloture_date)->days < 30) {
                                $duration = $start_date->diff($cloture_date)->days . " jours";
                            }
                            echo $duration;
                        ?>
                    </td>
                    <td>{{$stagiaire->stage->specialite->name}}</td>
                    <td>{{$stagiaire->Stage->start_date}}</td>
                    <td>{{$stagiaire->Stage->cloture_date}}</td>
                    <td style="text-align: center;">
                        @if ($stagiaire->attestation_date)
                            <i class="bi bi-check-circle-fill text-dark"></i>
                        @else
                            <i class="bi bi-x-circle-fill text-danger"></i>
                        @endif
                    </td>
                    <td>
                        <a data-bs-toggle="modal" data-bs-target="#attestationModal{{$stagiaire->id}}">
                            <button class="btn btn-sm btn-primary">
                                <i class="bi bi-file-earmark-arrow-down-fill"></i>
                            </button>
                        </a>
                        <div class="modal fade" id="attestationModal{{$stagiaire->id}}" tabindex="-1" aria-labelledby="attestationModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="attestationModalLabel">Attestation</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('attestation.download', $stagiaire->id) }}" method="POST">
                                        @csrf
                                  <p class="h6">Signataire</p>
                                  <select name="signataire_id" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                                    <option selected value="">Choisissez un signataire</option>
                                    @foreach ($signataires as $signataire)
                                        <option value="{{$signataire->id}}">{{$signataire->last_name}} {{$signataire->first_name}}</option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>                  
                                  <button type="submit" class="btn btn-warning">Continuer</button>
                                    </form>
                                </div>
                              </div>
                            </div>
                          </div>    
                    </td>
                </tr>
                </tbody>
                   @endforeach
            </table>
        </div>
        <div class="paginator mt-2">
            {{ $stagiaires->links() }}
        </div>
        @endif

</x-masterAdmin>

<script>
    function searchStagiaire() {
    var input = document.getElementById('searchInput').value.toLowerCase();
    var rows = document.getElementById('stagiairesTable').getElementsByTagName('tr');
    
    for (var i = 0; i < rows.length; i++) {
        var data = rows[i].getElementsByTagName('td')[0];
        if (data) {
            if (data.innerHTML.toLowerCase().indexOf(input) > -1) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }       
    }
    }
</script>


