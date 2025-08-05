// Máscara para CNPJ
document.addEventListener("input", function(e) {
  if(e.target.id === "cnpj") {
      document.getElementById('cnpj').addEventListener('input', function (e) {
      let value = e.target.value.replace(/\D/g, '');

      if (value.length > 14) value = value.slice(0, 14);

      value = value.replace(/^(\d{2})(\d)/, '$1.$2');
      value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
      value = value.replace(/\.(\d{3})(\d)/, '.$1/$2');
      value = value.replace(/(\d{4})(\d)/, '$1-$2');

      e.target.value = value;
    });
  }
});

// Máscara para telefone
document.addEventListener('input', function(e) {
  if (e.target && e.target.id === "phone-enterprise") {
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