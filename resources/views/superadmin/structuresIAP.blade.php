<x-master title="Structures IAP">
     
            @if(request()->has('modifier'))
            <div class="title">
                <h1>Modifier une structure IAP</h1>
              </div>
          
            <div id="add_edit_div"> 
                <form action="{{ route('structuresIAP.update',$structuresIAP->id) }}" method="POST">
                    @csrf 
                    @method('PUT')
                    <p class="h6">Nom</p>
                    <div class="row">
                        <div class="col-10">
                            <div class="form-group">                              
                                <div class="input-group input-group-sm mb-3">
                                <input type="text" name="name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" value="{{old('name',$structuresIAP->name)}}" required>
                                @error('name')
                                    <small class="text-danger">{{$message}}</small>               
                                @enderror    
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">                  
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="bi bi-house-check-fill"></i> Enregistrer
                                </button>
                                <button type="button" class="btn btn-sm btn-warning" onclick="goBack()"><i class="bi bi-x-lg"></i></button>
                            </div>  
                        </div>
                    </div>
                    
                      
                </form>
            </div>
            @else
            <div class="title">
                <h1>Ajouter une structure IAP</h1>
              </div>
                   
                <div id="add_edit_div"> 
                <form action="{{ route('structuresIAP.store') }}" method="POST">
                    @csrf 
                    <p class="h6">Nom</p>
                    <div class="row">
                        <div class="col-10">
                            <div class="form-group">                                
                                <div class="input-group input-group-sm mb-3">
                                    <input type="text" name="name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" required value="{{old('name')}}">
                                @error('name')
                                    <small class="text-danger">{{$message}}</small>               
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-success" name="ajouter"><i class="bi bi-house-add-fill"></i> Ajouter</button>
                            </div>
                        </div>
                    </div>
                    
                        
                </form>
            </div>
            @endif
        
 
    @if ($structuresIAPs->isEmpty())
    <p class="h3 text-center my-3">Aucune structure IAP trouvé.</p>
    @else
    <div class="d-flex">
        <div class="col">
            <div class="title">
                <h1>Liste des structures IAP</h1>
              </div>
        </div>
        <form  method="POST" action="{{ route('structuresIAP.searchIAP')}}">
            @csrf
        <div class="col d-flex">
            <div style="width: 350px">
                <input name="name" placeholder="Structure IAP" class="form-control form-control-sm" type="text" aria-label=".form-control-sm example" autocomplete="off" required>
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
            <th>Nom</th>
            <th style="text-align: center;">Options</th>
        </tr>
            </thead>
            <tbody>
    @foreach ($structuresIAPs as $structuresIAP)
        <tr>
            <td>{{$structuresIAP->name}}</td>
            <td>
                <div class="d-flex justify-content-center align-items-center">
                <form action ="{{route('structuresIAP.edit', $structuresIAP->id)}}" method="GET">
                    @csrf
                   <button class="btn btn-sm btn-warning mx-1" name="modifier">
                    <i class="bi bi-pencil-square"></i>
                   </button>
                    </form> 
                      
                <form action ="{{route('structuresIAP.destroy', $structuresIAP->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-warning mx-1" data-bs-toggle="modal" data-bs-target="#exampleModal{{$structuresIAP->id}}">
                        <i class="bi bi-trash3-fill"></i>
                      </button>
                    </form>
                </div> 
            </td>
        </tr>
            </tbody>
        <div class="modal fade" id="exampleModal{{$structuresIAP->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Désactivation</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Voulez-vous vraiment désactiver {{$structuresIAP->name}} ?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                  <form action ="{{route('structuresIAP.destroy', $structuresIAP->id)}}" method="POST">
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
        {{ $structuresIAPs->links() }}
    </div>

   @endif 
    </x-master>
    