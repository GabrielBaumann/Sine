<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Tabela de vagas</title>
  <style>
    body {
        font-family: sans-serif;
        margin: 0;
        padding: 0;
        font-size: 16px;
        background-color: #2c2c2c;
    }

    #visualizar-container {
        text-align: center;
        margin-bottom: 3px;
        padding: 7px 0;
        background-color: #3f3f3f;
        box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
    }

    #conteudo_pdf { 
        width: 210mm;
        margin: 0 auto;
        background: white;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .page {
        padding: 1.5cm;
        position: relative;
        min-height: 297mm;
        box-sizing: border-box;
    }

    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 8px;
        border-bottom: 4px solid #2e7d32;
        margin-bottom: 10px;
    }

    .header-left, .header-right {
        font-size: 16px;
        color: #2e7d32;
        font-weight: bold;
    }

    .logo-container {
        text-align: center;
        margin: 5px 0 15px 0;
    }

    .logo {
        width: 180px;
        display: block;
        margin: 0 auto 5px auto;
    }

    .title {
        text-align: center;
        margin: 10px;
    }

    .title h1 {
        font-size: 22px;
        font-weight: bold;
        color: #2e7d32;
        margin: 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    th {
        background-color: #2e7d32;
        color: white;
        padding: 12px;
        text-align: center;
        font-size: 16px;
        text-transform: uppercase;
    }

    td {
        padding: 12px;
        border: 1px solid #cecece;
        font-size: 15px;
        word-wrap: break-word;
    }

    .vaga-cell {
        font-weight: bold;
        text-transform: uppercase;
        width: 25%;
    }

    .qt-cell {
        font-weight: bold;
        text-transform: uppercase;
        text-align: center;
        width: 10%;
    }

    .descricao-cell {
        width: 65%;
        text-align: justify;
    }

    tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    tr {
        page-break-inside: avoid;
    }

    footer {
        text-align: center;
        font-size: 14px;
        position: absolute;
        /* bottom: 1.5cm; */
        bottom: 1.5cm;
        left: 1.5cm;
        right: 1.5cm;
        margin-top: 10px;
    }

    footer p {
        color: #6b7280;
        line-height: 1.3;
        margin: 4px 0;
    }

    #visualizar {
        background-color: #d42727;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 30px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    #visualizar:hover {
        background-color: #b92222;
    }

    /* Estilos específicos para PDF */
    @media print {
        body {
        background-color: white;
        }
        
        #visualizar-container {
        display: none;
        }
        
        .page {
        min-height: 277mm; /* A4 height - margins */
        height: auto;
        margin: 0;
        padding: 1.5cm;
        }
    }
</style>
</head>
<body>
  <div id="visualizar-container">
    <button id="visualizar">
      <span>Fazer download</span>
    </button>
  </div>

  <div class="container">
    <div id="conteudo_pdf">
      <!-- Página única no HTML -->
      <div class="page">
        <header>
          <div class="header-left">CANAÃ DOS CARAJÁS</div>
          <div class="header-right">SEGUNDA-FEIRA, 10/06/2025 - 8:00 AM</div>
        </header>

        <div class="logo-container">
          <img src="../../themes/sineapp/assets/images/logo-nacional.png" alt="logo-nacional" class="logo">
          <div class="title">
            <h1>Painel de vagas</h1>
          </div>
        </div>

        <div class="table-container">
          <table id="tabela">
            <thead>
              <tr>
                <th class="vaga-cell">Vaga</th>
                <th class="qt-cell">QT</th>
                <th class="descricao-cell-head">Descrição da Vaga</th>
              </tr>
            </thead>
            <tbody>
                <?php $tthis->insert("/printing/print_panel"); ?>
            </tbody>
          </table>
        </div>

        <footer>
          <p>Avenida JK, N° 104, Vale Dourado - CEP: 68.534-149</p>
          <p>Tel. (94) 99123-5373</p>
          <p>Canaã dos Carajás - PA</p>
        </footer>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
  <script>
     document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM totalmente carregado');

    // Calcular altura de todas as linhas (ignorando cabeçalhos)
    const linhas = document.querySelectorAll('#tabela tr:not(:has(th))');
    const linhasComAltura = [];
    
    linhas.forEach(linha => {
        const altura = linha.clientHeight;
        const descricaoCell = linha.querySelector('.descricao-cell');
        const descricao = descricaoCell ? descricaoCell.textContent : 'Sem descrição';
        
        linhasComAltura.push({
            elemento: linha.cloneNode(true), // Clonamos a linha aqui para evitar referências cruzadas
            altura: altura,
            descricao: descricao.trim()
        });
        console.log(`Linha com "${descricao.trim()}" tem ${altura}px de altura`);
    });

    const botaoVisualizar = document.getElementById('visualizar');
    
    if (botaoVisualizar) {
        console.log('Botão visualizar encontrado');
        
        botaoVisualizar.addEventListener('click', function() {
            console.log('Botão visualizar clicado');
            
            const elemento = document.getElementById('conteudo_pdf');
            
            if (!elemento) {
                console.error('Elemento conteudo_pdf não encontrado');
                return;
            }

            // Clonamos todo o conteúdo
            const elementoClone = elemento.cloneNode(true);
            const originalPage = elementoClone.querySelector('.page');
            
            if (!originalPage) {
                console.error('Elemento .page não encontrado');
                return;
            }

            // Pegamos o cabeçalho da tabela original
            const originalTable = originalPage.querySelector('table');
            const originalThead = originalTable ? originalTable.querySelector('thead') : null;
            
            // Dividir a tabela em páginas
            const pages = [];
            const maxHeightPerPage = 800; // Altura máxima ajustada para 800px
            
            // Variáveis para controle de paginação
            let currentPageRows = [];
            let currentHeight = 0;
            
            for (let i = 0; i < linhasComAltura.length; i++) {
                const linha = linhasComAltura[i];
                
                // Verificar se precisamos criar uma nova página
                if (currentHeight + linha.altura > maxHeightPerPage) {
                    if (currentPageRows.length > 0) {
                        // Criar nova página com as linhas acumuladas
                        const newPage = originalPage.cloneNode(true);
                        const newTable = newPage.querySelector('table');
                        const newTbody = newTable.querySelector('tbody');
                        
                        // Manter apenas o cabeçalho e remover conteúdo antigo
                        newTbody.innerHTML = '';
                        
                        // Adicionar linhas à nova página
                        currentPageRows.forEach(linha => {
                            newTbody.appendChild(linha.elemento.cloneNode(true));
                        });
                        
                        pages.push(newPage);
                    }
                    
                    // Resetar para a próxima página
                    currentPageRows = [linha];
                    currentHeight = linha.altura;
                } else {
                    // Adicionar linha à página atual
                    currentPageRows.push(linha);
                    currentHeight += linha.altura;
                }
            }
            
            // Adicionar a última página (se houver linhas e não estiver vazia)
            if (currentPageRows.length > 0) {
                const newPage = originalPage.cloneNode(true);
                const newTable = newPage.querySelector('table');
                const newTbody = newTable.querySelector('tbody');
                newTbody.innerHTML = '';
                
                currentPageRows.forEach(linha => {
                    newTbody.appendChild(linha.elemento.cloneNode(true));
                });
                
                pages.push(newPage);
            }
            
            // Substituir o conteúdo original pelas páginas divididas
            elementoClone.innerHTML = '';
            
            // Adicionar todas as páginas exceto a última se estiver vazia
            const effectivePages = pages.filter(page => {
                const tbody = page.querySelector('tbody');
                return tbody.children.length > 0;
            });
            
            effectivePages.forEach(page => elementoClone.appendChild(page));
            
            // Configurações para o PDF
            const opt = {
                margin: [1.5, 1.5, 1.5, 1.5],
                filename: 'painel_de_vagas.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { 
                    scale: 2,
                    useCORS: true,
                    scrollX: 0,
                    scrollY: 0,
                    letterRendering: true
                },
                jsPDF: { 
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait'
                },
                pagebreak: {
                    mode: ['css', 'legacy'],
                    avoid: ['tr', '.page']
                }
            };

            if (typeof html2pdf !== 'undefined') {
                console.log('Iniciando geração do PDF');
                html2pdf().set(opt).from(elementoClone).save();
            } else {
                console.error('html2pdf não está definido');
                alert('Erro: Biblioteca html2pdf não carregada corretamente');
            }
        });
    } else {
        console.error('Botão com ID "visualizar" não encontrado');
        alert('Erro: Botão "Visualizar" não encontrado');
    }
});
  </script>
</body>
</html>