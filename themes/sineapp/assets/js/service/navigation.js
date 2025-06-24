// Baseado na lista de empresas encontrar as vagas abertas
let vLasId = null;
let vCompanySelect = null;

document.addEventListener("click", (e) => {

    if(e.target.tagName === "SELECT" && e.target.id === "company-name"){
        vCompanySelect = document.getElementById("company-name");
        vOccupationSelect = document.getElementById("occupation-id-vacancy");

        const vUrl = e.target.dataset.url;
        if(vCompanySelect.dataset.loaded === "true" && vLasId !== null) return;

        fetch(vUrl)
        .then(response => response.json())
        .then(data => {

            data.sort((a, b) => a.name_enterprise.localeCompare(b.name_enterprise));

            document.querySelectorAll("option.company").forEach(el => el.remove());

            data.forEach(company => {
                const vOption = document.createElement("option");
                vOption.value = company.id_enterprise;
                vOption.classList.add("company");
                vOption.textContent = company.name_enterprise;
                vCompanySelect.appendChild(vOption);
            });

            vCompanySelect.dataset.loaded =  "true";
        });
    }
});


document.addEventListener("change", (e) => {
    
    vOccupationSelect = document.getElementById("occupation-id-vacancy");
    const vCompanyId = vCompanySelect?.value;
    const vUrl = vCompanySelect?.dataset.url;

    if(vOccupationSelect.dataset.loaded === "true" && vLasId === vCompanyId) return;
    
    vLasId = vCompanyId;

    vOccupationSelect.innerHTML = '<option value="">Carregando...</option>';
    vOccupationSelect.disabled = true;


    if(vCompanyId) {
        
        fetch(`${vUrl}/${vCompanyId}`)
        .then(response => response.json())
        .then(data => {

            vOccupationSelect.innerHTML = '<option value="">Selecione uma ocupação</option>';
            data.sort((a, b) => a.nomeclatura_vacancy.localeCompare(b.nomeclatura_vacancy));
            data.forEach(cbo => {
                const vOption = document.createElement("option");
                vOption.value = cbo.id_vacancy;
                vOption.textContent = `${cbo.number_vacancy}ª - ${cbo.nomeclatura_vacancy}`;
                vOccupationSelect.appendChild(vOption);
            });
            vOccupationSelect.disabled = false;
            vOccupationSelect.dataset.loaded =  "true";
        })
        .catch(error => {
            vOccupationSelect.innerHTML = '<option value="">Erro ao carregar vagas</option>';
        })
    } else {
        vOccupationSelect.innerHTML = '<option value="">Selecione uma empresa primeiro</option>';
        vOccupationSelect.disabled = true;
    }
});