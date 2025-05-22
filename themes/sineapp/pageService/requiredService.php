<div id="step-4" class="step-content">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Qual o tipo de Requerimento Especial?</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <button
            data-idservice = "14"  
            data-url="<?= url("/formularioAtendimento/especial")?>"
            class="p-4 border-2 border-gray-200 rounded-lg hover:border-sine-300 hover:bg-sine-50 transition-all flex items-start gap-3 text-left">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center text-blue-800 mt-1 flex-shrink-0">
                <i class="fas fa-gavel"></i>
            </div>
            <div>
                <span class="font-medium text-gray-800 block mb-1">Sentença Judicial</span>
                <p class="text-sm text-gray-500">Requerimento baseado em decisão judicial</p>
            </div>
        </button>

        <button
            data-idservice = "15"  
            data-url="<?= url("/formularioAtendimento/especial")?>"
            class="p-4 border-2 border-gray-200 rounded-lg hover:border-sine-300 hover:bg-sine-50 transition-all flex items-start gap-3 text-left">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center text-green-800 mt-1 flex-shrink-0">
                <i class="fas fa-file-contract"></i>
            </div>
            <div>
                <span class="font-medium text-gray-800 block mb-1">PDO</span>
                <p class="text-sm text-gray-500">Programa de Demissão Voluntária</p>
            </div>
        </button>
        
    </div>
    <button 
        data-url="<?= url("/segurodesemprego"); ?>"
        class="mt-6 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
        <i class="fas fa-arrow-left mr-2"></i> Voltar
    </button>
</div>