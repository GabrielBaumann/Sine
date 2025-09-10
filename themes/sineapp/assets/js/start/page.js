// Impressão
document.addEventListener("click", (e) => {
    const vButton = e.target.closest("button");
    if(vButton && vButton.classList.contains("print")) {
        const vVersion = document.getElementById("version-panel").value;
        const vUrl = vButton.dataset.url
        
        fetch(vUrl + "/" + vVersion)
        .then(response => response.json())
        .then(data => {

            if(data.message) {
                return fncMessage(data.message);
            }
            
            if(data.redirect) {
                window.open(data.redirect,  "_blank");
            }
        
        })
    }
})

// Baixar em excel lista da CTERC
document.getElementById("list-excel-cterc")?.addEventListener("click", async (e) => {
    
    const vButton = e.target.closest("BUTTON");
    const vUrl = vButton.dataset.url
    const vLoding = showSplash(true);  

    try{
        window.location.href = vUrl;
    } catch(err) {
        fncMessage();
    } finally {
        vLoding?.remove();
    }

});

// Baixar painel em pdf
document.addEventListener("click", (e) => {
    const vButton = e.target.closest("button");

    if(vButton && vButton.id === "visualizar-pdf") {

        const vNameDocument = vButton.dataset.name + "_" + fncDateNowFile();
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
            filename: vNameDocument + '.pdf',
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
});

// Baixar JPEG
document.addEventListener("click", (e) => {
    const vButton = e.target.closest("button");
    
    if(vButton && vButton.id === "download_image") {

        // Elemento a ser convertido em imagem
        const elemento = document.getElementById('conteudo_pdf');
        
        // Desabilitar o botão durante o processamento
        vButton.disabled = true;
        vButton.textContent = "Processando...";
        
        // Calcular altura de todas as linhas (ignorando cabeçalhos)
        const linhas = document.querySelectorAll('#tabela tr:not(:has(th))');
        const linhasComAltura = [];
        
        linhas.forEach(linha => {
            const altura = linha.clientHeight;
            const descricaoCell = linha.querySelector('.descricao-cell');
            const descricao = descricaoCell ? descricaoCell.textContent : 'Sem descrição';
            
            linhasComAltura.push({
                elemento: linha.cloneNode(true),
                altura: altura,
                descricao: descricao.trim()
            });
        });
        
        const elementoOriginal = document.querySelector('.page');
        
        if (!elementoOriginal) {
            console.error('Elemento .page não encontrado');
            return;
        }
        
        // Dividir a tabela em páginas
        const pages = [];
        const maxHeightPerPage = 800; // Altura máxima por página (ajustável)
        
        // Variáveis para controle de paginação
        let currentPageRows = [];
        let currentHeight = 0;
        let pageNumber = 1;
        
        for (let i = 0; i < linhasComAltura.length; i++) {
            const linha = linhasComAltura[i];
            
            // Verificar se precisamos criar uma nova página
            if (currentHeight + linha.altura > maxHeightPerPage) {
                
                if (currentPageRows.length > 0) {
                    // Criar nova página com as linhas acumuladas
                    const newPage = elementoOriginal.cloneNode(true);
                    const newTable = newPage.querySelector('#tabela');
                    const newTbody = newTable.querySelector('tbody');
                    
                    // Remover conteúdo antigo
                    newTbody.innerHTML = '';
                    
                    // Adicionar linhas à nova página
                    currentPageRows.forEach(linha => {
                        newTbody.appendChild(linha.elemento.cloneNode(true));
                    });
                    
                    // Atualizar número da página
                    newPage.querySelector('.page-number').textContent = `Página ${pageNumber}`;
                    pageNumber++;
                    
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
        
        // Adicionar a última página (se houver linhas)
        if (currentPageRows.length > 0) {
            const newPage = elementoOriginal.cloneNode(true);
            const newTable = newPage.querySelector('#tabela');
            const newTbody = newTable.querySelector('tbody');
            newTbody.innerHTML = '';
            
            currentPageRows.forEach(linha => {
                newTbody.appendChild(linha.elemento.cloneNode(true));
            });
            
            newPage.querySelector('.page-number').textContent = `Página ${pageNumber}`;
            pages.push(newPage);
        }
        
        // Criar ZIP com todas as páginas como imagens
        const zip = new JSZip();
        const promises = [];
        
        // Atualizar informações de progresso
        const totalPages = pages.length;
        let completedPages = 0;
        
        // Função para atualizar a barra de progresso
        // const updateProgress = () => {
        //     const percent = Math.round((completedPages / totalPages) * 100);
        //     progressBar.style.width = `${percent}%`;
        //     progressText.textContent = `${percent}% concluído (${completedPages}/${totalPages} páginas)`;
        // };
        
        // Processar cada página
        pages.forEach((page, index) => {
            // Criar um container temporário para renderizar a página
            
            const container = document.createElement('div');
            container.style.position = 'absolute';
            container.style.left = '0px';
            container.style.top = '0px';
            container.style.width = '794px';
            container.style.height = '1110px';
            container.appendChild(page);
            document.body.appendChild(container);

            const promise = html2canvas(container, {
                scale: 2,
                useCORS: true,
                backgroundColor: '#FFFFFF',
                logging: false
            }).then(canvas => {
                return new Promise((resolve) => {
                    canvas.toBlob(blob => {
                        // Adicionar imagem ao ZIP
                        zip.file(`Painel_Vagas_Pagina_${index + 1}.jpeg`, blob);
                        
                        // Remover container temporário
                        document.body.removeChild(container);
                        
                        // Atualizar progresso
                        completedPages++;
                        // updateProgress();
                        
                        resolve();
                    }, 'image/jpeg', 0.95);
                });
            });
            
            promises.push(promise);
        });
        
        // Aguardar todas as páginas serem processadas
        Promise.all(promises).then(() => {
            // Gerar o arquivo ZIP
            zip.generateAsync({type: 'blob'}).then(content => {
                // Fazer download do ZIP
                saveAs(content, 'Painel_de_Vagas.zip');
                
                // Ocultar tela de carregamento
                loading.style.display = 'none';
                
                // Resetar progresso
                progressBar.style.width = '0%';
                progressText.textContent = '0% concluído';
                
                // Reabilitar o botão
                vButton.disabled = false;
                vButton.textContent = "📷 Baixar Painel como JPEGs";
            });
        }).catch(error => {
            console.error('Erro ao gerar imagens:', error);
            loading.style.display = 'none';
            alert('Ocorreu um erro ao gerar as imagens. Tente novamente.');
            
            // Reabilitar o botão
            vButton.disabled = false;
            vButton.textContent = "📷 Baixar Painel como JPEGs";
        });
    }
});

// atualizar painel baseado no filtro de versão
document.addEventListener("change", (e) => {
    const vButton = e.target;
    if(vButton.id === "version-panel") {
        const vUrl = vButton.dataset.url; 
        fetch(vUrl + "/" + vButton.value)
        .then(response => response.json())
        .then(data => {
            
            if(data.message) {
                fncMessage(data.message);
                return;
            }
            document.getElementById(data.content).innerHTML = data.html;
        });
    }
});

// Retorna da data de hoje no pdf ao baixaro arquivo
function fncDateNowFile() {
    const vToday = new Date();

    const vDay = String(vToday.getDate()).padStart(2, '0');
    const vMonth = String(vToday.getMonth() + 1).padStart(2, '0');
    const vYear = vToday.getFullYear();

    const vTime = String(vToday.getHours()).padStart(2, '0');
    const vMinutes = String(vToday.getMinutes()).padStart(2, '0');

    return `${vDay}${vMonth}${vYear}${vTime}${vMinutes}`;
}