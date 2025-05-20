<div id="step-1" class="step-content">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Como está sendo realizado este atendimento?</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <button
            data-url="<?= url("/atendimentomotivo"); ?>" 
            class="p-6 border-2 border-gray-200 rounded-lg hover:border-sine-300 hover:bg-sine-50 transition-all flex flex-col items-center gap-3">
                <div class="w-14 h-14 bg-sine-100 rounded-full flex items-center justify-center text-sine-700">
                    <i class="fas fa-user text-xl"></i>
                </div>
                <span class="font-medium text-gray-800">Atendimento Presencial</span>
                <p class="text-sm text-gray-500 text-center">O candidato está presente fisicamente na unidade</p>
            </button>
        <button class="p-6 border-2 border-gray-200 rounded-lg hover:border-sine-300 hover:bg-sine-50 transition-all flex flex-col items-center gap-3">
            <div class="w-14 h-14 bg-sine-100 rounded-full flex items-center justify-center text-sine-700">
                <i class="fas fa-phone-alt text-xl"></i>
            </div>
            <span class="font-medium text-gray-800">Atendimento por Telefone</span>
            <p class="text-sm text-gray-500 text-center">O candidato está sendo atendido remotamente por telefone</p>
        </button>
    </div>
</div>