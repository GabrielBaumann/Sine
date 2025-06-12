<main class="flex-1 overflow-y-auto p-4 md:p-6 pb-20 lg:pb-6">
    <!-- Header de localização -->
    <header class="mb-4 md:mb-5 flex items-center gap-3 md:gap-5 text-blue-800 text-sm md:text-base">
        <a href="<?= url("/vagas"); ?>" class="cursor-pointer p-1 px-2 rounded-full border border-gray-400 text-gray-800 hover:bg-blue-800 hover:text-white transition hover:border-blue-900">< Voltar</a>
        <p>Vagas > Nova vaga</p> 
    </header>

    <div>
        <h1 id="titleForm" class="text-2xl md:text-2xl font-semibold text-gray-900 mb-3 md:py-5">Nova vaga</h1>

        <form id="formService" action="<?= url("/cadastrarvagas") . (isset($worker->id_worker) ? "/" . $worker->id_worker : "" ) ; ?>" method="post" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4">
            <?= csrf_input(); ?>

            <!-- Coluna 1 -->
            <div class="space-y-3 md:space-y-4">
                <!-- CBO - Ocupação -->
                <input type="hidden" id="" value="" name="cbo">
                <div>
                    <label for="" class="block text-sm font-medium text-gray-700 mb-1">CBO - Ocupação *</label>
                    <input value="" data-url="" type="text" id="" name="cbo" 
                        class="bg-white w-full px-3 py-2 md:py-1.5 text-sm border border-gray-300 rounded-lg md:rounded-md focus:ring-sine-500 focus:border-sine-500" 
                        placeholder="00000">
                </div>

                <!-- PCD -->
                <div>
                    <label for="" class="block text-sm font-medium text-gray-700 mb-1">PCD *</label>
                    <select id="" name="" class="bg-white block w-full pl-3 pr-8 py-2 md:py-1.5 text-sm border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 rounded-lg md:rounded-md">
                        <option value="">Selecione</option>
                        <option value="Masculino">Sim</option>
                        <option value="Feminino">Não</option>
                    </select>
                </div>

                <!-- APRENDIZ -->
                <div>
                    <label for="" class="block text-sm font-medium text-gray-700 mb-1">Aprendiz *</label>
                    <select id="" name="" class="bg-white block w-full pl-3 pr-8 py-2 md:py-1.5 text-sm border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 rounded-lg md:rounded-md">
                        <option value="">Selecione</option>
                        <option value="Masculino">Sim</option>
                        <option value="Feminino">Não</option>
                    </select>
                </div>
            </div>

            <!-- Coluna 2 -->
            <div class="space-y-3 md:space-y-4">
                <!-- Sexo -->
                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Sexo *</label>
                    <select name="gender" class="bg-white block w-full pl-3 pr-8 py-2 md:py-1.5 text-sm border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 rounded-lg md:rounded-md">
                        <option value="">Selecione</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Feminino">Feminino</option>
                        <option value="Outro">Outro</option>
                    </select>
                </div>

                <!-- N° de Vagas -->
                <input type="hidden" id="" value="" name="">
                <div>
                    <label for="" class="block text-sm font-medium text-gray-700 mb-1">N° de Vagas *</label>
                    <input value="" data-url="" type="text" id="" name="" 
                        class="bg-white w-full px-3 py-2 md:py-1.5 text-sm border border-gray-300 rounded-lg md:rounded-md focus:ring-sine-500 focus:border-sine-500" 
                        placeholder="00">
                </div>

                <!-- Qtd. por Vaga -->
                <input type="hidden" id="" value="" name="">
                <div>
                    <label for="" class="block text-sm font-medium text-gray-700 mb-1">Qtd. por Vaga *</label>
                    <input value="" data-url="" type="text" id="" name="" 
                        class="bg-white w-full px-3 py-2 md:py-1.5 text-sm border border-gray-300 rounded-lg md:rounded-md focus:ring-sine-500 focus:border-sine-500" 
                        placeholder="00">
                </div>
            </div>

            <!-- Coluna 3 -->
            <div class="space-y-3 md:space-y-4">
                <!-- Data de abertura -->
                <div>
                    <label for="" class="block text-sm font-medium text-gray-700 mb-1">Data de abertura *</label>
                    <input value="" type="date" id="" name="" 
                        class="bg-white w-full px-3 py-2 md:py-1.5 text-sm border border-gray-300 rounded-lg md:rounded-md focus:ring-sine-500 focus:border-sine-500 text-gray-900">
                </div>

                <!-- Escolaridade -->
                <div>
                    <label for="education" class="block text-sm font-medium text-gray-700 mb-1">Escolaridade *</label>
                    <select id="education" name="education" class="bg-white block w-full pl-3 pr-8 py-2 md:py-1.5 text-sm border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 rounded-lg md:rounded-md">
                        <option value="">Selecione</option>
                        <option value="">Ensino médio completo</option>
                        <option value="">Ensino superior completo</option>
                    </select>
                </div>

                <!-- Idade Mínima/Máxima -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label for="" class="block text-sm font-medium text-gray-700 mb-1">Idade Mínima *</label>
                        <input value="" data-url="" type="text" id="" name="" 
                            class="bg-white w-full px-3 py-2 md:py-1.5 text-sm border border-gray-300 rounded-lg md:rounded-md focus:ring-sine-500 focus:border-sine-500" 
                            placeholder="00">
                    </div>
                    <div>
                        <label for="" class="block text-sm font-medium text-gray-700 mb-1">Idade Máxima *</label>
                        <input value="" data-url="" type="text" id="" name="" 
                            class="bg-white w-full px-3 py-2 md:py-1.5 text-sm border border-gray-300 rounded-lg md:rounded-md focus:ring-sine-500 focus:border-sine-500" 
                            placeholder="00">
                    </div>
                </div>
            </div>

            <!-- Campos de largura total -->
            <div class="col-span-1 md:col-span-2 lg:col-span-3 grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4">
                <!-- Exp -->
                <div>
                    <label for="experience" class="block text-sm font-medium text-gray-700 mb-1">Experiência *</label>
                    <select id="experience" name="experience" class="bg-white block w-full pl-3 pr-8 py-2 md:py-1.5 text-sm border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 rounded-lg md:rounded-md">
                        <option value="">Selecione</option>
                        <option value="">Sim</option>
                        <option value="">Não</option>
                    </select>
                </div>

                <!-- Nomenclatura da vaga -->
                <input type="hidden" id="" value="" name="">
                <div>
                    <label for="" class="block text-sm font-medium text-gray-700 mb-1">Nomenclatura da vaga *</label>
                    <input value="" data-url="" type="text" id="" name="" 
                        class="bg-white w-full px-3 py-2 md:py-1.5 text-sm border border-gray-300 rounded-lg md:rounded-md focus:ring-sine-500 focus:border-sine-500" 
                        placeholder="00">
                </div>
            </div>

            <!-- Descrição / Requisitos da vaga -->
            <div class="col-span-1 md:col-span-2 lg:col-span-3">
                <label for="observation" class="block text-sm font-medium text-gray-700 mb-1">Descrição / Requisitos da vaga</label>
                <textarea id="observation" name="observation" rows="3" 
                    class="bg-white w-full px-3 py-2 text-sm border border-gray-300 rounded-lg md:rounded-md focus:ring-sine-500 focus:border-sine-500" 
                    placeholder="Digite alguma observação relevante"></textarea>
            </div>

            <!-- Botão de confirmação -->
            <div class="col-span-4 flex justify-end mt-4 md:p-3">
                <button
                    type="submit" class="cursor-pointer flex items-center px-6 py-2 bg-blue-800 text-white rounded-lg hover:bg-blue-900 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Confirmar
                </button>
            </div>
        </form>
    </div>
</main>