<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200 responsive-table">
        <thead class="text-gray-900">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Empresa</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Status</th>
                <th scope="col" class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <!-- Linha 1 -->
            <?php if (!empty($listEnterprise)): ?>
                <?php foreach($listEnterprise as $entreprise): ?>
                    <tr class="hover:bg-blue-50 bg-white border-b border-gray-300">
                        <td data-label="Unidade" class="px-6 py-2 whitespace-nowrap">
                            <div class="text-sm text-gray-900"><?= $entreprise->name_enterprise ?></div>
                        </td>
                        <td data-label="Tipo de Acesso" class="px-6 py-2 whitespace-nowrap">
                            <span class="status-company color-user text-sm text-blue-800 bg-blue-200 rounded-full px-2.5 py-0.5"><?= $entreprise->active ?></span>
                        </td>
                        
                        <td data-label="Ação" class="px-6 py-2 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end">
                                <button id="btn-edit" 
                                    data-url="<?= url("/editarempresa/{$entreprise->id_enterprise }"); ?>"
                                    class="cursor-pointer text-blue-600 hover:text-blue-800 p-1 rounded-full hover:bg-blue-50 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                            </div>
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
                            <p class="text-gray-600">Nenhum empresa encontrada</p>
                            <p class="text-sm text-gray-400">As empresas aparecerão aqui quando forem criadas</p>
                        </div>
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
                <?= $paginator ?? null ; ?>
            </div>
        </div>
        <div>Total: <?= format_number($countEnterprise) ?? "000" ?></div>
    </div>
</div>