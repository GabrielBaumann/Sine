<div id="step-2" class="step-content">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Qual o motivo deste atendimento?</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <button 
            data-url="<?= url("/formularioAtendimento")?>"
            class="p-4 border-2 border-gray-200 rounded-lg hover:border-sine-300 hover:bg-sine-50 transition-all flex items-start gap-3 text-left">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center text-blue-800 mt-1 flex-shrink-0">
                <i class="fas fa-user-edit"></i>
            </div>
            <div>
                <span class="font-medium text-gray-800 block mb-1">Cadastrar pessoas/Atualizar cadastro</span>
                <p class="text-sm text-gray-500">Cadastro ou atualização de informações no sistema</p>
            </div>
        </button>
        <button class="p-4 border-2 border-gray-200 rounded-lg hover:border-sine-300 hover:bg-sine-50 transition-all flex items-start gap-3 text-left">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center text-green-800 mt-1 flex-shrink-0">
                <i class="fas fa-id-card"></i>
            </div>
            <div>
                <span class="font-medium text-gray-800 block mb-1">ORIENTAÇÕES PARA CARTEIRA DE TRABALHO DIGITAL</span>
                <p class="text-sm text-gray-500">Informações sobre como acessar e usar a CTPS digital</p>
            </div>
        </button>
        <button class="p-4 border-2 border-gray-200 rounded-lg hover:border-sine-300 hover:bg-sine-50 transition-all flex items-start gap-3 text-left">
            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center text-purple-800 mt-1 flex-shrink-0">
                <i class="fas fa-briefcase"></i>
            </div>
            <div>
                <span class="font-medium text-gray-800 block mb-1">Orientações para o mercado de trabalho</span>
                <p class="text-sm text-gray-500">Dicas e informações sobre como se inserir no mercado</p>
            </div>
        </button>
        <button class="p-4 border-2 border-gray-200 rounded-lg hover:border-sine-300 hover:bg-sine-50 transition-all flex items-start gap-3 text-left">
            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center text-yellow-800 mt-1 flex-shrink-0">
                <i class="fas fa-handshake"></i>
            </div>
            <div>
                <span class="font-medium text-gray-800 block mb-1">Encaminhamento para entrevistas</span>
                <p class="text-sm text-gray-500">Agendamento e preparação para entrevistas de emprego</p>
            </div>
        </button>
        <button class="p-4 border-2 border-gray-200 rounded-lg hover:border-sine-300 hover:bg-sine-50 transition-all flex items-start gap-3 text-left">
            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center text-red-800 mt-1 flex-shrink-0">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <div>
                <span class="font-medium text-gray-800 block mb-1">Orientação sobre Abono Salárial</span>
                <p class="text-sm text-gray-500">Informações sobre direito ao abono salarial</p>
            </div>
        </button>
        <button
            data-url="<?= url("/segurodesemprego")?>" 
            class="p-4 border-2 border-gray-200 rounded-lg hover:border-sine-300 hover:bg-sine-50 transition-all flex items-start gap-3 text-left">
            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-800 mt-1 flex-shrink-0">
                <i class="fas fa-umbrella"></i>
            </div>
            <div>
                <span class="font-medium text-gray-800 block mb-1">Seguro desemprego</span>
                <p class="text-sm text-gray-500">Orientações sobre solicitação e benefício do seguro-desemprego</p>
            </div>
        </button>
    </div>
    <button class="mt-6 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
        <i class="fas fa-arrow-left mr-2"></i> Voltar
    </button>
</div>