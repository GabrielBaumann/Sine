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
    }

    #visualizar-container {
        text-align: center;
        margin-bottom: 3px;
        padding: 7px 0;
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
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13" />
            </svg>
            <span>Baixar PDF</span>
        </button>

        <button id="download_image" class="flex gap-2 bg-yellow-500 p-2 text-black font-semibold rounded-md cursor-pointer hover:bg-yellow-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
            </svg>
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

</body>
</html>