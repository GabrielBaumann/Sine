/**
 * Envio de formulário
 */
document.addEventListener("submit", (e)=> {
    if (e.target.tagName === "FORM") {
        e.preventDefault()

        const form = e.target;
        const formData = new FormData(form);
        const actionForm = e.target.action;

        let load;
        let timeoutLoading;

        // Agenda a exibição do "carregamento..." após 300 milesimo
        timeoutLoading = setTimeout(() => {
            load = document.createElement("div");
            load.id = "response";
            load.innerHTML = `
                <div class="alert-container space-y-3">
                    <div class="alert-message bg-white border border-gray-200 rounded-lg overflow-hidden">
                        <div class="flex items-center p-4">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center">
                                    <i class="fas fa-circle-notch text-gray-500 text-lg animate-spin"></i>
                                </div>
                            </div>
                            <div class="ml-3 flex-1">
                                <h3 class="text-sm font-semibold text-gray-800">Carregando...</h3>
                                <div class="mt-1 text-sm text-gray-600">
                                    <p>Aguarde...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            // Remove mensagem anterior (se existir) e adicona a nova
            const antigoResponse = document.getElementById("response");
            if (antigoResponse) antigoResponse.remove();
        
            document.body.appendChild(load);
        }, 300);

        fetch(actionForm, {
            method: "POST",
            body: formData
        })
        .then(response => {
            clearTimeout(timeoutLoading);

            if(!response.ok) throw new Error("Erro no servidor");

            return response.json();
        })
        .then(data => {
            
            if(data.redirected) {
                window.location.href = data.redirected
            } else {

                if(load) load.remove();

                const novoResponse = document.createElement("div")
                novoResponse.id = "response";
                novoResponse.innerHTML = data.message

                document.body.appendChild(novoResponse);

                setTimeout(() => {
                    removeElement(novoResponse)
                }, 3000)
            }
        })
        .catch(error => {
            clearTimeout(timeoutLoading);
            if(load) load.remove();
            
            console.log("Erro", error);
            
            const erroResponse = document.createElement("div");
            erroResponse.id = "response";
            erroResponse.innerHTML = `
                <div class="alert-container">
                    <div class="alert-message bg-white border border-red-400 rounded-lg p-4 text-red-700">
                        Erro inesperado. Tente novamente.
                    </div>
                </div>
            `;
           document.body.appendChild(erroResponse);

           setTimeout(() => {
                removeElement(erroResponse)
           }, 3000);            
        });
    }
});

/**
 * evento para fechar messagem
 */
document.body.addEventListener("click", (e) => {
    const botao = e.target.closest("#botao");
    const message = e.target.closest(".alert-container");

    if (botao && message) {
        message.style.transition = "opacity 0.5s ease";
        message.style.opacity = "0";
        setTimeout(() => message.remove(), 2000);
    }
})

/**
 * Função para evento de saída 
 */
function removeElement(element, duration = 1000) {
    if(!element) return;
        element.style.transition = "opacity 0.5s ease";
        element.style.opacity = "0";
    setTimeout(()=> element.remove(), duration);
}

/**
 * pesquisar valores em um input e um um select
 */
document.addEventListener("click", (e) => {
    if (e.target.id === "search"){
        const ele = document.getElementById("inputSearch");
        const nameInput = ele.name;
        const url = ele.dataset.url;
        const search = ele.value.trim();
        const formaData = new FormData();
        formaData.append(nameInput, search);

        nomeSelect = document.getElementById("selectData");
        formaData.append(nomeSelect.name, nomeSelect.value);


        fetch(url, {
            method: "POST",
            body: formaData
        } )
        .then(response => response.json())
        .then(dado => {

            if (dado.erro) {
                const novoResponse = document.createElement("div");
                novoResponse.id = "response";
                novoResponse.innerHTML = dado.message;
        
                document.body.appendChild(novoResponse);
        
                setTimeout(() => {
                    removeElement(novoResponse);
                }, 3000);
 
            } else {

                updateList.innerHTML = dado.message; // HTML da listagem
            }
        })
        .catch(error => console.log("erro ao carregar", error));
    }
});

// Pesquisar valor ao mudar valor de um select
document.addEventListener("change", (e) => {
    if (e.target.tagName === "SELECT" && e.target.id === "selectData") {
        const valor = e.target.value;
        const name = e.target.name;
        const url = e.target.dataset.url;
        const formData = new FormData();

        document.getElementById("inputSearch").value = "";
        formData.append(name, valor);

        fetch(url, {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(dado => {
            const updateList = document.getElementById("updateList");
            updateList.innerHTML = dado.message
        })
        .catch(error => console.log("erro ao carregar", error));
    }
});

// Pesquisar valor baseado em um único input
document.addEventListener("click", (e) => {
    if(e.target.id === "searchMaterial") {
        const vUrl = e.target.dataset.url;
        const form = new FormData();
        const vInputSearch = document.getElementById("inputSearch");
        const vIdRecipient = document.getElementById("idRecipient");


        form.append(vInputSearch.name, vInputSearch.value);
        form.append(vIdRecipient.name, vIdRecipient.value);

        fetch(vUrl, {
            method: "POST",
            body: form
        })
        .then(response => response.json())
        .then(data => {

            if (data.erro) {
                const novoResponse = document.createElement("div");
                novoResponse.id = "response";
                novoResponse.innerHTML = data.message;
        
                document.body.appendChild(novoResponse);
        
                setTimeout(() => {
                    removeElement(novoResponse);
                }, 3000);
 
            } else {
                // const idModal = document.getElementById("modal");
                const updateList = document.getElementById("updateListModal");
                // idModal.appendChild(updateList);
                updateList.innerHTML = data.message; // HTML da listagem
            }
        })
        .catch(error => console.log("erro ao carregar", error));
    }
})