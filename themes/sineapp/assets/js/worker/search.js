// Pesquisa dinâmica com qualquer quantidadede de campos de pesquisa, os campos com classe input-search serão capturados
// Também é necessário colocar um data-ajax no input para indicar o local que será renderizado o novo conteúdo da pesquisa
// const vArrayInput = [];
// const vInpusSearch = document.querySelectorAll(".input-search");
// if(vInpusSearch) {

//     vInpusSearch.forEach((e) => {
//         e.addEventListener("input", (e) => {

//             const vUrl = e.target.dataset.url;
//             const vName = e.target.name;
//             const vValue = e.target.value;
//             const vForm = new FormData();
//             const vIndex = vArrayInput.findIndex(objt => objt.hasOwnProperty(vName));
//             const vListAjax = e.target.dataset.ajax;

//             if (vIndex !== -1) {
//                 vArrayInput[vIndex][vName] = vValue;
//             } else {
//                 vArrayInput.push({[vName] : vValue});
//             }

//             vArrayInput.forEach(obj => {
//                 for (let key in obj) {
//                     vForm.append(key, obj[key]);
//                 }
//             });

//             fetch(vUrl, {
//                 method: "POST",
//                 body: vForm
//             })
//             .then(response => response.json())
//             .then(data => {
//                 document.getElementById(vListAjax).innerHTML = data.html;
//                 fncUpdateColorStatus();
//             });
//         });
//     });
// }

// document.addEventListener("input", (e) => {
//     const vInputsSearch =  e.target.classList.contains("input-search");

//     if(vInputsSearch) {

//         const vUrl = e.target.dataset.url;
//         const vName = e.target.name;
//         const vValue = e.target.value;
//         const vForm = new FormData();
//         const vIndex = vArrayInput.findIndex(objt => objt.hasOwnProperty(vName));
//         const vListAjax = e.target.dataset.ajax;

//         if (vIndex !== -1) {
//             vArrayInput[vIndex][vName] = vValue;
//         } else {
//             vArrayInput.push({[vName] : vValue});
//         }

//         vArrayInput.forEach(obj => {
//             for (let key in obj) {
//                 vForm.append(key, obj[key]);
//             }
//         });

//         fetch(vUrl, {
//             method: "POST",
//             body: vForm
//         })
//         .then(response => response.json())
//         .then(data => {
//             document.getElementById(vListAjax).innerHTML = data.html;
//             fncUpdateColorStatus();
//         });
//     }
// });