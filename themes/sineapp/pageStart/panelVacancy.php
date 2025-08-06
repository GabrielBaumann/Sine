<div class="rounded-lg flex flex-col">
    <div class="mb-3">
        <div class="flex justify-between items-center">
            <h2 class="text-lg font-normal text-gray-700">Painel de vagas</h2>
            <div class="flex space-x-2">

                <!-- botao de imrpimir -->
                <button
                    id="print-panel" 
                    data-url="<?= url("/imprimirpainel"); ?>"
                    class="cursor-pointer print p-2 text-blue-600 hover:bg-blue-50 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a51.299 51.299 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                    </svg>
                </button>

                <!-- botao de visualizar painel interno -->
                <button 
                    id="print-panel-internal" 
                    data-url="<?= url("/imprimirpainelinterno"); ?>"
                    class="cursor-pointer print p-2 text-blue-600 hover:bg-blue-50 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                </button>

            </div>
        </div>
    </div>
    
    <div class="overflow-x-auto flex-grow rounded-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-blue-500">
                <tr>
                    <th scope="col" class="px-5 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Vaga</th>
                    <th scope="col" class="py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Qt</th>
                </tr>
            </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php if($panelVacancy): ?>
                        <?php foreach($panelVacancy as $panelVacancyItem): ?>    
                            <!-- This is a line -->
                            <tr>
                                <td class="px-5 py-3 whitespace-nowrap text-sm font-medium text-gray-900"><?= $panelVacancyItem->nomeclatura_vacancy; ?></td>
                                <td class="py-3 whitespace-nowrap text-sm text-black"><?= $panelVacancyItem->total_vacancy_active; ?></td>
                            </tr>
                        <?php endforeach;?>
                    <?php else: ?>
                        <!-- If there are no vacancies -->
                        <tr>
                            <td class="px-5 py-3 whitespace-nowrap text-sm font-medium text-gray-900">Não há vagas cadastradas</td>
                        </tr>
                    <?php endif;?>
                </tbody>
        </table>
    </div>
</div>
<!-- Paginação -->
<div class="px-4 py-3 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-between gap-4">
    <div class="flex gap-1">
        <?= $paginator; ?>
    </div>
</div>

