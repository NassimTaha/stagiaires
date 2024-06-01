<x-master title="Structures d'affectation">
    @if(request()->has('recherche'))
        @if ($structuresAffectations->isEmpty())
            <div>
                <a onclick="goBack()" class="btn btn-danger my-2">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>
            </div>
            <p class="h3 text-center my-3">Aucun structure d'affectation trouvé.</p>
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
                            <th>Type</th>
                            <th>Structure IAP</th>         
                            <th>Quota PFE</th>
                            <th>Quota Immersion</th>   
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($structuresAffectations as $structuresAffectation)
                        <tr>
                            <td>{{$structuresAffectation->name}}</td>
                            <td>{{$structuresAffectation->type}}</td>
                            <td>{{$structuresAffectation->structuresIAP->name}}</td>
                            <td>{{$structuresAffectation->quota_pfe}}</td>
                            <td>{{$structuresAffectation->quota_im}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="paginator mt-2">
                {{ $structuresAffectations->appends(['recherche' => ''])->links() }}
            </div>
        @endif
    @else
    <div class="d-flex">
        <div class="col">
            <div class="title">
                <h1>Liste des structures d'affectation</h1>
            </div>
        </div>
        <form method="POST" action="{{ route('structuresAffectation.searchAffectation2') }}">
            @csrf
            <div class="col d-flex">
                <select style="width: 210px" id="type_recherche" class="form-select form-select-sm flex-grow-1 me-2" aria-label=".form-select-sm example" required onchange="rechercheType()">
                    <option selected disabled value="">-- Choisissez une option --</option>
                    <option value="structureIAP">Par structure IAP</option>
                    <option value="type">Par type</option>
                    <option value="name">Par nom</option>             
                </select> 
                <div style="width: 400px">
                    <select disabled id="decoy"  class="form-select form-select-sm" aria-label=".form-select-sm example" required></select>
                    <select hidden disabled id="structureIAP" name="structuresIAP_id" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                        <option selected value="">-- Choisissez une structure IAP --</option>
                        @foreach ($structuresIAPs as $structuresIAP)
                            <option value="{{ $structuresIAP->id }}">
                                {{ $structuresIAP->name }} 
                            </option>
                        @endforeach
                    </select>      
                    <select hidden disabled id="type" name="type" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                        <option selected value="">-- Choisissez le type --</option>
                        <option value="Direction">Direction</option>
                        <option value="Sous-direction">Sous-direction</option>
                        <option value="Departement">Département</option>
                    </select>    
                    <input hidden disabled id="name" name="name" placeholder="Structure d'affectation" class="form-control form-control-sm" type="text" aria-label=".form-control-sm example" autocomplete="off" required>
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
                    <th>Type</th>
                    <th>Structure IAP</th>         
                    <th>Quota PFE</th>
                    <th>Quota Immersion</th>   
                </tr>
            </thead>
            <tbody>
                @foreach ($structuresAffectations as $structuresAffectation)
                <tr>
                    <td>{{$structuresAffectation->name}}</td>
                    <td>{{$structuresAffectation->type}}</td>
                    <td>{{$structuresAffectation->structuresIAP->name}}</td>
                    <td>{{$structuresAffectation->quota_pfe}}</td>
                    <td>{{$structuresAffectation->quota_im}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="paginator mt-2">
        {{ $structuresAffectations->links() }}
    </div>
    @endif
</x-master>

