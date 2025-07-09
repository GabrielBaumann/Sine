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

            // Se não existir nenhum modal, então ele executa as mensagens
            if(data.modal != true){
                if(data.complete) {
                    fncMessage(data.message);
                    document.getElementById(vformId).reset();
                } else {
                    fncMessage(data.message);
                }
                if(data.html) {
                    document.getElementById(data.contentajax).innerHTML = data.html;
                }

                return;
            }
            const vElemente = document.createElement("div");
            vElemente.id = "modal"
            vElemente.innerHTML = data.html;
            document.body.appendChild(vElemente);
        })
        .catch(error => {
            fncMessage();
        })
    }
});