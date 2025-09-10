<style type="text/tailwindcss">
    /* Chrome, Safari, Edge */
    .scrollbar-custom::-webkit-scrollbar {
        width: 12px;
        
    }
    
    .scrollbar-custom::-webkit-scrollbar-track {
        background: #ffffffff;
        border-radius: 6px;
    }
    
    .scrollbar-custom::-webkit-scrollbar-thumb {
        background: #ffffffff;
        border-radius: 6px;
        border: 3px solid #f1f5f9;
    }
    
    .scrollbar-custom::-webkit-scrollbar-thumb:hover {
        background: #ffffffff;
    }
    
    /* Firefox */
    .scrollbar-custom {
        scrollbar-width: thin;
        scrollbar-color: #457fd7ff #ffffffff;
    }
</style>

<div class="flex flex-col gap-4 scrollbar-custom">
    <div class="p-5 w-full bg-gradient-to-br ml-3 md:ml-0 from-blue-300 to-blue-500 text-white rounded-2xl flex flex-col items-center justify-center text-center mx-auto gap-3">
        <!-- <h2 class="text-xl font-semibold text-white items-left mb-3 md:mb-0">Baixar Painel</h2> -->
            <div class="flex flex-col text-left w-full text-white">
                <label for="time-panel" class="font-semibold text-xl flex text-center 2xl:mb-5 mx-auto">Selecione a versão do painel:</label>
                <select data-url="<?= url("/filtrarversao"); ?>" name="time-panel" id="version-panel" class="w-full bg-transparent  border-b border-white p-2 cursor-pointer mb-3 md:mb-0 text-gray-900">
                    <option value="0">0 (Geral)</option>
                    <option value="1">1 (08:00 às 10:00)</option>
                    <option value="2">2 (10:00 às 12:00)</option>
                    <option value="3">3 (12:00 às 00:00)</option>
                </select>
            </div>
            <div class="flex flex-col w-full gap-2">
                <div class="flex w-full justify-center items-center gap-3">
                    <!-- botao de imprimir -->
                    <button
                        id="print-panel"
                        data-url="<?= url("/imprimirpainel"); ?>"
                        class="print w-full flex items-center justify-center gap-2 text-xs cursor-pointer print p-2 text-white bg-gray-900 hover:bg-gray-900 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15M9 12l3 3m0 0 3-3m-3 3V2.25" />
                        </svg>
                        <span>Painel de vagas</span>
                    </button>
                    <!-- botao de visualizar painel interno -->
                    <button
                        id="print-panel-internal"
                        data-url="<?= url("/imprimirpainelinterno"); ?>"
                        class="print w-full flex items-center text-xs cursor-pointer print p-2 gap-2 bg-blue-100 hover:bg-gray-800 hover:text-white transition-all duration-300 justify-center text-gray-900 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15M9 12l3 3m0 0 3-3m-3 3V2.25" />
                        </svg>
                        <span>Painel de empresas</span>
                    </button>
                </div>
                <button
                    id="list-excel-cterc"
                    data-url="<?= url("/excelcertec"); ?>"
                    class="print w-full flex items-center text-xs cursor-pointer print p-2 gap-2 bg-blue-100 hover:bg-gray-800 hover:text-white transition-all duration-300 justify-center text-gray-900 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15M9 12l3 3m0 0 3-3m-3 3V2.25" />
                    </svg>
                    <span>Baixar lista CTERC</span>
                </button>
            </div>
    </div>

    <!-- Main vacancy cards container -->
    <div id="detail-vacancy">
        <!-- Card -->
        
            <?php $this->insert("/pageStart/detailPanelVacancy"); ?>
        
        <!-- Card -->       
    </div>
</div>