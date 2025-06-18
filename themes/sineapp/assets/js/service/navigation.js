// Baseado na lista de empresas encontrar as vagas abertas
document.addEventListener("click", (e) => {
    if (e.target.tagName === "SELECT" && e.target.id === "company-name") {
        const vCompanySelect = document.getElementById("company-name");
        const vOccupationSelect = document.getElementById("occupation");

        const vUrl = e.target.dataset.url;
        fetch(vUrl)
        .then(response => response.json())
        .then(data => {

            data.sort((a, b) => a.name_enterprise.localeCompare(b.name_enterprise));

            // document.querySelectorAll("option").forEach((el) => {
            //     if (el.classList.contains("company")) {
            //         el.remove();
            //     }                
            // });

            document.querySelectorAll("option").forEach((el) => {
                // console.log(el.selected === true);

                if(el.selected){

                }else{
                    if (el.classList.contains("company")) {
                    el.remove();
                }  
                }
            })

            data.forEach(company => {
                const vOption = document.createElement("option");
                vOption.value = company.id_enterprise;
                vOption.classList.add("company");
                vOption.textContent = company.name_enterprise;
                vCompanySelect.appendChild(vOption);
            });

        });

        vCompanySelect.addEventListener("change", () => {
            const vCompanyId = vCompanySelect.value;

            vOccupationSelect.innerHTML = '<option value="">Carregando...</option>';
            vOccupationSelect.disabled = true;

            if(vCompanyId) {
                
                fetch(vUrl + "/" + vCompanyId)
                .then(response => response.json())
                .then(data => {

                    vOccupationSelect.innerHTML = '<option value="">Selecione uma ocupação</option>';
                    data.sort((a, b) => a.nomeclatura_vacancy.localeCompare(b.nomeclatura_vacancy));
                    data.forEach(cbo => {
                        const vOption = document.createElement("option");
                        vOption.value = cbo.cbo_occupation;
                        vOption.textContent = cbo.nomeclatura_vacancy;
                        vOccupationSelect.appendChild(vOption);
                    });
                    vOccupationSelect.disabled = false;

                })
                .catch(error => {
                    vOccupationSelect.innerHTML = '<option value="">Erro ao carregar vagas</option>';
                })
            } else {
                vOccupationSelect.innerHTML = '<option value="">Selecione uma empresa primeiro</option>';
                vOccupationSelect.disabled = true;
            }
        });

    }
});