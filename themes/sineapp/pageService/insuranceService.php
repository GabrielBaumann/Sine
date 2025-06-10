<div id="step-3" class="step-content">
    <div id="typeService" hidden><?= $type ?></div>
    <div class="hidden md:flex items-center justify-left p-2 gap-2 md:mt-10">
        <button
            data-url="<?= url("/atendimentotipo"); ?>"
            class="cursor-pointer p-1 px-2 rounded-full border border-gray-400 text-gray-800 hover:bg-blue-800 hover:text-white transition hover:border-blue-900">
            < Voltar
        </button>
        <p class='text-blue-500 flex items-center truncate'>Início > Atendimento > Presencial > Seguro Desemprego</p>
    </div>
    <main class="grid min-h-full place-items-center px-6 md:py-10 lg:px-8 mb-10">
        <div class="text-center">
            <h1 class="mt-4 text-3xl font-semibold tracking-tight text-balance text-gray-800 sm:text-5xl">Qual serviço do Seguro Desemprego?</h1>
            
        </div>
    </main>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <button
            data-idservice = "<?= $type === "telefone" ? "58" : "6" ?>"  
            data-url="<?= url("/formularioAtendimento/desemprego/") . $type ?>"
            class="p-4 border-2 border-gray-200 rounded-lg hover:border-sine-300 hover:bg-sine-50 transition-all flex items-start gap-3 text-left">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center text-blue-800 mt-1 flex-shrink-0">
                <i class="fas fa-user-edit"></i>
            </div>
            <div>
                <span class="font-medium text-gray-800 block mb-1">Atualização de Cadastro do Trabalhador</span>
                <p class="text-sm text-gray-500">Atualização de dados cadastrais para o seguro desemprego</p>
            </div>
        </button>

        <button 
            data-url="<?= url("/requerimentoEspecial/") . $type ?>"
            class="p-4 border-2 border-gray-200 rounded-lg hover:border-sine-300 hover:bg-sine-50 transition-all flex items-start gap-3 text-left">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center text-green-800 mt-1 flex-shrink-0">
                <i class="fas fa-file-alt"></i>
            </div>
            <div>
                <span class="font-medium text-gray-800 block mb-1">Requerimento Especial</span>
                <p class="text-sm text-gray-500">Solicitação especial de seguro desemprego</p>
            </div>
        </button>

        <button
            data-idservice = "<?= $type === "telefone" ? "59" : "7" ?>"  
            data-url="<?= url("/formularioAtendimento/desemprego/") . $type ?>"
            class="p-4 border-2 border-gray-200 rounded-lg hover:border-sine-300 hover:bg-sine-50 transition-all flex items-start gap-3 text-left">
            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center text-purple-800 mt-1 flex-shrink-0">
                <i class="fas fa-search"></i>
            </div>
            <div>
                <span class="font-medium text-gray-800 block mb-1">Consulta Dados Cadastrais INSS</span>
                <p class="text-sm text-gray-500">Verificação de dados no sistema do INSS</p>
            </div>
        </button>

        <button
            data-idservice = "<?= $type === "telefone" ? "66" : "8" ?>"  
            data-url="<?= url("/formularioAtendimento/desemprego/") . $type ?>"
            class="p-4 border-2 border-gray-200 rounded-lg hover:border-sine-300 hover:bg-sine-50 transition-all flex items-start gap-3 text-left">
            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center text-yellow-800 mt-1 flex-shrink-0">
                <i class="fas fa-file-invoice"></i>
            </div>
            <div>
                <span class="font-medium text-gray-800 block mb-1">Consulta Dados Cadastrais Receita Federal</span>
                <p class="text-sm text-gray-500">Verificação de dados na Receita Federal</p>
            </div>
        </button>

        <button
            data-idservice = "<?= $type === "telefone" ? "60" : "9" ?>"  
            data-url="<?= url("/formularioAtendimento/desemprego/") . $type ?>"
            class="p-4 border-2 border-gray-200 rounded-lg hover:border-sine-300 hover:bg-sine-50 transition-all flex items-start gap-3 text-left">
            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center text-red-800 mt-1 flex-shrink-0">
                <i class="fas fa-receipt"></i>
            </div>
            <div>
                <span class="font-medium text-gray-800 block mb-1">Cadastrar GRU</span>
                <p class="text-sm text-gray-500">Geração de Guia de Recolhimento da União</p>
            </div>
        </button>

        <button
            data-idservice = "<?= $type === "telefone" ? "69" : "10" ?>"  
            data-url="<?= url("/formularioAtendimento/desemprego/") . $type ?>"
            class="p-4 border-2 border-gray-200 rounded-lg hover:border-sine-300 hover:bg-sine-50 transition-all flex items-start gap-3 text-left">
            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-800 mt-1 flex-shrink-0">
                <i class="fas fa-briefcase"></i>
            </div>
            <div>
                <span class="font-medium text-gray-800 block mb-1">Entrada no Seguro Formal</span>
                <p class="text-sm text-gray-500">Registro para trabalhadores formais</p>
            </div>
        </button>

        <button
            data-idservice = "<?= $type === "telefone" ? "61" : "11" ?>"  
            data-url="<?= url("/formularioAtendimento/desemprego/") . $type ?>"
            class="p-4 border-2 border-gray-200 rounded-lg hover:border-sine-300 hover:bg-sine-50 transition-all flex items-start gap-3 text-left">
            <div class="w-10 h-10 bg-pink-100 rounded-lg flex items-center justify-center text-pink-800 mt-1 flex-shrink-0">
                <i class="fas fa-home"></i>
            </div>
            <div>
                <span class="font-medium text-gray-800 block mb-1">Entrada no Seguro Doméstico</span>
                <p class="text-sm text-gray-500">Registro para trabalhadores domésticos</p>
            </div>
        </button>

        <button
            data-idservice = "<?= $type === "telefone" ? "62" : "12" ?>"  
            data-url="<?= url("/formularioAtendimento/desemprego/") . $type ?>"
            class="p-4 border-2 border-gray-200 rounded-lg hover:border-sine-300 hover:bg-sine-50 transition-all flex items-start gap-3 text-left">
            <div class="w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center text-teal-800 mt-1 flex-shrink-0">
                <i class="fas fa-university"></i>
            </div>
            <div>
                <span class="font-medium text-gray-800 block mb-1">Alteração de dados Bancários</span>
                <p class="text-sm text-gray-500">Atualização de conta bancária para recebimento</p>
            </div>
        </button>

        <button
            data-idservice = "<?= $type === "telefone" ? "63" : "13" ?>"    
            data-url="<?= url("/formularioAtendimento/desemprego/") . $type ?>"
            class="p-4 border-2 border-gray-200 rounded-lg hover:border-sine-300 hover:bg-sine-50 transition-all flex items-start gap-3 text-left">
            <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center text-orange-800 mt-1 flex-shrink-0">
                <i class="fas fa-laptop"></i>
            </div>
            <div>
                <span class="font-medium text-gray-800 block mb-1">Empregador WEB</span>
                <p class="text-sm text-gray-500">Acesso ao sistema Empregador WEB</p>
            </div>
        </button>
    </div>
</div>