fncUpdateColorStatus();

// Chamar histórico a partir do clique no usuário
document.addEventListener("click", (e) => {
    const vTr = e.target.closest("button");
    if(vTr && vTr.id === "btn-edit") {
        const vContent = document.getElementById("content");
        if(vTr){
            const vUrlIdWorker = vTr.dataset.url;

            fetch(vUrlIdWorker)
            .then(response => response.json())
            .then(data => {
                vContent.innerHTML = data.html;
            })
        }
    }
});


// Mudar a cor do status da tabela
function fncUpdateColorStatus() {
    
    const table = [...document.getElementsByTagName("tr")];

    table.map((e) => {
        let vElementSpan = [...e.getElementsByTagName("span")] 
        vElementSpan.map((e) => {
            if(e.innerText === "Reprovado") {
                e.classList.replace("bg-blue-200", "bg-red-200")
                e.classList.replace("text-blue-800", "text-red-800")
            }

            if(e.innerText === "Aguardando Resposta") {
                e.classList.replace("bg-blue-200", "bg-orange-200")
                e.classList.replace("text-blue-800", "text-orange-800")
            }

            if(e.innerText === "Atendimento Realizado") {
                e.classList.replace("bg-blue-200", "bg-blue-200")
                e.classList.replace("text-blue-800", "text-blue-800")
            }
        })
    })
}

/*########################################*/
/*#############  Modal yes/no ############*/
/*########################################*/

// Cancelar ação
document.addEventListener("click", (e) => {
    if(e.target.id === "cancelBtn") {
        document.getElementById('modal').remove();
    }
});

// Fechar modal clicando no overlay (fora da modal)
document.addEventListener("click", (e) => {
    if(e.target.id === "confirmationModal") {
        document.getElementById("modal").remove();
    }
})

// Fechar com ESC
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        document.getElementById('modal').remove();
    }
});

