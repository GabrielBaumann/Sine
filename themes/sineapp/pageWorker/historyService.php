<input 
    id="id-worker" 
    type="number" 
    value="<?= $worker->id_worker; ?>"
    hidden>

<div class="">
    <!-- Cabeçalho -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-6 md:mb-0">
        <div class="flex items-center gap-3">
            <button
                id="btn-back"
                data-url="<?= url("/listatrabalhador"); ?>"
                data-change="content"
                class="cursor-pointer p-1 px-2 rounded-full border border-gray-300 text-gray-700 hover:bg-[#095998] hover:text-white transition-all duration-200 flex items-center gap-1">
                < Voltar
            </button>
        </div>
    </div>

    <!-- Histórico de Atendimentos -->
    <div class="overflow-hidden">
        <div class="py-4 md:py-12">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex flex-col md:px-3">
                    <h3 class="text-2xl text-gray-800 font-bold flex items-center gap-2">
                        <?= $worker->name_worker; ?>
                    </h3>
                    <div class="flex items-center gap-3">
                        <div>
                            <p class="text-md text-gray-600">CPF: <?= formatCPF($worker->cpf_worker); ?></p>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <div class="relative">
                        <select 
                            name="search-enterprise"
                            class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                        >
                            <option value="*">Todos</option>
                            <option value="">Orientação</option>
                            <option value="">Abono Salarial</option>
                            <option value="">Seguro desemprego</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabela Responsiva -->
        <div class="overflow-x-auto rounded-md">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="text-gray-900">
                    <tr>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider hidden sm:table-cell">Data</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Tipo</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider hidden md:table-cell">Detalhes</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider hidden lg:table-cell">Atendente</th>
                        <th scope="col" class="px-4 py-3 text-right text-xs font-medium uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-300">
                    <?php if(!empty($history)): ?>
                        <?php foreach($history as $item): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3 whitespace-nowrap hidden sm:table-cell">
                                    <div class="text-sm text-gray-900"><?= date('d/m/Y', strtotime($item->date_register)); ?></div>
                                    <div class="text-xs text-gray-500"><?= date('H:i', strtotime($item->date_register)); ?></div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900"><?= $item->type_service; ?></div>
                                    <div class="text-xs text-gray-500 sm:hidden"><?= date('d/m/Y', strtotime($item->date_register)); ?></div>
                                </td>
                                <td class="px-4 py-3 hidden md:table-cell">
                                    <div class="text-sm text-gray-900 truncate max-w-xs"><?= $item->detail; ?></div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap hidden lg:table-cell">
                                    <div class="text-sm text-gray-900"><?= $item->user_name; ?></div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-right">
                                    <button id="btn-edit" data-url="<?= url("/trabalhadoratendimento/" .  $item->id_service); ?>" 
                                        class="cursor-pointer text-blue-600 hover:text-blue-800 p-1 rounded-full hover:bg-blue-50 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr class="h-full">
                            <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-gray-600">Nenhum atendimento registrado</p>
                                    <p class="text-sm text-gray-400">Os atendimentos aparecerão aqui quando forem criados</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Paginação -->
        <div class="px-4 py-3 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex gap-1">
                <?= $paginator; ?>
            </div>
            <p class="text-sm text-gray-600">Total de atendimentos: <span class="font-medium"><?= format_number($countService ?? 0); ?></span></p>
        </div>
    </div>
</div>