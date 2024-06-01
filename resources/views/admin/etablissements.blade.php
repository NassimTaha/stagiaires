<x-masterAdmin title="Établissements">
    
    @if(request()->has('modifier'))
    <div class="title">
        <h1>Modifier un établissement</h1>
    </div>
  
    <div id="add_edit_div">
    <form action="{{ route('etablissements.update', $etablissement->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
        <div class="col-2">
        <div class="form-group">
            <p class="h6">Wilaya </p>
            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="wilaya">
                <option value="Adrar" {{ $etablissement->wilaya == 'Adrar' ? 'selected' : '' }}>01. Adrar</option>
<option value="Chlef" {{ $etablissement->wilaya == 'Chlef' ? 'selected' : '' }}>02. Chlef</option>
<option value="Laghouat" {{ $etablissement->wilaya == 'Laghouat' ? 'selected' : '' }}>03. Laghouat</option>
<option value="Oum El Bouaghi" {{ $etablissement->wilaya == 'Oum El Bouaghi' ? 'selected' : '' }}>04. Oum El Bouaghi</option>
<option value="Batna" {{ $etablissement->wilaya == 'Batna' ? 'selected' : '' }}>05. Batna</option>
<option value="Bejaia" {{ $etablissement->wilaya == 'Bejaia' ? 'selected' : '' }}>06. Bejaïa</option>
<option value="Biskra" {{ $etablissement->wilaya == 'Biskra' ? 'selected' : '' }}>07. Biskra</option>
<option value="Bechar" {{ $etablissement->wilaya == 'Bechar' ? 'selected' : '' }}>08. Béchar</option>
<option value="Blida" {{ $etablissement->wilaya == 'Blida' ? 'selected' : '' }}>09. Blida</option>
<option value="Bouira" {{ $etablissement->wilaya == 'Bouira' ? 'selected' : '' }}>10. Bouira</option>
<option value="Tamanrasset" {{ $etablissement->wilaya == 'Tamanrasset' ? 'selected' : '' }}>11. Tamanrasset</option>
<option value="Tebessa" {{ $etablissement->wilaya == 'Tebessa' ? 'selected' : '' }}>12. Tebessa</option>
<option value="Tlemcen" {{ $etablissement->wilaya == 'Tlemcen' ? 'selected' : '' }}>13. Tlemcen</option>
<option value="Tiaret" {{ $etablissement->wilaya == 'Tiaret' ? 'selected' : '' }}>14. Tiaret</option>
<option value="Tizi Ouzou" {{ $etablissement->wilaya == 'Tizi Ouzou' ? 'selected' : '' }}>15. Tizi Ouzou</option>
<option value="Alger" {{ $etablissement->wilaya == 'Alger' ? 'selected' : '' }}>16. Alger</option>
<option value="Djelfa" {{ $etablissement->wilaya == 'Djelfa' ? 'selected' : '' }}>17. Djelfa</option>
<option value="Jijel" {{ $etablissement->wilaya == 'Jijel' ? 'selected' : '' }}>18. Jijel</option>
<option value="Setif" {{ $etablissement->wilaya == 'Setif' ? 'selected' : '' }}>19. Sétif</option>
<option value="Saida" {{ $etablissement->wilaya == 'Saida' ? 'selected' : '' }}>20. Saïda</option>
<option value="Skikda" {{ $etablissement->wilaya == 'Skikda' ? 'selected' : '' }}>21. Skikda</option>
<option value="Sidi Bel Abbes" {{ $etablissement->wilaya == 'Sidi Bel Abbes' ? 'selected' : '' }}>22. Sidi Bel Abbès</option>
<option value="Annaba" {{ $etablissement->wilaya == 'Annaba' ? 'selected' : '' }}>23. Annaba</option>
<option value="Guelma" {{ $etablissement->wilaya == 'Guelma' ? 'selected' : '' }}>24. Guelma</option>
<option value="Constantine" {{ $etablissement->wilaya == 'Constantine' ? 'selected' : '' }}>25. Constantine</option>
<option value="Medea" {{ $etablissement->wilaya == 'Medea' ? 'selected' : '' }}>26. Médéa</option>
<option value="Mostaganem" {{ $etablissement->wilaya == 'Mostaganem' ? 'selected' : '' }}>27. Mostaganem</option>
<option value="MSila" {{ $etablissement->wilaya == 'MSila' ? 'selected' : '' }}>28. M'Sila</option>
<option value="Mascara" {{ $etablissement->wilaya == 'Mascara' ? 'selected' : '' }}>29. Mascara</option>
<option value="Ouargla" {{ $etablissement->wilaya == 'Ouargla' ? 'selected' : '' }}>30. Ouargla</option>
<option value="Oran" {{ $etablissement->wilaya == 'Oran' ? 'selected' : '' }}>31. Oran</option>
<option value="El Bayadh" {{ $etablissement->wilaya == 'El Bayadh' ? 'selected' : '' }}>32. El Bayadh</option>
<option value="Illizi" {{ $etablissement->wilaya == 'Illizi' ? 'selected' : '' }}>33. Illizi</option>
<option value="Bordj Bou Arreridj" {{ $etablissement->wilaya == 'Bordj Bou Arreridj' ? 'selected' : '' }}>34. Bordj Bou Arreridj</option>
<option value="Boumerdes" {{ $etablissement->wilaya == 'Boumerdes' ? 'selected' : '' }}>35. Boumerdès</option>
<option value="El Tarf" {{ $etablissement->wilaya == 'El Tarf' ? 'selected' : '' }}>36. El Tarf</option>
<option value="Tindouf" {{ $etablissement->wilaya == 'Tindouf' ? 'selected' : '' }}>37. Tindouf</option>
<option value="Tissemsilt" {{ $etablissement->wilaya == 'Tissemsilt' ? 'selected' : '' }}>38. Tissemsilt</option>
<option value="El Oued" {{ $etablissement->wilaya == 'El Oued' ? 'selected' : '' }}>39. El Oued</option>
<option value="Khenchela" {{ $etablissement->wilaya == 'Khenchela' ? 'selected' : '' }}>40. Khenchela</option>
<option value="Souk Ahras" {{ $etablissement->wilaya == 'Souk Ahras' ? 'selected' : '' }}>41. Souk Ahras</option>
<option value="Tipaza" {{ $etablissement->wilaya == 'Tipaza' ? 'selected' : '' }}>42. Tipaza</option>
<option value="Mila" {{ $etablissement->wilaya == 'Mila' ? 'selected' : '' }}>43. Mila</option>
<option value="Ain Defla" {{ $etablissement->wilaya == 'Ain Defla' ? 'selected' : '' }}>44. Aïn Defla</option>
<option value="Naama" {{ $etablissement->wilaya == 'Naama' ? 'selected' : '' }}>45. Naâma</option>
<option value="Ain Temouchent" {{ $etablissement->wilaya == 'Ain Temouchent' ? 'selected' : '' }}>46. Aïn Témouchent</option>
<option value="Ghardaia" {{ $etablissement->wilaya == 'Ghardaia' ? 'selected' : '' }}>47. Ghardaia</option>
<option value="Relizane" {{ $etablissement->wilaya == 'Relizane' ? 'selected' : '' }}>48. Relizane</option>
<option value="Timimoun" {{ $etablissement->wilaya == 'Timimoun' ? 'selected' : '' }}>49. Timimoun</option>
<option value="Bordj Baji Mokhtar" {{ $etablissement->wilaya == 'Bordj Baji Mokhtar' ? 'selected' : '' }}>50. Bordj Baji Mokhtar</option>
<option value="Ouled Djellal" {{ $etablissement->wilaya == 'Ouled Djellal' ? 'selected' : '' }}>51. Ouled Djellal</option>
<option value="Beni Abbes" {{ $etablissement->wilaya == 'Beni Abbes' ? 'selected' : '' }}>52. Béni Abbès</option>
<option value="In Salah" {{ $etablissement->wilaya == 'In Salah' ? 'selected' : '' }}>53. In Salah</option>
<option value="In Guezzam" {{ $etablissement->wilaya == 'In Guezzam' ? 'selected' : '' }}>54. In Guezzam</option>
<option value="Touggourt" {{ $etablissement->wilaya == 'Touggourt' ? 'selected' : '' }}>55. Touggourt</option>
<option value="Djanet" {{ $etablissement->wilaya == 'Djanet' ? 'selected' : '' }}>56. Djanet</option>
<option value="El MGhair" {{ $etablissement->wilaya == 'El MGhair' ? 'selected' : '' }}>57. El M'Ghair</option>
<option value="El Meniaa" {{ $etablissement->wilaya == 'El Meniaa' ? 'selected' : '' }}>58. El Meniaa</option>
            </select>
        </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <p class="h6">Type</p>
                <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="type">
                    <option value="Univesite" {{ $etablissement->type == 'Univesite' ? 'selected' : '' }}>Univesité</option>
                    <option value="Centre de formation" {{ $etablissement->type == 'Centre de formation' ? 'selected' : '' }}>Centre de formation</option>
                    <option value="Institut" {{ $etablissement->type == 'Institut' ? 'selected' : '' }}>Institut</option>
                    <option value="Ecole" {{ $etablissement->type == 'Ecole' ? 'selected' : '' }}>École</option>                         
                </select>
            </div>
        </div>
        <div class="col-6">
        <div class="form-group">
            <p class="h6">Nom</p>
            <div class="input-group input-group-sm mb-3">
                <input type="text" name="name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autocomplete="off" value="{{ old('name',$etablissement->name) }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>               
                @enderror
            </div>
        </div>        
        </div>
        <div class="col-2">
        <div class="form-group" style="margin-top: 26px">
            <button type="submit" class="btn btn-sm btn-primary">
                <i class="bi bi-building-check"></i> Enregistrer
            </button>                
            <button type="button" class="btn btn-sm btn-warning" onclick="goBack()"><i class="bi bi-x-lg"></i></button>
        </div> 
        </div> 
    </div>  
    </form>
    </div>
    @else
    <div class="title">
        <h1>Ajouter un établissement</h1>
    </div>

    <div id="add_edit_div">
    <form action="{{ route('etablissements.store') }}" method="POST">
        @csrf 
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <p class="h6">Wilaya </p>
                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="wilaya">
                        <option value="Adrar">01. Adrar</option>
                        <option value="Chlef">02. Chlef</option>
                        <option value="Laghouat">03. Laghouat </option>
                        <option value="Oum El Bouaghi">04. Oum El Bouaghi</option>
                        <option value="Batna">05. Batna</option>
                        <option value="Bejaia">06. Bejaïa</option>
                        <option value="Biskra">07. Biskra</option>
                        <option value="Bechar">08. Béchar</option>
                        <option value="Blida">09. Blida</option>
                        <option value="Bouira">10. Bouira</option>
                        <option value="Tamanrasset">11. Tamanrasset </option>
                        <option value="Tebessa">12. Tebessa</option>
                        <option value="Tlemcen">13. Tlemcen</option>
                        <option value="Tiaret">14. Tiaret</option>
                        <option value="Tizi Ouzou">15. Tizi Ouzou</option>
                        <option value="Alger">16. Alger</option>
                        <option value="Djelfa">17. Djelfa</option>
                        <option value="Jijel">18. Jijel</option>
                        <option value="Setif">19. Sétif</option>
                        <option value="Saida">20. Saïda</option>
                        <option value="Skikda">21. Skikda</option>
                        <option value="Sidi Bel Abbes">22. Sidi Bel Abbès</option>
                        <option value="Annaba">23. Annaba</option>
                        <option value="Guelma">24. Guelma</option>
                        <option value="Constantine">25. Constantine</option>
                        <option value="Medea">26. Médéa</option>
                        <option value="Mostaganem">27. Mostaganem</option>
                        <option value="MSila">28. M'Sila </option>
                        <option value="Mascara">29. Mascara</option>
                        <option value="Ouargla">30. Ouargla</option>
                        <option value="Oran">31. Oran</option>
                        <option value="El Bayadh">32. El Bayadh</option>
                        <option value="Illizi">33. Illizi</option>
                        <option value="Bordj Bou Arreridj">34. Bordj Bou Arreridj</option>
                        <option value="Boumerdes">35. Boumerdès</option>
                        <option value="El Tarf">36. El Tarf</option>
                        <option value="Tindouf">37. Tindouf</option>
                        <option value="Tissemsilt">38. Tissemsilt</option>
                        <option value="El Oued">39. El Oued</option>
                        <option value="Khenchela">40. Khenchela</option>
                        <option value="Souk Ahras">41. Souk Ahras</option>
                        <option value="Tipaza">42. Tipaza</option>
                        <option value="Mila">43. Mila</option>
                        <option value="Ain Defla">44. Aïn Defla</option>
                        <option value="Naama">45. Naâma</option>
                        <option value="Ain Temouchent">46. Aïn Témouchent</option>
                        <option value="Ghardaia">47. Ghardaia</option>
                        <option value="Relizane">48. Relizane</option>
                        <option value="Timimoun">49. Timimoun</option>
                        <option value="Bordj Baji Mokhtar">50. Bordj Baji Mokhtar</option>
                        <option value="Ouled Djellal">51. Ouled Djellal</option>
                        <option value="Beni Abbes">52. Béni Abbès </option>
                        <option value="In Salah">53. In Salah</option>
                        <option value="In Guezzam">54. In Guezzam</option>
                        <option value="Touggourt">55. Touggourt</option>
                        <option value="Djanet">56. Djanet</option>
                        <option value="El MGhair">57. El M'Ghair</option>
                        <option value="El Meniaa">58. El Meniaa</option>
                      </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <p class="h6">Type</p>
                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="type">
                        $table->enum('type', ['Univesite', 'Centre de formation', 'Institut', 'Ecole']);
                        <option value="Univesite">Univesité</option>
                        <option value="Centre de formation">Centre de formation</option>
                        <option value="Institut">Institut</option>
                        <option value="Ecole">École</option>                         
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <p class="h6">Nom</p>
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
                    <button type="submit" class="btn btn-sm btn-success" name="ajouter" style="margin-top: 26px">
                        <i class="bi bi-building-add"></i> Ajouter
                    </button>
                </div>
            </div>
        </div>     
    </form>
    </div>
    @endif


@if ($etablissements->isEmpty())
        <p class="h3 text-center my-3">Aucun établissement trouvé.</p>
        @else
        <div class="d-flex">
            <div class="col">
                <div class="title">
                    <h1>Liste des établissements</h1>
                </div>
            </div>
            <form  method="POST" action="{{ route('etablissements.searchEtablissement')}}">
                @csrf
            <div class="col d-flex">
                <div style="width: 350px">
                    <input name="name" placeholder="Étbalissement" class="form-control form-control-sm" type="text" aria-label=".form-control-sm example" autocomplete="off" required>
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
            <th>Type</th>
            <th>Wilaya</th>
            <th style="text-align: center;">Options</th>
        </tr> 
                </thead>
                <tbody>   
        @foreach ($etablissements as $etablissement)
    <tr>
        <td>{{$etablissement->name}}</td>
        <td>{{$etablissement->type}}</td>
        <td>{{$etablissement->wilaya}}</td>
        <td>
            <div class="d-flex justify-content-center align-items-center">
            <form action ="{{route('etablissements.edit',$etablissement->id)}}" method="GET">
            @csrf
           <button class="btn btn-sm btn-warning mx-1" name="modifier">
                    <i class="bi bi-pencil-square"></i>
           </button>
            </form>
        
            <form action ="{{route('etablissements.destroy', $etablissement->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-sm btn-warning mx-1" data-bs-toggle="modal" data-bs-target="#exampleModal{{$etablissement->id}}">
                    <i class="bi bi-trash3-fill"></i>
                  </button>
                </form>  
            </div>
        </td>
    </tr> 
                </tbody>
    <div class="modal fade" id="exampleModal{{$etablissement->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Désactivation</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Voulez-vous vraiment désactiver {{$etablissement->name}} ?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
              <form action ="{{route('etablissements.destroy', $etablissement->id)}}" method="POST">
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
    {{ $etablissements->links() }}
</div>
@endif

</x-masterAdmin>