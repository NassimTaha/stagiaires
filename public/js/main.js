document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type');
    const parentSelect = document.getElementById('parent_id');

    typeSelect.addEventListener('change', function() {
        if (this.value === 'Departement') {
            parentSelect.removeAttribute('disabled');
        } else {
            parentSelect.setAttribute('disabled', 'disabled');
        }
    });
});

function goBack() {
    window.history.back();
}

function rechercheType() {
    var selectValue = document.getElementById("type_recherche").value;
    var selects = document.querySelectorAll("select");
    var inputName = document.getElementById("name");

    selects.forEach(function(select) {
        if (select.id === selectValue) {
            select.removeAttribute("hidden");
            select.removeAttribute("disabled");
        } else if (select.id !== "type_recherche" && select.id !== "year") {
            select.setAttribute("hidden", true);
            select.setAttribute("disabled", true);
        }
    });

    if (selectValue === "name") {
        inputName.removeAttribute("hidden");
        inputName.removeAttribute("disabled");
    } else {
        inputName.setAttribute("hidden", true);
        inputName.setAttribute("disabled", true);
    }
}

    function validateForm() {
        var structuresAffectation = document.getElementsByName('structuresIAP_id')[0].value;
        var stageType = document.getElementsByName('stage_type')[0].value;
        var etablissement = document.getElementsByName('etablissement_id')[0].value;
        var stagiaire_count = document.getElementsByName('stagiaire_count')[0].value;
        var level = document.getElementsByName('level')[0].value;
        var domaine = document.getElementsByName('domaine_id')[0].value;
        var specialite = document.getElementsByName('specialite_id')[0].value;
        var year = document.getElementsByName('year')[0].value;
        var stage_annuleOui = document.getElementsByName('stage_annuleOui')[0].checked;
        var stage_annuleNon = document.getElementsByName('stage_annuleNon')[0].checked;
        var clotureOui = document.getElementsByName('clotureOui')[0].checked;
        var clotureNon = document.getElementsByName('clotureNon')[0].checked;
    
        if (structuresAffectation || stageType || etablissement || stagiaire_count || level || domaine || specialite || year || stage_annuleOui || stage_annuleNon || clotureOui || clotureNon) {
            return true; 
        } else {
            var myModal = new bootstrap.Modal(document.getElementById('searchModal'));
            myModal.show();
            return false; 
        }
    }

    function resetForm2() {
    document.getElementById("search_form").reset();
    }   

    function rechercheDomaine(){
        var type_recherche = document.getElementById('type_recherche').value;
        var structure = document.getElementById('structure');
        var nameee = document.getElementById('nameee');
        var decoy = document.getElementById('decoy');
        if(type_recherche == 'structure'){
            structure.removeAttribute('disabled');
            structure.removeAttribute('hidden');
            nameee.setAttribute('disabled', 'true');
            nameee.setAttribute('hidden', 'true');
            decoy.setAttribute('hidden', 'true');
        }else if(type_recherche == 'nameee'){
            nameee.removeAttribute('disabled');
            nameee.removeAttribute('hidden');
            structure.setAttribute('disabled', 'true');
            structure.setAttribute('hidden', 'true');
            decoy.setAttribute('hidden', 'true');
        }else{
            structure.setAttribute('disabled', 'true');
            structure.setAttribute('hidden', 'true');
            nameee.setAttribute('disabled', 'true');
            nameee.setAttribute('hidden', 'true');
            decoy.setAttribute('hidden', 'true');
        }
    }

    function rechercheEncadrant(){
        var type_recherche = document.getElementById('type_recherche').value;
        var decoy = document.getElementById('decoy');
        var structure = document.getElementById('structure');
        var structureAffectation = document.getElementById('structureAffectation');
        var name = document.getElementById('nameee');
        if(type_recherche == 'structure'){
            decoy.hidden = true;
            decoy.disabled = true;
            structure.hidden = false;
            structure.disabled = false;
            structureAffectation.hidden = true;
            structureAffectation.disabled = true;
            name.hidden = true;
            name.disabled = true;
        }else if(type_recherche == 'structureAffectation'){
            decoy.hidden = true;
            decoy.disabled = true;
            structure.hidden = true;
            structureAffectation.hidden = false;
            structureAffectation.disabled = false;
            name.hidden = true;
            name.disabled = true;
        }else if(type_recherche == 'nameee'){
            decoy.hidden = true;
            decoy.disabled = true;
            structure.hidden = true;
            structure.disabled = true;
            structureAffectation.hidden = true;
            structureAffectation.disabled = true;
            name.hidden = false;
            name.disabled = false;
        }
    }

    function rechercheSpecialite(){
        var type_recherche = document.getElementById('type_recherche').value;
        var decoy = document.getElementById('decoy');
        var structure = document.getElementById('structure');
        var domaine = document.getElementById('domaine');
        var nameee = document.getElementById('nameee');
        if(type_recherche == 'structure'){
            decoy.hidden = true;
            structure.hidden = false;
            structure.disabled = false;
            domaine.hidden = true;
            domaine.disabled = true;
            nameee.hidden = true;
            nameee.disabled = true;
        }else if(type_recherche == 'domaine'){
            decoy.hidden = true;
            structure.hidden = true;
            structure.disabled = true;
            domaine.hidden = false;
            domaine.disabled = false;
            nameee.hidden = true;
            nameee.disabled = true;
        }else if(type_recherche == 'nameee'){
            decoy.hidden = true;
            structure.hidden = true;
            structure.disabled = true;
            domaine.hidden = true;
            domaine.disabled = true;
            nameee.hidden = false;
            nameee.disabled = false;
        }
    }

    function rechercheAffectation(){
        var type = document.getElementById('type_recherche').value;
        if(type == 'structureIAP'){
            document.getElementById('decoy').setAttribute('hidden', 'true');
            document.getElementById('decoy').setAttribute('disabled', 'true');
            document.getElementById('structureIAP').removeAttribute('hidden');
            document.getElementById('structureIAP').removeAttribute('disabled');
            document.getElementById('typeee').setAttribute('hidden', 'true');
            document.getElementById('typeee').setAttribute('disabled', 'true');
            document.getElementById('nameee').setAttribute('hidden', 'true');
            document.getElementById('nameee').setAttribute('disabled', 'true');
        }else if(type == 'typeee'){
            document.getElementById('decoy').setAttribute('hidden', 'true');
            document.getElementById('decoy').setAttribute('disabled', 'true');
            document.getElementById('typeee').removeAttribute('hidden');
            document.getElementById('typeee').removeAttribute('disabled');
            document.getElementById('structureIAP').setAttribute('hidden', 'true');
            document.getElementById('structureIAP').setAttribute('disabled', 'true');
            document.getElementById('nameee').setAttribute('hidden', 'true');
            document.getElementById('nameee').setAttribute('disabled', 'true');
        }else if(type == 'nameee'){
            document.getElementById('decoy').setAttribute('hidden', 'true');
            document.getElementById('decoy').setAttribute('disabled', 'true');
            document.getElementById('nameee').removeAttribute('hidden');
            document.getElementById('nameee').removeAttribute('disabled');
            document.getElementById('structureIAP').setAttribute('hidden', 'true');
            document.getElementById('structureIAP').setAttribute('disabled', 'true');
            document.getElementById('typeee').setAttribute('hidden', 'true');
            document.getElementById('typeee').setAttribute('disabled', 'true');
        }
    }

    function handleClotureOui() {
        const clotureOui = document.getElementById('clotureOui');
        const clotureNon = document.getElementById('clotureNon');
        if(clotureNon.checked){
            clotureOui.checked = true;
            clotureNon.checked = false;
        }
    }

    function handleClotureNon() {
        const clotureOui = document.getElementById('clotureOui');
        const clotureNon = document.getElementById('clotureNon');
        if(clotureOui.checked){
            clotureNon.checked = true;
        clotureOui.checked = false;
        }
     
    }

    function handleStageAnnuleOui() {
        const stageAnnuleOui = document.getElementById('stage_annuleOui');
        const stageAnnuleNon = document.getElementById('stage_annuleNon');
        if(stageAnnuleNon.checked){
            stageAnnuleOui.checked = true;
            stageAnnuleNon.checked = false;
        }
        
    }

    function handleStageAnnuleNon() {
        const stageAnnuleOui = document.getElementById('stage_annuleOui');
        const stageAnnuleNon = document.getElementById('stage_annuleNon');
        if(stageAnnuleOui.checked){
            stageAnnuleNon.checked = true;
            stageAnnuleOui.checked = false;
        }
        
    }


