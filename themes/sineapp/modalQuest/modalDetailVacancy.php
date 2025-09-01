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
            /* background-color: rgba(255, 255, 255, 0.9); */
            /* padding: 30px; */
            border-radius: 10px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            width: 600px;
            /* height: 400px; */
            max-width: 90%;
            text-align: center;
            animation: fadeIn 0.4s ease-out;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body>

    <!-- Modal de confirmação -->
    <div class="modal-overlay" id="confirmationModal">
        <div class="modal-content flex flex-col bg-white">
            <div class="flex items-center justify-between border-b border-gray-400 px-5 py-2">
                <div class="modal-title font-light text-gray-600 font-semibold text-xl"><?= $title ?? "Erro!" ?></div>
                <button id="cancelBtn" class="flex justify-end items-end text-right text-2xl font-extralight text-gray-500 cursor-pointer p-2">
                    X
                </button>

            </div>
                <div class="flex p-5 ml-5 justify-between pb-0">
                    <div class="flex flex-col">
                        <span class="text-sm text-gray-500">Vaga:</span>
                        <span class="font-semibold text-md"><?= $orderVacancy; ?></span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-sm text-gray-500">Quantidade por vaga:</span>
                        <span class="font-semibold text-md"><?= format_number($quantityPerVacancy); ?></span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-sm text-gray-500">Quantidade de encaminhamentos:</span>
                        <span class="font-semibold text-md"><?= format_number($totalPerVacancy); ?></span>
                    </div>
                </div>
            <div class="flex flex-col h-full justify-between pb-4">
                    <div class="flex flex-col mt-4 p-4">
                        <div class="flex flex-col w-full max-h-[600px] overflow-y-auto gap-4">
                            <?php foreach($vwForwardingWorker as $vwForwardingWorkerItem): ?>
                                <!-- CARD -->
                                <div class="flex flex-col text-left gap-3 bg-white  border-b-2 border-gray-300 p-4">
                                    <div class="flex flex-col">
                                        <span class="text-sm text-gray-500">NOME</span>
                                        <span class="font-semibold text-md"><?= $vwForwardingWorkerItem->name_worker; ?></span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm text-gray-500">CPF</span>
                                        <span class="font-semibold text-md"><?= formatCPF($vwForwardingWorkerItem->cpf_worker); ?></span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm text-gray-500">Observação durante o encaminhamento</span>
                                        <span class="font-semibold text-md"><?= $vwForwardingWorkerItem->detail_service ?? "..." ?></span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm text-gray-500">DATA do Encaminhamento</span>
                                        <span class="font-semibold text-md"><?= date_simple($vwForwardingWorkerItem->date_forwarding); ?></span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm text-gray-500">STATUS</span>
                                        <span class="font-semibold text-sm px-3 p1-2 text-yellow-900 bg-yellow-300 rounded-full max-w-[220px]"><?= $vwForwardingWorkerItem->status_vacancy_worker; ?></span>
                                    </div>
                                    <?php if($vwForwardingWorkerItem->status_vacancy_worker <> "Aguardando resposta"): ?>
                                        <div class="flex flex-col">
                                            <span class="text-sm text-gray-500">DATA da Resposta do Empregador</span>
                                            <span class="font-semibold text-md"><?= date_simple($vwForwardingWorkerItem->date_response_company); ?></span>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-sm text-gray-500">Detalhe da resposta</span>
                                            <span class="font-semibold text-md"><?= $vwForwardingWorkerItem->detail_response; ?></span>
                                        </div>
                                    <?php endif;?>
                                    <div class="flex flex-col">
                                        <span class="text-sm text-gray-500">SERVIDOR</span>
                                        <span class="font-semibold text-md"><?= $vwForwardingWorkerItem->name_user; ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <div class="">
                    <button id="cancelBtn" class="flex items-center text-center mx-auto gap-2 bg-green-500 text-white px-4 py-2 rounded-md cursor-pointer hover:bg-green-600 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                        <span>OK</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>