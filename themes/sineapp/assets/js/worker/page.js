fncUpdateColorStatus();
// Pesquisar nome dos candidatos baseado em cada letra (alteração)
// document.addEventListener("input", (e) => {
//     if (e.target.id === "search") {
//         const vElement = e.target;
//         const vUrlSearch = vElement.dataset.url;
//         const vSearcheValue = vElement.value;
//         const vForm = new FormData();
//         vForm.append(vElement.name, vSearcheValue);

//         // alert(vFormData);
//         fetch(vUrlSearch, {
//             method: "POST",
//             body: vForm
//         })
//         .then(response => response.json())
//         .then(data => {

//             const vListUpdate = document.getElementById("listWorkes");
//             vListUpdate.innerHTML = data.html;
//             fncUpdateColorStatus();
//         })
//     }
// });

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
