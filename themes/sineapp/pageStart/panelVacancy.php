<div class="flex flex-col gap-4">
    <div class="p-5 w-full md:bg-white md:rounded-2xl md:flex md:flex-col items-center justify-center text-center mx-auto gap-3">
        <h2 class="text-xl font-semibold text-gray-800 items-left">Baixar painel</h2>
            <div class="flex flex-col text-left w-full">
                <label for="time-panel">Filtrar por versão</label>
                <select data-url="<?= url("/filtrarversao"); ?>" name="time-panel" id="version-panel" class="w-full bg-gray-200 rounded-xl p-2 cursor-pointer">
                    <option value="0">0 (Geral)</option>
                    <option value="1">1 (08:00 às 10:00)</option>
                    <option value="2">2 (10:00 às 12:00)</option>
                    <option value="3">3 (12:00 às 00:00)</option>
                </select>
            </div>
            <div class="flex w-full justify-center items-center gap-3">
                <!-- botao de imprimir -->
                <button
                    id="print-panel"
                    data-url="<?= url("/imprimirpainel"); ?>"
                    class="w-full flex items-center gap-2 text-xs cursor-pointer print p-2 text-white bg-blue-400 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15M9 12l3 3m0 0 3-3m-3 3V2.25" />
                    </svg>
                    <span>Painel de vagas</span>
                </button>
                <!-- botao de visualizar painel interno -->
                <button
                    id="print-panel-internal"
                    data-url="<?= url("/imprimirpainelinterno"); ?>"
                    class="w-full flex items-center text-xs cursor-pointer print p-2 text-white bg-blue-500 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15M9 12l3 3m0 0 3-3m-3 3V2.25" />
                    </svg>
                    <span>Painel de empresas</span>
                </button>
        </div>
    </div>

    <div class="md:bg-white md:rounded-2xl p-5 overflow-x-auto flex-grow rounded-md overflow-hidden">
        <h2 class="text-xl font-semibold text-gray-800 text-center mx-auto">PAINEL DO DIA</h2>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="">
                <tr>
                    <th scope="col" class="px-2 py-2 text-left text-xs font-medium text-black uppercase tracking-wider">Vaga</th>
                    <th scope="col" class="py-2 text-right pr-[12px] text-xs font-medium text-black uppercase tracking-wider">Qtd</th>
                </tr>
            </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php if($panelVacancy): ?>
                        <?php foreach($panelVacancy as $panelVacancyItem): ?>    
                            <!-- This is a line -->
                            <tr>
                                <td class="max-w-[120px] truncate px-2 py-3 text-xs font-medium text-gray-900">
                                    <?= $panelVacancyItem->nomeclatura_vacancy; ?>
                                </td>
                                <td class="py-1 whitespace-nowrap text-right pr-[12px] text-xs text-black">
                                    <?= $panelVacancyItem->total_vacancy_active; ?>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    <?php else: ?>
                        <!-- If there are no vacancies -->
                        <tr>
                            <td class="px-5 py-3 whitespace-nowrap text-xs font-medium text-gray-900">Painel oculto</td>
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