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