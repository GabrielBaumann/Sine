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

// formulário de edição
document.addEventListener("click", (e) => {
    const vClick = e.target.closest("button");
    if(vClick && vClick.id === "btn-edit") {
        const vUrl = vClick.dataset.url;
        fetch(vUrl)
        .then(response => response.json())
        .then(data => {
            const vForm = document.getElementById("companiesView");
            vForm.innerHTML = data.html;
            fncDesabledInput();
        });
    }
});


// Verificar se o CNPJ é válido e se já existe na base
document.addEventListener("focusout", (e) => {
    if(e.target.id === "cnpj"){

        if (e.target.value != "") {
            const vUrl = e.target.dataset.url;
            const vCnpjClean = e.target.value.replace(/\D/g, '');
            const vForm = new FormData();
            vForm.append(e.target.name, vCnpjClean);

            let vtimeLoading = showSplash();

            fetch(vUrl, {
                method: "post",
                body: vForm
            })
            .then(response => {
                clearTimeout(vtimeLoading);
                return response.json();
            })
            .then(data => {
                console.log("teste");
                if(!data.complete) {
                    fncMessage(data.message);
                    document.getElementById("cnpj").value = "";
                }

                if(data.complete === true) {
                    if(document.getElementById("response")) document.getElementById("response").remove();
                }
            })
        }
    }  
})

fncSatusColorCompany()
function fncSatusColorCompany() {
    const vSpan = document.querySelectorAll("span.status-company");
    vSpan.forEach((e) => {
        if(e.textContent === "Cancelada") {
            e.classList.replace("text-blue-800","text-red-800")
            e.classList.replace("bg-blue-200","bg-red-200")
        }
    })
}

// Bloquear inputs caso a empresa estiver cancelada
function fncDesabledInput() {
    const vInput = document.querySelectorAll("input");
    const vInputId = document.getElementById("active-company").value;
    if(vInputId === "Cancelada") {
        vInput.forEach((e) => {
            e.disabled = true;
            e.style.backgroundColor = "#f2f2f2";
            e.style.color = "#666";
            e.style.cursor = "not-allowed";
            e.style.borderColor = "#ccc";
        });
    }
}