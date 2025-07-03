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
        margin-top: 0;
        background: white;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);       
    }

    .page {
        /* /* top: 0; */
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
        /* border: 1px dashed #999; */
        }
        
        #visualizar-container {
        display: none;
        }
        
        .page {
        min-height: 277mm;  /* A4 height - margins */
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
                                    <td class="vaga-cell"><?= $panelVacancyItem->nomeclatura_vacancy ?></td>
                                    <td class="qt-cell"><?= $panelVacancyItem->total_vacancy_active ?></td>
                                    <td class="descricao-cell"><?= $panelVacancyItem->description_vacancy ?></td>
                                </tr>
                            <?php endforeach; ?>
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
</body>
</html>