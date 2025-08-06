document.addEventListener("click", (e) => {
    const vButton = e.target.closest("button");
    const vListWorks = document.getElementById("content");    

    if(vButton && vButton.id === "btn-edit") {

        fetch(vButton.dataset.url)
        .then(response => response.json())
        .then(data => {
            vListWorks.innerHTML = data.html;
        })
    }
});