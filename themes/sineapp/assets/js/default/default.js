//*  Scripts padrões para todo o sistema *//
let vArrayInput = [];
fncTodoClousureToday()
removeFlash()

// Verifica o tamanho da tela e chama a função de responsividade
window.addEventListener("resize", updateResponsive);
updateResponsive();

// Função para redimencionar o modo de resposividade
function updateResponsive() {
    if(window.matchMedia("(max-width: 600px)").matches) {
        // Modo celular
        const vUrlPage =  window.location.pathname.replace(/\/$/, "").split("/").pop();
        const vMenus = document.querySelectorAll("span.mobile");

        vMenus.forEach(vElemet => {

            if(vElemet.dataset.sidebar === vUrlPage) {
                vElemet.closest("a.mobile").classList.remove("text-gray-600")
                vElemet.closest("a.mobile").classList.add("text-blue-800");
            }
        });
    } else {
        // Modo desktop
        const vUrlPage =  window.location.pathname.replace(/\/$/, "").split("/").pop();
        const vMenus = document.querySelectorAll("span.menu");

        vMenus.forEach(vElemet => {
            if(vElemet.dataset.sidebar === vUrlPage) {
                vElemet.closest("a.menu").classList.remove("text-gray-500")
                vElemet.closest("a.menu").classList.add("text-white", "bg-blue-500", "rounded-md", "font-bold", "hover:text-white");
            }
        });
    }
}

//Função usada no evendo de sidebar 
function fncSanitizeCaractere(vTextSanitize) {

    return vTextSanitize
        .toLowerCase()
        .normalize("NFD").replace(/[\u0300-\u036f]/g, "")
        .replace(/[^a-z0-9\s]/g, "")
        .trim();
}

// Aviso de input vazio realce no campo e na label
const vform = document.getElementsByTagName('form');
if (vform) {

    document.addEventListener("submit", (e) => {
        const vLabel = document.querySelectorAll("label");
        vLabel.forEach(element => {
            if(element.innerText.includes("*") && element.nextElementSibling.value === "") {
                element.classList.add("requerid-alert");
                element.nextElementSibling.classList.add("requerid-alert");        
            };
        })
    })

    document.addEventListener("input", (e) => {
        if(e.target.classList.contains("requerid-alert") && e.target.value != "") {
            e.target.classList.remove("requerid-alert")
            e.target.previousElementSibling.classList.remove("requerid-alert");
        };
    })
}

// Botões de voltar sem usar o link, via ajax
document.addEventListener("click", (e) => {
    const vUrlPage =  window.location.pathname.replace(/\/$/, "").split("/").pop();

    const vClick = e.target.closest("button");
    if(vClick && vClick.id === "btn-back") {
        vArrayInput = [];
        const vUrl = vClick.dataset.url;
        const vIdView = e.target.dataset.change;
        fetch(vUrl)
        .then(response => response.json())
        .then(data => {
            const vForm = document.getElementById(vIdView);
            vForm.innerHTML = data.html;

            if(vUrlPage === "trabalhador") {
                fncUpdateColorStatus();
            }

            if(vUrlPage === "vagas") {
                fncUpdateColorStatusVacancy();
                fncCheckClosedVacancy();
            }

            if(vUrlPage === "empresas") {
                fncSatusColorCompany();
            }

            if(vUrlPage === "usuarios") {
                fncStatusUserSystem();
            }
        });
    }
});

// Paginação com critério vínculado
// Paginação via ajax
document.addEventListener("click", (e) => {
    const vLinkPaginator = e.target.closest(".paginator_item");
    const vUrlPage =  window.location.pathname.replace(/\/$/, "").split("/").pop();

    if (vLinkPaginator) {
        e.preventDefault();

        const vSearchs = document.querySelectorAll(".input-search");

        let vString = "";

        vSearchs.forEach((e) => {

            if(vString.includes("?")) {
                vString += `&${e.name}=${encodeURIComponent(e.value)}`;
            } else {
                vString += `?${e.name}=${encodeURIComponent(e.value)}`;
            }
        });

        const pageHref = new URL(vLinkPaginator.href);
        const vUrl = pageHref + vString;

       fetch(vUrl)
       .then(response => response.json())
       .then(data => {
            const vContent = document.getElementById(data.content);
            vContent.innerHTML = data.html;

            if (vUrlPage === "trabalhador") {
                fncUpdateColorStatus();
            } 
            else if (vUrlPage === "vagas") {
                fncUpdateColorStatusVacancy();
                fncCheckClosedVacancy();
            } 
            else if (vUrlPage === "empresas") {
                fncSatusColorCompany();
            } 
            else if (vUrlPage === "usuarios") {
                fncStatusUserSystem();
            }
       })
    };
});


// Pesquisa dinâmica com qualquer quantidadede de campos de pesquisa, os campos com classe input-search serão capturados
// Também é necessário colocar um data-ajax no input para indicar o local que será renderizado o novo conteúdo da pesquisa, data-url para encaminhar o local do backend que fará a pesquisa
document.addEventListener("input", (e) => {
    const vInputsSearch =  e.target.classList.contains("input-search");
    const vUrlPage =  window.location.pathname.replace(/\/$/, "").split("/").pop();

    if(vInputsSearch) {

        const vUrl = e.target.dataset.url;
        const vName = e.target.name;
        const vValue = e.target.value;
        const vForm = new FormData();
        const vIndex = vArrayInput.findIndex(objt => objt.hasOwnProperty(vName));
        const vListAjax = e.target.dataset.ajax;

        if (vIndex !== -1) {
            vArrayInput[vIndex][vName] = vValue;
        } else {
            vArrayInput.push({[vName] : vValue});
        }

        vArrayInput.forEach(obj => {
            for (let key in obj) {
                vForm.append(key, obj[key]);
            }
        });

        fetch(vUrl, {
            method: "POST",
            body: vForm
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById(vListAjax).innerHTML = data.html;
            
            if (vUrlPage === "trabalhador") {
                fncUpdateColorStatus();
            } 
            else if (vUrlPage === "vagas") {
                fncUpdateColorStatusVacancy();
                fncCheckClosedVacancy();
            } 
            else if (vUrlPage === "empresas") {
                fncSatusColorCompany();
            } 
            else if (vUrlPage === "usuarios") {
                fncStatusUserSystem();
            }
        });
    }
});

/*#################################*/
/**###### Função de mensagem ######*/
/**############################### */
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
    }, 500);
}

function removeFlash() {
    const element = document.querySelectorAll(".alert-container");

    element.forEach(el => {
        setTimeout(() => {
            el.style.transition = "opacity 0.5s ease";
            el.style.opacity = "0";
            
            setTimeout(() => el.remove(), 3000);
        }, 3000);
    });
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

// Evento para fechar mensagem no clique na mensagem
document.addEventListener("click", (e) => {
    const vButton = e.target.closest("#button-close");   
    if(vButton) {
        const vMessage =  e.target.closest(".alert-container");
        vMessage.style.transition = "opacity 0.5s ease";
        vMessage.style.opacity = "0";
        setTimeout(() => vMessage.remove(), 2000)

        const vResponse = document.getElementById("response");
        vResponse.remove();
    }
});

/*######## End ##################*/

/**loading href */
document.addEventListener("DOMContentLoaded", function () {
    const vLinks = document.querySelectorAll("a.menu, a.mobile");

    vLinks.forEach(link => {
        if (link.hostname === window.location.hostname) {
            
            link.addEventListener("click", function(e) {
                if (link.target === "_black") return;
                showSplashNavigation();
            });
        }
    });
});

function showSplashNavigation() {
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
    }, 300);
}

/**
 * Programação de encerramento de vagas
 */

function fncTodoClousureToday() {
    fetch("/sine/encerramentoautomatico")
    .then(response => response.json())
    .then(data => {
        if(data) {
            data.forEach(todo => {
                const vNow = new Date();
                const vTimeClousure = new Date(todo.timeTodo);
                const vDelay = vTimeClousure - vNow;

                if (vDelay > 0) {
                    setTimeout(() => {

                        fetch("/sine/encerramentoautomatico", {
                            method: "POST",
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: "id=" + encodeURIComponent(todo.idVacancy)
                        })
                        .then(res => res.text())
                        .then(text => {
                        });
                    }, vDelay);
                } else {
                }
            });
        }
    });
}

/*########################################*/
/*#############  Modal yes/no ############*/
/*########################################*/

// Função para chamar modal quest
function fncModalQuest (vIdButton) {
    document.addEventListener("click", (e) => {
        const vButton = e.target.closest("button");
        if(vButton && vButton.id === vIdButton) {
            const vUrl = vButton.dataset.url;
            fetch(vUrl)
            .then(response => response.json())
            .then(data => {

                if (document.getElementById("modal")) return document.getElementById("modal").remove();

                const vElement = document.createElement("div");
                vElement.id = "modal";
                vElement.innerHTML = data.html;
                document.body.appendChild(vElement);
            })
        }
    });
}

// Cancelar ação
document.addEventListener("click", (e) => {
    if(e.target.id === "cancelBtn") {
        document.getElementById('modal').remove();
    }
});

// Fechar modal clicando no overlay (fora da modal)
document.addEventListener("click", (e) => {
    if(e.target.id === "confirmationModal") {
        document.getElementById("modal").remove();
    }
})

// Fechar com ESC
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        document.getElementById('modal').remove();
    }
});