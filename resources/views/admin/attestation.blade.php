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
        <div class="table-responsive">
            <table  class="table table-sm table-dark table-bordered table-striped table-hover">
                    <tr>
                        <th>Nom</th>
                        <th>Date De Naissance</th>
                        <th>Lieu De Naissance </th>
                        <th>Durée de stage</th>
                        <th>Specialite</th>
                        <th>Date De Debut</th>
                        <th>Date De Fin</th>
                        <th><i class="bi bi-file-earmark-arrow-down-fill"></i></th>
                    </tr>   
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
                        <td>
                        <a href="{{ route('attestation.download', $stagiaire) }}">
                            <button class="btn btn-sm btn-primary"><i class="bi bi-file-earmark-arrow-down-fill"></i></button>
                        </a>
                        </td>
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
            <form  method="POST" action="{{ route('searchResultsStagiares2')}}">
                @csrf
            <div class="col d-flex">
                <div style="width: 350px">
                    <input name="name" placeholder="Nom" class="form-control form-control-sm" type="text" aria-label=".form-control-sm example" autocomplete="off" required>
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
                    <th>Date De Naissance</th>
                    <th>Lieu De Naissance </th>
                    <th>Durée de stage</th>
                    <th>Specialite</th>
                    <th>Date De Debut</th>
                    <th>Date De Fin</th>
                    <th><i class="bi bi-file-earmark-arrow-down-fill"></i></th>    
                </tr>   
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
                    <td>
                    <a href="{{ route('attestation.download', $stagiaire) }}">
                        <button class="btn btn-sm btn-primary"><i class="bi bi-file-earmark-arrow-down-fill"></i></button>
                    </a>
                    </td>
                </tr>
                   @endforeach
            </table>
        </div>
        <div class="paginator">
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


