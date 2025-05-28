<div id="step-5" class="step-content">
    <div class="text-center py-8">
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center text-green-600 mx-auto mb-4">
           <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
        <path fill-rule="evenodd" d="M8.603 3.799A4.49 4.49 0 0 1 12 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 0 1 3.498 1.307 4.491 4.491 0 0 1 1.307 3.497A4.49 4.49 0 0 1 21.75 12a4.49 4.49 0 0 1-1.549 3.397 4.491 4.491 0 0 1-1.307 3.497 4.491 4.491 0 0 1-3.497 1.307A4.49 4.49 0 0 1 12 21.75a4.49 4.49 0 0 1-3.397-1.549 4.49 4.49 0 0 1-3.498-1.306 4.491 4.491 0 0 1-1.307-3.498A4.49 4.49 0 0 1 2.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 0 1 1.307-3.497 4.49 4.49 0 0 1 3.497-1.307Zm7.007 6.387a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
        </svg>
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
            class="px-6 py-3 bg-sine-600 text-green rounded-lg hover:bg-sine-700 transition-colors">
            <i class="fas fa-home mr-2"></i> Voltar para a página inicial
        </button>
    </div>
</div>