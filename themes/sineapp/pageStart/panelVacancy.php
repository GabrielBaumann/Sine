<div class="flex flex-col gap-4">
    <div class="p-5 w-full md:bg-white md:rounded-2xl md:flex md:flex-col items-center justify-center text-center mx-auto gap-3">
        <h2 class="text-xl font-semibold text-gray-800 items-left">Baixar painel</h2>
            <div class="flex flex-col text-left w-full">
                <label for="time-panel">Filtrar por versão</label>
                <select data-url="<?= url("/filtrarversao"); ?>" name="time-panel" id="version-panel" class="w-full bg-white rounded-md border border-gray-200 p-2 cursor-pointer">
                    <option value="0">0 (Geral)</option>
                    <option value="1">1 (08:00 às 10:00)</option>
                    <option value="2">2 (10:00 às 12:00)</option>
                    <option value="3">3 (12:00 às 00:00)</option>
                </select>
            </div>
            <div class="flex w-full justify-center items-center gap-3">
                <!-- botao de imprimir -->
                <button
                    id="print-panel"
                    data-url="<?= url("/imprimirpainel"); ?>"
                    class="w-full flex items-center justify-center gap-2 text-xs cursor-pointer print p-2 text-white bg-gray-800 hover:bg-gray-900 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15M9 12l3 3m0 0 3-3m-3 3V2.25" />
                    </svg>
                    <span>Painel de vagas</span>
                </button>
                <!-- botao de visualizar painel interno -->
                <button
                    id="print-panel-internal"
                    data-url="<?= url("/imprimirpainelinterno"); ?>"
                    class="w-full flex items-center text-xs cursor-pointer print p-2 bg-white border border-black hover:bg-gray-800 hover:text-white transition-all duration-300 justify-center text-black rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15M9 12l3 3m0 0 3-3m-3 3V2.25" />
                    </svg>
                    <span>Painel de empresas</span>
                </button>
        </div>
    </div>

    <!-- Main vacancy cards container -->
    <h2 class="mx-auto text-black font-semibold text-xl mb-2">PAINEL DO DIA</h2>
    <div class="flex flex-col w-full md:max-h-[450px] 2xl:max-h-[600px] overflow-y-auto gap-4 p-1 pt-0">
        <!-- Card -->
        <div class="bg-gradient-to-br from-blue-400 to-blue-500 text-white flex flex-col md:flex-row justify-between w-full p-4 rounded-xl">
            <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex flex-col">
                    <span class="font-semibold text-xs md:text-xs 2xl:text-xl text-white truncate" title="">
                        Açougueiro II 
                    </span>
                    <span class="text-xs 2xl:text-sm mt-1">CBO: 1234-10</span>
                    <span class="mt-1 flex items-center text-sm">Barbosa Mello</span>
                </div>
            </div>
            <div class="mt-4 md:mt-0 flex flex-col items-start md:items-end  md:w-30">
                <span class="font-semibold py-1 rounded-full text-md mb-2 text-sm">QTD: 34</span>
                <span class="flex items-center text-sm">Masculino</span>
                <span class="text-sm">Pegar currículo</span>
            </div>
        </div>
        
    </div>
</div>