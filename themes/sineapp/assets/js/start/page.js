fncUpdateColorStatus();
// Pesquisar nome dos candidatos baseado em cada letra (alteração)
document.addEventListener("input", (e) => {
    if (e.target.id === "search") {
        const vElement = e.target;
        const vUrlSearch = vElement.dataset.url;
        const vSearcheValue = vElement.value;
        const vForm = new FormData();
        vForm.append(vElement.name, vSearcheValue);

        // alert(vFormData);
        fetch(vUrlSearch, {
            method: "POST",
            body: vForm
        })
        .then(response => response.json())
        .then(data => {

            const vListUpdate = document.getElementById("listWorkes");
            vListUpdate.innerHTML = data.html;
            fncUpdateColorStatus();
        })
    }
});

// Chamar histórico a partir do clique no usuário
document.addEventListener("click", (e) => {
    const vTr = e.target.closest("tr");
    const vContent = document.getElementById("content");
    if(vTr){
        const vUrlIdWorker = vTr.dataset.url;

        fetch(vUrlIdWorker)
        .then(response => response.json())
        .then(data => {
            vContent.innerHTML = data.html;
        })
    }
});

// Paginação via ajax
document.addEventListener("click", (e) => {
    const vLinkPaginator = e.target.closest(".paginator_item");

    if (vLinkPaginator) {
        e.preventDefault();

        const vidWork = document.getElementById("id-worker")?.value || "" ;
        const vUrl = vLinkPaginator.href

       fetch(vUrl + "/" + vidWork)
       .then(response => response.json())
       .then(data => {
            const vContent = document.getElementById(data.content);
            vContent.innerHTML = data.html;
            
            fncUpdateColorStatus()
       })
    };
});

// Mudar a cor do status da tabela

function fncUpdateColorStatus() {
    const table = [...document.getElementsByTagName("tr")];

    table.map((e) => {
        let vElementSpan = [...e.getElementsByTagName("span")] 
        vElementSpan.map((e) => {
            if(e.innerText === "Reprovado") {
                e.classList.replace("bg-green-100", "bg-red-100")
            }

            if(e.innerText === "Aguardando Respostas") {
                e.classList.replace("bg-green-100", "bg-orange-100")
            }

            if(e.innerText === "Atendimento Realizado") {
                e.classList.replace("bg-green-100", "bg-blue-100")
            }
        })
    })
}
