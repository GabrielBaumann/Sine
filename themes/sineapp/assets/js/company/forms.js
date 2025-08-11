/**
 * Botão clicado
 */
let vBotaoClick = null;

document.addEventListener("click", (e) => {
    const vButton = e.target.closest("BUTTON");
    if(vButton) {
        if (vButton.tagName === "BUTTON" && vButton.type === "submit") {
            vBotaoClick = vButton;
        }
    }
});


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

        if (vBotaoClick && vBotaoClick.name) {
            vForm.append(vBotaoClick.name, vBotaoClick.value);
        }

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