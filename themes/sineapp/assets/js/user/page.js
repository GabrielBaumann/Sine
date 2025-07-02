fncStatusUserSystem();
// Chamar formulário
document.addEventListener("click", (e) => {
    const vClick = e.target.closest("button");
    if(vClick && vClick.id === "btn-form") {
        const vUrl = vClick.dataset.url;
        fetch(vUrl)
        .then(response => response.json())
        .then(data => {
            const vForm = document.getElementById("usersView");
            vForm.innerHTML = data.html;
            fncDesabledInput()
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

// Bloquear inputs caso a empresa estiver cancelada
function fncDesabledInput() {
    const vInput = document.querySelectorAll("input, select");
    const vInputId = document.getElementById("active-user")?.value;

    if(vInputId === "2") {
        vInput.forEach((e) => {
            e.disabled = true;
            e.style.backgroundColor = "#f2f2f2";
            e.style.color = "#666";
            e.style.cursor = "not-allowed";
            e.style.borderColor = "#ccc";
        });
    }
}