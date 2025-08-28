<!-- Header -->
<div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-6 md:mb-0">
    <div class="flex items-center gap-3">
        <button
            id="btn-back"
            data-url="<?= url("/historicoatendimento/" .  fncEncrypt($service->id_worker)); ?>"
            data-change="content"
            class="cursor-pointer p-1 px-2 rounded-full border border-gray-300 text-gray-700 hover:bg-[#095998] hover:text-white transition-all duration-200 flex items-center gap-1">
            < Voltar
        </button>
    </div>
</div>

<div class="overflow-hidden">
    <div class="container mx-auto py-8">
        <!-- Worker Info Section -->
        <div class="mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex-1">
                    <h3 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
                        <?= $service->name_worker; ?>
                    </h3>
                    <div class="mt-2">
                        <p class="text-md text-gray-600"><?= formatCPF($service->cpf_worker); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Interview Section -->
        <div class="mb-6">
            <div class="flex items-center mb-6 gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-blue-700">
                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm4.28 10.28a.75.75 0 0 0 0-1.06l-3-3a.75.75 0 1 0-1.06 1.06l1.72 1.72H8.25a.75.75 0 0 0 0 1.5h5.69l-1.72 1.72a.75.75 0 1 0 1.06 1.06l3-3Z" clip-rule="evenodd" />
                </svg>
                <h1 class="text-xl font-normal text-gray-900"><?= $service->type_service;?><?=  $service->nomeclatura_vacancy ? ": Ocupação " . $service->nomeclatura_vacancy : ""; ?></h1>
            </div>
            <?php if($service->nomeclatura_vacancy): ?><h1 class="text-xl font-normal text-gray-900">Empresa: <?= $service->name_fantasy_enterpise; ?></h1><?php endif;?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Date -->
                <div class="col-span-2 md:col-span-1">
                    <p class="text-sm font-medium text-gray-700 mb-1">Data:</p>
                    <p class="text-lg bg-gray-100 text-gray-600 p-4"><?= date_simple($service->date_register); ?></p>
                </div>
                <!-- Observation -->
                <div class="col-span-2">
                    <label for="observation" class="block text-sm font-medium text-gray-700 mb-2">Observação</label>
                    <div id="observation" name="observation" class="bg-gray-100 w-full p-4 rounded-md  min-h-32 text-gray-600">
                       <?= $service->service_detail ?? null; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions Section -->
        <div class="">
            <div class="flex flex-col sm:flex-row gap-4">
                <?php if(in_array($service->id_type_service, ["4","56"])): ?>
                    <?php if($service->status_vacancy_worker === "Aguardando resposta"): ?>
                        <?php if(in_array($userSystem ->type_user, ["DEV","ADM"])): ?>
                            <form action="<?= url("/finalizarencaminhatoentrevista"); ?>" method="post" class="flex flex-col sm:flex-row gap-4">
                                <?= csrf_input(); ?>

                                <input name="id-service" type="hidden" value="<?= fncEncrypt($service->id_service) ?>">
                                <input name="id-worker" type="hidden" value="<?= fncEncrypt($service->id_worker) ?>">                            
                                <input name="id-vacancy" type="hidden" value="<?= fncEncrypt($service->id_vacancy) ?>">

                                <div class="flex flex-col gap-4 w-full">
                                    <div class="flex gap-4 w-full">
                                        <div class="flex flex-col w-full">
                                            <label for="motivo">*</label>
                                            <select id="motivo" name="source-service-vacancy" class="bg-gray-200 flex-1 border border-gray-100 p-2 rounded-md cursor-pointer">
                                                <option value="">selecione um motivo</option>
                                                <option value="Na ocupação">Na ocupação</option>
                                                <option value="Em outra ocupação">Em outra ocupação</option>
                                                <option value="Trabalhador recusou condições oferecidas pelo empregador">Trabalhador recusou condições oferecidas pelo empregador</option>
                                                <option value="Trabalhador reprovado no processo de seleção">Trabalhador reprovado no processo de seleção</option>
                                                <option value="Trabalhador não atendeu às exigências do empregador">Trabalhador não atendeu às exigências do empregador</option>
                                                <option value="Trabalhador já trabalhou na empresa e foi dispensado da mesma">Trabalhador já trabalhou na empresa e foi dispensado da mesma</option>
                                                <option value="Trabalhador não compareceu à empresa">Trabalhador não compareceu à empresa</option>
                                                <option value="Empregador não atendeu o trabalhador">Empregador não atendeu o trabalhador</option>
                                                <option value="Vaga cancelada pelo empregador">Vaga cancelada pelo empregador</option>
                                                <option value="Vaga preenchida por outro trabalhador">Vaga preenchida por outro trabalhador</option>
                                                <option value="Vaga preenchida por outras fontes">Vaga preenchida por outras fontes</option>
                                                <option value="Turma Cancelada">Turma Cancelada</option>
                                            </select>
                                        </div>
                                        <div class="flex flex-col">
                                            <label for="date-response-company" class="text-gray-500">Data de Resposta *</label>
                                            <input type="date" name="date-response-company" id="date-response-company" class="p-2 bg-gray-200 border border-gray-100 rounded-md">
                                        </div>
                                        <div class="flex flex-col w-full">
                                            <label for="detail-response-company" class="text-gray-500">Observação</label>
                                            <input type="text" name="detail-response-company" id="detail-response-company" class="p-2 bg-gray-200 border border-gray-100 rounded-md w-full md:w-[500px] 2xl:w-[700px]">
                                        </div>
                                    </div>
                                    <div class="flex w-full gap-4">
                                        <div class="flex flex-col sm:flex-row gap-3">
                                            <button class="flex-1 cursor-pointer bg-green-600 hover:bg-green-700 text-white font-medium p-3 rounded-md transition duration-200">
                                                <span>Salvar</span>
                                            </button>
                                        </div>
                                    
                                        <div class="flex flex-col sm:flex-row gap-3">
                                            <button name="actionbtn" value="delete" class="flex-1 cursor-pointer border border-red-400 hover:bg-red-500 hover:text-white text-red-500 p-3  font-medium rounded-md transition duration-200">
                                                <span>Excluir</span>
                                            </button>
                                        </div>
                                    </form>
                        <?php endif; ?>
                            </div>
                        </div>
                        
                    <?php else:?>
                        <div class="flex gap-4 w-full">
                            <div class="flex flex-col">
                                <div class="text-gray-700">Status:</div> 
                                <div class="p-3 border border-green-400 bg-green-100 text-green-500 rounded-md"><?= $service->status_vacancy_worker; ?></div>
                            </div>
                            <div class="flex flex-col">
                                <div class="text-gray-700">Data:</div> 
                                <div class="p-3 bg-gray-200 rounded-md"><?= date_simple($service->date_response_company); ?></div>
                            </div>
                            <div class="flex flex-col w-full max-w-[300px]">
                                <div class="text-gray-700">Obs:</div> 
                                <div class="p-3 bg-gray-200 rounded-md"><?= $service->detail_response; ?></div>
                            </div>
                        </div>
                    <?php endif;?>
                <?php else:?>

                <?php if(in_array($userSystem ->type_user, ["DEV","ADM"])): ?>
                        <div class="flex flex-col sm:flex-row gap-3">
                            <form action="<?= url("/editarservicotrabalhador/atendimentosexcluir"); ?>" method="post" class="flex flex-col sm:flex-row gap-4">
                            <?= csrf_input(); ?>

                            <input name="id-service" type="hidden" value="<?= $service->id_service ?>">
                            <input name="id-worker" type="hidden" value="<?= $service->id_worker ?>">   

                                <button class="flex-1 cursor-pointer border border-red-400 hover:bg-red-500 hover:text-white text-red-500 py-3 md:py-0 font-medium px-4 rounded-md transition duration-200">
                                    <span>Excluir</span>
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>
                <?php endif;?>
            </div>
        </div>