<div id="step-5" class="step-content">
    <div class="text-center py-8 px-4">
        <div class="w-24 h-24 flex items-center justify-center text-blue-600 mx-auto mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-20 h-20">
                <path fill-rule="evenodd" d="M8.603 3.799A4.49 4.49 0 0 1 12 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 0 1 3.498 1.307 4.491 4.491 0 0 1 1.307 3.497A4.49 4.49 0 0 1 21.75 12a4.49 4.49 0 0 1-1.549 3.397 4.491 4.491 0 0 1-1.307 3.497 4.491 4.491 0 0 1-3.497 1.307A4.49 4.49 0 0 1 12 21.75a4.49 4.49 0 0 1-3.397-1.549 4.49 4.49 0 0 1-3.498-1.306 4.491 4.491 0 0 1-1.307-3.498A4.49 4.49 0 0 1 2.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 0 1 1.307-3.497 4.49 4.49 0 0 1 3.497-1.307Zm7.007 6.387a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
            </svg>
        </div>
        <h2 class="text-2xl text-gray-900 mb-3">Atendimento registrado com sucesso!</h2>
        <p class="text-gray-900 mb-8 max-w-md mx-auto">O atendimento foi registrado no sistema e já está disponível para consulta.</p>
        
        <div class="p-6 mb-8 text-left max-w-xl mx-auto">
            <!-- <div class="flex justify-between pb-3 mb-3">
                <span class="text-gray-900 font-medium">Tipo:</span>
                <span class="font-semibold text-blue-900" id="confirm-type"></span>
            </div> -->
            <div class="flex justify-between pb-3 mb-3">
                <span class="text-gray-900 font-medium">Nome Candidato:</span>
                <span class="font-semibold text-blue-900" id="confirm-reason"><?= $candidate->name_worker ?? $candidate->name_work_phone ?></span>
            </div>
            <div class="flex justify-between pb-3 mb-3" id="confirm-service-container">
                <span class="text-gray-900 font-medium">Serviço:</span>
                <span class="font-semibold text-blue-900" id="confirm-service"><?= $type->type_service ?? "" ?></span>
            </div>
            <!-- <div class="flex justify-between pt-3" id="confirm-request-container">
                <span class="text-gray-900 font-medium">Requerimento:</span>
                <span class="font-semibold text-blue-900" id="confirm-request"></span>
            </div> -->
        </div>
        
        <button 
            data-url="<?= url("/atendimentotipo"); ?>"
            class="cursor-pointer px-6 py-2 hover:bg-blue-700 text-blue-700 hover:text-white rounded-full border border-blue-700 font-medium transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            <i class="fas fa-home mr-2"></i> Voltar para a página inicial
        </button>
    </div>
</div>