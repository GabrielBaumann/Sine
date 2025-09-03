<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Tabela de vagas</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
  <style>
    body {
        font-family: sans-serif;
        margin: 0;
        padding: 0;
        font-size: 16px;
        background-color: #6b7280;
    }

    #visualizar-container {
        text-align: center;
        margin-bottom: 3px;
        padding: 12px;
        background-color: #373b41ff;
    }

    #visualizar-pdf {
        background-color: white;
        border: none;
        border-radius: 30px;
        padding: 12px;
        gap: 3;
        color: #373737;
        font-size: 12px;
        cursor: pointer;
        text-align: center;
        justify-content: center;
    }

    #visualizar-pdf:hover {
        background-color: #aeaeaeff;
    }

    #download_image {
        background-color: #373b41ff;
        border: none;
        border-radius: 30px;
        padding: 12px;
        gap: 3;
        color: white;
        border: 1px solid white;
        font-size: 12px;
        cursor: pointer;
        text-align: center;
        justify-content: center;
    }

    #download_image:hover {
        background-color: #2b2e32ff;
    }

    #conteudo_pdf { 
        width: 210mm;
        margin: 0 auto;
        margin-top: 0;
        background: white;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);       
    }

    .page {
        padding: 1.5cm;
        position: relative;
        min-height: 290mm;
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
        align-items: center;
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
        left: 1.5cm;
        right: 1.5cm;
        bottom: 0cm;
    }

    footer p {
        color: #6b7280;
        line-height: 1.3;
        margin: 1px 0;
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
        min-height: 277mm; 
        height: auto;
        margin: 0;
        padding: 1.5cm;
        
        }
    }
</style>
</head>
<body>
    <div id="visualizar-container" class="flex items-center justify-center gap-3 p-10">
        <button id="visualizar-pdf" data-name="PAINEL VAGA" class="flex gap-2 bg-red-500 p-2 text-white font-semibold rounded-md cursor-pointer hover:bg-red-600">
            <span>Baixar PDF</span>
        </button>

        <button id="download_image" class="flex gap-2 bg-yellow-500 p-2 text-black font-semibold rounded-md cursor-pointer hover:bg-yellow-600">
            <span>Baixar como imagem</span>
        </button>

    </div>

    <div class="container">
        <div id="conteudo_pdf">
            <!-- Página única no HTML -->
            <div class="page">
                <header>
                    <div class="header-left">CANAÃ DOS CARAJÁS</div>
                    <div class="header-right"><?= day_now_string() ?>, <?= date_simple() ?> - <?= time_now() ?></div>
                </header>

                <div class="logo-container">
                    <img src="<?= theme("/assets/images/logo-nacional.png", CONF_VIEW_APP) ?>" alt="logo-nacional" class="logo">
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
                            <?php foreach($panelVacancy as $panelVacancyItem): ?>
                                <tr>
                                    <td class="vaga-cell"><?= $panelVacancyItem->nomeclatura_vacancy; ?></td>
                                    <td class="qt-cell"><?= $panelVacancyItem->total_vancacy_general; ?></td>
                                    <td class="descricao-cell"><?= $panelVacancyItem->description_vacancy; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <footer>
                    <p>Avenida JK, N° 104, Vale Dourado - CEP: 68.534-149</p>
                    <p>Tel. (94) 99123-5373</p>
                    <p>Canaã dos Carajás - PA</p>
                    <p class="page-number" hidden>Página 1</p>
                </footer>
            </div>
        </div>
    </div>

    <script src="<?= theme("/assets/js/start/page.js", CONF_VIEW_APP); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</body>
</html>