/**
 * pesquisar valores em um input e um um select
 */
// document.addEventListener("click", (e) => {
//     if (e.target.id === "search"){
//         const ele = document.getElementById("inputSearch");
//         const nameInput = ele.name;
//         const url = ele.dataset.url;
//         const search = ele.value.trim();
//         const formaData = new FormData();
//         formaData.append(nameInput, search);

//         nomeSelect = document.getElementById("selectData");
//         formaData.append(nomeSelect.name, nomeSelect.value);


//         fetch(url, {
//             method: "POST",
//             body: formaData
//         } )
//         .then(response => response.json())
//         .then(dado => {

//             if (dado.erro) {
//                 const novoResponse = document.createElement("div");
//                 novoResponse.id = "response";
//                 novoResponse.innerHTML = dado.message;
        
//                 document.body.appendChild(novoResponse);
        
//                 setTimeout(() => {
//                     removeElement(novoResponse);
//                 }, 3000);
 
//             } else {

//                 updateList.innerHTML = dado.message; // HTML da listagem
//             }
//         })
//         .catch(error => console.log("erro ao carregar", error));
//     }
// });

// Pesquisar valor ao mudar valor de um select
// document.addEventListener("change", (e) => {
//     if (e.target.tagName === "SELECT" && e.target.id === "selectData") {
//         const valor = e.target.value;
//         const name = e.target.name;
//         const url = e.target.dataset.url;
//         const formData = new FormData();

//         document.getElementById("inputSearch").value = "";
//         formData.append(name, valor);

//         fetch(url, {
//             method: "POST",
//             body: formData
//         })
//         .then(response => response.json())
//         .then(dado => {
//             const updateList = document.getElementById("updateList");
//             updateList.innerHTML = dado.message
//         })
//         .catch(error => console.log("erro ao carregar", error));
//     }
// });

// Pesquisar valor baseado em um único input
// document.addEventListener("click", (e) => {
//     if(e.target.id === "searchMaterial") {
//         const vUrl = e.target.dataset.url;
//         const form = new FormData();
//         const vInputSearch = document.getElementById("inputSearch");
//         const vIdRecipient = document.getElementById("idRecipient");


//         form.append(vInputSearch.name, vInputSearch.value);
//         form.append(vIdRecipient.name, vIdRecipient.value);

//         fetch(vUrl, {
//             method: "POST",
//             body: form
//         })
//         .then(response => response.json())
//         .then(data => {

//             if (data.erro) {
//                 const novoResponse = document.createElement("div");
//                 novoResponse.id = "response";
//                 novoResponse.innerHTML = data.message;
        
//                 document.body.appendChild(novoResponse);
        
//                 setTimeout(() => {
//                     removeElement(novoResponse);
//                 }, 3000);
 
//             } else {
//                 // const idModal = document.getElementById("modal");
//                 const updateList = document.getElementById("updateListModal");
//                 // idModal.appendChild(updateList);
//                 updateList.innerHTML = data.message; // HTML da listagem
//             }
//         })
//         .catch(error => console.log("erro ao carregar", error));
//     }
// })