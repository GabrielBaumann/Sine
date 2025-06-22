<div id="step-3-form" class="step-content">
    <div class="hidden md:flex items-center justify-left p-2 gap-2">
        <button
            id="bntBack"
            data-url="<?= $url ; ?>"
            class="cursor-pointer p-1 px-2 rounded-full border border-gray-400 text-gray-800 hover:bg-blue-800 hover:text-white transition hover:border-blue-900">
            < Voltar
        </button>
        <p class="text-blue-500 flex items-center truncate navigation">
            <!-- Caminho -->
        </p>
    </div>

    <h1 id="titleForm" class="text-2xl font-semibold text-gray-900 md:px-3 py-3"><?= $titleForm ?? "" ?></h1>

    <form id="formService" action="<?= url("/formularioAtendimento") . (isset($worker->id_worker) ? "/" . $worker->id_worker : "" ) ; ?>" method="post" class="md:p-3 grid grid-cols-1 md:grid-cols-4 gap-4">
        <?= csrf_input(); ?>

        <input 
            type="hidden" 
            id="idServiceType"
            value="<?= $idServiceType ?? null ?>" 
            name="idServiceType">

        <!-- Linha 1 -->
        <div class="col-span-4 md:col-span-2 lg:col-span-1">
            <label for="cpf" class="block text-sm font-medium text-gray-700 mb-1">CPF *</label>
            <input
                value="<?= formatCPF($worker->cpf_worker ?? "") ?>" 
                data-url="<?= url("/verificarCpfAtendimento")?>"
                type="text" 
                id="cpf" 
                name="cpf" 
                class="bg-white w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500" 
                placeholder="000.000.000-00">
        </div>

        <div class="col-span-4 md:col-span-2 lg:col-span-3">
            <label for="nome" class="block text-sm font-medium text-gray-700 mb-1">Nome Completo *</label>
            <input 
                value="<?= $worker->name_worker ?? "" ?>"
                type="text" 
                id="nome" 
                name="nome" 
                class="bg-white w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500" 
                placeholder="Digite o nome completo" >
        </div>

        <!-- Linha 2 -->
        <div class="col-span-4 md:col-span-2 lg:col-span-1">
            <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Sexo *</label>
            <select id="gender" name="gender" class="bg-white mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 sm:text-sm rounded-md">
                <option value="">Selecione</option>
                <option value="Masculino" <?= ($worker->gender_worker ?? '') === 'Masculino' ? 'selected' : '' ?>>Masculino</option>
                <option value="Feminino" <?= ($worker->gender_worker ?? '') === 'Feminino' ? 'selected' : '' ?>>Feminino</option>
                <option value="Outro" <?= ($worker->gender_worker ?? '') === 'Outro' ? 'selected' : '' ?>>Outro</option>
            </select>
        </div>

        <div class="col-span-4 md:col-span-2 lg:col-span-1">
            <label for="data-atendimento" class="block text-sm font-medium text-gray-700 mb-1">Data Nasc. *</label>
            <input 
                value="<?= $worker->date_birth_worker ?? "" ?>"
                type="date" 
                id="date-birth-worker" 
                name="date-birth-worker" 
                class="bg-white w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500" >
        </div>

        <div class="col-span-4 md:col-span-2 lg:col-span-1">
            <label for="pcd" class="block text-sm font-medium text-gray-700 mb-1">PCD *</label>
            <select id="pcd" name="pcd" class="bg-white mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 sm:text-sm rounded-md">
                <option value="não" <?= ($worker->pcd_worker ?? 'não') === 'não' ? 'selected' : '' ?>>Não</option>
                <option value="sim" <?= ($worker->pcd_worker ?? 'não') === 'sim' ? 'selected' : '' ?>>Sim</option>
            </select>
        </div>

        <div class="col-span-4 md:col-span-2 lg:col-span-1">
            <label for="apprentice" class="block text-sm font-medium text-gray-700 mb-1">Aprendiz *</label>
            <select id="apprentice" name="apprentice" class="bg-white mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 sm:text-sm rounded-md">
                <option value="não" <?= ($worker->apprentice_worker ?? 'não') === 'não' ? 'selected' : '' ?>>Não</option>
                <option value="sim" <?= ($worker->apprentice_worker ?? 'não') === 'sim' ? 'selected' : '' ?>>Sim</option>
            </select>
        </div>

        <!-- Linha 3 -->
        <div class="col-span-4 md:col-span-2 lg:col-span-1">
            <label for="cterc" class="block text-sm font-medium text-gray-700 mb-1">CTERC *</label>
            <select id="cterc" name="cterc" class="bg-white mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 sm:text-sm rounded-md">
                <option value="não" <?= ($worker->cterc ?? 'não') === 'não' ? 'selected' : '' ?>>Não</option>
                <option value="sim" <?= ($worker->cterc ?? 'não') === 'sim' ? 'selected' : '' ?>>Sim</option>
            </select>
        </div>

        <?php if((int)$idInterview === 4 || (int)$idInterview === 56): ?>
            <!-- Encaminhamento para entrevistas -->
            <div class="col-span-4 md:col-span-2 lg:col-span-1">
                <label for="company-name" class="block text-sm font-medium text-gray-700 mb-1">Empresa *</label>
                <select 
                    data-url="<?= url("/selecionarempresa"); ?>"
                    id="company-name" 
                    name="company-name" 
                    class="bg-white mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 sm:text-sm rounded-md">
                    <option value="">Selecione</option>
                </select>
            </div>

            <!-- Encaminhamento para entrevistas -->
            <div class="col-span-4 md:col-span-2 lg:col-span-2">
                <label for="occupation-id-vacancy" class="block text-sm font-medium text-gray-700 mb-1">Função *</label>
                <select id="occupation-id-vacancy" name="occupation-id-vacancy" class="bg-white mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 sm:text-sm rounded-md">
                    <option value="">Selecione</option>
                </select>
            </div>
        <?php endif; ?>
        
        <!-- linha inteira -->
        <div class="col-span-4">
            <label for="observation" class="block text-sm font-medium text-gray-700 mb-1">Observação</label>
            <textarea 
                id="observation" 
                name="observation" 
                rows="3" 
                class="bg-white w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500" 
                placeholder="Digite alguma observação relevante"><?= $worker->observacao ?? "" ?></textarea>
        </div>

        <!-- Botão de confirmação -->
        <div class="col-span-4 flex justify-end mt-4">
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