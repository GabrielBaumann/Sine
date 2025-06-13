// Chamar formulário
document.addEventListener("click", (e) => {
    const vClick = e.target.closest("button");
    if(vClick && vClick.id === "btn-new-company") {
        const vUrl = vClick.dataset.url;
        fetch(vUrl)
        .then(response => response.json())
        .then(data => {
            const vForm = document.getElementById("companiesView");
            vForm.innerHTML = data.html;
        });
    }
});

// Verificar se o CNPJ é válido e se já existe na base
document.addEventListener("focusout", (e) => {
    if(e.target.id === "cnpj"){
        const vUrl = e.target.dataset.url;
        const vCnpjClean = e.target.value.replace(/\D/g, '');
        const vForm = new FormData();
        vForm.append(e.target.name, vCnpjClean);

        fetch(vUrl, {
            method: "post",
            body: vForm
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
        })
    }  
})