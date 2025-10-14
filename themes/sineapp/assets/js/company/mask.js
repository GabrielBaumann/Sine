// Máscara para CNPJ
document.addEventListener("input", function(e) {
  if(e.target.id === "input-cnpj") {
      document.getElementById('input-cnpj').addEventListener('input', function (e) {
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

// Máscara para CPF
document.addEventListener("input", function(e) {
  if(e.target.id === "input-cpf") {
      document.getElementById('input-cpf').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, '');

        // Limita a 11 dígitos
        value = value.slice(0, 11);

        // Aplica a máscara do CPF
        if (value.length >= 10) {
            value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{1,2})/, '$1.$2.$3-$4');
        } else if (value.length >= 7) {
            value = value.replace(/(\d{3})(\d{3})(\d{1,3})/, '$1.$2.$3');
        } else if (value.length >= 4) {
            value = value.replace(/(\d{3})(\d{1,3})/, '$1.$2');
        }

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

// Mudar input de CNPJ para CPF
function typedocument() {
  const cnpj = document.getElementById('cnpj');
  const cpf = document.getElementById('cpf');

  if (cnpj.classList.contains('hidden')) {
    cnpj.classList.remove('hidden');
    cpf.classList.add('hidden');
  } else {
    cnpj.classList.add('hidden');
    cpf.classList.remove('hidden');
  }
}