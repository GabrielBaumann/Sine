/**
 * Envio de formulário
 */
document.addEventListener("submit", async (e)=> {
    if (e.target.tagName === "FORM") {
        e.preventDefault()

        const form = e.target;
        const formData = new FormData(form);
        const actionForm = e.target.action;

        let vtimeLoading;

        vtimeLoading = showSplash(true);

        try {
            const vResponse = await fetch(actionForm, {
                method: "POST",
                body: formData
            })
            const vData = await vResponse.json();

            if (vData.htmlquestion) {
                const vElement = document.createElement("div");
                vElement.id = "modal";
                vElement.innerHTML = vData.htmlquestion;
                document.body.appendChild(vElement);
                return;
            }

            if (vData.erro === false) {
                const vHtmlAjax = document.getElementById("newElement");
                vHtmlAjax.innerHTML = vData.html;
            } else {
                fncMessage(vData.message);
            }

        } catch (err) {
            fncMessage();
        } finally {
            vtimeLoading?.remove();
        }
    }
});
