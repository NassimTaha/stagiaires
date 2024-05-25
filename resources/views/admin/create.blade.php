<x-masterAdmin  title="Création">
    <div id="add_edit_div">
        <form id="stage_form" method="POST" action="{{ route('stages.store')}}">
            @csrf
        <p class="h2">Ajouter un stage</p>

        <div class="row">
            <div class="col-6">
                <p class="h6">Type de stage</p>
                <select id="stage_type" name="stage_type" class="form-select form-select-sm" aria-label=".form-select-sm example" required onchange="quotaVerification()">
                    <option value="pfe" {{ old('stage_type') == 'pfe' ? 'selected' : '' }}>Projet fin d'étude</option>
                    <option value="immersion" {{ old('stage_type') == 'immersion' ? 'selected' : '' }}>Stage immersion</option>
                </select>
            </div>
            <div class="col-6">
                <p class="h6">Structure D'Affectation</p>
                <select name="structuresAffectation_id" id="structuresAffectation" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                    <option value="" selected disabled>Sélectionnez une structure d'affectation</option>
                    @foreach ($structuresAffectations as $structuresAffectation)
                        <option value="{{ $structuresAffectation->id }}" {{ old('structuresAffectation_id') == $structuresAffectation->id ? 'selected' : '' }}>
                            {{ $structuresAffectation->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row" style="margin-top: 5px">
            <div class="col-4">
                <p class="h6">Date début</p>
                <input id="start_date" disabled name="start_date" value="{{old('start_date')}}" class="form-control form-control-sm" type="date"  aria-label=".form-control-sm example" required>
            </div>
            <div class="col-4">
                <p class="h6">Date fin</p>
                <input id="end_date" disabled name="end_date" value="{{old('end_date')}}" class="form-control form-control-sm" type="date"  aria-label=".form-control-sm example" required>
            </div>
            <div class="col-4">
                <p class="h6">Nombre de stagiaires</p>
                <select id="stagiaire_count" disabled name="stagiaire_count" class="form-select form-select-sm" aria-label=".form-select-sm example" onchange="toggleStagiaires(this)" required>
                    <option value="" selected disabled>Sélectionnez le nombre de stagiaires</option>
                    <option value="Monome" {{ old('stagiaire_count') == 'Monome' ? 'selected' : '' }}>Monome</option>
                    <option value="Binome" {{ old('stagiaire_count') == 'Binome' ? 'selected' : '' }}>Binome</option>
                    <option value="Trinome" {{ old('stagiaire_count') == 'Trinome' ? 'selected' : '' }}>Trinome</option>
                    <option value="Quadrinome" {{ old('stagiaire_count') == 'Quadrinome' ? 'selected' : '' }}>Quadrinome</option>
                </select>
            </div>
        </div>

        <div class="row" style="margin-top: 5px">
            <div class="col-4">
                <p class="h6">Encadrant</p>
                <select id="encadrant_id" disabled name="encadrant_id" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                    <option value="" selected disabled>Sélectionnez un encadrant</option>
                    @foreach ($encadrants as $encadrant)
                        <option value="{{ $encadrant->id }}"
                            {{ old('encadrant_id') == $encadrant->id ? 'selected' : '' }}
                            data-structure-id="{{ $encadrant->structuresAffectation_id }}"
                            data-parent="{{$encadrant->structureAffectation->parent_id}}">
                            {{ $encadrant->last_name }} {{ $encadrant->first_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-4">
                <p class="h6">Établissement</p>
                <select id="etablissement_id" disabled name="etablissement_id" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                    @foreach ($etablissements as $etablissement)
                        <option value="{{$etablissement->id}}" {{ old('etablissement_id') == $etablissement->id ? 'selected' : '' }}>
                            {{$etablissement->name}} ({{$etablissement->wilaya}})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-4">
                <p class="h6">Niveau</p>
                <select id="level" disabled name="level" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                    <option value="Licence" {{ old('level') == 'Licence' ? 'selected' : '' }}>Licence</option>
                    <option value="Master" {{ old('level') == 'Master' ? 'selected' : '' }}>Master</option>
                    <option value="Doctorat" {{ old('level') == 'Doctorat' ? 'selected' : '' }}>Doctorat</option>
                    <option value="Ingenieur" {{ old('level') == 'Ingenieur' ? 'selected' : '' }}>Ingénieur</option>
                    <option value="TS" {{ old('level') == 'TS' ? 'selected' : '' }}>Technicien Supérieur</option>
                </select>
            </div>
        </div>

        <div class="row" style="margin-top: 5px">
            <div class="col">
                <p class="h6">Domaine</p>
                <select id="domain" class="form-select form-select-sm" aria-label=".form-select-sm example" required disabled>
                    <option value="" disabled selected>Sélectionnez un domaine</option>
                    @foreach($domaines as $domaine)
                        <option value="{{ $domaine->id }}" {{ old('domain') == $domaine->id ? 'selected' : '' }}>
                            {{ $domaine->name }}
                        </option>
                    @endforeach
                </select>

            </div>
            <div class="col">
                <p class="h6">Specialité</p>
                <select id="specialite_id" name="specialite_id" class="form-select form-select-sm" aria-label=".form-select-sm example" required disabled>
                    <option value="" disabled selected>Sélectionnez une spécialité</option>
                    @foreach($specialites as $specialite)
                        <option value="{{ $specialite->id }}" domaine_id="{{ $specialite->domaine_id }}" {{ old('specialite_id') == $specialite->id ? 'selected' : '' }}>
                            {{ $specialite->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                    <p class="h6">Jour(s) de réception</p>
                <div class="form-check form-check-inline">
                    <input disabled class="form-check-input" type="checkbox" name="selected_days" id="Dimanche" value="Dimanche">
                    <label class="form-check-label" for="Dimanche">Dimanche</label>
                </div>
                <div class="form-check form-check-inline">
                    <input disabled class="form-check-input" type="checkbox" name="selected_days" id="Lundi" value="Lundi">
                    <label class="form-check-label" for="Lundi">Lundi</label>
                </div>
                <div class="form-check form-check-inline">
                    <input disabled class="form-check-input" type="checkbox" name="selected_days" id="Mardi" value="Mardi">
                    <label class="form-check-label" for="Mardi">Mardi</label>
                </div>
                <div class="form-check form-check-inline">
                    <input disabled class="form-check-input" type="checkbox" name="selected_days" id="Mercredi" value="Mercredi">
                    <label class="form-check-label" for="Mercredi">Mercredi</label>
                </div>
                <div style="margin-left : 8px;" class="form-check form-check-inline">
                    <input disabled class="form-check-input" type="checkbox" name="selected_days" id="Jeudi" value="Jeudi">
                    <label class="form-check-label" for="Jeudi">Jeudi</label>
                </div>
                <div style="margin-left: 3px;" class="form-check form-check-inline">
                    <input disabled class="form-check-input" type="checkbox" name="selected_days" id="Samedi" value="Samedi">
                    <label class="form-check-label" for="Samedi">Samedi</label>
                </div>
                <input type="hidden" name="reception_days" id="reception_days">
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <p class="h6">Thème</p>
                <input id="theme" disabled name="theme" value="{{old('theme')}}" class="form-control form-control-sm" type="text"  aria-label=".form-control-sm example" autocomplete="off" required>
            </div>

        </div>


        <hr style="border-top: 2px solid black;">

        <div class="row" style="margin-top: 2px">
            <p class="h2">Stagiaires</p>

            <div id="stagiaire1" class="col-3">
                <p class="h5">Stagiaire 1</p>

                        <p class="h6">Nom</p>
                        <input id="last_name1" disabled name="last_name1" value="{{old('last_name1')}}" class="form-control form-control-sm" type="text"  aria-label=".form-control-sm example" autocomplete="off" required>


                        <p style="margin-top : 2px;" class="h6">Prénom</p>
                        <input id="first_name1" disabled name="first_name1" value="{{old('first_name1')}}" class="form-control form-control-sm" type="text"  aria-label=".form-control-sm example" autocomplete="off" required>


                        <p style="margin-top : 2px;" class="h6">Date de naissance</p>
                        <input id="date_of_birth1" disabled name="date_of_birth1" value="{{old('date_of_birth1')}}" class="form-control form-control-sm" type="date"  aria-label=".form-control-sm example" required>

                        <p style="margin-top : 2px;" class="h6">Lieu de naissance</p>
                <input id="place_of_birth1" disabled name="place_of_birth1" value="{{old('place_of_birth1')}}" class="form-control form-control-sm" type="text"  aria-label=".form-control-sm example" autocomplete="off" required>

                    <div style="margin-top : 2px;" class="row">
                        <div class="col-6">
                            <p class="h6">N° de tel</p>
                            <input id="phone_number1" type="tel" pattern="0[0-9]{9}" placeholder="XXXXXXXXXX" disabled maxlength="10" name="phone_number1" value="{{old('phone_number1')}}" class="form-control form-control-sm" type="text"  aria-label=".form-control-sm example" autocomplete="off" required>
                        </div>
                        <div class="col-6">
                            <p class="h6">Groupe sanguin</p>
                            <select id="blood_group1" disabled name="blood_group1" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                                <option value="A+" {{ old('blood_group1') == 'A+' ? 'selected' : '' }}>A+</option>
                                <option value="A-" {{ old('blood_group1') == 'A-' ? 'selected' : '' }}>A-</option>
                                <option value="B+" {{ old('blood_group1') == 'B+' ? 'selected' : '' }}>B+</option>
                                <option value="B-" {{ old('blood_group1') == 'B-' ? 'selected' : '' }}>B-</option>
                                <option value="AB+" {{ old('blood_group1') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                <option value="AB-" {{ old('blood_group1') == 'AB-' ? 'selected' : '' }}>AB-</option>
                                <option value="O+" {{ old('blood_group1') == 'O+' ? 'selected' : '' }}>O+</option>
                                <option value="O-" {{ old('blood_group1') == 'O-' ? 'selected' : '' }}>O-</option>
                            </select>
                        </div>

                    </div>

                <p style="margin-top : 2px;" class="h6">Email</p>
                <input id="email1" disabled name="email1" value="{{old('email1')}}" class="form-control form-control-sm" type="email"  aria-label=".form-control-sm example" autocomplete="off" required>
            </div>

            <div id="stagiaire2" class="col-3">
                <p class="h5">Stagiaire 2</p>

                        <p class="h6">Nom</p>
                        <input id="last_name2" disabled name="last_name2" value="{{old('last_name2')}}" class="form-control form-control-sm" type="text"  aria-label=".form-control-sm example" autocomplete="off" required>

                        <p style="margin-top : 2px;" class="h6">Prénom</p>
                        <input id="first_name2" disabled name="first_name2" value="{{old('first_name2')}}" class="form-control form-control-sm" type="text"  aria-label=".form-control-sm example" autocomplete="off" required>

                        <p style="margin-top : 2px;" class="h6">Date de naissance</p>
                        <input id="date_of_birth2" disabled name="date_of_birth2" value="{{old('date_of_birth2')}}" class="form-control form-control-sm" type="date"  aria-label=".form-control-sm example" required>

                        <p style="margin-top : 2px;" class="h6">Lieu de naissance</p>
                <input id="place_of_birth2" disabled name="place_of_birth2" value="{{old('place_of_birth2')}}" class="form-control form-control-sm" type="text"  aria-label=".form-control-sm example" autocomplete="off" required>

                        <div style="margin-top : 2px;" class="row">
                            <div class="col-6">
                                <p class="h6">N° de tel</p>
                                <input id="phone_number2" type="tel" pattern="0[0-9]{9}" placeholder="XXXXXXXXXX" disabled maxlength="10" name="phone_number2" value="{{old('phone_number2')}}" class="form-control form-control-sm" type="text"  aria-label=".form-control-sm example" autocomplete="off" required>
                            </div>
                            <div class="col-6">
                                <p class="h6">Groupe sanguin</p>
                                <select id="blood_group2" disabled name="blood_group2" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                                    <option value="A+" {{ old('blood_group2') == 'A+' ? 'selected' : '' }}>A+</option>
                                    <option value="A-" {{ old('blood_group2') == 'A-' ? 'selected' : '' }}>A-</option>
                                    <option value="B+" {{ old('blood_group2') == 'B+' ? 'selected' : '' }}>B+</option>
                                    <option value="B-" {{ old('blood_group2') == 'B-' ? 'selected' : '' }}>B-</option>
                                    <option value="AB+" {{ old('blood_group2') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                    <option value="AB-" {{ old('blood_group2') == 'AB-' ? 'selected' : '' }}>AB-</option>
                                    <option value="O+" {{ old('blood_group2') == 'O+' ? 'selected' : '' }}>O+</option>
                                    <option value="O-" {{ old('blood_group2') == 'O-' ? 'selected' : '' }}>O-</option>
                                </select>
                            </div>

                        </div>

                <p style="margin-top : 2px;" class="h6">Email</p>
                <input id="email2" disabled name="email2" value="{{old('email2')}}" class="form-control form-control-sm" type="email"  aria-label=".form-control-sm example" autocomplete="off" required>
            </div>

            <div id="stagiaire3" class="col-3">
                <p class="h5">Stagiaire 3</p>

                        <p  class="h6">Nom</p>
                        <input id="last_name3" disabled name="last_name3" value="{{old('last_name3')}}" class="form-control form-control-sm" type="text"  aria-label=".form-control-sm example" autocomplete="off" required>


                        <p style="margin-top : 2px;" class="h6">Prénom</p>
                        <input id="first_name3" disabled name="first_name3" value="{{old('first_name3')}}" class="form-control form-control-sm" type="text"  aria-label=".form-control-sm example" autocomplete="off" required>

                        <p style="margin-top : 2px;" class="h6">Date de naissance</p>
                        <input id="date_of_birth3" disabled name="date_of_birth3" value="{{old('date_of_birth3')}}" class="form-control form-control-sm" type="date"  aria-label=".form-control-sm example" required>

                        <p style="margin-top : 2px;" class="h6">Lieu de naissance</p>
                <input id="place_of_birth3" disabled name="place_of_birth3" value="{{old('place_of_birth3')}}" class="form-control form-control-sm" type="text"  aria-label=".form-control-sm example" autocomplete="off" required>

                            <div style="margin-top : 2px;" class="row">
                                <div class="col-6">
                                    <p class="h6">N° de tel</p>
                                    <input id="phone_number3" type="tel" pattern="0[0-9]{9}" placeholder="XXXXXXXXXX" disabled maxlength="10" name="phone_number3" value="{{old('phone_number3')}}" class="form-control form-control-sm" type="text"  aria-label=".form-control-sm example" autocomplete="off" required>
                                </div>
                                <div class="col-6">
                                    <p class="h6">Groupe sanguin</p>
                                    <select id="blood_group3" disabled name="blood_group3" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                                        <option value="A+" {{ old('blood_group3') == 'A+' ? 'selected' : '' }}>A+</option>
                                        <option value="A-" {{ old('blood_group3') == 'A-' ? 'selected' : '' }}>A-</option>
                                        <option value="B+" {{ old('blood_group3') == 'B+' ? 'selected' : '' }}>B+</option>
                                        <option value="B-" {{ old('blood_group3') == 'B-' ? 'selected' : '' }}>B-</option>
                                        <option value="AB+" {{ old('blood_group3') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                        <option value="AB-" {{ old('blood_group3') == 'AB-' ? 'selected' : '' }}>AB-</option>
                                        <option value="O+" {{ old('blood_group3') == 'O+' ? 'selected' : '' }}>O+</option>
                                        <option value="O-" {{ old('blood_group3') == 'O-' ? 'selected' : '' }}>O-</option>
                                    </select>
                                </div>
                            </div>
                <p style="margin-top : 2px;" class="h6">Email</p>
                <input id="email3" disabled name="email3" value="{{old('email3')}}" class="form-control form-control-sm" type="email"  aria-label=".form-control-sm example" autocomplete="off" required>
            </div>

            <div id="stagiaire4" class="col-3">
                <p class="h5">Stagiaire 4</p>

                        <p class="h6">Nom</p>
                        <input id="last_name4" disabled name="last_name4" value="{{old('last_name4')}}" class="form-control form-control-sm" type="text"  aria-label=".form-control-sm example" autocomplete="off" required>

                        <p style="margin-top : 2px;" class="h6">Prénom</p>
                        <input id="first_name4" disabled name="first_name4" value="{{old('first_name4')}}" class="form-control form-control-sm" type="text"  aria-label=".form-control-sm example" autocomplete="off" required>

                        <p style="margin-top : 2px;" class="h6">Date de naissance</p>
                        <input id="date_of_birth4" disabled name="date_of_birth4" value="{{old('date_of_birth4')}}" class="form-control form-control-sm" type="date"  aria-label=".form-control-sm example" required>

                        <p style="margin-top : 2px;" class="h6">Lieu de naissance</p>
                        <input id="place_of_birth4" disabled name="place_of_birth4" value="{{old('place_of_birth4')}}" class="form-control form-control-sm" type="text"  aria-label=".form-control-sm example" autocomplete="off" required>

                        <div style="margin-top : 2px;" class="row">
                            <div class="col-6">
                                <p class="h6">N° de tel</p>
                                <input id="phone_number4" type="tel" pattern="0[0-9]{9}" placeholder="XXXXXXXXXX" disabled maxlength="10" name="phone_number4" value="{{old('phone_number4')}}" class="form-control form-control-sm" type="text"  aria-label=".form-control-sm example" autocomplete="off" required>
                            </div>
                            <div class="col-6">
                                <p class="h6">Groupe sanguin</p>
                                <select id="blood_group4" disabled name="blood_group4" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                                    <option value="A+" {{ old('blood_group4') == 'A+' ? 'selected' : '' }}>A+</option>
                                    <option value="A-" {{ old('blood_group4') == 'A-' ? 'selected' : '' }}>A-</option>
                                    <option value="B+" {{ old('blood_group4') == 'B+' ? 'selected' : '' }}>B+</option>
                                    <option value="B-" {{ old('blood_group4') == 'B-' ? 'selected' : '' }}>B-</option>
                                    <option value="AB+" {{ old('blood_group4') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                    <option value="AB-" {{ old('blood_group4') == 'AB-' ? 'selected' : '' }}>AB-</option>
                                    <option value="O+" {{ old('blood_group4') == 'O+' ? 'selected' : '' }}>O+</option>
                                    <option value="O-" {{ old('blood_group4') == 'O-' ? 'selected' : '' }}>O-</option>
                                </select>
                            </div>

                        </div>
                <p style="margin-top : 2px;" class="h6">Email</p>
                <input id="email4" disabled name="email4" value="{{old('email4')}}" class="form-control form-control-sm" type="email"  aria-label=".form-control-sm example" autocomplete="off" required>

        </div>

        <div class="float-end">
            <button type="button" onclick="formSubmit()" class="btn float-end btn-warning my-2" style="width: 150px">
                <i class="bi bi-patch-plus-fill"></i> Ajouter
            </button>
            <button type="button" onclick="resetForm()" class=" float-end btn btn-dark mx-2 my-2" style="width: 150px">
                <i class="bi bi-arrow-counterclockwise"></i> Réinitialiser
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



