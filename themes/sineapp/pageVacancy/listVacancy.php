<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 bg-white p-5 rounded-2xl">
    <!-- Título -->
    <h1 class="hidden md:flex text-md 2xl:text-2xl font-semibold text-gray-900">Vagas</h1>
    
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
                data-url="<?= url("/listavagas"); ?>"
                data-ajax="listVacancy"
                type="text"
                name="search-vacancy"
                id="search-vacancy"
                placeholder="Pesquisar vagas..."
                class="input-search pl-10 pr-12 py-2 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
        </div>
        
        <!-- Filtros -->
        <div class="flex flex-col sm:flex-row gap-2">
            <select
                data-url="<?= url("/listavagas"); ?>"
                data-ajax="listVacancy" 
                name="search-enterprise"
                class="input-search 2xl:px-4 py-0 2xl:py-2 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                <option value="">Todas empresas</option>
                <?php foreach($listEnterprise as $entreprise): ?>
                    <option value="<?= $entreprise->id_enterprise ?>"><?= $entreprise->name_enterprise ?></option>
                <?php endforeach; ?>
            </select>
            
            <select
                data-url="<?= url("/listavagas"); ?>"
                data-ajax="listVacancy" 
                name="search-status"
                class="input-search 2xl:px-4 2xl:py-2 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                <option value="">Todos status</option>
                <option>Ativa</option>
                <option>Encerrada</option>
            </select>
            
            <!-- Botão Nova Vaga -->
            <button 
                data-url="<?= url("/cadastrarvagas")?>"
                id="btn-new-vacancy" 
                class="cursor-pointer flex items-center gap-2 bg-blue-600 hover:bg-blue-700 2xl:px-4 2xl:py-2 text-white font-medium rounded-lg transition-colors duration-200 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Nova vaga
            </button>

            <?php if($checkPanelVacancy === 1): ?>
                <button 
                    data-url="<?= url("/janelaocultarpainel/1")?>"
                    id="btn-hiden-panel" 
                    class="cursor-pointer flex items-center gap-2 bg-red-500 hover:bg-red-600 2xl:px-4 2xl:py-2 text-white font-medium rounded-lg transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Ocultar Painel
                </button>
            <?php elseif($checkPanelVacancy === 2): ?>
                <button 
                    data-url="<?= url("/janelaocultarpainel/2")?>"
                    id="btn-hiden-panel" 
                    class="cursor-pointer flex items-center gap-2 bg-blue-600 hover:bg-blue-700 2xl:px-4 2xl:py-2 text-white font-medium rounded-lg transition-colors duration-200 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Mostrar Painel
                </button>
            <?php else: ?>
                <!-- Quando não existir vagas ativas -->
            <?php endif;?>
        </div>
    </div>
</div>
<div id="listVacancy">
    <?php $this->insert("/pageVacancy/componentListVacancy");?>
</div>