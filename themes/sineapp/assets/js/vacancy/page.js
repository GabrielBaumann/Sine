const vLine = [...document.getElementsByTagName("tr")];

if (vLine) {
    vLine.map((e)=>{
        const span = e.getElementsByTagName("span")[0];
        
        if (span && span.innerText === "Encerrada") {
            span.classList.replace("bg-green-100", "bg-orange-100");
            span.classList.replace("text-green-800", "text-orange-800");
        }
    })
}



