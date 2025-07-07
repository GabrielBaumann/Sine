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

// Funcção que cria tela de splash
// function showSplashs() {
//     if(document.getElementById("response")) document.getElementById("response").remove();
//     load = document.createElement("div");
//     load.id = "response";
//     load.innerHTML = 
//     `
//         <div class="main h-full w-full bg-gray-50 absolute top-0 left-0">
//             <div class="container mx-auto px-4 h-full flex items-center justify-center">
//                 <div class="text-center">
//                     <!-- Texto animado -->
//                     <h1 class="text-4xl md:text-5xl font-normal text-gray-800">
//                         Carregando teste
//                     </h1>
//                     <div class="dots flex space-x-6 mt-10 justify-center">
//                         <div class="dot-1 w-6 h-6 bg-blue-900"></div>
//                         <div class="dot-2 w-6 h-6 bg-blue-600"></div>
//                         <div class="dot-3 w-6 h-6 bg-blue-500"></div>
//                     </div>
//                 </div>
//             </div>
//         </div>

//         `;
//     return setTimeout (() => {
//         document.body.appendChild(load);
//     }, 500);
// }

// função para montar a mensagem e remover a mensagem
// function fncMessage(vMessage) {

//     // Remove qualquer mensagem que possa estar no DOM
//     if(document.getElementById("response")) document.getElementById("response").remove();

//     const vNewMessage = document.createElement("div");
//     vNewMessage.id = "response";
    
//     // Se a função for chamada sem o argumento mensagem ela devolve a mensagem de erro
//     if(!vMessage) {
//         vMessage = `
//             <div class="alert-container">
//                 <div class="alert-message bg-white border border-red-400 rounded-lg p-4 text-red-700">
//                     Erro inesperado. Tente novamente.
//                 </div>
//             </div>
//         `;  
//     }
        
//     vNewMessage.innerHTML = vMessage
//     document.body.appendChild(vNewMessage);

//     setTimeout(() => {
//         if(!vNewMessage) return;
//             vNewMessage.style.transition = "opacity 0.5s ease";
//             vNewMessage.style.opacity = "0";
//             setTimeout(() => vNewMessage.remove(), 1000)
//     }, 4000);    
// }

// Evento para fechar mensagem no clique na mensagem
// document.addEventListener("click", (e) => {
//     const vButton = e.target.closest("#button-close");   
//     if(vButton) {
//         const vMessage =  e.target.closest(".alert-container");
//         vMessage.style.transition = "opacity 0.5s ease";
//         vMessage.style.opacity = "0";
//         setTimeout(() => vMessage.remove(), 2000)
//     }
// });

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