<input 
    id="id-worker" 
    type="number" 
    value="<?= $worker->id_worker; ?>"
    hidden>

<div class="">
    <!-- Cabeçalho -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-6 md:mb-0">
        <div class="flex items-center gap-3">
            <a href="<?= url("/trabalhador"); ?>">
                <button
                    data-url="<?= url("/trabalhador"); ?>"
                    class="cursor-pointer p-2 rounded-full border border-gray-300 text-gray-700 hover:bg-blue-600 hover:text-white transition-all duration-200 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    <span class="hidden sm:inline">Voltar</span>
                </button>
            </a>
            <p class='text-blue-600 text-sm md:text-base flex items-center truncate'>
                <span class="hidden md:inline">Início</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-1 hidden md:inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span>Trabalhador</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="font-medium truncate max-w-xs"><?= $worker->name_worker; ?></span>
            </p>
        </div>
        
        <!-- Perfil resumido -->
        <div class="bg-blue-50 p-3 rounded-lg w-full md:w-auto">
            <div class="flex items-center gap-3">
                <div>
                    <h2 class="text-xl font-bold text-gray-800 truncate"><?= $worker->name_worker; ?></h2>
                    <p class="text-md text-gray-600">CPF: <?= formatCPF($worker->cpf_worker); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Histórico de Atendimentos -->
    <div class="overflow-hidden">
        <div class="p-4">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <h3 class="text-2xl text-gray-800 flex items-center gap-2">
                    Histórico de Atendimentos
                </h3>
                <div class="flex items-center gap-2">
                    <div class="relative">
                        <input type="text" placeholder="Buscar atendimento..." class="pl-8 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full md:w-64">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute left-3 top-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabela Responsiva -->
        <div class="overflow-x-auto rounded-md">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-blue-500 to-blue-800">
                    <tr>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider hidden sm:table-cell">Data</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Tipo</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider hidden md:table-cell">Detalhes</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider hidden lg:table-cell">Atendente</th>
                        <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-white uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if(!empty($history)): ?>
                        <?php foreach($history as $item): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-4 whitespace-nowrap hidden sm:table-cell">
                                    <div class="text-sm text-gray-900"><?= date('d/m/Y', strtotime($item->date_register)); ?></div>
                                    <div class="text-xs text-gray-500"><?= date('H:i', strtotime($item->date_register)); ?></div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900"><?= $item->service_type; ?></div>
                                    <div class="text-xs text-gray-500 sm:hidden"><?= date('d/m/Y', strtotime($item->date_register)); ?></div>
                                </td>
                                <td class="px-4 py-4 hidden md:table-cell">
                                    <div class="text-sm text-gray-900 truncate max-w-xs"><?= $item->service_detail; ?></div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap hidden lg:table-cell">
                                    <div class="text-sm text-gray-900"><?= $item->user_name; ?></div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-right">
                                    <button class="text-blue-600 hover:text-blue-800 p-1 rounded-full hover:bg-blue-50 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
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
            <p class="text-sm text-gray-600">Total de atendimentos: <span class="font-medium"><?= format_number($countService ?? 0); ?></span></p>
            <div class="flex gap-1">
                <?= $paginator; ?>
            </div>
        </div>
    </div>
</div>