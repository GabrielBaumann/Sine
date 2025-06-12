//*  Scripts padrões para todo o sistema *//

// Evento para efeitos do sidebar
window.onload = function() {
    const vUrlPage =  window.location.pathname.replace(/\/$/, "").split("/").pop();
    const vMenus = document.querySelectorAll("span.menu");

    vMenus.forEach(vElemet => {
        if(fncSanitizeCaractere(vElemet.textContent) === vUrlPage) {
            vElemet.closest("a").classList.add("bg-blue-800", "text-white")
        }
    });
}

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




