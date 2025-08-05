// Máscara para CPF em qualquer input mesmo se adicionado dinamicamente

let cpfInitialEdit = "";
document.addEventListener("input", function(e) {
    if (e.target && e.target.id === "cpf") {
        let value = e.target.value.replace(/\D/g, '');

        // Limita a 11 dígitos
        value = value.slice(0, 11);

        // Aplica a máscara do CPF
        if (value.length >= 10) {
            value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{1,2})/, '$1.$2.$3-$4');
        } else if (value.length >= 7) {
            value = value.replace(/(\d{3})(\d{3})(\d{1,3})/, '$1.$2.$3');
        } else if (value.length >= 4) {
            value = value.replace(/(\d{3})(\d{1,3})/, '$1.$2');
        }

        e.target.value = value;
    }
});

// Verificar quantidade de digito no cpf
document.addEventListener("focusout", function(e) {

    if (e.target.id === "cpf") {
        
        if (document.getElementById("cpf").value === "") {
            fncClearForm();
        }

        if(e.target.value !== "") {
            
            const vLabel = e.target.name;
            const vValue = e.target.value;
            const vUrl = e.target.dataset.url;
            const vForm = new FormData();

            const vUrlBack = document.getElementById("bntBack").dataset.url;
            const vTitleForm = document.getElementById("titleForm").textContent;
            const vidService = document.getElementById("idServiceType").value;
            const vTypeService = document.getElementById("typeService").value;

            vForm.append(vLabel, vValue.replace(/\D/g, ''));
            vForm.append("url", vUrlBack);
            vForm.append("titleForm", vTitleForm);
            vForm.append("idServiceType", vidService);
            vForm.append("typeService", vTypeService);

            if(cpfInitialEdit != vValue && vValue.length === 14) {

                fetch(vUrl, {
                    method: "POST",
                    body: vForm
                })
                .then(response => response.json())
                .then(data => {

                    if(data.erro === true) {
                        fncMessage(data.message)
                        fncClearForm();
                    } else {
                        if(data.freeCpf){
                            cpfInitialEdit = vValue;
                        } else{
                            document.getElementById("newElement").innerHTML = data.html;
                            cpfInitialEdit = vValue;
                            fncPhoneMask();
                        }
                    }
                })
            }
        }
    }
});

// Opção de voltar limpar variável do cpf
document.addEventListener("click", (e) => {
    const vButton = e.target.closest("button");
    const vUrl = vButton?.dataset.url;

    if(vUrl) {
        cpfInitialEdit = "";
    }
})

// função para limpar formulário
function fncClearForm() {
    const form = document.getElementById("formService");
    form.action = form.action.replace(/\/\d+$/, "");

    document.getElementById("nome").value = "";
    document.getElementById("cpf").value = "";
    document.getElementById("date-birth-worker").value = "";
    document.getElementById("pcd").checked = true;
    document.getElementById("apprentice").checked = true;
    document.getElementById("cterc").checked = true;

    cpfInitialEdit = "";
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
                    fncPhoneMask();
                }
            }
        });
    }
})

// Máscara para telefone
function fncPhoneMask() {
    const vPhone = document.getElementById("contact-work").addEventListener("input", (e) => {
        let vValor = e.target.value.replace(/\D/g, '');
        if (vValor.length > 6) {
            vValor = vValor.slice(0 ,5) + "-" + vValor.slice(5, 11);
        }
        e.target.value = vValor;
    })
}