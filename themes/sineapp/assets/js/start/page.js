// Impressão
document.addEventListener("click", (e) => {
    const vButton = e.target.closest("button");

    if(vButton && vButton.id === "print-panel") {
        // console.log(vButton.dataset.url);
        const vUrl = vButton.dataset.url
        fetch(vUrl)
        .then(response => response.json())
        .then(data => {

            const vDiv = document.getElementById("content");
            vDiv.innerHTML = data.html;
        })
    }
})