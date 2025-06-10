<main class="flex-1 overflow-y-auto p-6 pb-20 lg:pb-6">

    <!-- Header de localização -->
    <header class="mb-5 flex items-center gap-5 text-blue-800 ">
        <a href="<?= url("/vagas"); ?>" class="cursor-pointer p-1 px-2 rounded-full border border-gray-400 text-gray-800 hover:bg-blue-800 hover:text-white transition hover:border-blue-900">< Voltar</a>
        <p>Início > Vagas > Nova vaga</p> 
    </header>

    <div>
    <h1 id="titleForm" class="text-3xl font-normal text-gray-800 mb-4">Nova vaga</h1>
        <span class='flex w-full border border-gray-200 mb-4'></span>

    <form id="formService" action="<?= url("/formularioAtendimento") . (isset($worker->id_worker) ? "/" . $worker->id_worker : "" ) ; ?>" method="post" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <?= csrf_input(); ?>

        <!-- CBO - Ocupação -->
        <input 
            type="hidden" 
            id=""
            value="" 
            name="">

        <div class="col-span-2 md:col-span-1">
            <label for="" class="block text-sm font-medium text-gray-700 mb-1">CBO - Ocupação *</label>
            <input
                value="" 
                data-url=""
                type="text" 
                id="" 
                name="" 
                class="bg-white w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500" 
                placeholder="00000">
        </div>

        <!-- PCD -->
        <div class="col-span-2 md:col-span-1">
            <label for="" class="block text-sm font-medium text-gray-700 mb-1">PCD *</label>
            <select id="" name="" class="bg-white mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 sm:text-sm rounded-md">
                <option value="">Selecione</option>
                <option value="Masculino">Sim</option>
                <option value="Feminino">Não</option>
            </select>
        </div>

        <!-- APRENDIZ -->
        <div class="col-span-2 md:col-span-1">
            <label for="" class="block text-sm font-medium text-gray-700 mb-1">Aprendiz *</label>
            <select id="" name="" class="bg-white mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 sm:text-sm rounded-md">
                <option value="">Selecione</option>
                <option value="Masculino">Sim</option>
                <option value="Feminino">Não</option>
            </select>
        </div>

        <!-- Sexo -->
        <div class="col-span-2 md:col-span-1">
            <label for="" class="block text-sm font-medium text-gray-700 mb-1">Sexo *</label>
            <select id="gender" name="gender" class="bg-white mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 sm:text-sm rounded-md">
                <option value="">Selecione</option>
                <option value="Masculino">Masculino</option>
                <option value="Feminino">Feminino</option>
                <option value="Outro">Outro</option>
            </select>
        </div>

        <!-- N° de Vagas -->
        <input 
            type="hidden" 
            id=""
            value="" 
            name="">

        <div class="col-span-2 md:col-span-1">
            <label for="" class="block text-sm font-medium text-gray-700 mb-1">N° de Vagas *</label>
            <input
                value="" 
                data-url=""
                type="text" 
                id="" 
                name="" 
                class="bg-white w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500" 
                placeholder="00">
        </div>

        <!-- Qtd. por Vaga -->
        <input 
            type="hidden" 
            id=""
            value="" 
            name="">

        <div class="col-span-2 md:col-span-1">
            <label for="" class="block text-sm font-medium text-gray-700 mb-1">Qtd. por Vaga *</label>
            <input
                value="" 
                data-url=""
                type="text" 
                id="" 
                name="" 
                class="bg-white w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500" 
                placeholder="00">
        </div>

        <!-- Data de abertura -->
        <div class="col-span-2 md:col-span-1">
            <label for="" class="block text-sm font-medium text-gray-700 mb-1">Data de abertura *</label>
            <input 
                value=""
                type="date" 
                id="" 
                name="" 
                class="bg-white w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500 text-gray-900" >
        </div>

        <!-- Escolaridade -->
        <div class="col-span-2 md:col-span-1">
            <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Escolaridade *</label>
            <select id="gender" name="gender" class="bg-white mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 sm:text-sm rounded-md">
                <option value="">Selecione</option>
                <option value="">Ensino médio completo</option>
                <option value="">Ensino superior completo</option>
            </select>
        </div>

        <!-- Idade Mínima -->
        <input 
            type="hidden" 
            id=""
            value="" 
            name="">

        <div class="col-span-2 md:col-span-1">
            <label for="" class="block text-sm font-medium text-gray-700 mb-1">Idade Mínima *</label>
            <input
                value="" 
                data-url=""
                type="text" 
                id="" 
                name="" 
                class="bg-white w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500" 
                placeholder="00">
        </div>

        <!-- Idade Mínima -->
        <input 
            type="hidden" 
            id=""
            value="" 
            name="">

        <div class="col-span-2 md:col-span-1">
            <label for="" class="block text-sm font-medium text-gray-700 mb-1">Idade Máxima *</label>
            <input
                value="" 
                data-url=""
                type="text" 
                id="" 
                name="" 
                class="bg-white w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500" 
                placeholder="00">
        </div>

        <!-- Exp -->
        <div class="col-span-2 md:col-span-1">
            <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Experiência *</label>
            <select id="gender" name="gender" class="bg-white mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 sm:text-sm rounded-md">
                <option value="">Selecione</option>
                <option value="">Sim</option>
                <option value="">Não</option>
            </select>
        </div>

        <!-- Nomenclatura da vaga -->
        <input 
            type="hidden" 
            id=""
            value="" 
            name="">

        <div class="col-span-2 md:col-span-1">
            <label for="" class="block text-sm font-medium text-gray-700 mb-1">Nomenclatura da vaga *</label>
            <input
                value="" 
                data-url=""
                type="text" 
                id="" 
                name="" 
                class="bg-white w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500" 
                placeholder="00">
        </div>

        <!-- Descrição / Requisitos da vaga -->
        <div class="col-span-2">
            <label for="observation" class="block text-sm font-medium text-gray-700 mb-1">Descrição / Requisitos da vaga</label>
            <textarea 
                id="observation" 
                name="observation" 
                rows="3" 
                class="bg-white w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500" 
                placeholder="Digite alguma observação relevante"></textarea>
        </div>

        <!-- Botões de navegação -->
        <div class="col-span-2 flex justify-between mt-4">
            <button
                id="bntBack" 
                data-url="<?= ($url ?? null); ?>"
                type="button" class="cursor-pointer px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Voltar
            </button>

            <button
                type="submit" class="cursor-pointer px-6 py-2 bg-blue-900 text-white rounded-lg hover:bg-blue-950 transition-colors">
                Confirmar <i class="fas fa-check ml-2"></i>
            </button>
        </div>
    </form>
</div>
</main>