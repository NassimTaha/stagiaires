<x-master title="Signataires">
                @if(request()->has('recherche'))
                @if ($signataires->isEmpty())
                    <div>
                        <a onclick="goBack()" class="btn btn-danger my-2">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                    </div>
                    <p class="h3 text-center my-3">Aucun signataire trouvé.</p>
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
                                    <th>Nom</th>    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($signataires as $signataire)
                                <tr>
                                    <td>{{$signataire->structuresIAP->name}}</td>
                                    <td>{{$signataire->last_name}} {{$signataire->first_name}}</td>                           
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="paginator mt-2">
                        {{ $signataires->appends(['recherche' => ''])->links() }}
                    </div>
                @endif
                @else
                <div class="d-flex">
                    <div class="col">
                        <div class="title">
                            <h1>Liste des signataires</h1>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('signataires.searchSignataire2') }}">
                        @csrf
                        <div class="col d-flex">
                            <div style="width: 450px">        
                                <input name="name" id="name" placeholder="Nom" class="form-control form-control-sm" type="text" aria-label=".form-control-sm example" autocomplete="off" required>
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
                                <th>Nom</th>    
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($signataires as $signataire)
                            <tr>
                                <td>{{$signataire->structuresIAP->name}}</td>
                                <td>{{$signataire->last_name}} {{$signataire->first_name}}</td>                           
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="paginator mt-2">
                    {{ $signataires->links() }}
                </div>
                @endif
</x-master>