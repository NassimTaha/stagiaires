<x-masterAdmin title="Domaines">
    @if(request()->has('modifier'))
    <div class="title">
        <h1>Modifier un domaine</h1>
    </div>

    <div id="add_edit_div">
    <form action="{{ route('domaines.update', $domaine->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row ">
            <div class="col-10">
                <p class="h6">Nom</p>
                <input name="name" class="form-control form-control-sm" type="text" aria-label=".form-control-sm example" autocomplete="off" required value="{{ old('name', $domaine->name) }}">
            </div>
            <div class="col-2" style="margin-top: 27px">
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="bi bi-journal-check"></i> Enregistrer
                </button>                
                <button type="button" class="btn btn-sm btn-warning" onclick="goBack()"><i class="bi bi-x-lg"></i></button>
            </div>
            </div>
            </form>
        </div>
    @else
    <div class="title">
        <h1>Ajouter un domaine</h1>
    </div>
    
    <div id="add_edit_div">
        <form action="{{ route('domaines.store') }}" method="POST">
            @csrf
            <div class="row">
        <div class="col-10">
            <p class="h6">Nom</p>
            <input name="name" class="form-control form-control-sm" type="text" aria-label=".form-control-sm example" autocomplete="off" required value="{{old('name')}}">    
        </div>
        <div class="col-2" style="margin-top: 27px">
            <button type="submit" class="btn btn-sm btn-success" name="ajouter" >
                <i class="bi bi-journal-plus"></i> Ajouter
            </button>
        </div>
        </div>
        </form>
        </div>

    @endif
    
    @if ($domaines->isEmpty())
        <p class="h3 text-center my-3">Aucun domaine trouvé.</p>
        @else
        <div class="d-flex">
            <div class="col">
                <div class="title">
                    <h1>Liste des domaines</h1>
                </div>
            </div>
            <form method="POST" action="{{ route('domaines.searchDomaine') }}">
                @csrf
                <div class="col d-flex">
                   
                    <div style="width: 350px">
                        <input name="name" placeholder="Domaine" class="form-control form-control-sm" type="text" aria-label=".form-control-sm example" autocomplete="off" required>
                    </div>
                    <div>
                        <button type="submit" name="recherche" class="btn btn-sm btn-warning mx-1">
                            <i class="bi bi-search"></i> 
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
        @foreach ($domaines as $domaine)
        <tr>
            <td>{{$domaine->name}}</td>
            <td>
                <div class="d-flex justify-content-center align-items-center">
                <form action ="{{route('domaines.edit', $domaine->id)}}" method="GET">
                    @csrf
                   <button class="btn btn-sm btn-warning mx-1" name="modifier">
                    <i class="bi bi-pencil-square"></i>
                   </button>
                    </form> 
                     
                <form action ="{{route('domaines.destroy', $domaine->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-warning mx-1" data-bs-toggle="modal" data-bs-target="#exampleModal{{$domaine->id}}">
                        <i class="bi bi-trash3-fill"></i>
                      </button>
                    </form>
                </div> 
            </td>
        </tr>
                </tbody>
        <div class="modal fade" id="exampleModal{{$domaine->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Désactivation</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Voulez-vous vraiment désactiver {{$domaine->name}} ?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                  <form action ="{{route('domaines.destroy', $domaine->id)}}" method="POST">
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
        {{ $domaines->links() }}
    </div>
    @endif
</x-masterAdmin>
