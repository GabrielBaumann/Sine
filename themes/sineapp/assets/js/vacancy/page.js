fncUpdateColorStatus();
// Pesquisa dinâmica com qualquer quantidadede de campos de pesquisa, os campos com classe input-search serão capturados
// Também é necessário colocar um data-ajax no input para indicar o local que será renderizado o novo conteúdo da pesquisa
const vArrayInput = [];
const vInpusSearch = document.querySelectorAll(".input-search");
if(vInpusSearch) {

    vInpusSearch.forEach((e) => {
        e.addEventListener("input", (e) => {
            console.log(e.target.value)
            console.log(e.target.dataset.url)
            console.log(e.target.name)
            console.log(e.target.dataset.ajax)

            const vUrl = e.target.dataset.url;
            const vName = e.target.name;
            const vValue = e.target.value;
            const vForm = new FormData();
            const vIndex = vArrayInput.findIndex(objt => objt.hasOwnProperty(vName));
            const vListAjax = e.target.dataset.ajax;

            if (vIndex !== -1) {
                vArrayInput[vIndex][vName] = vValue;
            } else {
                vArrayInput.push({[vName] : vValue});
            }

            vArrayInput.forEach(obj => {
                for (let key in obj) {
                    vForm.append(key, obj[key]);
                }
            });

            fetch(vUrl, {
                method: "POST",
                body: vForm
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById(vListAjax).innerHTML = data.html;
            })
        } )
    })
}

// Paginação via ajax
document.addEventListener("click", (e) => {
    const vLinkPaginator = e.target.closest(".paginator_item");

    if (vLinkPaginator) {
        e.preventDefault();

        const vidWork = document.getElementById("id-worker")?.value || "" ;
        const vUrl = vLinkPaginator.href

       fetch(vUrl + "/" + vidWork)
       .then(response => response.json())
       .then(data => {
            const vContent = document.getElementById(data.content);
            vContent.innerHTML = data.html;
            
            fncUpdateColorStatus()
       })
    };
});


// função para Atualização dos status das vagas - lista
function fncUpdateColorStatus(){
    const vSpan = document.querySelectorAll("span").forEach((ele) => {
        if(ele.classList.contains("status-vacancy")) {
            if(ele.textContent === "Encerrada") {
                ele.classList.replace("text-blue-800","text-orange-800");
                ele.classList.replace("bg-blue-200","bg-orange-200");
            }
        }
    });
}

// Chamar formulário
document.addEventListener("click", (e) => {
    const vClick = e.target.closest("button");
    if(vClick && vClick.id === "btn-new-vacancy") {
        // console.log(vClick.dataset.url)
        const vUrl = vClick.dataset.url;

        fetch(vUrl)
        .then(response => response.json())
        .then(data => {
            const vForm = document.getElementById("view-form");
            vForm.innerHTML = data.html;
            console.log(data);
        })
    }
})
