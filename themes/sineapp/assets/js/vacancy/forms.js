/**
 * Envio de formulário de cadastro de vagas
 */
document.addEventListener("submit", async (e) => {
    if(e.target.tagName === "FORM") {
        e.preventDefault();

        const vForm = new FormData(e.target);
        const vActionForm = e.target.action;
        const vformId = e.target.id;
        let vtimeLoading;

        vtimeLoading = showSplash(true);
        document.getElementById("modal")?.remove();

        try {
            
            const vReponse = await fetch(vActionForm, {
                method: "POST",
                body: vForm
            })

            const vData = await vReponse.json();
            
            if(vData.redirect) {
                window.location.href = vData.redirect;
                return;
            }

            if(vData.complete) {
                fncMessage(vData.message);
                document.getElementById(vformId).reset();
                $('#enterprise').val(null).trigger('change');
                $('#cbo-occupation').val(null).trigger('change');
                fncTodoClousureToday()
            } else {
                fncMessage(vData.message);
            }

            if(vData.html) {
                document.getElementById("view-form").innerHTML = vData.html;
                fnccheckBoxVacancy();
                fncCheckClosedVacancy();
                document.getElementById("modal")?.remove();
            }
            
            if(vData.updatetodo) {
                fncTodoClousureToday()
            }

        } catch(error) {
            fncMessage();
        } finally {
            vtimeLoading?.remove();
        }
    }
});