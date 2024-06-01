<x-master title="Comptes">    
       @if(request()->has('modifier'))
       <div class="title">
         <h1>Modifier un compte</h1>
     </div>


       <div id="add_edit_div">
        <form action="{{ route('comptes.update', $compte->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-6">
                    <label for="structuresIAP_id" class="h6  ">Structure IAP</label>
                    <select name="structuresIAP_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        @foreach ($structuresIAPs as $structuresIAP)
                        <option value="{{ $structuresIAP->id }}" {{ $compte->structuresIAP_id == $structuresIAP->id ? 'selected' : '' }}>{{ $structuresIAP->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    <p class="h6  ">Email</p>
                    <div class="input-group input-group-sm mb-3">
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $compte->email) }}">
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <p class="h6  ">User Type</p>
                    <select name="usertype" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="Superadmin" {{ $compte->usertype == 'Superadmin' ? 'selected' : '' }}>Superadmin</option>
                        <option value="Admin" {{ $compte->usertype == 'Admin' ? 'selected' : '' }}>Admin</option>
                        <option value="User" {{ $compte->usertype == 'User' ? 'selected' : '' }}>User</option>
                        <option value="Security" {{ $compte->usertype == 'Security' ? 'selected' : '' }}>Security</option>
                    </select>
                </div>
                <div class="col-6">
                    <p class="h6  ">Nouveau mot de passe</p>
                    <div class="input-group input-group-sm mb-3">
                        <input type="password" name="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" required>
                        @error('password')
                        <small class="text-danger">{{$message}}</small>               
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <p class="h6  ">Username</p>
                    <div class="input-group input-group-sm mb-3">
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $compte->name) }}">
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <p class="h6  ">Confirmer le nouveau mot de passe</p>
                    <div class="input-group input-group-sm mb-3">
                        <input type="password" name="password_confirmation" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" required>
                        @error('password_confirmation')
                        <small class="text-danger">{{$message}}</small>               
                        @enderror
                    </div>
                </div>
            </div>            
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="bi bi-person-check-fill"></i> Enregistrer
                    </button> 
                    <button type="button" class="btn btn-sm btn-warning" onclick="goBack()"><i class="bi bi-x-lg"> Annuler</i></button>
                
        </form>
    </div>
        
        @else
        <div class="title">
            <h1>Ajouter un compte</h1>
        </div>

     
        <div id="add_edit_div">
    <form action="{{ route('comptes.store') }}" method="POST">
        @csrf
        
        <div class="row">
            <div class="col-6">
                <p class="h6  ">Structure IAP</p>
                <select name="structuresIAP_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
                    @foreach ($structuresIAPs as $structuresIAP)
                    <option value="{{ $structuresIAP->id }}">{{ $structuresIAP->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <p class="h6  ">Email</p>
                <div class="input-group input-group-sm mb-3">
                    <input type="email" name="email" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" required value="{{old('email')}}">
                    @error('email')
                    <small class="text-danger">{{$message}}</small>               
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <p class="h6   ">User Type</p>
                <select name="usertype" class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option value="Superadmin">Superadmin</option>
                    <option value="Admin">Admin</option>
                    <option value="User">User</option>
                    <option value="Security">Security</option>
                </select>
            </div>
            <div class="col-6">
                <p class="h6 ">Mot de passe</p>
                <div class="input-group input-group-sm mb-3">
                    <input type="password" name="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" required>
                    @error('password')
                    <small class="text-danger">{{$message}}</small>               
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <p class="h6   ">Username</p>
                <div class="input-group input-group-sm mb-3">
                    <input type="text" name="name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" required value="{{old('name')}}">
                    @error('name')
                    <small class="text-danger">{{$message}}</small>               
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <p class="h6  ">Confirmer le mot de passe</p>
                <div class="input-group input-group-sm mb-3">
                    <input type="password" name="password_confirmation" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" required>
                    @error('password_confirmation')
                    <small class="text-danger">{{$message}}</small>               
                    @enderror
                </div>
            </div>
        </div>
                
                <button type="submit" class="btn btn-sm btn-success" name="ajouter">
                    <i class="bi bi-person-plus-fill"></i> Ajouter
                </button>
        
    </form>
</div>

        @endif
   
        @if ($comptes->isEmpty())
        <p class="h3 text-center my-3">Aucun compte trouvé.</p>
        @else
        <div class="d-flex">
            <div class="col">
                <div class="title">
                    <h1>Liste des comptes</h1>
                  </div>
            </div>
            <form  method="POST" action="{{ route('comptes.searchComptes')}}">
                @csrf
            <div class="col d-flex">
                <div style="width: 350px">
                    <input name="name" placeholder="Username" class="form-control form-control-sm" type="text" aria-label=".form-control-sm example" autocomplete="off" required>
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
            <th>Username</th>
            <th>Email</th>
            <th>User Type</th>
            <th>Structure IAP</th>
            <th style="text-align: center;">Options</th>
        </tr>  
                </thead>
        <tbody> 
        @foreach ($comptes as $compte)
        <tr>
            <td>{{$compte->name}}</td>
            <td>{{$compte->email}}</td>
            <td>{{$compte->usertype}}</td>
            <td>{{$compte->structuresIAP->name}}</td>
            <td style="width: auto;">
                <div class="d-flex justify-content-center align-items-center">
                <form action ="{{route('comptes.edit',$compte->id)}}" method="GET">
                    @csrf
                   <button class="btn btn-sm btn-warning mx-1" name="modifier">
                    <i class="bi bi-pencil-square"></i>
                   </button>
                    </form> 
                    <form action ="{{route('comptes.destroy', $compte->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm btn-warning mx-1" data-bs-toggle="modal" data-bs-target="#exampleModal{{$compte->id}}">
                            <i class="bi bi-trash3-fill"></i>
                          </button>
                        </form>
                    </div> 
                    </td> 
        </tr>
        </tbody>
        <div class="modal fade" id="exampleModal{{$compte->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Désactivation</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Voulez-vous vraiment désactiver {{$compte->name}} ?
                  <br>
                  Email : {{$compte->email}}
                  <br>
                  User Type : {{$compte->usertype}}
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                  <form action ="{{route('comptes.destroy', $compte->id)}}" method="POST">
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
        {{ $comptes->links() }}
    </div>
    @endif
</x-master>