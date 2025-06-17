fncUpdateColorStatusVacancy();

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
                document.getElementById("btn-new-vacancy").disabled = true;
            }

        });
    }
});

// Marcar todos os checksbox
document.addEventListener("click", (e) => {
    const vCheckClik = e.target.id;

    if(vCheckClik === "chek-vacancy" && e.target.checked === true){
        document.querySelectorAll(".check-vacancy").forEach((e) => {
            if(e.disabled === false) {
                e.checked = true
                document.querySelector("#btn-closed-vacancy").classList.remove("hidden");
            }    
        });
    }

    if(vCheckClik === "chek-vacancy" && e.target.checked === false){
        document.querySelectorAll(".check-vacancy").forEach((e) => {
            if(e.disabled === false) {
                e.checked = false
                document.querySelector("#btn-closed-vacancy").classList.add("hidden");
            }    
        });
    }
});

// Clique no checkbox individual e mostrar o botão de encerrar
document.addEventListener("click", (e) => {
    const vButton = e.target.classList.contains("check-vacancy");
    if(vButton){
        if(e.target.checked) {
            document.querySelector("#btn-closed-vacancy").classList.remove("hidden");
        } else {
            
            document.querySelectorAll(".check-vacancy").forEach((e) => {
                if(e.disabled === false) {
                    if(e.checked === false) {
                        document.querySelector("#btn-closed-vacancy").classList.add("hidden");
                    } 
                    if(e.checked === true) {
                        document.querySelector("#btn-closed-vacancy").classList.remove("hidden");
                    }
                }
            }) 
        }
    }
});