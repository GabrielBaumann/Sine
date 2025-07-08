// Impressão
document.addEventListener("click", (e) => {
    const vButton = e.target.closest("button");

    if(vButton && vButton.id === "print-panel") {
        // console.log(vButton.dataset.url);
        const vUrl = vButton.dataset.url
        fetch(vUrl)
        .then(response => response.json())
        .then(data => {

            if(data.message) {
                return fncMessage(data.message)
            }

            const vDiv = document.getElementById("content");
            vDiv.innerHTML = data.html;

        })
    }
})

// Baixar painel em pdf
document.addEventListener("click", (e) => {

    const vButton = e.target.closest("button");

    if(vButton && vButton.id === "visualizar") {
            
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
            // console.log(`Linha com "${descricao.trim()}" tem ${altura}px de altura`);
        });
   
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
            // console.log('Iniciando geração do PDF');
            html2pdf().set(opt).from(elementoClone).save();
        } else {
            // console.error('html2pdf não está definido');
            alert('Erro: Biblioteca html2pdf não carregada corretamente');
        }

    }
})