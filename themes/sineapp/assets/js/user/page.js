fncStatusUserSystem();
// Chamar formulário
document.addEventListener("click", (e) => {
    const vClick = e.target.closest("button");
    if(vClick && vClick.id === "btn-new-user") {
        const vUrl = vClick.dataset.url;
        fetch(vUrl)
        .then(response => response.json())
        .then(data => {
            const vForm = document.getElementById("usersView");
            vForm.innerHTML = data.html;
        });
    }
});

// função de Status dos usuarios

function fncStatusUserSystem() {
    const vSpan = document.querySelectorAll("span.status-user-system");
    vSpan.forEach((e) => {
        if(e.textContent === "Cancelado") {
            e.classList.replace("bg-blue-200","bg-red-200");
            e.classList.replace("text-blue-800","text-red-800");
        }
    });
}
