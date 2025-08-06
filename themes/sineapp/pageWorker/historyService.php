<input 
    id="id-worker" 
    type="hidden"
    name="id-worker" 
    value="<?= $worker->id_worker; ?>">

<div>
    <!-- Cabeçalho -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-6 md:mb-0">
        <div class="flex items-center gap-3">
            <button
                id="btn-back"
                data-url="<?= url("/listatrabalhador"); ?>"
                data-change="content"
                class="cursor-pointer p-1 px-2 rounded-full border border-gray-300 text-gray-700 hover:bg-[#095998] hover:text-white transition-all duration-200 flex items-center gap-1">
                < Voltar
            </button>
        </div>
    </div>

    <!-- Histórico de Atendimentos -->
    <div class="overflow-hidden">
        <div class="py-4 md:py-12">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex flex-col md:px-3">
                    <h3 class="text-2xl text-gray-800 font-bold flex items-center gap-2">
                        <?= $worker->name_worker; ?>
                    </h3>
                    <div class="flex items-center gap-3">
                        <div>
                            <p class="text-md text-gray-600">CPF: <?= formatCPF($worker->cpf_worker); ?></p>
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
        </div>

        <!-- Tabela Responsiva -->
        <div id="content-history">
            <?php $this->insert("/pageWorker/listHistoryService"); ?>
        </div>
    </div>
</div>