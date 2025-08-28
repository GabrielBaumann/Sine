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
                <option>Oculta</option>
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
                    class="cursor-pointer flex items-center gap-2 bg-gray-500 hover:bg-gray-600 2xl:px-4 2xl:py-2 text-white font-medium rounded-lg transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                    <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                    <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
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