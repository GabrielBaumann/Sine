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

            const vListUpdate = document.getElementById("listMorkes");
            vListUpdate.innerHTML = data.html;
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

// Interceptar o paginador
document.addEventListener("click", (e) => {
    const vLinkPaginator = e.target.closest(".paginator_item");

    if (vLinkPaginator) {
        e.preventDefault();
        const vContent = document.getElementById("content");
        const vidWork = document.getElementById("id-worker")?.value || "" ;
        const vUrl = vLinkPaginator.href

       fetch(vUrl + "/" + vidWork)
       .then(response => response.json())
       .then(data => {
            console.log(data.html);
            vContent.innerHTML = data.html;
       })
    };
});