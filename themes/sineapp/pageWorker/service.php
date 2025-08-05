<!-- Header -->
<div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-6 md:mb-0">
    <div class="flex items-center gap-3">
        <button
            id="btn-back"
            data-url="<?= url("/historicoatendimento/" .  $service->id_worker); ?>"
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
                        Observação bem observada
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions Section -->
        <div class="">
            <div class="flex flex-col sm:flex-row gap-4">
                <?php if(in_array($service->id_type_service, ["4","56"])): ?>
                    <?php if($service->status_vacancy_worker === "Aguardando resposta"): ?>
                        <form action="<?= url("/finalizarencaminhatoentrevista"); ?>" method="post" class="flex flex-col sm:flex-row gap-4">
                            <?= csrf_input(); ?>

                            <input name="id-service" type="hidden" value="<?= $service->id_service ?>">
                            <input name="id-worker" type="hidden" value="<?= $service->id_worker ?>">                            

                            <div class="flex flex-col gap-4 w-full">
                                <div class="flex gap-4 w-full">
                                    <div class="flex flex-col w-full">
                                        <label for="motivo">*</label>
                                        <select id="motivo" name="source-service-vacancy" class="bg-gray-200 flex-1 border border-gray-100 p-2 rounded-md cursor-pointer">
                                            <option value="">selecione um motivo</option>
                                            <option value="Na ocupação">Na ocupação</option>
                                            <option value="Trabalhador recusou condições oferecidas pelo empregador">Trabalhador recusou condições oferecidas pelo empregador</option>
                                            <option value="Turma Cancelada">Turma Cancelada</option>
                                        </select>
                                    </div>
                                    <div class="flex flex-col">
                                        <label for="" class="text-gray-500">Data de Resposta *</label>
                                        <input type="date" class="p-2 bg-gray-200 border border-gray-100 rounded-md">
                                    </div>
                                    <div class="flex flex-col w-full">
                                        <label for="" class="text-gray-500">Observação</label>
                                        <input type="text" class="p-2 bg-gray-200 border border-gray-100 rounded-md w-full">
                                    </div>
                                </div>
                            <div class="flex w-full gap-4">
                                <div class="flex flex-col sm:flex-row gap-3">
                                    <button class="flex-1 cursor-pointer bg-green-600 hover:bg-green-700 text-white font-medium p-3 rounded-md transition duration-200">
                                        <span>Salvar</span>
                                    </button>
                                </div>
                                </form>
                                
                                <?php if(in_array($userSystem ->type_user, ["dev","adm"])): ?>
                                    <form action="<?= url("/excluirencaminhatoentrevista"); ?>" method="post" class="flex flex-col sm:flex-row gap-4">
                                        <?= csrf_input(); ?>
                                
                                        <input name="id-service" type="hidden" value="<?= $service->id_service ?>">
                                        <input name="id-worker" type="hidden" value="<?= $service->id_worker ?>">
                                        <input name="id-vacancy" type="hidden" value="<?= $service->id_vacancy ?>">
                                        <div class="flex flex-col sm:flex-row gap-3">
                                            <button class="flex-1 cursor-pointer border border-red-400 hover:bg-red-500 hover:text-white text-red-500 p-3  font-medium rounded-md transition duration-200">
                                                <span>Excluir</span>
                                            </button>
                                        </div>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                    <?php else:?>
                        <?= $service->status_vacancy_worker ?>
                    <?php endif;?>
                <?php else:?>
                <?php if(in_array($userSystem ->type_user, ["dev","adm"])): ?>
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