<input 
    id="id-worker" 
    type="hidden"
    name="id-worker" 
    value="<?= $worker->id_worker ?? null; ?>">

<div>
    <!-- Cabeçalho -->
    <div class="flex items-center gap-3 mb-4">
        <button
            id="btn-back"
            data-url="<?= url("/listatrabalhador"); ?>"
            data-change="content"
            class="cursor-pointer text-blue-500">
            < Voltar à página de trabalhadores
        </button>
    </div>
    
    <div><?= flash(); ?></div>
    <!-- Histórico de Atendimentos -->
    <div class="overflow-hidden">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-white p-5 rounded-2xl mb-4">
            <div class="flex flex-col">
                <h3 class="text-2xl text-gray-800 font-bold flex items-center gap-2">
                    <?= $worker->name_worker ?? null; ?>
                </h3>
                <div class="flex items-center gap-3">
                    <div>
                        <p class="text-md text-gray-600">CPF: <?= formatCPF($worker->cpf_worker ?? '00000'); ?></p>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <div class="relative">
                    <select 
                        name="search-enterprise"
                        data-ajax="content-history"
                        data-url="<?= url("/pesquisartiposervico/{$worker->id_worker}"); ?>"
                        class="input-search px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                        <option value="">Todos</option>
                        <?php foreach($typeService as $typeServiceItem): ?>
                            <option value="<?= $typeServiceItem->type_service ?>"><?= $typeServiceItem->type_service ?></option>
                        <?php endforeach;?>
                        </select>
                </div>
            </div>
        </div>

        <!-- Tabela Responsiva -->
        <div id="content-history" class="bg-white rounded-2xl p-5">
            <?php $this->insert("/pageWorker/listHistoryService"); ?>
        </div>
    </div>
</div>