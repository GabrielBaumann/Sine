<form action="<?= url("/informacaovagas"); ?>" method="post">
    <?= csrf_input(); ?>
    <input type="hidden" name="id-vacancy-fixed" value="<?= $vacancyInfo->id_vacancy; ?>">
    <div class="bg-transparent rounded-md overflow-hidden mt-5">  
        <table class="min-w-full divide-y divide-gray-200 responsive-table">
            <thead class="">
            <tr>
                <th scope="col" class="w-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    <input type="checkbox" id="chek-vacancy" class="h-4 w-4 ml-3 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vaga</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <!-- Linha 1 -->
                <?php if($vacancyList):?>
                    <?php foreach($vacancyList as $vacancyItem): ?>
                        <tr class="hover:bg-blue-100">
                            <td class="whitespace-nowrap">
                                <input 
                                    type="checkbox" 
                                    name="check-vacancy-<?= $vacancyItem->id_vacancy; ?>"
                                    value="<?= $vacancyItem->id_vacancy; ?>"
                                    id="<?= $vacancyItem->id_vacancy; ?>" 
                                    class="check-vacancy h-4 w-4 ml-3 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            </td>
                            <td data-label="Nome" class="px-6 py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="">
                                        <div class="text-sm font-medium text-gray-900"><?= $vacancyItem->nomeclatura_vacancy; ?></div>
                                    </div>
                                </div>
                            </td>
                            <td data-label="Vaga" class="px-6 py-3 whitespace-nowrap">
                                <div class="text-sm text-gray-900"><?= $vacancyItem->number_vacancy . "/" . $vacancyInfo->total_vancacy_general; ?></div>
                            </td>
                                <td data-label="Status" class="px-6 py-3 whitespace-nowrap">
                                <span class="text-sm text-gray-700"><?= $vacancyItem->status_vacancy; ?></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>           
                <?php else:?>
                    <tr class="h-full">
                        <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-gray-600">Nenhuma vaga registrada</p>
                                <p class="text-sm text-gray-400">As vagas aparecerão aqui quando forem criadas</p>
                            </div>
                        </td>
                    </tr>
                <?php endif;?>
            </tbody>
        </table>
        
        <div id="info" class="hidden flex justify-between items-center gap-3 p-3 rounded-xl p-3">
            <div class="flex flex-col w-full">
                <div class="flex items-center w-full gap-4">
                    <div class="flex flex-col w-full">
                        <label for="reason-closed" class="text-gray-800 font-semibold mb-4">Motivo do encerramento *</label>
                        <select name="reason-closed" id="reason-closed" class="border border-gray-400 rounded-md p-2 w-full">
                            <option value="">Selecione um motivo</option>
                            <option value="Prazo encerrado">Prazo encerrado</option>
                            <option value="Empresa encerrou">Empresa encerrou</option>
                        </select>
                    </div>
                    <button
                        type="submit"
                        id="btn-closed-vacancy"
                        class="flex items-center gap-2 mt-10 cursor-pointer text-sm font-semibold bg-red-500 text-white p-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                        <span>Encerrar</span>
                    </button>
                </div>
            </div> 
        </div>

        <!-- paginação aqui -->
        <div class="bg-white disabled pointer-events-none opacity-50 px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <div class="flex gap-2">
                        <?= $paginator ?? null; ?>
                    </div>
                </div>
                <div>Total: <?= format_number($countVacancy ?? 000); ?></div>
            </div>
        </div>

        <!-- vacancy info -->
        <div class="flex w-full gap-4 bg-gray-100 p-3 rounded-md">
            <div class="flex flex-col w-full">
                <div class="flex flex-col md:grid md:grid-cols-3 gap-3">
                    <div class="flex flex-col">
                        <label for="enterprise" class="block text-sm font-medium text-gray-700 mb-1">Empresa *</label>
                        <?php if($vacancy ?? null): ?>
                            <div
                                id="enterprise"
                                name="enterprise"
                                class="bg-white disabled pointer-events-none opacity-50 block w-full pl-3 pr-8 py-2 text-base md:text-sm border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 rounded-lg">

                            </div>
                        <?php else:?>
                            <select
                                id="enterprise"
                                name="enterprise"
                                class="bg-white disabled pointer-events-none opacity-50 block w-full pl-3 pr-8 py-2 text-base md:text-sm border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 rounded-lg">
                                <option value="">Empresa</option>
                                    <?php foreach($companys as $company): ?>
                                        <option value="<?= $company->id_enterprise; ?>"><?= $company->name_enterprise; ?></option>
                                    <?php endforeach; ?>
                            </select>
                        <?php endif; ?>
                    </div>
                    
                    <!-- CBO - Ocupação -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">CBO - Ocupação *</label>
                        <select
                            id="cbo-occupation"
                            name="cbo-occupation"
                            class="js-example-responsive select2-container select2-selection--multiple" style="width: 100%">
                            <option value="">CBO ocupação</option>
                            <?php foreach($cbos_occupations as $cbo_occupation): ?>
                                <option value="<?= $cbo_occupation->id_code; ?>" <?= ($vacancy->cbo_occupation ?? null) === "{$cbo_occupation->id_code}" ? "selected" : "" ?>><?= $cbo_occupation->id_code; ?> - <?= $cbo_occupation->occupation; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- PCD -->
                    <div>
                        <label for="pcd-vacancy" class="block text-sm font-medium text-gray-700 mb-1">PCD *</label>
                        <select
                            id="pcd-vacancy"
                            name="pcd-vacancy"
                            class="bg-white disabled pointer-events-none opacity-50 block w-full pl-3 pr-8 py-2 text-base md:text-sm border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 rounded-lg">
                            <option value="">Selecione</option>
                            <option value="SIM" <?= ($vacancy->pcd_vacancy ?? '') === 'SIM' ? 'selected' : '' ?>>SIM</option>
                            <option value="NÃO" <?= ($vacancy->pcd_vacancy ?? '') === 'NÃO' ? 'selected' : '' ?>>NÃO</option>
                        </select>
                    </div>
                </div>
                <div class="flex flex-col md:grid md:grid-cols-3 gap-3">
                    <!-- APRENDIZ -->
                    <div>
                        <label for="apprentice-vacancy" class="block text-sm font-medium text-gray-700 mb-1">Aprendiz *</label>
                        <select
                            id="apprentice-vacancy"
                            name="apprentice-vacancy"
                            class="bg-white disabled pointer-events-none opacity-50 block w-full pl-3 pr-8 py-2 text-base md:text-sm border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 rounded-lg">
                            <option value="">Selecione</option>
                            <option value="SIM" <?= ($vacancy->apprentice_vacancy ?? '') === 'SIM' ? 'selected' : '' ?>>SIM</option>
                            <option value="NÃO" <?= ($vacancy->apprentice_vacancy ?? '') === 'NÃO' ? 'selected' : '' ?>>NÃO</option>
                        </select>
                    </div>
                    <!-- Sexo -->
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Sexo *</label>
                        <select
                            id="gender"
                            name="gender"
                            class="bg-white disabled pointer-events-none opacity-50 block w-full pl-3 pr-8 py-2 text-base md:text-sm border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 rounded-lg">
                            <option value="">Selecione</option>
                            <option value="MASCULINO" <?= ($vacancy->gender_vacancy ?? '') === 'MASCULINO' ? 'selected' : '' ?>>MASCULINO</option>
                            <option value="FEMININO" <?= ($vacancy->gender_vacancy ?? '') === 'FEMININO' ? 'selected' : '' ?>>FEMININO</option>
                            <option value="INDIFERENTE" <?= ($vacancy->gender_vacancy ?? '') === 'INDIFERENTE' ? 'selected' : '' ?>>INDIFERENTE</option>
                        </select>
                    </div>
                    
                    <!-- Data de abertura -->
                    <div>
                        <label for="date-open-vacancy" class="block text-sm font-medium text-gray-700 mb-1">Data de abertura *</label>
                        <input
                            value="<?= $vacancy->date_open_vacancy ?? "" ?>"
                            type="date"
                            id="date-open-vacancy"
                            name="date-open-vacancy"
                            class="bg-white disabled pointer-events-none opacity-50 w-full px-3 py-2 text-base md:text-sm border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500 text-gray-900">
                    </div>
                </div>
                <div class="flex flex-col md:grid md:grid-cols-3 gap-3">
                    <!-- N° de Vagas -->
                    <div>
                        <label for="number-vacancy" class="block text-sm font-medium text-gray-700 mb-1">N° de Vagas *</label>
                        <input
                            id="number-vacancy"
                            value="<?= $vacancy->number_vacancy ?? "" ?>"
                            type="text"
                            name="number-vacancy"
                            class="bg-white disabled pointer-events-none opacity-50 w-full px-3 py-2 text-base md:text-sm border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500"
                            placeholder="00">
                    </div>
                    <!-- Qtd. por Vaga -->
                    <div>
                        <label for="quantity-per-vacancy" class="block text-sm font-medium text-gray-700 mb-1">Qtd. por Vaga *</label>
                        <input
                            value="<?= $vacancy->quantity_per_vacancy ?? "" ?>"
                            type="text"
                            id="quantity-per-vacancy"
                            name="quantity-per-vacancy"
                            class="bg-white disabled pointer-events-none opacity-50 w-full px-3 py-2 text-base md:text-sm border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500"
                            placeholder="00">
                    </div>
                    <!-- Experiência -->
                    <div>
                        <label for="exp-vacancy" class="block text-sm font-medium text-gray-700 mb-1">Experiência *</label>
                        <select
                            id="exp-vacancy"
                            name="exp-vacancy"
                            class="bg-white disabled pointer-events-none opacity-50 block w-full pl-3 pr-8 py-2 text-base md:text-sm border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 rounded-lg">
                            <option value="">Selecione</option>
                            <option value="SIM" <?= ($vacancy->exp_vacancy ?? '') === 'SIM' ? 'selected' : '' ?>>SIM</option>
                            <option value="NÃO" <?= ($vacancy->exp_vacancy ?? '') === 'NÃO' ? 'selected' : '' ?>>NÃO</option>
                            <option value="DESEJÁVEL" <?= ($vacancy->exp_vacancy ?? '') === 'DESEJÁVEL' ? 'selected' : '' ?>>DESEJÁVEL</option>
                        </select>
                    </div>
                </div>
                <div class="flex flex-col md:grid md:grid-cols-3 gap-3">
                    <!-- Requisitos da vaga -->
                    <div>
                        <label for="request-vacancy" class="block text-sm font-medium text-gray-700 mb-1">Requisitos da vaga (Se houver)</label>
                        <input
                            value="<?= $vacancy->request_vacancy ?? "" ?>"
                            type="text"
                            id="request-vacancy"
                            name="request-vacancy"
                            class="bg-white disabled pointer-events-none opacity-50 w-full px-3 py-2 text-base md:text-sm border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500"
                            placeholder="Ex: técnico em informática, CNH D...">
                    </div>
                    
                    <!-- Data de encerramento da vaga -->
                    <div>
                        <label for="date-close-vacancy" class="block text-sm font-medium text-gray-700 mb-1">Data de encerramento *</label>
                        <input
                            value="<?= $vacancy->date_closed_vacancy ?? "" ?>"
                            type="datetime-local"
                            id="date-close-vacancy"
                            name="date-close-vacancy"
                            class="bg-white disabled pointer-events-none opacity-50 w-full px-3 py-2 text-base md:text-sm border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500 text-gray-900">
                    </div>
                    <!-- Escolaridade -->
                    <div>
                        <label for="education-vacancy" class="block text-sm font-medium text-gray-700 mb-1">Escolaridade *</label>
                        <select
                            id="education-vacancy"
                            name="education-vacancy"
                            class="bg-white disabled pointer-events-none opacity-50 block w-full pl-3 pr-8 py-2 text-base md:text-sm border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 rounded-lg">
                            <option value="">Selecione</option>
                            <option value="SEM INSTRUÇÃO" <?= ($vacancy->education_vacancy ?? '') === 'SEM INSTRUÇÃO' ? 'selected' : '' ?>>SEM INSTRUÇÃO</option>
                            <option value="FUNDAMENTAL INCOMPLETO" <?= ($vacancy->education_vacancy ?? '') === 'FUNDAMENTAL INCOMPLETO' ? 'selected' : '' ?>>FUNDAMENTAL INCOMPLETO</option>
                            <option value="FUNDAMENTAL COMPLETO" <?= ($vacancy->education_vacancy ?? '') === 'FUNDAMENTAL COMPLETO' ? 'selected' : '' ?>>FUNDAMENTAL COMPLETO</option>
                            <option value="ENSINO MÉDIO INCOMPLETO" <?= ($vacancy->education_vacancy ?? '') === 'ENSINO MÉDIO INCOMPLETO' ? 'selected' : '' ?>>ENSINO MÉDIO INCOMPLETO</option>
                            <option value="ENSINO MÉDIO COMPLETO" <?= ($vacancy->education_vacancy ?? '') === 'ENSINO MÉDIO COMPLETO' ? 'selected' : '' ?>>ENSINO MÉDIO COMPLETO</option>
                            <option value="SUPERIOR INCOMPLETO" <?= ($vacancy->education_vacancy ?? '') === 'SUPERIOR INCOMPLETO' ? 'selected' : '' ?>>SUPERIOR INCOMPLETO</option>
                            <option value="SUPERIOR COMPLETO" <?= ($vacancy->education_vacancy ?? '') === 'SUPERIOR COMPLETO' ? 'selected' : '' ?>>SUPERIOR COMPLETO</option>
                            <option value="PÓS-GRADUAÇÃO INCOMPLETA" <?= ($vacancy->education_vacancy ?? '') === 'PÓS-GRADUAÇÃO INCOMPLETA' ? 'selected' : '' ?>>PÓS-GRADUAÇÃO INCOMPLETA</option>
                            <option value="PÓS-GRADUAÇÃO COMPLETA" <?= ($vacancy->education_vacancy ?? '') === 'PÓS-GRADUAÇÃO COMPLETA' ? 'selected' : '' ?>>PÓS-GRADUAÇÃO COMPLETA</option>
                            <option value="PREFIRO NÃO RESPONDER" <?= ($vacancy->education_vacancy ?? '') === 'PREFIRO NÃO RESPONDER' ? 'selected' : '' ?>>PREFIRO NÃO RESPONDER</option>
                        </select>
                    </div>
                </div>
                <!-- Idade Mínima/Máxima -->
                <div class="md:grid md:grid-cols-4 gap-3 items-center flex flex-col">
                    <div>
                        <label for="age-min-vacancy" class="block text-sm font-medium text-gray-700 mb-1">Idade Mínima *</label>
                        <input
                            value="<?= $vacancy->age_min_vacancy ?? "" ?>"
                            type="text"
                            id="age-min-vacancy"
                            name="age-min-vacancy"
                            class="bg-white disabled pointer-events-none opacity-50 w-full px-3 py-2 text-base md:text-sm border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500"
                            placeholder="00">
                    </div>
                    <div>
                        <label for="age-max-vacancy" class="block text-sm font-medium text-gray-700 mb-1">Idade Máxima *</label>
                        <input
                            value="<?= $vacancy->age_max_vacancy ?? "" ?>"
                            type="text"
                            id="age-max-vacancy"
                            name="age-max-vacancy"
                            class="bg-white disabled pointer-events-none opacity-50 w-full px-3 py-2 text-base md:text-sm border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500"
                            placeholder="00">
                    </div>

                    <!-- Nomenclatura da vaga -->
                    <div>
                        <label for="nomeclatura-vacancy" class="block text-sm font-medium text-gray-700 mb-1">Nomenclatura da vaga *</label>
                        <input
                            value="<?= $vacancy->nomeclatura_vacancy ?? "" ?>"
                            type="text"
                            id="nomeclatura-vacancy"
                            name="nomeclatura-vacancy"
                            class="bg-white disabled pointer-events-none opacity-50 w-full px-3 py-2 text-base md:text-sm border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500"
                            placeholder="00">
                    </div>
                    <!-- Pegar currículo -->
                    <div class="flex items-center gap-2 mt-4">
                        <input id="curriculum-vacancy" name="curriculum-vacancy" type="checkbox" class="cursor-pointer" value="1" <?= isset($vacancy->accept_curriculum) ? ($vacancy->accept_curriculum === 1 ? "checked" : "" ) : "" ?>></input>
                        <label for="curriculum-vacancy">Pegar currículo</label>
                    </div>
                    
                    <!-- Descrição -->
                    <div class="col-span-1 md:col-span-4">
                        <label for="description-vacancy" class="block text-sm font-medium text-gray-700 mb-1">Descrição (Opcional)</label>
                        <input
                            value="<?= $vacancy->description_vacancy ?? "" ?>"
                            type="text"
                            id="description-vacancy"
                            name="description-vacancy"
                            class="bg-white disabled pointer-events-none opacity-50 w-full px-3 py-2 text-base md:text-sm border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500"
                            placeholder="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>