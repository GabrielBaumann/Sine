<div id="step-3-form" class="step-content">
    <h1 id="titleForm" class="text-xl font-semibold text-sine-600 mb-4"><?= $titleForm ?? "" ?></h1>
        <span class='flex w-full border border-gray-200 mb-4 border-[1px]'></span>
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Informações do Candidato</h2>

    <form id="formService" action="<?= url("/formularioAtendimento") . (isset($worker->id_worker) ? "/" . $worker->id_worker : "" ) ; ?>" method="post" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <?= csrf_input(); ?>

        <input 
            type="number" 
            id="idServiceType"
            hidden
            value="<?= $idServiceType ?? null ?>" 
            name="idServiceType">

        <div class="col-span-2 md:col-span-1">
            <label for="cpf" class="block text-sm font-medium text-gray-700 mb-1">CPF</label>
            <input
                value="<?= formatCPF($worker->cpf_worker ?? "") ?>" 
                data-url="<?= url("/verificarCpfAtendimento")?>"
                type="text" 
                id="cpf" 
                name="cpf" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500" 
                placeholder="000.000.000-00">
        </div>

        <!-- Nome -->
        <div class="col-span-2 md:col-span-1">
            <label for="nome" class="block text-sm font-medium text-gray-700 mb-1">Nome Completo</label>
            <input 
                value="<?= $worker->name_worker ?? "" ?>"
                type="text" 
                id="nome" 
                name="nome" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500" 
                placeholder="Digite o nome completo" >
        </div>

        <!-- Sexo -->
        <div class="col-span-2 md:col-span-1">
            <label class="block text-sm font-medium text-gray-700 mb-1">Sexo</label>
            <div class="flex gap-4">
                <label class="inline-flex items-center">
                    <input type="radio" name="sexo" value="Masculino" class="h-4 w-4 text-sine-600 focus:ring-sine-500 border-gray-300" >
                    <span class="ml-2 text-gray-700">Masculino</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="sexo" value="Feminino" class="h-4 w-4 text-sine-600 focus:ring-sine-500 border-gray-300">
                    <span class="ml-2 text-gray-700">Feminino</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="sexo" value="Outro" class="h-4 w-4 text-sine-600 focus:ring-sine-500 border-gray-300">
                    <span class="ml-2 text-gray-700">Outro</span>
                </label>
            </div>
        </div>

        <!-- Data do Atendimento -->
        <div class="col-span-2 md:col-span-1">
            <label for="data-atendimento" class="block text-sm font-medium text-gray-700 mb-1">Data do Atendimento</label>
            <input 
                value="<?= $worker->date_birth_worker ?? "" ?>"
                type="date" 
                id="date-birth-worker" 
                name="date-birth-worker" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500" >
        </div>

        <!-- PCD -->
        <div class="col-span-2 md:col-span-1">
            <label class="block text-sm font-medium text-gray-700 mb-1">Pessoa com Deficiência (PCD)</label>
            <div class="flex gap-4">
                <label class="inline-flex items-center">
                    <input 
                        type="radio" 
                        name="pcd" 
                        value="sim"
                        <?= ($worker->pcd_worker ?? "não") === "sim" ? "checked" : "" ?> 
                        class="h-4 w-4 text-sine-600 focus:ring-sine-500 border-gray-300" >
                    <span class="ml-2 text-gray-700">Sim</span>
                </label>
                <label class="inline-flex items-center">
                    <input 
                        id="pcd" 
                        type="radio" 
                        name="pcd" 
                        value="não" 
                        <?= ($worker->pcd_worker ?? "não") === "não" ? "checked" : "" ?>
                        class="h-4 w-4 text-sine-600 focus:ring-sine-500 border-gray-300">
                    <span class="ml-2 text-gray-700">Não</span>
                </label>
            </div>
        </div>

        <!-- Aprendiz -->
        <div class="col-span-2 md:col-span-1">
            <label class="block text-sm font-medium text-gray-700 mb-1">Aprendiz</label>
            <div class="flex gap-4">
                <label class="inline-flex items-center">
                    <input 
                        type="radio" 
                        name="apprentice" 
                        <?= ($worker->apprentice_worker ?? "não") === "sim" ? "checked" : "" ?>
                        value="sim" 
                        class="h-4 w-4 text-sine-600 focus:ring-sine-500 border-gray-300" >
                    <span class="ml-2 text-gray-700">Sim</span>
                </label>
                <label class="inline-flex items-center">
                    <input 
                        id="apprentice" 
                        type="radio" 
                        name="apprentice" 
                        <?= ($worker->apprentice_worker ?? "não") === "não" ? "checked" : "" ?>
                        value="não" 
                        class="h-4 w-4 text-sine-600 focus:ring-sine-500 border-gray-300">
                    <span class="ml-2 text-gray-700">Não</span>
                </label>
            </div>
        </div>

        <!-- CTERC -->
        <div class="col-span-2 md:col-span-1">
            <label class="block text-sm font-medium text-gray-700 mb-1">CTERC (Terceirizado)</label>
            <div class="flex gap-4">
                <label class="inline-flex items-center">
                    <input 
                        type="radio" 
                        name="cterc"
                        <?= ($worker->cterc ?? "não") === "sim" ? "checked" : "" ?> 
                        value="sim" 
                        class="h-4 w-4 text-sine-600 focus:ring-sine-500 border-gray-300" >
                    <span class="ml-2 text-gray-700">Sim</span>
                </label>
                <label class="inline-flex items-center">
                    <input 
                        id="cterc" 
                        type="radio" 
                        name="cterc"
                        <?= ($worker->cterc ?? "não") === "não" ? "checked" : "" ?>  
                        value="não" 
                        class="h-4 w-4 text-sine-600 focus:ring-sine-500 border-gray-300">
                    <span class="ml-2 text-gray-700">Não</span>
                </label>
            </div>
        </div>

        <!-- Botões de navegação -->
        <div class="col-span-2 flex justify-between mt-4">
            <button
                id="bntBack" 
                data-url="<?= ($url ?? null); ?>"
                type="button" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Voltar
            </button>

            <button
                type="submit" class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-500 transition-colors">
                Confirmar <i class="fas fa-check ml-2"></i>
            </button>
        </div>
    </form>
</div>