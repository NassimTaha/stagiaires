<x-masterAdmin title="Signataires">
    @if(request()->has('modifier'))
    <div class="title">
        <h1>Modifier un signataire</h1>
    </div>
    <div id="add_edit_div">
        <form action="{{ route('signataires.update',$signataire->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-4">
                    <p class="h6">Fonction</p>
                    <select name="function" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="Directeur Gestion du Personnel" @if($signataire->function == 'Directeur Gestion du Personnel') selected @endif>Directeur Gestion du Personnel</option>
                        <option value="Directeur de l’école" @if($signataire->function == 'Directeur de l’école') selected @endif>Directeur de l’école</option>
                    </select>
                </div>
                <div class="col-3">
                    <p class="h6">Nom</p>
                    <input name="last_name" class="form-control form-control-sm" type="text" aria-label=".form-control-sm example" autocomplete="off" value="{{ old('last_name', $signataire->last_name) }}">
                </div>
                <div class="col-3">
                    <p class="h6">Prénom</p>
                    <input name="first_name" class="form-control form-control-sm" type="text" aria-label=".form-control-sm example" autocomplete="off" required value="{{ old('first_name', $signataire->first_name) }}">
                </div>
                <div class="col" style="margin-top: 19px">
                    <button type="submit" class="btn btn-sm btn-primary mt-2">
                        <i class="bi bi-vector-pen"></i> Enregistrer
                    </button>
                    <button type="button" class="btn btn-sm btn-warning mt-2" onclick="goBack()"><i class="bi bi-x-lg"></i></button>
                </div>              
            </div>    
        </form>
    </div>
    @else
    <div class="title">
        <h1>Ajouter un signataire</h1>
    </div>
    <div id="add_edit_div">
        <form action="{{ route('signataires.store') }}" method="POST">
            @csrf
        <div class="row">
            <div class="col-4">
                <p class="h6">Fonction</p>
                <select name="function" class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option value="Directeur Gestion du Personnel">Directeur Gestion du Personnel</option>
                    <option value="Directeur de l’école">Directeur de l’école</option>
                </select>
            </div>
            <div class="col-3">
                <p class="h6">Nom</p>
                <input name="last_name" class="form-control form-control-sm" type="text" aria-label=".form-control-sm example" autocomplete="off" required value="{{old('last_name')}}">
            </div>
            <div class="col-3">
                <p class="h6">Prénom</p>
                <input name="first_name" type="text" class="form-control form-control-sm"  aria-label=".form-control-sm example" autocomplete="off" required value="{{old('first_name')}}">
            </div>
            <div class="col" style="margin-top: 19px">
                <button type="submit" class="btn btn-sm btn-success mt-2" name="ajouter">
                    <i class="bi bi-vector-pen"></i> Ajouter
                </button>
            </div>         
        </div>
        
        </form>
    </div>
    @endif

    @if ($signataires->isEmpty())
        <p class="h3 text-center my-3">Aucun signataire trouvé.</p>
        @else
        <div class="d-flex">
            <div class="col">
                <div class="title">
                    <h1>Liste des signataires</h1>
                </div>
            </div>
            <form  method="POST" action="{{ route('signataires.searchSignataire')}}">
                @csrf
            <div class="col d-flex">
                <div style="width: 350px">
                    <input name="name" placeholder="Nom" class="form-control form-control-sm" type="text" aria-label=".form-control-sm example" autocomplete="off" required>
                </div>
                <div>
                    <button type="submit" class="btn btn-sm btn-warning mx-1">
                        <i class="bi bi-search"></i> Rechercher
                    </button>
                </div>         
            </div>
            </form>
        </div>
          
        <div class="table-wrapper">
            <table class="fl-table">  
                <thead>
                    <tr>
                        <th>Structure IAP</th>
                        <th>Nom</th>
                        <th>Fonction</th>                   
                        <th style="text-align: center;">Options</th>
                    </tr>   
                </thead>
                <tbody>
                    @foreach ($signataires as $signataire)
                    <tr>
                        <td>{{$signataire->structuresIAP->name}}</td>
                        <td>{{$signataire->last_name}} {{$signataire->first_name}}</td>
                        <td>{{$signataire->function}}</td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center">
                            <form action ="{{route('signataires.edit', $signataire->id)}}" method="GET">
                                @csrf
                                <button class="btn btn-sm btn-warning mx-1" name="modifier">
                                    <i class="bi bi-pencil-square"></i>
                                   </button>
                            </form> 
                            <form action ="{{route('signataires.destroy', $signataire->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-warning m-1" data-bs-toggle="modal" data-bs-target="#exampleModal{{$signataire->id}}">
                                <i class="bi bi-trash3-fill"></i>
                              </button>
                            </form> 
                            </div>
                        </td> 
                        <div class="modal fade" id="exampleModal{{$signataire->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Désactivation</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  Voulez-vous vraiment désactiver {{$signataire->last_name}} {{$signataire->first_name}} ?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                                  <form action ="{{route('signataires.destroy', $signataire->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                  <button type="submit" class="btn btn-warning">Oui</button>
                                    </form>
                                </div>
                              </div>
                            </div>
                          </div> 
                    </tr> 
                </tbody>                
                    @endforeach 
                </table>
            </div>
            <div class="paginator mt-2">
                {{ $signataires->links() }}
            </div>
            @endif

</x-masterAdmin>