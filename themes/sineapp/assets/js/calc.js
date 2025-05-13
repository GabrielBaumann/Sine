document.addEventListener("change", (e) => {
    if (e.target.id === "unitPrice" || e.target.id === "amount") {
    
        const vUnitPrice = parseFloat(document.getElementById("unitPrice").value) || 0;
        const vAmount = parseFloat(document.getElementById("amount").value) || 0;

        const vTotal = vUnitPrice * vAmount;

        const formatValue = vTotal.toLocaleString('pt-BR', {
            style: 'currency',
            currency:  'BRL'
        });

        const vValueTotal = document.getElementById("valueTotal");
        vValueTotal.value = formatValue;
    }
})