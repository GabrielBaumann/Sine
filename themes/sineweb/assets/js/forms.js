let load = "";

/**
 * Envio de formulário
 */
document.addEventListener("submit", (e)=> {

    if (e.target.tagName === "FORM") {
        e.preventDefault()

        const form = e.target;
        const formData = new FormData(form);
        const actionForm = e.target.action;

        let timeoutLoading;

        // Agenda a exibição do "carregamento..." após 300 milesimo
        timeoutLoading = showSplash()

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

// Remove mensagem flash
window.onload = function () {
    const e = document.querySelector('.alert-container');
    if(e) {
        setTimeout(() => {
            removeElement(e, 3000);
        }, 3000);
    }
}


// Função para chamar tela de splash e remover mensagens anteriores
function showSplash () {
    return setTimeout(() => {
        document.body.appendChild(fncSplash());
    }, 300)
}

// Funcção que cria tela de splash
function fncSplash() {
    load = document.createElement("div");
    load.id = "response";
    load.innerHTML = 
    `
        <div class="main h-full w-full bg-gray-50 absolute top-0 left-0">
            <div class="container mx-auto px-4 h-full flex items-center justify-center">
                <div class="text-center">
                    <!-- Texto animado -->
                    <h1 class="text-4xl md:text-5xl font-normal text-gray-800">
                        Carregando
                    </h1>
                    <div class="dots flex space-x-6 mt-10 justify-center">
                        <div class="dot-1 w-6 h-6 bg-blue-900"></div>
                        <div class="dot-2 w-6 h-6 bg-blue-600"></div>
                        <div class="dot-3 w-6 h-6 bg-blue-500"></div>
                    </div>
                </div>
            </div>
        </div>

        `;
    return load;
}