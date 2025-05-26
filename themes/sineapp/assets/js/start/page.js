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