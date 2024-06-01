<x-master title="Spécialités">
    @if(request()->has('recherche'))
        @if ($specialites->isEmpty())
            <div>
                <a onclick="goBack()" class="btn btn-danger my-2">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>
            </div>
            <p class="h3 text-center my-3">Aucune spécialité trouvé.</p>
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
                            <th>Structure IAP</th>
                            <th>Domaine</th>
                            <th>Spécialité</th>  
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($specialites as $specialite)
                        <tr>
                            <td>{{$specialite->domaine->structuresIAP->name}}</td>
                            <td>{{$specialite->domaine->name}}</td>
                            <td>{{$specialite->name}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="paginator mt-2">
                {{ $specialites->appends(['recherche' => ''])->links() }}
            </div>
        @endif
    @else
    <div class="d-flex">
        <div class="col">
            <div class="title">
                <h1>Liste des spécialités</h1>
            </div>
        </div>
        <form method="POST" action="{{ route('specialites.searchSpecialite2') }}">
            @csrf
            <div class="col d-flex">
                <select style="width: 210px" id="type_recherche" class="form-select form-select-sm flex-grow-1 me-2" aria-label=".form-select-sm example" required onchange="rechercheType()">
                    <option selected disabled value="">-- Choisissez une option --</option>
                    <option value="structure">Par structure IAP</option>
                    <option value="domaine">Par domaine</option>
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
                    <select hidden disabled id="domaine" name="domaine_id" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                        <option selected value="">-- Choisissez un domaine --</option>
                        @foreach ($domaines as $domaine)
                            <option value="{{ $domaine->id }}">
                                {{ $domaine->name }} ({{ $domaine->structuresIAP->name }})
                            </option>
                        @endforeach        
                    <input hidden disabled name="name" id="name" placeholder="Spécialité" class="form-control form-control-sm" type="text" aria-label=".form-control-sm example" autocomplete="off" required>
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
                    <th>Structure IAP</th>
                    <th>Domaine</th>
                    <th>Spécialité</th>  
                </tr>
            </thead>
            <tbody>
                @foreach ($specialites as $specialite)
                <tr>
                    <td>{{$specialite->domaine->structuresIAP->name}}</td>
                    <td>{{$specialite->domaine->name}}</td>
                    <td>{{$specialite->name}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="paginator mt-2">
        {{ $specialites->links() }}
    </div>
    @endif
</x-master>