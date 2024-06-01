<x-master title="Encadrants">
    @if(request()->has('recherche'))
        @if ($encadrants->isEmpty())
            <div>
                <a onclick="goBack()" class="btn btn-danger my-2">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>
            </div>
            <p class="h3 text-center my-3">Aucun encadrant trouvé.</p>
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
                            <th>Nom</th>
                            <th>Fonction</th>
                            <th>Matricule</th>
                            <th>Email</th>
                            <th>N° Fibre</th>
                            <th>Struct. D'Affectation</th>
                            <th>Struct. IAP</th>   
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($encadrants as $encadrant)
                        <tr>
                            <td>{{$encadrant->last_name}} {{$encadrant->first_name}}</td>
                            <td>{{$encadrant->function}}</td>
                            <td>{{$encadrant->registration_id}}</td>
                            <td>{{$encadrant->email}}</td>
                            <td>{{$encadrant->fibre_sh}}</td>
                            <td>{{$encadrant->structureAffectation->name}}</td>         
                            <td>{{$encadrant->structureAffectation->structuresIAP->name}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="paginator mt-2">
                {{ $encadrants->appends(['recherche' => ''])->links() }}
            </div>
        @endif
    @else
    <div class="d-flex">
        <div class="col">
            <div class="title">
                <h1>Liste des encadrants</h1>
            </div>
        </div>
        <form method="POST" action="{{ route('encadrants.searchEncadrant2') }}">
            @csrf
            <div class="col d-flex">
                <select style="width: 210px" id="type_recherche" class="form-select form-select-sm flex-grow-1 me-2" aria-label=".form-select-sm example" required onchange="rechercheType()">
                    <option selected disabled value="">-- Choisissez une option --</option>
                    <option value="structure">Par structure IAP</option>
                    <option value="structureAffectation">Par structure d'affectation</option>
                    <option value="name">Par nom</option>             
                </select> 
                <div style="width: 450px">
                    <select disabled id="decoy" class="form-select form-select-sm" aria-label=".form-select-sm example" required></select>
                    <select hidden disabled id="structure" name="structuresIAP_id" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                        <option selected value="">-- Choisissez une structure IAP --</option>
                        @foreach ($structuresIAPs as $structuresIAP)
                            <option value="{{ $structuresIAP->id }}">
                                {{ $structuresIAP->name }} 
                            </option>
                        @endforeach
                    </select> 
                    <select hidden disabled id="structureAffectation" name="structuresAffectation_id" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                        <option selected value="">-- Choisissez une structure d'affectation --</option>
                        @foreach ($structuresAffectations as $structureAffectation)
                            <option value="{{ $structureAffectation->id }}">
                                {{ $structureAffectation->name }} ({{ $structureAffectation->structuresIAP->name }})
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
                    <th>Nom</th>
                    <th>Fonction</th>
                    <th>Matricule</th>
                    <th>Email</th>
                    <th>N° Fibre</th>
                    <th>Struct. D'Affectation</th>
                    <th>Struct. IAP</th>   
                </tr>
            </thead>
            <tbody>
                @foreach ($encadrants as $encadrant)
                <tr>
                    <td>{{$encadrant->last_name}} {{$encadrant->first_name}}</td>
                    <td>{{$encadrant->function}}</td>
                    <td>{{$encadrant->registration_id}}</td>
                    <td>{{$encadrant->email}}</td>
                    <td>{{$encadrant->fibre_sh}}</td>
                    <td>{{$encadrant->structureAffectation->name}}</td>         
                    <td>{{$encadrant->structureAffectation->structuresIAP->name}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="paginator mt-2">
        {{ $encadrants->links() }}
    </div>
    @endif
</x-master>