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
