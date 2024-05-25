function goBack() {
    window.history.back();
}

function resetForm() {
    document.getElementById("stage_form").reset();
    document.getElementById('theme').disabled = true;
    document.getElementById('etablissement_id').disabled = true;
    document.getElementById('encadrant_id').disabled = true;
    document.getElementById('stagiaire_count').disabled = true;
    document.getElementById('stagiaire_count').value = document.getElementById('stagiaire_count').options[0].value;
    document.getElementById('level').disabled = true;
    document.getElementById('end_date').disabled = true;
    document.getElementById('start_date').disabled = true;
    document.getElementById('specialite_id').disabled = true;
    document.getElementById('domain').disabled = true;
    document.getElementById('Dimanche').disabled = true;
    document.getElementById('Lundi').disabled = true;
    document.getElementById('Mardi').disabled = true;
    document.getElementById('Mercredi').disabled = true;
    document.getElementById('Samedi').disabled = true;
    document.getElementById('Jeudi').disabled = true;

    toggleInputs(stagiaire1, true);
    toggleInputs(stagiaire2, true);
    toggleInputs(stagiaire3, true);  
    toggleInputs(stagiaire4, true);
    }   
    
    function resetForm2() {
        document.getElementById("search_form").reset();
        }   

    function toggleStagiaires(selectElement) {
        var stagiaire1 = document.getElementById("stagiaire1");
        var stagiaire2 = document.getElementById("stagiaire2");
        var stagiaire3 = document.getElementById("stagiaire3");
        var stagiaire4 = document.getElementById("stagiaire4");
    
        if (selectElement.value === "Monome") {
            toggleInputs(stagiaire1, false);
            toggleInputs(stagiaire2, true); 
            toggleInputs(stagiaire3, true);
            toggleInputs(stagiaire4, true);
        } else if (selectElement.value === "Binome") {
            toggleInputs(stagiaire1, false);
            toggleInputs(stagiaire2, false);
            toggleInputs(stagiaire3, true);
            toggleInputs(stagiaire4, true);
        } else if (selectElement.value === "Trinome") {
            toggleInputs(stagiaire1, false);
            toggleInputs(stagiaire2, false);
            toggleInputs(stagiaire3, false);
            toggleInputs(stagiaire4, true);
        } else if (selectElement.value === "Quadrinome") {
            toggleInputs(stagiaire1, false);
            toggleInputs(stagiaire2, false);
            toggleInputs(stagiaire3, false);
            toggleInputs(stagiaire4, false);
        }
    }

    function toggleInputs(container, enable) {
        var inputs = container.querySelectorAll("input");
        var selects = container.querySelectorAll("select");
    
        inputs.forEach(function (input) {
            input.disabled = enable;
        });
    
        selects.forEach(function (select) {
            select.disabled = enable;
        });
    }

    const structuresAffectationSelect = document.getElementById('structuresAffectation');
    const encadrantSelect = document.getElementById('encadrant_id');
    const encadrantOptions = Array.from(encadrantSelect.options);
    
    
    function populateEncadrantOptions(selectedStructuresAffectation) {
 
    encadrantSelect.innerHTML = '';

    
    encadrantOptions.forEach(option => {
        const structureId = option.getAttribute('data-structure-id');
        const parentId = option.getAttribute('data-parent');
        if (structureId === selectedStructuresAffectation || parentId === selectedStructuresAffectation || structureId === '') {
            const clone = option.cloneNode(true);
            encadrantSelect.appendChild(clone);
        }
    });
    }

    

    populateEncadrantOptions(document.getElementById('structuresAffectation').value);

    structuresAffectationSelect.addEventListener('change', function() {
        const selectedStructuresAffectation = this.value;
        populateEncadrantOptions(selectedStructuresAffectation);
        quotaVerification();
    });

    function disableFields() {
        document.getElementById('theme').disabled = true;
        document.getElementById('etablissement_id').disabled = true;
        document.getElementById('encadrant_id').disabled = true;
        document.getElementById('stagiaire_count').disabled = true;
        document.getElementById('stagiaire_count').value = document.getElementById('stagiaire_count').options[0].value;
        document.getElementById('level').disabled = true;
        document.getElementById('end_date').disabled = true;
        document.getElementById('start_date').disabled = true;
        document.getElementById('specialite_id').disabled = true;
        document.getElementById('domain').disabled = true;
        document.getElementById('Dimanche').disabled = true;
        document.getElementById('Lundi').disabled = true;
        document.getElementById('Mardi').disabled = true;
        document.getElementById('Mercredi').disabled = true;
        document.getElementById('Samedi').disabled = true;
        document.getElementById('Jeudi').disabled = true;

        toggleInputs(stagiaire1, true);
        toggleInputs(stagiaire2, true);
        toggleInputs(stagiaire3, true);  
        toggleInputs(stagiaire4, true);

    }

    function enableFields() {
        document.getElementById('theme').disabled = false;
        document.getElementById('etablissement_id').disabled = false;
        document.getElementById('encadrant_id').disabled = false;
        document.getElementById('stagiaire_count').disabled = false;
        document.getElementById('level').disabled = false;
        document.getElementById('end_date').disabled = false;
        document.getElementById('start_date').disabled = false;
        document.getElementById('specialite_id').disabled = false;
        document.getElementById('domain').disabled = false;
        document.getElementById('Dimanche').disabled = false;
        document.getElementById('Lundi').disabled = false;
        document.getElementById('Mardi').disabled = false;
        document.getElementById('Mercredi').disabled = false;
        document.getElementById('Samedi').disabled = false;
        document.getElementById('Jeudi').disabled = false;
    }


        const domainSelect = document.getElementById('domain');
        const specialiteSelect = document.getElementById('specialite_id');
        const specialiteOptions = Array.from(specialiteSelect.options);


        function populateSpecialiteOptions(selectedDomainId) {
      
            specialiteSelect.innerHTML = '';

   
            specialiteOptions.forEach(option => {
                const domaineId = option.getAttribute('domaine_id');
                

                if (domaineId === selectedDomainId || domaineId === '') {
                    const clone = option.cloneNode(true);
                    specialiteSelect.appendChild(clone);
                }
            });
        }

        domainSelect.addEventListener('change', function() {
            const selectedDomainId = this.value;
            populateSpecialiteOptions(selectedDomainId);
        });

        function rechercheType() {
            var selectValue = document.getElementById("type_recherche").value;
            var selects = document.querySelectorAll("select");
        
            selects.forEach(function(select) {
                if (select.id === selectValue) {
                    select.removeAttribute("hidden");
                    select.removeAttribute("disabled");
                } else if (select.id !== "type_recherche") {
                    select.setAttribute("hidden", true);
                    select.setAttribute("disabled", true);
                }
            });
        }

        function validateForm() {
            
            var structuresAffectation = document.getElementsByName('structuresAffectation_id')[0].value;
            var encadrant = document.getElementsByName('encadrant_id')[0].value;
            var stageType = document.getElementsByName('stage_type')[0].value;
            var etablissement = document.getElementsByName('etablissement_id')[0].value;
            var stagiaire_count = document.getElementsByName('stagiaire_count')[0].value;
            var level = document.getElementsByName('level')[0].value;
            var domaine = document.getElementsByName('domaine_id')[0].value;
            var specialite = document.getElementsByName('specialite_id')[0].value;
            var year = document.getElementsByName('year')[0].value;
            var theme = document.getElementsByName('theme')[0].value;

            if (structuresAffectation || encadrant || stageType || etablissement || stagiaire_count || level || domaine || specialite || year || theme ) {
                return true; 
            } else {
                var myModal = new bootstrap.Modal(document.getElementById('searchModal'));
                myModal.show();
                return false; 
            }
        }

        function validateFormCloture() {
    const quitusCheckboxes = document.querySelectorAll('input[name="quitus[]"]');
    let oneQuitusChecked = false;

    quitusCheckboxes.forEach(checkbox => {
        if (checkbox.checked) {
            oneQuitusChecked = true;
        }
    });

    if (!oneQuitusChecked) {
        var myModal = new bootstrap.Modal(document.getElementById('quitusModal'));
        myModal.show();
        return false;
    }

    return true;
}

function rechercheEncadrant(){
    var type_recherche = document.getElementById('type_recherche').value;
    var decoy = document.getElementById('decoy');
    var structureAffectation = document.getElementById('structureAffectation');
    var name = document.getElementById('nameee');
    if(type_recherche == 'structureAffectation'){
        decoy.hidden = true;
        decoy.disabled = true;
        structureAffectation.hidden = false;
        structureAffectation.disabled = false;
        name.hidden = true;
        name.disabled = true;
    }else if(type_recherche == 'nameee'){
        decoy.hidden = true;
        decoy.disabled = true;
        structureAffectation.hidden = true;
        structureAffectation.disabled = true;
        name.hidden = false;
        name.disabled = false;
    }
}


        
        
