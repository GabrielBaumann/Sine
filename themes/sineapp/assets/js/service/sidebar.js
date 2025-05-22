// Evento para efeitos do sidebar
window.onload = function() {
    const vUrlPage =  window.location.pathname.replace(/\/$/, "").split("/").pop();
    const vMenus = document.querySelectorAll("span.menu");

    vMenus.forEach(vElemet => {
        if(fncSanitizeCaractere(vElemet.textContent) === vUrlPage) {
            vElemet.closest("a").classList.add("bg-gray-900", "text-white")
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

// Chamadas do atendimento
document.addEventListener("click", (e) => {
    const vButton = e.target.closest("button");
    const vUrl = vButton?.dataset.url;
    const vIdServiceType = vButton?.dataset.idservice;

    if(vUrl) {

        const vTextTitle = vButton.querySelector("span")?.innerText;       

        fetch(vUrl)
        .then(response => response.text())
        .then(data => {

            const vElementoNew = document.getElementById("newElement");
            vElementoNew.innerHTML = data

            const vTitleForm = document.getElementById("titleForm");
            const vId = document.getElementById("idServiceType");

            if(vTitleForm) {
                if (vTextTitle && vTextTitle) {
                    vTitleForm.textContent = vTextTitle;
                    vId.value = vIdServiceType;
                }
            }
        });
    }
})