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
                            <div class="text-sm text-gray-900"><?= $vacancyItem->number_vacancy; ?></div>
                        </td>
                            <td data-label="Status" class="px-6 py-3 whitespace-nowrap">
                            <span class="text-sm text-gray-700"><?= $vacancyItem->status_vacancy; ?></span>
                        </td>
                    </tr>
                <?php endforeach; ?>           
            </tbody>
        </table>
        
        <div class="flex justify-end items-center py-5">
            <button
                type="submit"
                id="btn-closed-vacancy"
                class="hidden flex items-center gap-2 cursor-pointer text-sm bg-transparent text-red-500 font-semibold hover:bg-red-500 hover:text-white transition py-2 px-3 rounded-full hover:shadow-xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
                <span>Encerrar</span>
            </button>
        </div>

        <!-- falta a paginação aqui -->

    </div>
</form>