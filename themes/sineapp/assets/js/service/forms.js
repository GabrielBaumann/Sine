/**
 * Envio de formulário
 */
document.addEventListener("submit", (e)=> {
    if (e.target.tagName === "FORM") {
        e.preventDefault()

        const form = e.target;
        const formData = new FormData(form);
        const actionForm = e.target.action;
        const formId = e.target.id;

        let load = document.getElementById("response");
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

            if (data.erro === false) {
                const vHtmlAjax = document.getElementById("newElement");
                vHtmlAjax.innerHTML = data.html;
                if(load) load.remove();
                
            } else {
                if(load) load.remove();
                fncMessage(data.message);
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

// Função de mensagem para usuário
function fncMessage(vText = "Atenção algo de errado não está certo!") {
    const vResponse = document.createElement("div");
    vResponse.id = "response";
    vResponse.innerHTML =   vText;
    const vResponseBefore = document.getElementById("response");
    if (vResponseBefore) vResponseBefore.remove();

    document.body.appendChild(vResponse);

    setTimeout(() => {
        fncRemoveMenssage(vResponse)
    }, 3000);

}

// Função para remover mensagem com efeito
function fncRemoveMenssage(element, timeDuration = 1000) {
    if(!element) return;
        element.style.transition = "opacity 0.5s ease";
        element.style.opacity = "0";
        setTimeout(() => element.remove(), timeDuration);
}