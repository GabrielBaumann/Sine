
// let vArrayNavigation = [];

// // Chamadas do atendimento
// document.addEventListener("click", (e) => {
//     const vButton = e.target.closest("button");
//     const vUrl = vButton?.dataset.url;
//     const vIdServiceType = vButton?.dataset.idservice;
    
    
//     if(e.target.id = "bntBack" && e.target.tagName === "BUTTON") {
//         // vArrayNavigation.pop();
//     }

//     if(vUrl) {

//         const vTextTitle = vButton.querySelector("span")?.innerText;
//         const vNavigationText = vButton.querySelector("span")?.textContent;       

//         fetch(vUrl)
//         .then(response => response.text())
//         .then(data => {

//             const vElementoNew = document.getElementById("newElement");
//             vElementoNew.innerHTML = data

//             const vTitleForm = document.getElementById("titleForm");
//             const vId = document.getElementById("idServiceType");

//             // Criar barra de vavegação por local
//             const vConteinerLocation = document.querySelector("p.navigation");
            
//             if(vConteinerLocation) {

//                 const vLocation = document.createElement("button");
//                 vLocation.innerText = vNavigationText + " > ";
//                 vLocation.id = "navigation"
//                 vLocation.dataset.url = document.getElementById("bntBack").dataset.url

//                 vArrayNavigation.push(vLocation);

//                 vArrayNavigation.forEach((item) => {
//                     vConteinerLocation.appendChild(item);
//                 });
//             }

//             if(vTitleForm) {
//                 if (vTextTitle && vTextTitle) {
//                     vTitleForm.textContent = vTextTitle;
//                     vId.value = vIdServiceType;
                    
//                 }
//             }
//         });
//     }
// })