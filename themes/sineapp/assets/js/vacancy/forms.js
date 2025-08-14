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
        console.log(vformId);
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
                $('#enterprise').val(null).trigger('change');
                $('#cbo-occupation').val(null).trigger('change');
                fncTodoClousureToday()
            } else {
                fncMessage(data.message);
            }

            if(data.html) {
                document.getElementById("list-info-vacancy").innerHTML = data.html;
                fnccheckBoxVacancy();
                fncCheckClosedVacancy()
            }
            
            if(data.updatetodo) {
                fncTodoClousureToday()
            }

        })
        .catch(error => {
            fncMessage();
        })
    }
});