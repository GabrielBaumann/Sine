<div class="bg-transparent rounded-md overflow-hidden mt-10">
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 responsive-table">
            <thead class="bg-gradient-to-r from-blue-500 to-blue-800 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nome</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">CPF</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <!-- Linha 1 -->
                <?php if(!empty($workers)): ?>    
                    <?php foreach($workers as $work): ?> 
                        <tr class="hover:bg-blue-50 bg-white" data-url="<?= url("/historicoatendimento/" .  $work->id_worker); ?>">
                            <td data-label="Nome" class=" whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900"><?= $work->name_worker; ?></div>
                                        
                                    </div>
                                </div>
                            </td>
                            <td data-label="Unidade" class="px-6 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-900"><?= formatCPF($work->cpf_worker); ?></div>
                            </td>
                            <td data-label="Tipo de Acesso" class="px-6 py-2 whitespace-nowrap">
                                <span class="color-user text-sm text-blue-800 bg-blue-200 rounded-full px-2.5 py-0.5"><?= $work->status_work; ?></span>
                            </td>
                            
                            <td data-label="Ação" class="px-6 py-2 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end">
                                    <button 
                                        id="btn-edit" 
                                        class="text-blue-600 p-1 rounded-full cursor-pointer">
                                        Editar
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">Não há trabalhadores cadastrados!</div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Paginação -->
    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <div class="flex gap-2">
                    <?= $paginator; ?>
                </div>
            </div>
           <div>Total: 100</div>
        </div>
    </div>
</div>