<div id="step-5" class="step-content">
    <div class="text-center py-8">
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center text-green-600 mx-auto mb-4">
            <i class="fas fa-check text-3xl"></i>
        </div>
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Atendimento registrado com sucesso!</h2>
        <p class="text-gray-600 mb-6">O atendimento foi registrado no sistema e já está disponível para consulta.</p>
        <div class="bg-gray-50 p-4 rounded-lg mb-6 text-left max-w-md mx-auto">
            <div class="flex justify-between border-b border-gray-200 pb-2 mb-2">
                <span class="text-gray-500">Tipo:</span>
                <span class="font-medium" id="confirm-type"><?= $type->group ?? "" ?></span>
            </div>
            <div class="flex justify-between border-b border-gray-200 pb-2 mb-2">
                <span class="text-gray-500">Nome Candidato:</span>
                <span class="font-medium" id="confirm-reason"><?= $candidate->name_worker ?? "" ?></span>
            </div>
            <div class="flex justify-between border-b border-gray-200 pb-2 mb-2" id="confirm-service-container">
                <span class="text-gray-500">Serviço:</span>
                <span class="font-medium" id="confirm-service"><?= $type->type_service ?? "" ?></span>
            </div>
            <div class="flex justify-between" id="confirm-request-container">
                <span class="text-gray-500">Requerimento:</span>
                <span class="font-medium" id="confirm-request"></span>
            </div>
        </div>
        <button 
            data-url="<?= url("/atendimentotipo"); ?>"
            class="px-6 py-3 bg-sine-600 text-white rounded-lg hover:bg-sine-700 transition-colors">
            <i class="fas fa-home mr-2"></i> Voltar para a página inicial
        </button>
    </div>
</div>