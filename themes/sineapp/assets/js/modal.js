// Abre modal baseado em modelos do plates
let currentModal = null;

// Função que recebe o endereço e devolve via ajax o modelo
function openModal(url, idModal) {
    
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

    fetch(url)
    .then(response => {
        clearTimeout(timeoutLoading);
        
        if (!response.ok) throw new Error("Erro no servidor");
        return response.text()
    })
    .then(html => {
        if(load) load.remove();
        
        const modalView = document.getElementById("modal").innerHTML = html;
        const modal = document.getElementById(idModal);
        modal.classList.remove("hidden");
        document.body.classList.add('overflow-hidden');
        currentModal = idModal;

        const closeBtn = document.getElementById("closeModal");
        if (closeBtn) {
            closeBtn.addEventListener("click", closeModal);
        }

        window.onclick = function(event) {
        if (event.target.classList.contains('modal')) {
            closeModal();
            }
        };
    })
    .catch(error => console.error("Erro ao carregar", error));
}

// função para fechar os modais
function closeModal() {
    if(currentModal) {
        document.getElementById(currentModal).style.display = "none";
        document.getElementById("modal").innerHTML = "";
        currentModal = null;
    }
}

// Escuta o clique e verifica se é data-modal, para disparar o openModal e closeModal
document.addEventListener("click", (e) => {
    if (e.target.closest("[data-modal]")) {
        
        const idModal = e.target.dataset.modal;
        const dataUrl = e.target.dataset.url;
        
        openModal(dataUrl, idModal)

    }
})

// Esculta o clique e verifica se é closeModal e fecha fora do botão prévio do disparo de evento
document.addEventListener("click", function(e) {
    if (e.target.id === "closeModal") {
        closeModal();
    }
});

// Remover elementos com efeito
function removeElement(element, duration = 1000) {
    if(!element) return;
        element.style.transition = "opacity 0.5s ease";
        element.style.opacity = "0";
    setTimeout(()=> element.remove(), duration);
}

// Remove mensagem flash
window.onload = function () {
    const e = document.querySelector('.alert-container');
    if (e) {
        setTimeout(() => {
            removeElement(e, 3000)
       }, 3000); 
    }
}
