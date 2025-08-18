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
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
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
            <!-- Empresa -->
            <div class="flex flex-col">
                <label class="block text-sm font-medium text-gray-700 mb-1">Empresa</label>
                <div class="bg-gray-50 text-gray-700 block w-full pl-3 pr-8 py-2 text-base md:text-sm border border-gray-300 rounded-lg">
                    Nome da Empresa
                </div>
            </div>
            
            <!-- CBO - Ocupação -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">CBO - Ocupação</label>
                <div class="bg-gray-50 text-gray-700 block w-full pl-3 pr-8 py-2 text-base md:text-sm border border-gray-300 rounded-lg">
                    1234 - Operador de Máquinas
                </div>
            </div>
            
            <!-- PCD -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">PCD</label>
                <div class="bg-gray-50 text-gray-700 block w-full pl-3 pr-8 py-2 text-base md:text-sm border border-gray-300 rounded-lg">
                    NÃO
                </div>
            </div>
        </div>
        
        <div class="flex flex-col md:grid md:grid-cols-3 gap-3">
            <!-- APRENDIZ -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Aprendiz</label>
                <div class="bg-gray-50 text-gray-700 block w-full pl-3 pr-8 py-2 text-base md:text-sm border border-gray-300 rounded-lg">
                    NÃO
                </div>
            </div>
            
            <!-- Sexo -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sexo</label>
                <div class="bg-gray-50 text-gray-700 block w-full pl-3 pr-8 py-2 text-base md:text-sm border border-gray-300 rounded-lg">
                    INDIFERENTE
                </div>
            </div>
            
            <!-- Data de abertura -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Data de abertura</label>
                <div class="bg-gray-50 text-gray-700 w-full px-3 py-2 text-base md:text-sm border border-gray-300 rounded-lg">
                    15/08/2023
                </div>
            </div>
        </div>
        
        <div class="flex flex-col md:grid md:grid-cols-3 gap-3">
            <!-- N° de Vagas -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">N° de Vagas</label>
                <div class="bg-gray-50 text-gray-700 w-full px-3 py-2 text-base md:text-sm border border-gray-300 rounded-lg">
                    2
                </div>
            </div>
            
            <!-- Qtd. por Vaga -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Qtd. por Vaga</label>
                <div class="bg-gray-50 text-gray-700 w-full px-3 py-2 text-base md:text-sm border border-gray-300 rounded-lg">
                    1
                </div>
            </div>
            
            <!-- Experiência -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Experiência</label>
                <div class="bg-gray-50 text-gray-700 block w-full pl-3 pr-8 py-2 text-base md:text-sm border border-gray-300 rounded-lg">
                    DESEJÁVEL
                </div>
            </div>
        </div>
        
        <div class="flex flex-col md:grid md:grid-cols-3 gap-3">
            <!-- Requisitos da vaga -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Requisitos da vaga</label>
                <div class="bg-gray-50 text-gray-700 w-full px-3 py-2 text-base md:text-sm border border-gray-300 rounded-lg">
                    CNH B, experiência comprovada
                </div>
            </div>
            
            <!-- Data de encerramento da vaga -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Data de encerramento</label>
                <div class="bg-gray-50 text-gray-700 w-full px-3 py-2 text-base md:text-sm border border-gray-300 rounded-lg">
                    30/09/2023
                </div>
            </div>
            
            <!-- Escolaridade -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Escolaridade</label>
                <div class="bg-gray-50 text-gray-700 block w-full pl-3 pr-8 py-2 text-base md:text-sm border border-gray-300 rounded-lg">
                    ENSINO MÉDIO COMPLETO
                </div>
            </div>
        </div>
        
        <!-- Idade Mínima/Máxima e outros -->
        <div class="md:grid md:grid-cols-6 gap-3 items-center flex flex-col">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Idade Mínima</label>
                <div class="bg-gray-50 text-gray-700 w-full px-3 py-2 text-base md:text-sm border border-gray-300 rounded-lg">
                    18
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Idade Máxima</label>
                <div class="bg-gray-50 text-gray-700 w-full px-3 py-2 text-base md:text-sm border border-gray-300 rounded-lg">
                    45
                </div>
            </div>
            
            <!-- Nomenclatura da vaga -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomenclatura da vaga</label>
                <div class="bg-gray-50 text-gray-700 w-full px-3 py-2 text-base md:text-sm border border-gray-300 rounded-lg">
                    VAGA-001
                </div>
            </div>
            
            <!-- Pegar currículo -->
            <div class="flex items-center gap-2 mt-4">
                <div class="w-4 h-4 border border-gray-300 bg-gray-200 rounded"></div>
                <label>Pegar currículo</label>
            </div>
            
            <!-- Descrição -->
            <div class="col-span-1 md:col-span-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                <div class="bg-gray-50 text-gray-700 w-full px-3 py-2 text-base md:text-sm border border-gray-300 rounded-lg">
                    Vaga para operador de máquinas industriais com experiência em linha de produção.
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
</form>