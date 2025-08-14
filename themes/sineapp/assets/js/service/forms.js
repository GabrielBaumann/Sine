/**
 * Envio de formulário
 */
document.addEventListener("submit", (e)=> {
    if (e.target.tagName === "FORM") {
        e.preventDefault()

        const form = e.target;
        const formData = new FormData(form);
        const actionForm = e.target.action;
        // const formId = e.target.id;

        let vtimeLoading;

        vtimeLoading = showSplash();

        fetch(actionForm, {
            method: "POST",
            body: formData
        })
        .then(response => {
            clearTimeout(vtimeLoading);

            if(!response.ok) throw new Error("Erro no servidor");

            return response.json();
        })
        .then(data => {

            if (data.htmlquestion) {
                const vElement = document.createElement("div");
                vElement.id = "modal";
                vElement.innerHTML = data.htmlquestion;
                document.body.appendChild(vElement);
                return;
            }

            if (data.erro === false) {
                const vHtmlAjax = document.getElementById("newElement");
                vHtmlAjax.innerHTML = data.html;
            } else {
                fncMessage(data.message);
            }
        })
        .catch(error => {
            fncMessage();           
        });
    }
});
