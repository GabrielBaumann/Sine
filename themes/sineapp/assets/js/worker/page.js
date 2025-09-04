fncUpdateColorStatus();

// Chamar histórico a partir do clique no usuário
document.addEventListener("click", (e) => {
    const vTr = e.target.closest("button");
    if(vTr && vTr.id === "btn-edit") {
        const vContent = document.getElementById("content");
        if(vTr){
            const vUrlIdWorker = vTr.dataset.url;

            fetch(vUrlIdWorker)
            .then(response => response.json())
            .then(data => {
                vContent.innerHTML = data.html;
                fncEnabledandDisabledObservation();
            })
        }
    }
});


// Mudar a cor do status da tabela
function fncUpdateColorStatus() {
    
    const table = [...document.getElementsByTagName("tr")];

    table.map((e) => {
        let vElementSpan = [...e.getElementsByTagName("span")] 
        vElementSpan.map((e) => {
            if(e.innerText === "Reprovado") {
                e.classList.replace("bg-blue-200", "bg-red-200")
                e.classList.replace("text-blue-800", "text-red-800")
            }

            if(e.innerText === "Aguardando Resposta") {
                e.classList.replace("bg-blue-200", "bg-orange-200")
                e.classList.replace("text-blue-800", "text-orange-800")
            }

            if(e.innerText === "Atendimento Realizado") {
                e.classList.replace("bg-blue-200", "bg-blue-200")
                e.classList.replace("text-blue-800", "text-blue-800")
            }
        })
    })
}

// Função para Habilitar observação após chamar o histórico do usuário
function fncEnabledandDisabledObservation() {
    document.getElementById("edit-detail")?.addEventListener("click", async (e) => {
        const vObservation = document.getElementById("observation");
        const vButton = document.getElementById("edit-detail");
        if(vObservation.disabled === true) {

            vObservation.disabled = false;
            vObservation.classList.replace("bg-gray-100", "bg-white");
            vObservation.classList.replace("text-gray-500", "text-black");
            vObservation.classList.replace("border-none", "border");
            vButton.classList.replace("text-black", "text-white");
            vButton.classList.replace("bg-yellow-300", "bg-green-600");

            vButton.querySelector("svg").outerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                </svg>
            `;

            const vTextButton = vButton.querySelector("span");
            vTextButton.innerText = "Salvar observação"

        } else {

            vObservation.disabled = true;
            vObservation.classList.replace("bg-white", "bg-gray-100");
            vObservation.classList.replace("text-black", "text-gray-500");
            vObservation.classList.replace("border", "border-none");
            vButton.classList.replace("text-white", "text-black");
            vButton.classList.replace("bg-green-600", "bg-yellow-300");

            vButton.querySelector("svg").outerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                </svg>
            `;

            const vTextButton = vButton.querySelector("span");
            vTextButton.innerText = "Editar observação"

            // Salvar edição encaminhar requisição para o backend
            const vFormData = new FormData();
            vFormData.append("observation", document.getElementById("observation").value);

            try {
                const vRequest = await fetch(vButton.dataset.url ,{
                    method: "POST",
                    body: vFormData
                });

                if(!vRequest.ok) {
                    throw fncMessage();
                }

                const vResponse = await vRequest.json();
                
                if(vResponse.message) {
                    fncMessage(vResponse.message);
                }
            } catch (erro) {
                fncMessage();
            }
        }
    })
}

fncModalQuest("delete-service");


/*########################################*/
/*#############  Modal yes/no ############*/
/*########################################*/

// // Cancelar ação
// document.addEventListener("click", (e) => {
//     if(e.target.id === "cancelBtn") {
//         document.getElementById('modal').remove();
//     }
// });

// // Fechar modal clicando no overlay (fora da modal)
// document.addEventListener("click", (e) => {
//     if(e.target.id === "confirmationModal") {
//         document.getElementById("modal").remove();
//     }
// })

// // Fechar com ESC
// document.addEventListener('keydown', (e) => {
//     if (e.key === 'Escape') {
//         document.getElementById('modal').remove();
//     }
// });

