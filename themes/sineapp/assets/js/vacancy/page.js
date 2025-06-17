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
        
            const vCheckVacancy = document.querySelectorAll("input.check-vacancy").forEach((e) => {
                const vTr = e.closest("tr").querySelector("span").textContent;
                if(vTr === "Encerrada") {
                    const vInputs = e.closest("tr").querySelectorAll("input");
                    vInputs[0].disabled = true;
                    e.checked = true;
                }
            });
        });
    }
});

// Marcar todos os checksbox
document.addEventListener("click", (e) => {
    const vCheckClik = e.target.id;

    if(vCheckClik === "chek-vacancy" && e.target.checked === true){
        const vChek = document.querySelectorAll(".check-vacancy").forEach((e) => {
            if(e.disabled === false) {
                e.checked = true
            }    
        });
    }

    if(vCheckClik === "chek-vacancy" && e.target.checked === false){
        const vChek = document.querySelectorAll(".check-vacancy").forEach((e) => {
            if(e.disabled === false) {
                e.checked = false
            }    
        });
    }
});

// Encerrar vagas
document.addEventListener("click", (e) => {
    if(e.target.id === "btn-closed-vacancy"){
        console.log(e.target.dataset.url)
        
    }
})