fncUpdateColorStatusVacancy();
fnccheckBoxVacancy();
fncCheckClosedVacancy();
removeFlash();

// função para Atualização dos status das vagas - lista
function fncUpdateColorStatusVacancy(){
    const vSpan = document.querySelectorAll("span").forEach((ele) => {
        if(ele.classList.contains("status-vacancy")) {
            if(ele.textContent === "Encerrada") {
                ele.classList.replace("text-blue-800","text-orange-800");
                ele.classList.replace("bg-blue-200","bg-orange-200");
            }
        }
    });
}

// Função para marcar e desmarcar todas as checkbox
function fnccheckBoxVacancy () {
    document.addEventListener("click", (e) => {
    const vCheckClik = e.target.id;
        
        if(vCheckClik === "chek-vacancy" && e.target.checked === true){
            document.querySelectorAll(".check-vacancy").forEach((e) => {
                if(e.disabled === false) {
                    e.checked = true
                    document.querySelector("#info").classList.remove("hidden");
                }    
            });
        }

        if(vCheckClik === "chek-vacancy" && e.target.checked === false){
            document.querySelectorAll(".check-vacancy").forEach((e) => {
                if(e.disabled === false) {
                    e.checked = false
                    document.querySelector("#info").classList.add("hidden");

                    // Remover a cor vermelha da mensagem de erro do input
                    const vAlert = document.querySelector(".requerid-alert") ;
                    if(vAlert) {
                        vAlert.classList.remove("requerid-alert");
                    }
                }    
            });
        }
    });
}

// Função para marcar o checkbox encerrados
function fncCheckClosedVacancy() {
    
    if(document.getElementById("chek-vacancy")) {

        const vCheckVacancy = document.querySelectorAll("input.check-vacancy");
        let vCounter = 0;

        vCheckVacancy.forEach((e) => {
            const vTr = e.closest("tr").querySelector("span").textContent;
            if(vTr === "Encerrada") {
                const vInputs = e.closest("tr").querySelectorAll("input");
                vInputs[0].disabled = true;
                e.checked = true;
                vCounter++;
            }
        });

        // Verificar se todos estão encerrador para bloquear o check principal e o botão de editar
        if(vCounter === vCheckVacancy.length) {
            document.getElementById("chek-vacancy").disabled = true;
            // document.getElementById("btn-new-vacancy").disabled = true;
        }
    }
}

// Chamar formulário nova vaga
document.addEventListener("click", (e) => {
    const vClick = e.target.closest("button");
    if(vClick && vClick.id === "btn-new-vacancy") {
        const vUrl = vClick.dataset.url;

        fetch(vUrl)
        .then(response => response.json())
        .then(data => {
            const vForm = document.getElementById("view-form");
            vForm.innerHTML = data.html;

            // Caixa select de lista de ocupações (CBO)
            $(document).ready(function() {
                $('#cbo-occupation').select2({
                    placeholder: 'Selecione uma CBO ou Ocupação',
                    allowClear: true, // permite limpar a seleção
                    language: {
                        noResults: function() {
                            return "Não há ocupação para essa pesquisa!"
                        }
                    }
                });
            });
            
            // Caixa select de lista de empresas
            $(document).ready(function() {
                $('#enterprise').select2({
                    placeholder: 'Selecione uma empresa',
                    allowClear: true, // permite limpar a seleção
                    language: {
                        noResults: function() {
                            return "Não há empresa para essa pesquisa!"
                        }
                    }
                });
            });
        })
    }
})

// Chamar tabela de informações das vagas
document.addEventListener("click", (e) => {
    const vClick = e.target.closest("button");
    if(vClick && vClick.id === "btn-info-vacancy") {
        const vUrl = vClick.dataset.url;

        fetch(vUrl)
        .then(response => response.json())
        .then(data => {
            const vForm = document.getElementById("view-form");
            vForm.innerHTML = data.html;
        
            fncCheckClosedVacancy()
        });
    }
});

// Clique no checkbox individual e mostrar o botão de encerrar
document.addEventListener("click", (e) => {
    const vButton = e.target.classList.contains("check-vacancy");
    if(vButton){
        if(e.target.checked) {
            document.querySelector("#info").classList.remove("hidden");
        } else {
            
            document.querySelectorAll(".check-vacancy").forEach((e) => {
                if(e.disabled === false) {

                    let vCont = 0;

                    document.querySelectorAll("input.check-vacancy").forEach((e) => {
                        if(e.checked === true && !e.disabled) {
                            vCont++
                        }
                    })

                    if(vCont === 0) {
                        document.querySelector("#info").classList.add("hidden");
                        document.getElementById("chek-vacancy").checked = false;
                        
                        // Remover a cor vermelha da mensagem de erro do input
                        const vAlert = document.querySelector(".requerid-alert") ;
                        if(vAlert) {
                            vAlert.classList.remove("requerid-alert");
                        }

                    } 
                }
            }) 
        }
    }
});

// Atualização da página de informações da vaga
document.addEventListener("click", async (e) => {
    const vButton = e.target.closest("BUTTON");
    if(vButton && vButton.id === "btn-closed-mirror-vacancy") {
        const vUrl = vButton.dataset.url;
        const vFlash = showSplash(true);

        try{
            const vResponse = await fetch(vUrl);
            
            const vData = await vResponse.json();

            vElement = document.getElementById("view-form");
            vElement.innerHTML = vData.html;
            fncCheckClosedVacancy()

            if(vData.message) {
                fncMessage(vData.message);
            }

        } catch (err) {
            fncMessage();
        } finally {
            vFlash?.remove();
        }
    }
})

// Modal de confirmação de exclusãode vaga
fncModalQuest("btn-delete-vacancy");

// Modal de confirmação para ocultar painel
fncModalQuest("btn-hiden-panel");

// Modal de confirmação para ocultar vaga
fncModalQuest("btn-hide-vacancy");

// Modal de detalhe de encaminhamento para vaga
fncModalQuest("btn-detail-vacancy");

// Modal de confirmação para reativar vaga
fncModalQuest("btn-reactivate-vacancy");

// Modal com detalhe dos encaminhamentos por vaga
document.addEventListener("click", (e) => {
    const vButton = e.target.closest("a");
    if(vButton && vButton.id === "btn-detail-vacancy") {
        const vUrl = vButton.dataset.url;
        fetch(vUrl)
        .then(response => response.json())
        .then(data => {

            document.getElementById("response")?.remove();
            if (document.getElementById("modal")) return document.getElementById("modal").remove();

            if(data.message) {
                fncMessage(data.message);
                return;
            }
            const vElement = document.createElement("div");
            vElement.id = "modal";
            vElement.innerHTML = data.html;
            document.body.appendChild(vElement);
        })
    }
});