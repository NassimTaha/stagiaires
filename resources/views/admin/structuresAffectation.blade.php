<x-masterAdmin title="Structures D'Affectation"> 
        @if(request()->has('modifier'))
        <div class="title">
            <h1>Modifier une structure d'affectation</h1>
          </div>
  
        <div id="add_edit_div">
        <form action="{{ route('structuresAffectation.update', $structuresAffectation->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-2">
                    <p class="h6">Type</p>
                            <select name="type" id="type" required class="form-select form-select-sm" aria-label=".form-select-sm example" onchange="activerSelect()">
                                <option value="Direction" {{ $structuresAffectation->type == 'Direction' ? 'selected' : '' }}>Direction</option>
                                <option value="Sous-direction" {{ $structuresAffectation->type == 'Sous-direction' ? 'selected' : '' }}>Sous-direction</option>
                                <option value="Departement" {{ $structuresAffectation->type == 'Departement' ? 'selected' : '' }}>Département</option>
                            </select>
                </div>
                <div class="col-3">
                    <p class="h6">Direction / Sous-direction</p>
                    <select name="parent_id" id="parent_id" required class="form-select form-select-sm" aria-label=".form-select-sm example" {{ $structuresAffectation->type != 'Departement' ? 'disabled' : '' }}>
                        @foreach ($directions as $direction)
                            <option value="{{$direction->id}}" {{ $structuresAffectation->parent_id == $direction->id ? 'selected' : '' }}>
                                {{$direction->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <p class="h6">Nom</p>      
                        <input type="text" name="name" class="form-control form-control-sm"  aria-label=".form-control-sm example" autocomplete="off" value="{{ old('name',$structuresAffectation->name) }}" required>
                </div>
                <div class="col-2">
                    <p class="h6">Quota PFE</p>
                        <input type="number" min="0" max="99" maxlength="2" placeholder="XX" autocomplete="off"  name="quota_pfe" class="form-control form-control-sm"  aria-label=".form-control-sm example" value="{{ old('quota_pfe',$structuresAffectation->quota_pfe )}}" autocomplete="off"  required>
                </div>
                <div class="col-2">
                    <p class="h6">Quota Immersion</p>
                    <input type="number" min="0" max="99" maxlength="2" placeholder="XX" autocomplete="off" name="quota_im" class="form-control form-control-sm"  aria-label=".form-control-sm example" value="{{ old('quota_im',$structuresAffectation->quota_im) }}" autocomplete="off"  required>
            </div>
            </div>
            
            <button type="submit" class="btn btn-sm btn-primary mt-2" name="modifier"><i class="bi bi-building-fill-check"></i> Enregistrer</button>
            <button type="button" class="btn btn-sm btn-warning mt-2" onclick="goBack()"><i class="bi bi-x-lg"> Annuler</i></button>
        </form> 
        </div>       
        @else
        <div class="title">
            <h1>Ajouter une structure d'affectation</h1>
          </div>

     
        <div id="add_edit_div">
        <form action="{{ route('structuresAffectation.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-2">
                    <p class="h6">Type</p>
                        <select name="type" id="type" class="form-select form-select-sm" aria-label=".form-select-sm example" required onchange="activerSelect()">
                                <option value="Direction">Direction</option>
                                <option value="Sous-direction">Sous-direction</option>
                                <option value="Departement">Département</option>
                        </select>
                </div>
                <div class="col-3">
                    <p class="h6">Direction / Sous-direction</p>
                        <select name="parent_id" id="parent_id" class="form-select form-select-sm" aria-label=".form-select-sm example" required disabled>
                                <option selected disabled value="">Direction / Sous-direction</option>
                                @foreach ($directions as $direction)
                                    <option value="{{$direction->id}}">{{$direction->name}}</option>
                                @endforeach
                        </select>  
                </div>
                <div class="col-3">
                    <p class="h6">Nom</p>      
                        <input type="text" name="name" class="form-control form-control-sm"  aria-label=".form-control-sm example" autocomplete="off" required>
                </div>
                <div class="col-2">
                    <p class="h6">Quota PFE</p>
                        <input type="number" min="0" max="99" maxlength="2" placeholder="XX" autocomplete="off"  name="quota_pfe" class="form-control form-control-sm"  aria-label=".form-control-sm example" autocomplete="off"  required>
                </div>
                <div class="col-2">
                    <p class="h6">Quota Immersion</p>
                    <input type="number" min="0" max="99" maxlength="2" placeholder="XX" autocomplete="off" name="quota_im" class="form-control form-control-sm"  aria-label=".form-control-sm example" autocomplete="off"  required>
            </div>
            </div>
          
           <button type="submit" class="btn btn-sm btn-success mt-2" name="ajouter"><i class="bi bi-building-fill-add"></i> Ajouter</button>
    
            
        </form>
        </div>
        @endif
        

    @if ($structuresAffectations->isEmpty())
    <p class="h3 text-center my-3">Aucune structure d'affectation trouvé.</p>
    @else
    <div class="d-flex">
        <div class="col">
            <div class="title">
                <h1>Liste des structures d'affectation</h1>
            </div>
        </div>
        <form method="POST" action="{{ route('structuresAffectation.searchAffectation') }}">
            @csrf
            <div class="col d-flex">
                <select style="width: 210px" id="type_recherche" class="form-select form-select-sm flex-grow-1 me-2" aria-label=".form-select-sm example" required onchange="rechercheAffectation()">
                    <option selected value="">Options de recherche</option>
                    <option value="typeee">Par type</option>
                    <option value="nameee">Par nom</option>             
                </select> 
                <div style="width: 400px">
                    <select disabled id="decoy"  class="form-select form-select-sm" aria-label=".form-select-sm example" required></select>   
                    <select hidden disabled id="typeee" name="type" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                        <option selected value="">-- Choisissez le type --</option>
                        <option value="Direction">Direction</option>
                        <option value="Sous-direction">Sous-direction</option>
                        <option value="Departement">Département</option>
                    </select>    
                    <input hidden disabled id="nameee" name="name" placeholder="Structure d'affectation" class="form-control form-control-sm" type="text" aria-label=".form-control-sm example" autocomplete="off" required>
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
            <th>Direction / Sous-direction</th>      
            <th>Quota PFE</th>
            <th>Quota Immersion</th>
            <th style="text-align: center;">Options</th>
        </tr>   
    </thead>
    <tbody>
        @foreach ($structuresAffectations as $structuresAffectation)
        <tr>
        <td>{{$structuresAffectation->name}}</td>
        <td>{{$structuresAffectation->type}}</td>
        <td>{{$structuresAffectation->parent->name ?? ''}}</td>
        <td>{{$structuresAffectation->quota_pfe}}</td>
        <td>{{$structuresAffectation->quota_im}}</td>
        <td>
            <div class="d-flex justify-content-center align-items-center">
            <form action ="{{route('structuresAffectation.edit', $structuresAffectation->id)}}" method="GET">
                @csrf
               <button class="btn btn-sm btn-warning m-1" name="modifier">
                <i class="bi bi-pencil-square"></i>
               </button>
                </form>       
            <form action ="{{route('structuresAffectation.destroy', $structuresAffectation->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-sm btn-warning m-1" data-bs-toggle="modal" data-bs-target="#exampleModal{{$structuresAffectation->id}}">
                    <i class="bi bi-trash3-fill"></i>
                  </button>
                </form>
            </div> 
        </td>
        </tr>
        </tbody>
        <div class="modal fade" id="exampleModal{{$structuresAffectation->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Désactivation</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Voulez-vous vraiment désactiver {{$structuresAffectation->name}} ?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                  <form action ="{{route('structuresAffectation.destroy', $structuresAffectation->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                  <button type="submit" class="btn btn-warning">Oui</button>
                    </form>
                </div>
              </div>
            </div>
          </div>
        @endforeach
    </table>
    </div>
    <div class="paginator mt-2">
        {{ $structuresAffectations->links() }}
    </div>
    @endif
</x-masterAdmin>
