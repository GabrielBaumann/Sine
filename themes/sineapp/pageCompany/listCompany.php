<?php ?>
<header class="p-5 bg-white rounded-2xl flex items-center justify-between mb-4">
    <!-- Título -->
    <h1 class="text-2xl text-gray-900 font-semibold">Empresas</h1>

    <!-- Barra de Pesquisa com Ícone -->
    <div class="flex items-center gap-3">
        <input
            data-url="<?= url("/pequisarempresas")?>"
            data-ajax="list-company"
            type="text"
            name="search-company"
            id="search-company"
            placeholder="Pesquisar empresas..."
            class="input-search py-2 pr-20 pl-2 border border-gray-300 rounded-lg"
        >

        <select
            data-url="<?= url("/pequisarempresas")?>"
            data-ajax="list-company" 
            name="search-all-status"
            class="cursor-pointer input-search px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
        >
            <option value="">Todos status</option>
            <option>Ativa</option>
            <option>Cancelada</option>
        </select>

        <!-- Botão Nova Vaga -->
        <button 
            id="btn-new-company" 
            data-url="<?= url("/adicionarempresa") ?>",
            class="cursor-pointer flex items-center gap-2 bg-blue-800 hover:bg-blue-900 px-4 py-2 text-white rounded-lg  duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Nova Empresa
        </button>

        <!-- Download company list -->
        <button 
            id="list-excel-company" 
            data-url="<?= url("/baixarexcelempresa") ?>",
            class="cursor-pointer flex items-center gap-2 bg-gray-100 hover:bg-gray-200 p-2 text-gray-900 rounded-lg  duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
            </svg>
        </button>
    </div>
</header>
    
<div class="overflow-hidden">
    <div id="list-company">
        <?php $this->insert("/pageCompany/componentListCompany")?>
    </div>    
</div>