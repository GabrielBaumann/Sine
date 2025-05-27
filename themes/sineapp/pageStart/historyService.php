<input 
    id="id-worker" 
    type="number" 
    value="<?= $worker->id_worker; ?>"
    hidden>

<div class="bg-white rounded-xl shadow-md p-6 mb-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center text-blue-800">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-8">
                    <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-semibold text-gray-800"><?= $worker->name_worker; ?></h2>
                <p class="text-gray-600"><?= formatCPF($worker->cpf_worker); ?></p>
            </div>
        </div>
</div>
<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">Histórico de Atendimentos</h3>
    </div>
    <div class="divide-y divide-gray-200">
        <!-- Item 1 -->
        <?php if(!empty($history)): ?>
            <?php foreach($history as $history): ?>
                <div class="p-6 hover:bg-gray-50 transition-colors">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-3">
                        <div>
                            <h4 class="font-medium text-gray-900"><?= $history->service_type; ?></h4>
                            <p class="text-sm text-gray-500">Atendente: <?= $history->user_name; ?></p>
                        </div>
                        <div class="flex items-center gap-2 text-sm">
                            <!-- <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Concluído</span> -->
                            <span class="text-gray-500"><?= $history->date_register; ?></span>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-4"><?= $history->service_detail; ?></p>
                    <div class="flex justify-end">
                        <button class="text-blue-600 hover:text-blue-800 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                            <span>Editar</span>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div>Não há históricos!!!</div>
        <?php endif; ?>
    <!-- Paginação -->
    <div class="px-6 py-4 border-t border-gray-200 flex justify-between items-center">
        <p class="text-sm text-gray-600">Total de atendimentos: <?= format_number($countService ?? 000); ?></p>
        <div class="flex gap-2">
            <?= $paginator; ?>
        </div>
    </div>
</div>