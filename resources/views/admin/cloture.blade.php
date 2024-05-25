<x-masterAdmin title="Clôture">

        <div class="title">
            <h1>Clôture</h1>
        </div>
                <div id="add_edit_div">
                    <table class="table table-sm">
                        <tbody>
                            <tr>
                                <th>Type de stage</th>
                                <td>{{$stage->stage_type}}</td>
                                <th>Structure D'Affectation</th>
                                <td>{{$stage->structureAffectation->name}}</td>
                            </tr>
                            <tr>
                                <th>Date début</th>
                                <td>{{$stage->start_date}}</td>
                                <th>Date fin</th>
                                <td>{{$stage->end_date}}</td>
                            </tr>
                            <tr>
                                <th>Nombre de stagiaires</th>
                                <td>{{$stage->stagiaire_count}}</td>
                                <th>Encadrant</th>
                                <td>{{$stage->encadrant->last_name}} {{$stage->encadrant->last_name}}</td>
                            </tr>
                            <tr>
                                <th>Établissement</th>
                                <td>{{$stage->etablissement->name}}</td>
                                <th>Niveau</th>
                                <td>{{$stage->level}}</td>
                            </tr>
                            <tr>
                                <th>Domaine</th>
                                <td>{{$stage->specialite->domaine->name}}</td>
                                <th>Spécialité</th>
                                <td>{{$stage->specialite->name}}</td>
                            </tr>
                            <tr>
                                <th>Jour(s) de réception</th>
                                <td colspan="3">{{$stage->reception_days}}</td>
                            </tr>
                            <tr>
                                <th>Thème</th>
                                <td colspan="3">{{$stage->theme}}</td>
                            </tr>
                        </tbody>
                    </table>

                    <hr style="border-top: 2px solid black;">

                    <form action="{{ route('stage.done', $stage->id) }}" method="POST" onsubmit="return validateFormCloture()">
                        @csrf
                        @method('POST')
                    
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Dépôt de mémoire</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="memoire" id="memoire" value="1" required>
                                    <label class="form-check-label" for="memoire">Dépôt de mémoire effectué</label>
                                </div>
                                <br>
                                <h5>Date de clôture</h5>
                                <input name="cloture_date" class="form-control form-control-sm w-75" type="date" required>
                            </div>
                            <div class="col-md-6">
                                <h5>Quitus des stagiaires</h5>
                                @foreach ($stagiaires->where('stage_id', $stage->id) as $stagiaire)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="quitus[]" id="quitus_{{ $stagiaire->id }}" value="{{ $stagiaire->id }}">
                                    <label class="form-check-label" for="quitus_{{ $stagiaire->id }}">
                                        {{ $stagiaire->last_name }} {{ $stagiaire->first_name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    
                        <div class="d-flex justify-content-start mt-2">
                            <button type="submit" class="btn btn-warning" style="width: 150px">
                                <i class="bi bi-calendar2-check-fill"></i> Clôturer
                            </button>
                        </div>
                     

                    </form>
                    
       

                </div>
                         
         
          
                
    

</x-masterAdmin>

<div class="modal fade" id="quitusModal" tabindex="-1" aria-labelledby="quitusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="quitusModalLabel">Alerte</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Veuillez sélectionner au moins un stagiaire.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>