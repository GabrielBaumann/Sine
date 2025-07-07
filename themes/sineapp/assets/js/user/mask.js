// Máscara para CPF em qualquer input mesmo se adicionado dinamicamente
let cpfInitialEdit = "";
document.addEventListener("input", function(e) {
    if (e.target && e.target.id === "cpf") {
        let value = e.target.value.replace(/\D/g, '');

        if(cpfInitialEdit) {
            if(value === "") {
                value = cpfInitialEdit.replace(/\D/g, '');
            }
        }

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

document.addEventListener("focusin", (e) => {
    if (e.target.id === "cpf" && document.getElementById("idSystemUser")?.value !== "") {
        cpfInitialEdit = e.target.value;
    }

    if (e.target.id === "cpf" && document.getElementById("idSystemUser")?.value === "") {
        cpfInitialEdit = "";
    }
});

// Verificar quantidade de digito no cpf
document.addEventListener("focusout", function(e) {
    if (e.target.id === "cpf") {
        if(e.target.value !== "") {
            
            const vLabel = e.target.name;
            const vValue = e.target.value;
            const vUrl = e.target.dataset.url;
            const vForm = new FormData();
            vForm.append(vLabel, vValue.replace(/\D/g, ''));

            // Verificar se existe o ID para não editar o CPF
            if(document.getElementById("idSystemUser")?.value !== "") {
                const vIdUserSystem = document.getElementById("idSystemUser");
                vForm.append(vIdUserSystem.name, vIdUserSystem.value);
            }

            fetch(vUrl, {
                method: "POST",
                body: vForm
            })
            .then(response => response.json())
            .then(data => {
                fncMessages(data.message)

                if(data.erro === true) {
                    if(cpfInitialEdit) {
                        document.getElementById("cpf").value = cpfInitialEdit;
                    } else {
                        document.getElementById("cpf").value = "";
                    }
                }
            })
        }
    }
});

// Máscara para telefone
document.addEventListener('input', function(e) {
    if (e.target && e.target.id === "telephone") {
        let value = e.target.value.replace(/\D/g, '');

            if (value.length > 11) value = value.substring(0, 11);
            
            if (value.length <= 10) {
                value = value.replace(/(\d{2})(\d)/, '($1) $2');
                value = value.replace(/(\d{4})(\d)/, '$1-$2');
            } else {
                value = value.replace(/(\d{2})(\d)/, '($1) $2');
                value = value.replace(/(\d{5})(\d)/, '$1-$2');
            }
            e.target.value = value;       
    }
});

document.addEventListener("focusout", function(e) {
    if (e.target.id === "telephone") {
        const vCountCpf = e.target.value.replace(/\D/g, '');
        if (vCountCpf.length < 11) {
            e.target.value ="";
        }
    }
})

// API para retornar estados e cudades do IBGE

// document.addEventListener("click", (e) => {
//     if(e.target.tagName === "SELECT" && e.target.id === "state") {
//         const vStateSelect = document.getElementById("state");
//         const vCitSelect = document.getElementById("cit");

//         fetch('https://servicodados.ibge.gov.br/api/v1/localidades/estados')
//         .then(response => response.json())
//         .then(data => {
//             data.sort((a, b) => a.nome.localeCompare(b.nome));

//             data.forEach(state => {
//                 const vOption = document.createElement("option");
//                 vOption.value = state.sigla;
//                 vOption.textContent = state.nome;
//                 vStateSelect.appendChild(vOption);
//             });
//         });

//         vStateSelect.addEventListener("change", () => {
//             const vStatId = vStateSelect.value;

//             vCitSelect.innerHTML = '<option value="">Carregando...</option>';
//             vCitSelect.disabled = true;

//             if (vStatId) {
//                 fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${vStatId}/municipios`)
//                 .then(response => response.json())
//                 .then(cities => {
//                     vCitSelect.innerHTML = '<option value="">Selecione uma cidade</option>';
//                     cities.sort((a, b) => a.nome.localeCompare(b.nome));
//                     cities.forEach(cit => {
//                         const vOption = document.createElement("option");
//                         vOption.value = cit.nome;
//                         vOption.textContent = cit.nome;
//                         vCitSelect.appendChild(vOption);
//                     });
//                     vCitSelect.disabled = false;
//                 })
//                 .catch(error => {
//                     vCitSelect.innerHTML = '<option value="">Erro ao carregar cidades</option>';
//                     console.error(error);
//                 })
//             } else {
//                 vCitSelect.innerHTML = '<option value="">Selecione um estado primeiro</option>';
//                 vCitSelect.disabled = true;
//             }
//         })
//     }
// })

// Fechar mensagem para usuário
document.addEventListener("click", (e) => {

    const botao = e.target.closest("#botao");
    const message = e.target.closest(".alert-container");

    if (botao && message) {
        message.style.transition = "opacity 0.5s ease";
        message.style.opacity = "0";
        setTimeout(() => message.remove(), 2000);
    }
})