

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 pt-10">
    <!-- Título -->
    <h1 class="text-2xl font-semibold text-gray-900">Trabalhadores</h1>
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
                data-url="<?= url("/pesquisarcandidato"); ?>"
                name="name-search"
                id="search" 
                type="text" 
                placeholder="Pesquisar trabalhadores..."
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
        </div>
    </div>
</div>