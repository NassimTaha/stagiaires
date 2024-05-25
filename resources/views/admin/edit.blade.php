<x-masterAdmin  title="Modification">
    <div id="add_edit_div">
        <form id="stage_form" method="POST" action="{{ route('stages.update', $stage->id) }}">
            @csrf
            @method('PUT')
        <p class="h2">Modifier un stage</p>

        <div class="row">
            <div class="col-6">
                <p class="h6">Type de stage</p>
                <select id="stage_type" name="stage_type" class="form-select form-select-sm" aria-label=".form-select-sm example" required onchange="quotaVerification()">
                    <option value="pfe" {{ $stage->stage_type == 'pfe' ? 'selected' : '' }}>Projet fin d'étude</option>
                    <option value="immersion" {{ $stage->stage_type == 'immersion' ? 'selected' : '' }}>Stage immersion</option>
                </select>
            </div>
            <div class="col-6">
                <p class="h6">Structure D'Affectation</p>
                <select name="structuresAffectation_id" id="structuresAffectation" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                    <option value="" selected disabled>Sélectionnez une structure d'affectation</option>
                    @foreach ($structuresAffectations as $structuresAffectation)
                        <option value="{{ $structuresAffectation->id }}" {{ $stage->structuresAffectation_id == $structuresAffectation->id ? 'selected' : '' }}>
                            {{ $structuresAffectation->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row" style="margin-top: 5px">
            <div class="col-4">
                <p class="h6">Date début</p>
                <input id="start_date"  name="start_date" value="{{ $stage->start_date }}" class="form-control form-control-sm" type="date"  aria-label=".form-control-sm example" required>
            </div>
            <div class="col-4">
                <p class="h6">Date fin</p>
                <input id="end_date"  name="end_date" value="{{ $stage->end_date }}" class="form-control form-control-sm" type="date"  aria-label=".form-control-sm example" required>
            </div>
            <div class="col-4">
                <p class="h6">Nombre de stagiaires</p>
                <select id="stagiaire_count"  name="stagiaire_count" class="form-select form-select-sm readonly-select" aria-label=".form-select-sm example" required>
                    <option value="Monome" {{ $stage->stagiaire_count === 'Monome' ? 'selected' : '' }}>Monome</option>
                    <option value="Binome" {{ $stage->stagiaire_count === 'Binome' ? 'selected' : '' }}>Binome</option>
                    <option value="Trinome" {{ $stage->stagiaire_count === 'Trinome' ? 'selected' : '' }}>Trinome</option>
                    <option value="Quadrinome" {{ $stage->stagiaire_count === 'Quadrinome' ? 'selected' : '' }}>Quadrinome</option>
                </select>
            </div>
        </div>
        <style>
    .readonly-select {
        pointer-events: none;
        background-color: #e9ecef;
    }
</style>

        <div class="row" style="margin-top: 5px">
            <div class="col-4">
                <p class="h6">Encadrant</p>
                <select id="encadrant_id"  name="encadrant_id" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                    @foreach ($encadrants as $encadrant)
                    <option value="{{ $encadrant->id }}" {{ $stage->encadrant_id == $encadrant->id ? 'selected' : '' }}
                        data-structure-id="{{ $encadrant->structuresAffectation_id }}"
                        data-parent="{{ $encadrant->structureAffectation->parent_id }}">
                    {{ $encadrant->last_name }} {{ $encadrant->first_name }}
                </option>
                    @endforeach
                </select>
            </div>
            <div class="col-4">
                <p class="h6">Établissement</p>
                <select id="etablissement_id"  name="etablissement_id" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                    @foreach ($etablissements as $etablissement)
                    <option value="{{ $etablissement->id }}" {{ $stage->etablissement_id == $etablissement->id ? 'selected' : '' }}>
                        {{ $etablissement->name }} ({{ $etablissement->wilaya }})
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-4">
                <p class="h6">Niveau</p>
                <select id="level"  name="level" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                    <option value="Licence" {{ $stage->level == 'Licence' ? 'selected' : '' }}>Licence</option>
                    <option value="Master" {{ $stage->level == 'Master' ? 'selected' : '' }}>Master</option>
                    <option value="Doctorat" {{ $stage->level == 'Doctorat' ? 'selected' : '' }}>Doctorat</option>
                    <option value="Ingenieur" {{ $stage->level == 'Ingenieur' ? 'selected' : '' }}>Ingénieur</option>
                    <option value="TS" {{ $stage->level == 'TS' ? 'selected' : '' }}>Technicien Supérieur</option>
                </select>
            </div>
        </div>

        <div class="row" style="margin-top: 5px">
            <div class="col">
                <p class="h6">Domaine</p>
                <select id="domaine_id" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                    @foreach($domaines as $domaine)
                        <option value="{{ $domaine->id }}" {{ $stage->specialite->domaine_id == $domaine->id ? 'selected' : '' }}>
                            {{ $domaine->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <p class="h6">Specialité</p>
                <select id="specialite_id" name="specialite_id" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                    @foreach($specialites as $specialite)
                        <option value="{{ $specialite->id }}" domaine_id="{{ $specialite->domaine_id }}" {{ $stage->specialite_id == $specialite->id ? 'selected' : '' }}>
                            {{ $specialite->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col" >
                    <p class="h6">Jour(s) de réception</p>
                <div class="form-check form-check-inline">
                    <input  class="form-check-input" type="checkbox" name="selected_days" id="Dimanche" value="Dimanche" {{ in_array('Dimanche', explode(' ', $stage->reception_days)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="Dimanche">Dimanche</label>
                </div>
                <div class="form-check form-check-inline">
                    <input  class="form-check-input" type="checkbox" name="selected_days" id="Lundi" value="Lundi" {{ in_array('Lundi', explode(' ', $stage->reception_days)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="Lundi">Lundi</label>
                </div>
                <div class="form-check form-check-inline">
                    <input  class="form-check-input" type="checkbox" name="selected_days" id="Mardi" value="Mardi" {{ in_array('Mardi', explode(' ', $stage->reception_days)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="Mardi">Mardi</label>
                </div>
                <div class="form-check form-check-inline">
                    <input  class="form-check-input" type="checkbox" name="selected_days" id="Mercredi" value="Mercredi" {{ in_array('Mercredi', explode(' ', $stage->reception_days)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="Mercredi">Mercredi</label>
                </div>
                <div style="margin-left : 8px;" class="form-check form-check-inline">
                    <input  class="form-check-input" type="checkbox" name="selected_days" id="Jeudi" value="Jeudi" {{ in_array('Jeudi', explode(' ', $stage->reception_days)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="Jeudi">Jeudi</label>
                </div>
                <div style="margin-left: 3px;" class="form-check form-check-inline">
                    <input  class="form-check-input" type="checkbox" name="selected_days" id="Samedi" value="Samedi" {{ in_array('Samedi', explode(' ', $stage->reception_days)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="Samedi">Samedi</label>
                </div>
                <input type="hidden" name="reception_days" id="reception_days">
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <p class="h6">Thème</p>
                <input id="theme"  name="theme" value="{{$stage->theme}}"  class="form-control form-control-sm" type="text"  aria-label=".form-control-sm example" autocomplete="off" required>
            </div>

        </div>


        <hr style="border-top: 2px solid black;">

        <div class="row" style="margin-top: 2px">
            <p class="h2">Stagiaires</p>

            @foreach($stagiaires as $key => $stagiaire)
            <div id="stagiaire{{$key+1}}" class="col-3">
                <p class="h5">Stagiaire {{$key+1}}</p>
                
                <p class="h6">Nom</p>
                <input id="last_name{{$key+1}}" name="last_name{{$key+1}}" value="{{$stagiaire->last_name}}" class="form-control form-control-sm" type="text" aria-label=".form-control-sm example" autocomplete="off" required >
        
                <p style="margin-top: 2px;" class="h6">Prénom</p>
                <input id="first_name{{$key+1}}" name="first_name{{$key+1}}" value="{{$stagiaire->first_name}}" class="form-control form-control-sm" type="text" aria-label=".form-control-sm example" autocomplete="off" required >
        
                <p style="margin-top: 2px;" class="h6">Date de naissance</p>
                <input id="date_of_birth{{$key+1}}" name="date_of_birth{{$key+1}}" value="{{$stagiaire->date_of_birth}}" class="form-control form-control-sm" type="date" aria-label=".form-control-sm example" required >
        
                <p style="margin-top: 2px;" class="h6">Lieu de naissance</p>
                <input id="place_of_birth{{$key+1}}" name="place_of_birth{{$key+1}}" value="{{$stagiaire->place_of_birth}}" class="form-control form-control-sm" type="text" aria-label=".form-control-sm example" autocomplete="off" required >
        
                <div style="margin-top: 2px;" class="row">
                    <div class="col-6">
                        <p class="h6">N° de tel</p>
                        <input id="phone_number{{$key+1}}" type="tel" pattern="0[0-9]{9}" placeholder="XXXXXXXXXX" maxlength="10" name="phone_number{{$key+1}}" value="{{$stagiaire->phone_number}}" class="form-control form-control-sm" aria-label=".form-control-sm example" autocomplete="off" required >
                    </div>
                    <div class="col-6">
                        <p class="h6">Groupe sanguin</p>
                        <select id="blood_group{{$key+1}}" name="blood_group{{$key+1}}" class="form-select form-select-sm" aria-label=".form-select-sm example" required >
                            <option value="A+" {{ $stagiaire->blood_group == 'A+' ? 'selected' : '' }}>A+</option>
                            <option value="A-" {{ $stagiaire->blood_group == 'A-' ? 'selected' : '' }}>A-</option>
                            <option value="B+" {{ $stagiaire->blood_group == 'B+' ? 'selected' : '' }}>B+</option>
                            <option value="B-" {{ $stagiaire->blood_group == 'B-' ? 'selected' : '' }}>B-</option>
                            <option value="AB+" {{ $stagiaire->blood_group == 'AB+' ? 'selected' : '' }}>AB+</option>
                            <option value="AB-" {{ $stagiaire->blood_group == 'AB-' ? 'selected' : '' }}>AB-</option>
                            <option value="O+" {{ $stagiaire->blood_group == 'O+' ? 'selected' : '' }}>O+</option>
                            <option value="O-" {{ $stagiaire->blood_group == 'O-' ? 'selected' : '' }}>O-</option>
                        </select>
                    </div>
                </div>
        
                <p style="margin-top: 2px;" class="h6">Email</p>
                <input id="email{{$key+1}}" name="email{{$key+1}}" value="{{$stagiaire->email}}" class="form-control form-control-sm" type="email" aria-label=".form-control-sm example" autocomplete="off" required >
            </div>
            @endforeach


        <div class="float-end">
            <button type="button" onclick="formSubmit()" class="btn float-end btn-warning my-2" style="width: 150px">
                <i class="bi bi-floppy-fill"></i> Modifier
            </button>
        </div>

        </form>
    </div>
    </x-masterAdmin>
    <script>

    function quotaVerification() {
    var stageTypeSelect = document.getElementById("stage_type");
    var selectedStageType = stageTypeSelect.value;

    var structuresAffectationSelect = document.getElementById("structuresAffectation");
    var selectedStructuresAffectation = structuresAffectationSelect.value;

    if (!selectedStructuresAffectation) {
        console.log('No structures affectation selected');
        return;
    }

    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    var data = {
        stage_type: selectedStageType,
        structuresAffectation_id: selectedStructuresAffectation
    };

    fetch('{{ route('quotaVerification') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log('Response from server:', data);

        var count = data.count;
        var quota = data.quota;

        if (count >= quota) {
            disableFields();
        } else {
            enableFields();
        }
    })
    .catch(error => {
        console.error('There was a problem with your fetch operation:', error);
    });
}

document.addEventListener('DOMContentLoaded', function() {
            const domaineSelect = document.getElementById('domaine_id');
            const specialiteSelect = document.getElementById('specialite_id');
        
            function updateSpecialites() {
                const selectedDomaineId = domaineSelect.value;
                for (let i = 0; i < specialiteSelect.options.length; i++) {
                    const option = specialiteSelect.options[i];
                    option.style.display = option.getAttribute('domaine_id') === selectedDomaineId ? 'block' : 'none';
                }
                for (let i = 0; i < specialiteSelect.options.length; i++) {
                    if (specialiteSelect.options[i].style.display === 'block') {
                        specialiteSelect.selectedIndex = i;
                        break;
                    }
                }
            }
        
            domaineSelect.addEventListener('change', updateSpecialites);
            updateSpecialites();
        });

function formSubmit() {

    if (!document.getElementById('stage_form').checkValidity()) {

        document.getElementById('stage_form').reportValidity();
        return;
    }

    var checkedCount = document.querySelectorAll('input[name="selected_days"]:checked').length;

    if (checkedCount < 1 || checkedCount > 3) {
        var myModal = new bootstrap.Modal(document.getElementById('maxDaysModal'));
        myModal.show();
        return;
    }


    var selectedDays = [];
    document.querySelectorAll('input[name="selected_days"]:checked').forEach(function(checkbox) {
        selectedDays.push(checkbox.value);
    });
    document.getElementById('reception_days').value = selectedDays.join(' ');

    document.getElementById('stage_form').submit();
}
function disableFields() {
    document.getElementById("start_date").disabled = true;
    document.getElementById("end_date").disabled = true;
    document.getElementById("stagiaire_count").disabled = true;
    document.getElementById("encadrant_id").disabled = true;
    document.getElementById("etablissement_id").disabled = true;
    document.getElementById("level").disabled = true;
    document.getElementById("theme").disabled = true;
    document.getElementById("domaine_id").disabled = true;
    document.getElementById("specialite_id").disabled = true;
   // document.getElementById("reception_days").disabled = true;
}
function enableFields() {
    document.getElementById("start_date").disabled = false;
    document.getElementById("end_date").disabled = false;
    document.getElementById("stagiaire_count").disabled = false;
    document.getElementById("encadrant_id").disabled = false;
    document.getElementById("etablissement_id").disabled = false;
    document.getElementById("level").disabled = false;
    document.getElementById("theme").disabled = false;
    document.getElementById("domaine_id").disabled = false;
    document.getElementById("specialite_id").disabled = false;
    //document.getElementById("reception_days").disabled = false;
}


</script>
<div class="modal fade" id="maxDaysModal" tabindex="-1" aria-labelledby="maxDaysModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="maxDaysModalLabel">Alerte</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Veuillez sélectionner de 1 à 3 jours.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>
