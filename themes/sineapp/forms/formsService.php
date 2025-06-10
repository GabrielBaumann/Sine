<div id="step-3-form" class="step-content">
    <h1 id="titleForm" class="text-xl font-normal text-gray-800 mb-4"><?= $titleForm ?? "" ?></h1>
        <span class='flex w-full border border-gray-200 mb-4'></span>
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Informações do Candidato</h2>

    <form id="formService" action="<?= url("/formularioAtendimento") . (isset($worker->id_worker) ? "/" . $worker->id_worker : "" ) ; ?>" method="post" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <?= csrf_input(); ?>

        <input 
            type="hidden" 
            id="idServiceType"
            value="<?= $idServiceType ?? null ?>" 
            name="idServiceType">

        <div class="col-span-2 md:col-span-1">
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

        <!-- Nome -->
        <div class="col-span-2 md:col-span-1">
            <label for="nome" class="block text-sm font-medium text-gray-700 mb-1">Nome Completo *</label>
            <input 
                value="<?= $worker->name_worker ?? "" ?>"
                type="text" 
                id="nome" 
                name="nome" 
                class="bg-white w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500" 
                placeholder="Digite o nome completo" >
        </div>

        <!-- Sexo -->
        <div class="col-span-2 md:col-span-1">
            <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Sexo *</label>
            <select id="gender" name="gender" class="bg-white mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 sm:text-sm rounded-md">
                <option value="">Selecione</option>
                <option value="Masculino" <?= ($worker->gender_worker ?? '') === 'Masculino' ? 'selected' : '' ?>>Masculino</option>
                <option value="Feminino" <?= ($worker->gender_worker ?? '') === 'Feminino' ? 'selected' : '' ?>>Feminino</option>
                <option value="Outro" <?= ($worker->gender_worker ?? '') === 'Outro' ? 'selected' : '' ?>>Outro</option>
            </select>
        </div>

        <!-- Data do Nascimento -->
        <div class="col-span-2 md:col-span-1">
            <label for="data-atendimento" class="block text-sm font-medium text-gray-700 mb-1">Data de Nascimento *</label>
            <input 
                value="<?= $worker->date_birth_worker ?? "" ?>"
                type="date" 
                id="date-birth-worker" 
                name="date-birth-worker" 
                class="bg-white w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500" >
        </div>

        <!-- PCD -->
        <div class="col-span-2 md:col-span-1">
            <label for="pcd" class="block text-sm font-medium text-gray-700 mb-1">Pessoa com Deficiência (PCD) *</label>
            <select id="pcd" name="pcd" class="bg-white mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 sm:text-sm rounded-md">
                <option value="não" <?= ($worker->pcd_worker ?? 'não') === 'não' ? 'selected' : '' ?>>Não</option>
                <option value="sim" <?= ($worker->pcd_worker ?? 'não') === 'sim' ? 'selected' : '' ?>>Sim</option>
            </select>
        </div>

        <!-- Aprendiz -->
        <div class="col-span-2 md:col-span-1">
            <label for="apprentice" class="block text-sm font-medium text-gray-700 mb-1">Aprendiz *</label>
            <select id="apprentice" name="apprentice" class="bg-white mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 sm:text-sm rounded-md">
                <option value="não" <?= ($worker->apprentice_worker ?? 'não') === 'não' ? 'selected' : '' ?>>Não</option>
                <option value="sim" <?= ($worker->apprentice_worker ?? 'não') === 'sim' ? 'selected' : '' ?>>Sim</option>
            </select>
        </div>

        <!-- CTERC -->
        <div class="col-span-2 md:col-span-1">
            <label for="cterc" class="block text-sm font-medium text-gray-700 mb-1">CTERC *</label>
            <select id="cterc" name="cterc" class="bg-white mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 sm:text-sm rounded-md">
                <option value="não" <?= ($worker->cterc ?? 'não') === 'não' ? 'selected' : '' ?>>Não</option>
                <option value="sim" <?= ($worker->cterc ?? 'não') === 'sim' ? 'selected' : '' ?>>Sim</option>
            </select>
        </div>

        <!-- Observação -->
        <div class="col-span-2">
            <label for="observation" class="block text-sm font-medium text-gray-700 mb-1">Observação</label>
            <textarea 
                id="observation" 
                name="observation" 
                rows="3" 
                class="bg-white w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500" 
                placeholder="Digite alguma observação relevante"><?= $worker->observacao ?? "" ?></textarea>
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