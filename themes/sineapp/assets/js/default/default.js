//*  Scripts padrões para todo o sistema *//
let vArrayInput = [];
// Evento para efeitos do sidebar
window.onload = function() {
    const vUrlPage =  window.location.pathname.replace(/\/$/, "").split("/").pop();
    const vMenus = document.querySelectorAll("span.menu");

    vMenus.forEach(vElemet => {
        if(fncSanitizeCaractere(vElemet.textContent) === vUrlPage) {
            vElemet.closest("a").classList.remove("text-gray-700")
            vElemet.closest("a").classList.add("text-[#095998]", "border-l-3", "border-[#095998]");
        }
    });
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

// Paginação via ajax
// document.addEventListener("click", (e) => {
//     const vLinkPaginator = e.target.closest(".paginator_item");
//     const vUrlPage =  window.location.pathname.replace(/\/$/, "").split("/").pop();

//     if (vLinkPaginator) {
//         e.preventDefault();

//         const vStatus = document.getElementById("search-all-status")?.value || "" ;
//         const vName = document.getElementById("name-search")?.value || "" ;

//         const pageHref = new URL(vLinkPaginator.href);
//         const vPageNumber = pageHref.pathname.split("/").pop();
//         const vUrl = `/sine/listatrabalhador/p/${vPageNumber}?name=${encodeURIComponent(vName)}&status=${encodeURIComponent(vStatus)}`;

//        fetch(vUrl)
//        .then(response => response.json())
//        .then(data => {
//             const vContent = document.getElementById(data.content);
//             vContent.innerHTML = data.html;

//             if(vUrlPage === "trabalhador") fncUpdateColorStatus();

//             if(vUrlPage === "vagas") fncUpdateColorStatusVacancy();

//             if(vUrlPage === "empresas") fncSatusColorCompany();
 
//             if(vUrlPage === "usuarios") fncStatusUserSystem();
//        })
//     };
// });

// Paginação via ajax
document.addEventListener("click", (e) => {
    const vLinkPaginator = e.target.closest(".paginator_item");
    const vUrlPage =  window.location.pathname.replace(/\/$/, "").split("/").pop();

    if (vLinkPaginator) {
        e.preventDefault();

        const vidWork = document.getElementById("id-worker")?.value || "" ;
        const vUrl = vLinkPaginator.href

       fetch(vUrl + "/" + vidWork)
       .then(response => response.json())
       .then(data => {
            const vContent = document.getElementById(data.content);
            vContent.innerHTML = data.html;

            if(vUrlPage === "trabalhador") {
                fncUpdateColorStatus();
            }

            if(vUrlPage === "vagas") {
                fncUpdateColorStatusVacancy();
            }

            if(vUrlPage === "empresas") {
                fncSatusColorCompany();
            }

            if(vUrlPage === "usuarios") {
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
            
            if(vUrlPage === "trabalhador") {
                fncUpdateColorStatus();
            }

            if(vUrlPage === "vagas") {
                fncUpdateColorStatusVacancy();
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