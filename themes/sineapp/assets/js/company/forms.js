/**
 * Envio de formulário de cadastro de vagas
 */

document.addEventListener("submit", (e) => {
    if(e.target.tagName === "FORM") {
        e.preventDefault();

        const vForm = new FormData(e.target);
        const vActionForm = e.target.action;
        const vformId = e.target.id;
        let vtimeLoading;

        vtimeLoading = showSplash();
        
        fetch(vActionForm, {
            method: "POST",
            body: vForm
        })
        .then(response => {
            clearTimeout(vtimeLoading);
            return response.json();
        })
        .then(data => {

            if(data.complete) {
                fncMessage(data.message);
                document.getElementById(vformId).reset();
            } else {
                fncMessage(data.message);
            }

            if(data.content) {
                const vElement = document.getElementById(data.content);
                vElement.innerHTML = data.html;
                fncSatusColorCompany()
            }

        })
        .catch(error => {
            fncMessage();
        })
    }
});


// Funcção que cria tela de splash
function showSplash() {
    if(document.getElementById("response")) document.getElementById("response").remove();
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
    return setTimeout (() => {
        document.body.appendChild(load);
    }, 200);
}

// função para montar a mensagem e remover a mensagem
function fncMessage(vMessage) {

    // Remove qualquer mensagem que possa estar no DOM
    if(document.getElementById("response")) document.getElementById("response").remove();

    const vNewMessage = document.createElement("div");
    vNewMessage.id = "response";
    
    // Se a função for chamada sem o argumento mensagem ela devolve a mensagem de erro
    if(!vMessage) {
        vMessage = `
            <div class="alert-container">
                <div class="alert-message bg-white border border-red-400 rounded-lg p-4 text-red-700">
                    Erro inesperado. Tente novamente.
                </div>
            </div>
        `;  
    }
        
    vNewMessage.innerHTML = vMessage
    document.body.appendChild(vNewMessage);

    setTimeout(() => {
        if(!vNewMessage) return;
            vNewMessage.style.transition = "opacity 0.5s ease";
            vNewMessage.style.opacity = "0";
            setTimeout(() => vNewMessage.remove(), 1000)
    }, 4000);    
}

// Evento para fechar mensagem
document.addEventListener("click", (e) => {
    const vButton = e.target.closest("#button-close");   
    if(vButton) {
        const vMessage =  e.target.closest(".alert-container");
        vMessage.style.transition = "opacity 0.5s ease";
        vMessage.style.opacity = "0";
        setTimeout(() => vMessage.remove(), 2000)
    }
});