<!-- Header -->
<div class="flex items-center gap-3 mb-4">
    <button
        id="btn-back"
        data-url="<?= url("/historicoatendimento/" .  fncEncrypt($service->id_worker)); ?>"
        data-change="content"
        class="cursor-pointer text-blue-500 gap-2">
        < Voltar à página de trabalhador
    </button>
</div>

<div class="overflow-hidden">

    <!-- Info Section -->
    <div class="mb-4 flex flex-col gap-3 bg-white rounded-2xl p-5 mb-4">
        <div class="flex items-center gap-2">
            <h1 class="text-xl font-semibold text-gray-800 text-2xl uppercase"><?= $service->type_service;?><?=  $service->nomeclatura_vacancy ? ": " . $service->nomeclatura_vacancy : ""; ?></h1>
        </div>

        <?php if($service->nomeclatura_vacancy): ?><h1 class="text-xl font-normal text-gray-800">Empresa: <?= $service->name_fantasy_enterpise; ?></h1><?php endif;?>
    </div>

    <div class="mb-4 p-5 bg-white rounded-2xl">
        <div class="mb-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex flex-col gap-3">
                <div class="flex items-center text-gray-800 flex items-center gap-2">
                    <span>Trabalhador:</span>
                    <span class="font-semibold"><?= $service->name_worker; ?></span>
                </div>
                <div class="flex items-center gap-2 text-gray-800">
                    <span>CPF:</span>
                    <p class="font-semibold"><?= formatCPF($service->cpf_worker); ?></p>
                </div>
                <div class="flex items-center gap-2 text-gray-800">
                    <p>Data:</p>
                    <p class="font-semibold"><?= date_simple($service->date_register); ?></p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Observation -->
            <div class="col-span-2">
                <label for="observation" class="mb-3 text-gray-800">Observação</label>
                <textarea disabled id="observation" name="observation" class="resize-none bg-gray-100 border-none w-full p-4 rounded-md text-gray-500" rows="4"><?= $service->service_detail ?? null; ?></textarea>
           </div>

            <div class="col-span-2 flex justify-end">
                <button data-url="<?= url("/salvaredicaoatendimento"); ?>" id="edit-detail" class="py-2 px-4 flex items-center gap-2 cursor-pointer bg-yellow-300 text-black rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                    </svg>
                    <span>Editar observação</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Actions Section -->
    <div class="flex flex-col sm:flex-row gap-4 bg-white rounded-2xl p-5">
        <?php if(in_array($service->id_type_service, ["4","56"])): ?>
            <?php if($service->status_vacancy_worker === "Aguardando resposta"): ?>
                <?php if(in_array($userSystem->type_user, ["DEV","ADM"])): ?>
                    <form action="<?= url("/finalizarencaminhatoentrevista"); ?>" method="post" class="flex flex-col sm:flex-row gap-4">
                        <?= csrf_input(); ?>

                        <input name="id-service" type="hidden" value="<?= fncEncrypt($service->id_service) ?>">
                        <input name="id-worker" type="hidden" value="<?= fncEncrypt($service->id_worker) ?>">                            
                        <input name="id-vacancy" type="hidden" value="<?= fncEncrypt($service->id_vacancy) ?>">

                        <div class="flex flex-col gap-4 w-full">
                            <h1 class="font-semibold text-xl uppercase text-gray-800">encerramento de vaga</h1>
                            <div class="flex gap-4 w-full">
                                <div class="flex flex-col w-full">
                                    <label for="motivo">Motivo do encerramento *</label>
                                    <select id="motivo" name="source-service-vacancy" class="flex-1 border border-gray-400 p-2 rounded-md cursor-pointer">
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
                                    <label for="date-response-company" class="text-gray-800">Data de Resposta *</label>
                                    <input type="date" name="date-response-company" id="date-response-company" class="p-2 border border-gray-400 rounded-md">
                                </div>
                                <div class="flex flex-col w-full">
                                    <label for="detail-response-company" class="text-gray-800">Observação</label>
                                    <input type="text" name="detail-response-company" id="detail-response-company" class="p-2 border border-gray-400 rounded-md w-full md:w-[500px] 2xl:w-[700px]">
                                </div>
                            </div>
                            <div class="flex w-full gap-4">
                                <div class="flex flex-col sm:flex-row gap-3">
                                    <button class="flex items-center gap-2 cursor-pointer bg-green-600 hover:bg-green-700 text-white py-2 px-6 rounded-full transition duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                        </svg>
                                        <span class="">Salvar</span>
                                    </button>
                                </div>
                            
                                <div class="flex flex-col sm:flex-row gap-3">
                                    <button name="actionbtn" value="delete" class="flex items-center gap-2 cursor-pointer border border-red-400 hover:bg-red-500 hover:text-white text-red-500 py-2 px-6 rounded-full transition duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                        <span>Excluir cadastro</span>
                                    </button>
                                </div>
                            </form>
                <?php endif; ?>
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

                <?php if(in_array($userSystem->type_user, ["DEV","ADM"])): ?>
                    <div class="flex flex-col md:justify-end md:flex gap-3 w-full">
                        <div class="flex flex-col sm:flex-row gap-4 justify-end">
                            <button id="delete-service" data-url="<?= url("confirmarexcluir"); ?>" class="flex items-end gap-3 cursor-pointer border border-red-400 hover:bg-red-500 hover:text-white text-red-500 py-2 px-4 rounded-full transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                                <span>Excluir cadastro</span>
                            </button>
                        </div>
                    </div>
                <?php endif; ?>
        <?php endif;?>
    </div>