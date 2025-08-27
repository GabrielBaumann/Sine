<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Reativação</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
        }
        
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        
        .modal-content {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            width: 450px;
            max-width: 90%;
            text-align: center;
            animation: fadeIn 0.1s ease-out;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
    </style>
</head>
<body>
    <!-- Modal de confirmação -->
    <div class="modal-overlay" id="confirmationModal">
        <div class="modal-content">
            <p class="modal-message font-semibold text-xl py-5"><?= $textMessage ?? "Erro!" ?></p>
            <div class="modal-buttons flex justify-center gap-4">
            <?php if($delete): ?>
                <form action="<?= url("/excluirvaga/". fncEncrypt($idVacancy)) ?>" method="post">
                    <button class="modal-button confirm-button bg-green-600 hover:bg-green-700 cursor-pointer rounded-md py-2 px-3 text-white font-semibold" id="confirmBtn">Sim, quero excluir</button>
                </form>
            <?php endif; ?>    
                <button id="cancelBtn" class="modal-button cancel-button cursor-pointer hover:bg-red-600 bg-red-500 rounded-md py-2 px-3 text-white font-semibold">Cencelar</button>
            </div>
        </div>
    </div>
</body>
</html>