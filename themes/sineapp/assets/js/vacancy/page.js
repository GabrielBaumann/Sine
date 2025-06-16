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

// Chamar formulário
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

// Chamar formulário
document.addEventListener("click", (e) => {
    const vClick = e.target.closest("button");
    if(vClick && vClick.id === "btn-info-vacancy") {
        const vUrl = vClick.dataset.url;

        fetch(vUrl)
        .then(response => response.json())
        .then(data => {
            const vForm = document.getElementById("view-form");
            vForm.innerHTML = data.html;
        })
    }
})