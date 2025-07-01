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

        <!-- falta a paginação aqui -->
                 <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <div class="flex gap-2">
                        <?= $paginator; ?>
                    </div>
                </div>
                <div>Total: <?= format_number($countVacancy); ?></div>
            </div>
        </div>
    </div>
</form>