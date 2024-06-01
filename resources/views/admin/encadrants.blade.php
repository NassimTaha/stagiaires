<x-masterAdmin title="Encadrants">
    @if ($errors->any())
    <ul class="list-group col-6">         
                @foreach ($errors->all() as $error)
                    <li class="list-group-item list-group-item-danger">{{$error}}</li>
                @endforeach
    </ul>
    @endif
    @if(request()->has('modifier'))
    <div class="title">
        <h1>Modifier un encadrant</h1>
    </div>
     <div id="add_edit_div">
        <form action="{{ route('encadrants.update', $encadrant->id) }}" method="POST">
            @csrf 
            @method('PUT')
                <div class="row">
                    <div class="col-4">
                        <p class="h6">Structures d'affectation</p>
                        <select id="structuresAffectation_id" name="structuresAffectation_id" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                            @foreach ($structuresAffectations as $structuresAffectation)
                            <option value="{{$structuresAffectation->id}}" {{ old('structuresAffectation_id', $encadrant->structuresAffectation_id) == $structuresAffectation->id ? 'selected' : '' }}>
                                {{$structuresAffectation->name}} 
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <p class="h6">Nom</p>
                        <div class="input-group input-group-sm mb-3">
                        <input type="text" name="last_name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" required value="{{ old('last_name', $encadrant->last_name) }}">
                        </div>
                    </div>
                    <div class="col-3">
                        <p class="h6">Prénom</p>
                        <div class="input-group input-group-sm mb-3">
                            <input type="text" name="first_name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" required value="{{ old('first_name', $encadrant->first_name) }}">
                        </div>
                    </div>
                    <div class="col-2">
                        <p class="h6">N° Fibre</p>
                        <div class="input-group input-group-sm mb-3">
                        <input type="string" maxlength="4" name="fibre_sh" class="form-control" placeholder="XXXX" pattern="[0-9]{4}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" required value="{{ old('fibre_sh', $encadrant->fibre_sh) }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <p class="h6">Email</p>
                        <div class="input-group input-group-sm mb-3">
                        <input type="email" name="email" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" required value="{{ old('email', $encadrant->email) }}">
                        </div>
                    </div>
                    <div class="col-3">
                        <p class="h6">Matricule</p>
                        <div class="input-group input-group-sm mb-3">
                            <input type="text" name="registration_id" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" required value="{{old('registration_id',$encadrant->registration_id)}}">
                        </div>
                    </div>
                    <div class="col-3">
                        <p class="h6">Fonction</p>
                        <div class="input-group input-group-sm mb-3">
                            <input type="text" name="function" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" required value="{{old('function',$encadrant->function)}}">
                        </div>
                    </div>
                    <div class="col-3" style="margin-top: 26px">
                        <button type="submit" class="btn btn-sm btn-primary">
                            <i class="bi bi-person-fill-check"></i> Enregistrer
                        </button>
                        <button type="button" class="btn btn-sm btn-warning" onclick="goBack()"><i class="bi bi-x-lg"> Annuler</i></button>
                    </div>
                </div>
            </form>        
        </div>
    @else
    <div class="title">
        <h1>Ajouter un encadrant</h1>
    </div>
           
    <div id="add_edit_div">
        <form action="{{ route('encadrants.store') }}" method="POST">
            @csrf 
            <div class="row">
                <div class="col-4">
                    <p class="h6">Structures d'affectation</p>
                            <select id="structuresAffectation_id" name="structuresAffectation_id" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                                <option selected disabled value="">-- Choisissez une structure d'affectation --</option>
                                @foreach ($structuresAffectations as $structuresAffectation)
                                <option value="{{$structuresAffectation->id}}">
                                    {{$structuresAffectation->name}}
                                </option>
                                @endforeach
                            </select>          
                </div>
                <div class="col-3">
                    <p class="h6">Nom</p>
                    <div class="input-group input-group-sm mb-3">
                        <input type="text" name="last_name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" required value="{{old('last_name')}}">
                    </div>
                </div>
                <div class="col-3">
                    <p class="h6">Prénom</p>
                    <div class="input-group input-group-sm mb-3">
                        <input type="text" name="first_name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" required value="{{old('first_name')}}">
                    </div>
                </div>
                <div class="col-2">
                    <p class="h6">N° Fibre</p>
                    <div class="input-group input-group-sm mb-3">
                        <input type="text" maxlength="4" name="fibre_sh" pattern="[0-9]{4}" placeholder="XXXX" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" min="0" max="9999" autocomplete="off" required value="{{old('fibre_sh')}}">
                    </div>             
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <p class="h6">Email</p>
                    <div class="input-group input-group-sm mb-3">
                        <input type="email" name="email" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" required value="{{old('email')}}">
                    </div>
                </div>
                <div class="col-3">
                    <p class="h6">Matricule</p>
                    <div class="input-group input-group-sm mb-3">
                        <input type="text" name="registration_id" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" required value="{{old('registration_id')}}">
                    </div>
                </div>
                <div class="col-3">
                    <p class="h6">Fonction</p>
                    <div class="input-group input-group-sm mb-3">
                        <input type="text" name="function" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" required value="{{old('function')}}">
                    </div>
                </div>
                <div class="col-3" style="margin-top: 26px">
                    <button type="submit" class="btn btn-sm btn-success " name="ajouter">
                        <i class="bi bi-person-fill-add"></i> Ajouter
                    </button>
                </div>
            </div>
            </form>        
        </div>
    @endif

    @if ($encadrants->isEmpty())
    <p class="h3 text-center my-3">Aucun encadrant trouvé.</p>
    @else
    <div class="d-flex">
        <div class="col">
            <div class="title">
                <h1>Liste des encadrants</h1>
            </div>
        </div>
        <form method="POST" action="{{ route('encadrants.searchEncadrant') }}">
            @csrf
            <div class="col d-flex">
                <select style="width: 210px" id="type_recherche" class="form-select form-select-sm flex-grow-1 me-2" aria-label=".form-select-sm example" required onchange="rechercheEncadrant()">
                    <option selected value="">Options de recherche</option>
                    <option value="structureAffectation">Par structure d'affectation</option>
                    <option value="nameee">Par nom</option>             
                </select> 
                <div style="width: 450px">
                    <select disabled id="decoy" class="form-select form-select-sm" aria-label=".form-select-sm example" required></select>
                    <select hidden disabled id="structureAffectation" name="structuresAffectation_id" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                        <option selected value="">-- Choisissez une structure d'affectation --</option>
                        @foreach ($structuresAffectations as $structureAffectation)
                            <option value="{{ $structureAffectation->id }}">
                                {{ $structureAffectation->name }}
                            </option>
                        @endforeach
                    </select>         
                    <input hidden disabled name="name" id="nameee" placeholder="Nom" class="form-control form-control-sm" type="text" aria-label=".form-control-sm example" autocomplete="off" required>
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
            <th style="text-align: center;">Options</th>
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
            <td>
                <div class="d-flex justify-content-center align-items-center">
                <form action="{{route('encadrants.edit',$encadrant->id)}}" method="GET">
                    @csrf
                    <button class="btn btn-sm btn-warning mx-1" name="modifier">
                        <i class="bi bi-pencil-square"></i>
                       </button>
                </form> 
                <form action="{{route('encadrants.destroy',$encadrant->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-sm btn-warning m-1" data-bs-toggle="modal" data-bs-target="#exampleModal{{$encadrant->id}}">
                    <i class="bi bi-trash3-fill"></i>
                  </button>
                </form> 
                </div>
            </td> 
            <div class="modal fade" id="exampleModal{{$encadrant->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Désactivation</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Voulez-vous vraiment désactiver {{$encadrant->last_name}} {{$encadrant->first_name}} ?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                      <form action="{{route('encadrants.destroy',$encadrant->id)}}" method="POST">
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
    {{ $encadrants->links() }}
</div>
@endif
</x-masterAdmin>