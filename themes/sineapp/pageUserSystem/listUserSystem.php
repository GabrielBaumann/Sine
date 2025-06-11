<div id="usuarioLista" class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 pt-10">
    <!-- Título -->
    <h1 class="text-2xl text-gray-800">Usuários</h1>
    
    <!-- Controles -->
    <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
        <!-- Barra de Pesquisa com Ícone -->
        <div class="relative flex-grow max-w-md">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input
                type="text"
                placeholder="Pesquisar vagas..."
                class="pl-10 pr-4 py-2 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
            >
        </div>
        
        <!-- Filtros -->
        <div class="flex flex-col sm:flex-row gap-2">
            <select 
                name="search-enterprise"
                class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
            >
                <option value="*">Todas empresas</option>
                
                <option value="">teste</option>
                
            </select>
            
            <select 
                name="search-all-tatus"
                class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
            >
                <option value="*">Todos status</option>
                <option>Ativa</option>
                <option>Encerrada</option>
            </select>
            
            <!-- Botão Nova Vaga -->
            <button class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 px-4 py-2 text-white font-medium rounded-lg transition-colors duration-200 shadow-sm"
                    id="addUserBtn" 
                    data-url="<?= url("/adicionarusuario") ?>" 
                    data-modal="userModal">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Novo usuário
            </button>
        </div>
    </div>
</div>
<div class="bg-transparent rounded-md overflow-hidden mt-10">
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 responsive-table">
            <thead class="bg-gradient-to-r from-blue-500 to-blue-800 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">usuário</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">função</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <!-- Linha 1 -->
                
                    <?php foreach($users as $user): ?>
                        <tr class="hover:bg-blue-50 bg-white border-b border-gray-300" 
                            data-url="<?= url("/adicionarusuario/{$user->id_user}") ?>"
                            data-modal="userModal">
                            <td data-label="Nome" class=" whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900"><?= $user->name_user; ?></div>
                                        
                                    </div>
                                </div>
                            </td>
                            <td data-label="Unidade" class="px-6 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-900"><?= $user->type_user; ?></div>
                            </td>
                            <td data-label="Tipo de Acesso" class="px-6 py-2 whitespace-nowrap">
                                <span class="color-user text-sm text-blue-800 bg-blue-200 rounded-full px-2.5 py-0.5"><?= $user->active ? "ativo" : "cancelado" ; ?></span>
                            </td>
                            
                            <td data-label="Ação" class="px-6 py-2 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end">
                                    <button id="btn-edit" class="cursor-pointer text-blue-600 hover:text-blue-800 p-1 rounded-full hover:bg-blue-50 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                
            </tbody>
        </table>
    </div>

    <!-- Paginação -->
    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <div class="flex gap-2">
                    paginator fica aqui
                </div>
            </div>
           <div>Total: aqui</div>
        </div>
    </div>
</div>