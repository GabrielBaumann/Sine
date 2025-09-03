// Baseado na lista de empresas encontrar as vagas abertas
let vLasId = null;
let vCompanySelect = null;

// Empresas que tenham vaga
document.addEventListener("click", (e) => {

    if(e.target.tagName === "SELECT" && e.target.id === "company-name"){
        vCompanySelect = document.getElementById("company-name");
        vOccupationSelect = document.getElementById("occupation-id-vacancy");

        const vUrl = e.target.dataset.url;
        if(vCompanySelect.dataset.loaded === "true" && vLasId !== null) return;

        fetch(vUrl)
        .then(response => response.json())
        .then(data => {

            data.sort((a, b) => a.name_fantasy_enterpise.localeCompare(b.name_fantasy_enterpise));

            document.querySelectorAll("option.company").forEach(el => el.remove());

            data.forEach(company => {
                const vOption = document.createElement("option");
                vOption.value = company.id_enterprise;
                vOption.classList.add("company");
                vOption.textContent = company.name_fantasy_enterpise;
                vCompanySelect.appendChild(vOption);
            });

            vCompanySelect.dataset.loaded =  "true";
        });
    }
});

// Filtrar vagas por empresa
document.addEventListener("change", (e) => {
    
    vOccupationSelect = document.getElementById("occupation-id-vacancy");
    
    if(vOccupationSelect) {

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
                    vOption.textContent = `${cbo.number_vacancy}ª - ${cbo.nomeclatura_vacancy} (${cbo.gender_vacancy[0]}) - ${cbo.total_vacancy_forwarding}`;
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
    }
});

// Select para empresa
document.addEventListener("click", (e) => {

    if(e.target.id === "company-name") {
        $(document).ready(function() {
            $('#occupation-id-vacancy').select2({
                placeholder: 'Selecione uma empresa',
                allowClear: true // permite limpar a seleção
            });
        });        
    }
})

// Mostrar ou ocultar os tipos de deficiências
document.addEventListener("change", async (e) => {
    const vChangeSelect = e.target;

    if(vChangeSelect.tagName === "SELECT" && vChangeSelect.id === "pcd") {
        
        const vElementeGet = document.getElementById("pcd-type");

        if(vChangeSelect.value === "SIM") {
            vElementeGet.classList.remove("hidden");
        } else {
            vElementeGet.classList.add("hidden");
        }
    }
})