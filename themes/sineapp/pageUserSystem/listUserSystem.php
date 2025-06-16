<div id="usuarioLista" class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 pt-10">
    <!-- Título -->
    <h1 class="text-2xl text-gray-900 font-semibold">Usuários</h1>
    
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
                data-url="<?= url("/pesquisarusuarios")?>"
                data-ajax="list-user-system" 
                type="text"
                name="search-user-system"
                placeholder="Pesquisar usuários..."
                class="input-search pl-10 pr-4 py-2 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
            >
        </div>
        
        <!-- Filtros -->
        <div class="flex flex-col sm:flex-row gap-2">
            <select
                data-url="<?= url("/pesquisarusuarios")?>"
                data-ajax="list-user-system" 
                name="search-function-user"
                class="input-search px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
            >
                <option value="">Todas Funções</option>
                <option value="user">user</option>
                <option value="adm">adm</option>
                <option value="dev">dev</option>
            </select>
            
            <select
                data-url="<?= url("/pesquisarusuarios")?>"
                data-ajax="list-user-system" 
                name="search-all-status"
                class="input-search px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
            >
                <option value="">Todos status</option>
                <option value="1">Ativo</option>
                <option value="2">Cancelado</option>
            </select>
            
            <!-- Botão Nova Vaga -->
            <button class="cursor-pointer flex items-center gap-2 bg-blue-600 hover:bg-blue-700 px-4 py-2 text-white font-medium rounded-lg transition-colors duration-200 shadow-sm"
                    id="btn-new-user" 
                    data-url="<?= url("/adicionarusuario") ?>">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Novo usuário
            </button>
        </div>
    </div>
</div>
<div class="bg-transparent rounded-md overflow-hidden mt-10">
    
    <div id="list-user-system" >
        <?php $this->insert("/pageUserSystem/componentListUserSystem") ?>
    </div>

</div>