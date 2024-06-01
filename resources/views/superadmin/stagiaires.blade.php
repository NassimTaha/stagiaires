<x-master title="Encadrants">
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
                <table class="fl-table">  
                    <thead>    
                        <tr>
                            <th>Struct. IAP</th>
                            <th>Nom</th>
                            <th>Date de naissance</th>
                            <th>Lieu de naissance</th>
                            <th>N° de tel</th>
                            <th>Email</th>
                            {{--<th>Durée du stage</th>--}}
                            <th>Date début</th>
                            <th>Date fin</th>
                            <th>Jours de réception</th>  
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stagiaires as $stagiaire)
                        <tr>
                            <td>{{$stagiaire->stage->structureAffectation->structuresIAP->name}}</td>
                            <td>{{$stagiaire->last_name}} {{$stagiaire->first_name}}</td>
                            <td>{{$stagiaire->date_of_birth}}</td>
                            <td>{{$stagiaire->place_of_birth}}</td>
                            <td>{{$stagiaire->phone_number}}</td>
                            <td>{{$stagiaire->email}}</td>
                            {{-- <td>
                                <?php
                                    $start_date = new DateTime($stagiaire->Stage->start_date);
                                    $end_date = new DateTime($stagiaire->Stage->end_date);
                                    $duration = $start_date->diff($end_date)->format("%m mois");
                                    if ($start_date->diff($end_date)->days < 30) {
                                        $duration = $start_date->diff($end_date)->days . " jours";
                                    }
                                    echo $duration;
                                ?>
                            </td>--}}
                            <td>{{$stagiaire->Stage->start_date}}</td>
                            <td>{{$stagiaire->Stage->end_date}}</td>
                            <td>{{$stagiaire->Stage->reception_days}}</td>
                        </tr>
                           @endforeach
                    </tbody>
                </table>
            </div>
            <div class="paginator mt-2">
                {{ $stagiaires->appends(['recherche' => ''])->links() }}
            </div>
        @endif
    @else
    <div class="d-flex">
        <div class="col">
            <div class="title">
                <h1>Liste des stagiaires</h1>
            </div>
        </div>
        <form method="POST" action="{{ route('stagiaires.searchStagiaire') }}">
            @csrf
            <div class="col d-flex">
                <select style="width: 150px" name="year" id="year" class="form-select form-select-sm flex-grow-1 me-2" aria-label=".form-select-sm example">
                    <option selected value="">Année</option>
                    <?php
                    $currentYear = date('Y');
                    for ($i = 0; $i < 10; $i++) {
                        $year = $currentYear - $i;
                        echo "<option value=\"$year\">$year</option>";
                    }
                    ?>
                </select> 
                <select style="width: 210px" id="type_recherche" class="form-select form-select-sm flex-grow-1 me-2" aria-label=".form-select-sm example" required onchange="rechercheType()">
                    <option selected disabled value="">Options de recherche</option>
                    <option value="structure">Par structure IAP</option>
                    <option value="name">Par nom</option>             
                </select> 
                <div style="width: 350px">
                    <select disabled id="decoy" class="form-select form-select-sm" aria-label=".form-select-sm example" required></select>
                    <select hidden disabled id="structure" name="structuresIAP_id" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                        <option selected value="">-- Choisissez une structure IAP --</option>
                        @foreach ($structuresIAPs as $structuresIAP)
                            <option value="{{ $structuresIAP->id }}">
                                {{ $structuresIAP->name }} 
                            </option>
                        @endforeach
                    </select>    
                    <input hidden disabled name="name" id="name" placeholder="Nom" class="form-control form-control-sm" type="text" aria-label=".form-control-sm example" autocomplete="off" required>
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
                    <th>Struct. IAP</th>
                    <th>Nom</th>
                    <th>Date de naissance</th>
                    <th>Lieu de naissance</th>
                    <th>N° de tel</th>
                    <th>Email</th>
                    {{--<th>Durée du stage</th>--}}
                    <th>Date début</th>
                    <th>Date fin</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stagiaires as $stagiaire)
                <tr>
                    <td>{{$stagiaire->stage->structureAffectation->structuresIAP->name}}</td>
                    <td>{{$stagiaire->last_name}} {{$stagiaire->first_name}}</td>
                    <td>{{$stagiaire->date_of_birth}}</td>
                    <td>{{$stagiaire->place_of_birth}}</td>
                    <td>{{$stagiaire->phone_number}}</td>
                    <td>{{$stagiaire->email}}</td>
                    {{-- <td>
                        <?php
                            $start_date = new DateTime($stagiaire->Stage->start_date);
                            $end_date = new DateTime($stagiaire->Stage->end_date);
                            $duration = $start_date->diff($end_date)->format("%m mois");
                            if ($start_date->diff($end_date)->days < 30) {
                                $duration = $start_date->diff($end_date)->days . " jours";
                            }
                            echo $duration;
                        ?>
                    </td>--}}
                    <td>{{$stagiaire->Stage->start_date}}</td>
                    <td>{{$stagiaire->Stage->end_date}}</td>
                </tr>
                   @endforeach
            </tbody>
        </table>
    </div>
    <div class="paginator mt-2">
        {{ $stagiaires->links() }}
    </div>
    @endif
</x-master>