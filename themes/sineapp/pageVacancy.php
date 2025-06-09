<?php $this->layout("layout_page"); ?>

<!-- Conteúdo principal -->
<main class="flex-1 overflow-y-auto p-6 pb-20 lg:pb-6">
    <!-- Cabeçalho com título e botão -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mt-10">
        <h1 class="text-2xl font-bold text-gray-800">Lista de Vagas</h1>
        <div class="flex flex-col sm:flex-row gap-3">
            <!-- Filtros -->
            <div class="flex gap-2">
                <select 
                    name="search-enterprise"
                    data-url="<?= url("/pesquisarvagas") ?>"
                    data-ajax="listVacancy"
                    class="input-search bg-white border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="*">Todas</option>
                    <?php foreach($listEnterprise as $entreprise): ?>
                        <option value="<?= $entreprise->id_enterprise ?>" ><?= $entreprise->name_enterprise ?></option>
                    <?php endforeach; ?>
                </select>
                <select 
                    name="search-all-tatus"
                    data-url="<?= url("/pesquisarvagas") ?>"
                    data-ajax="listVacancy"
                    class="input-search bg-white border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="*">Todos Status</option>
                    <option>Ativa</option>
                    <option>Encerrada</option>
                </select>
                <button class="cursor-pointer flex bg-blue-700 px-3 py-2 text-white font-semibold rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Nova vaga
                </button>
            </div>
        </div>
    </div>

    <!-- Tabela Responsiva -->
    <div id="listVacancy">
        <?php $this->insert("/pageVacancy/listVacancy"); ?>
    </div>
    
</main>

<?php $this->start("scripts"); ?>
  <script src="<?= theme("/assets/js/vacancy/page.js", CONF_VIEW_APP) ?>"></script>
<?php $this->stop("scripts"); ?>