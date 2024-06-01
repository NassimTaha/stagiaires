<x-master title="Étbalissements">
    @if(request()->has('recherche'))
        @if ($etablissements->isEmpty())
            <div>
                <a onclick="goBack()" class="btn btn-danger my-2">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>
            </div>
            <p class="h3 text-center my-3">Aucun établissement trouvé.</p>
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
                            <th>Wilaya</th>
                            <th>Nom</th>    
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($etablissements as $etablissement)
                        <tr>
                            <td>{{ $etablissement->wilaya }}</td>
                            <td>{{ $etablissement->name }}</td>                           
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="paginator mt-2">
                {{ $etablissements->appends(['recherche' => ''])->links() }}
            </div>
        @endif
    @else
    <div class="d-flex">
        <div class="col">
            <div class="title">
                <h1>Liste des établissements</h1>
            </div>
        </div>
        <form method="POST" action="{{ route('etablissements.searchEtablissement2') }}">
            @csrf
            <div class="col d-flex">
                <div style="width: 450px">        
                    <input name="name" id="name" placeholder="Étbalissement" class="form-control form-control-sm" type="text" aria-label=".form-control-sm example" autocomplete="off" required>
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
                    <th>Wilaya</th>
                    <th>Nom</th>    
                </tr>
            </thead>
            <tbody>
                @foreach ($etablissements as $etablissement)
                <tr>
                    <td>{{ $etablissement->wilaya }}</td>
                    <td>{{ $etablissement->name }}</td>                           
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="paginator mt-2">
        {{ $etablissements->links() }}
    </div>
    @endif
</x-master>