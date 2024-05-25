<x-masterAdmin title="Encadrants">
    
    @if(request()->has('modifier'))
    <div class="title">
        <h1>Modifier un encadrant</h1>
    </div>
            <div id="add_edit_div">
    <div class="row">
        <div class="col-md-7">
            <form action="{{ route('encadrants2.update', $encadrant->id) }}" method="POST">
                @csrf 
                @method('PUT')
                <div class="form-group">
                            <p class="h6">Structures d'affectation</p>
                                <select id="structuresAffectation_id" name="structuresAffectation_id" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                                    @foreach ($structuresAffectations as $structuresAffectation)
                                    <option value="{{$structuresAffectation->id}}" {{ old('structuresAffectation_id', $encadrant->structuresAffectation_id) == $structuresAffectation->id ? 'selected' : '' }}>
                                        {{$structuresAffectation->name}} ({{$structuresAffectation->structuresIAP->name}})
                                    </option>
                                    @endforeach
                                </select>
                        
                              
                </div>
                <div style="margin-top: 4px" class="row">
                    <div class="col-6">
                <div style="margin-top: 12px" class="form-group">
                    <p class="h6">Nom</p>
                    <div class="input-group input-group-sm mb-3">
                        <input type="text" name="last_name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" required value="{{ old('last_name', $encadrant->last_name) }}">
                        @error('last_name')
                        <small class="text-danger">{{ $message }}</small>               
                        @enderror
                    </div>
                </div>
            </div>
                <div class="col-6">
                <div class="form-group" style="margin-top: 12px">
                    <p class="h6">Prénom</p>
                    <div class="input-group input-group-sm mb-3">
                        <input type="text" name="first_name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" required value="{{ old('first_name', $encadrant->first_name) }}">
                        @error('first_name')
                        <small class="text-danger">{{ $message }}</small>               
                        @enderror
                    </div>
                </div>
            </div></div>
            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="bi bi-person-fill-check"></i> Enregistrer
                </button>
                <button type="button" class="btn btn-sm btn-warning" onclick="goBack()"><i class="bi bi-x-lg"> Annuler</i></button>
            </div>
            </div>
            <div class="col-md-5" >
                <div  class="form-group row">
                    <div class="col-6">
                        <p class="h6">Matricule</p>
                    <div class="input-group input-group-sm mb-3">
                        <input type="text" name="registration_id" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" required value="{{old('registration_id',$encadrant->registration_id)}}">
                        @error('registration_id')
                        <small class="text-danger">{{ $message }}</small>               
                        @enderror
                    </div>
                    </div>
                    <div class="col-6">
                        <p class="h6">Fonction</p>
                    <div class="input-group input-group-sm mb-3">
                        <input type="text" name="function" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" required value="{{old('function',$encadrant->function)}}">
                        @error('function')
                        <small class="text-danger">{{ $message }}</small>               
                        @enderror
                    </div>
                    </div>                      
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <p class="h6">Email</p>
                    <div class="input-group input-group-sm mb-3">
                        <input type="email" name="email" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" required value="{{ old('email', $encadrant->email) }}">
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>               
                        @enderror
                    </div>
                    </div>
                    <div class="col-6">
                        <p class="h6">N° Fibre</p>
                    <div class="input-group input-group-sm mb-3">
                        <input type="string" maxlength="4" name="fibre_sh" class="form-control" placeholder="XXXX" pattern="[0-9]{4}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" required value="{{ old('fibre_sh', $encadrant->fibre_sh) }}">
                        @error('fibre_sh')
                        <small class="text-danger">{{ $message }}</small>               
                        @enderror
                    </div>
                    </div>                 
                </div> 
            </form>        
        </div>
    </div>
</div>

    @else
    <div class="title">
        <h1>Ajouter un encadrant</h1>
    </div>
           
    <div id="add_edit_div">
    <div class="row">
        <div class="col-md-7">
            <form action="{{ route('encadrants2.store') }}" method="POST">
                @csrf 
                <div class="form-group">                      
                            <p class="h6">Structures d'affectation</p>
                            <select id="structuresAffectation_id" name="structuresAffectation_id" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                                <option selected disabled value="">-- Choisissez une structure d'affectation --</option>
                                @foreach ($structuresAffectations as $structuresAffectation)
                                <option value="{{$structuresAffectation->id}}">
                                    {{$structuresAffectation->name}} ({{$structuresAffectation->structuresIAP->name}})
                                </option>
                                @endforeach
                            </select>                     
                </div>
                <div style="margin-top: 4px" class="row">
                    <div class="col-6">
                <div style="margin-top: 12px" class="form-group">
                    <p class="h6">Nom</p>
                    <div class="input-group input-group-sm mb-3">
                        <input type="text" name="last_name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" required value="{{old('last_name')}}">
                        @error('last_name')
                        <small class="text-danger">{{ $message }}</small>               
                        @enderror
                    </div>
                </div>
            </div>
                <div class="col-6">
                <div class="form-group" style="margin-top: 12px">
                    <p class="h6">Prénom</p>
                    <div class="input-group input-group-sm mb-3">
                        <input type="text" name="first_name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" required value="{{old('first_name')}}">
                        @error('first_name')
                        <small class="text-danger">{{ $message }}</small>               
                        @enderror
                    </div>
                </div>
            </div></div>
            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-success" name="ajouter">
                    <i class="bi bi-person-fill-add"></i> Ajouter
                </button>
            </div>
            </div>
            <div class="col-md-5" >
                <div  class="form-group row">
                    <div class="col-6">
                        <p class="h6">Matricule</p>
                    <div class="input-group input-group-sm mb-3">
                        <input type="text" name="registration_id" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" required value="{{old('registration_id')}}">
                        @error('registration_id')
                        <small class="text-danger">{{ $message }}</small>               
                        @enderror
                    </div>
                    </div>
                    <div class="col-6">
                        <p class="h6">Fonction</p>
                    <div class="input-group input-group-sm mb-3">
                        <input type="text" name="function" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" required value="{{old('function')}}">
                        @error('function')
                        <small class="text-danger">{{ $message }}</small>               
                        @enderror
                    </div>
                    </div>                      
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <p class="h6">Email</p>
                    <div class="input-group input-group-sm mb-3">
                        <input type="email" name="email" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" required value="{{old('email')}}">
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>               
                        @enderror
                    </div>
                    </div>
                    <div class="col-6">
                        <p class="h6">N° Fibre</p>
                    <div class="input-group input-group-sm mb-3">
                        <input type="string" maxlength="4" name="fibre_sh" pattern="[0-9]{4}" placeholder="XXXX" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" min="0" max="9999" autocomplete="off" required value="{{old('fibre_sh')}}">
                        @error('fibre_sh')
                        <small class="text-danger">{{ $message }}</small>               
                        @enderror
                    </div>
                    </div>                  
                </div> 
            </form>        
        </div>
    </div>
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
        <form method="POST" action="{{ route('encadrants.searchEncadrantAdmin') }}">
            @csrf
            <div class="col d-flex">
                <select style="width: 210px" id="type_recherche" class="form-select form-select-sm flex-grow-1 me-2" aria-label=".form-select-sm example" required onchange="rechercheEncadrant()">
                    <option selected disabled value="">-- Choisissez une option --</option>
                    <option value="structureAffectation">Par structure d'affectation</option>
                    <option value="nameee">Par nom</option>             
                </select> 
                <div style="width: 450px">
                    <select disabled id="decoy" class="form-select form-select-sm" aria-label=".form-select-sm example" required></select>
                    <select hidden disabled id="structureAffectation" name="structuresAffectation_id" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                        <option selected value="">-- Choisissez une structure d'affectation --</option>
                        @foreach ($structuresAffectations as $structureAffectation)
                            <option value="{{ $structureAffectation->id }}">
                                {{ $structureAffectation->name }} ({{ $structureAffectation->structuresIAP->name }})
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

<div class="table-responsive">
<table class="table table-sm table-dark table-bordered table-striped table-hover">
        <tr>
            <th>Nom</th>
            <th>Fonction</th>
            <th>Matricule</th>
            <th>Email</th>
            <th>N° Fibre</th>
            <th>Struct. D'Affectation</th>
            <th style="text-align: center;">Options</th>
        </tr>   
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
                <form action="{{route('encadrants2.edit',$encadrant->id)}}" method="GET">
                    @csrf
                    <button class="btn btn-sm btn-warning mx-1" name="modifier">
                        <i class="bi bi-pencil-square"></i>
                       </button>
                </form> 
                <form action="{{route('encadrants2.destroy',$encadrant->id)}}" method="POST">
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
                      <form action="{{route('encadrants2.destroy',$encadrant->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                      <button type="submit" class="btn btn-warning">Oui</button>
                        </form>
                    </div>
                  </div>
                </div>
              </div> 
        </tr>                 
        @endforeach 
    </table>
</div>
<div class="paginator">
    {{ $encadrants->links() }}
</div>
@endif
</x-masterAdmin>
