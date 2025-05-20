// Evento para 
window.onload = function() {
    const vUrlPage =  window.location.pathname.replace(/\/$/, "").split("/").pop();
    const vMenus = document.querySelectorAll("span.menu");

    vMenus.forEach(vElemet => {
        if(fncSanitizeCaractere(vElemet.textContent) === vUrlPage) {
            vElemet.closest("a").classList.add("bg-sine-600", "hover:bg-sine-700", "text-white")
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