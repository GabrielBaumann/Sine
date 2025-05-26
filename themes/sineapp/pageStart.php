<?php $this->layout("layout_page"); ?>

<div class="flex-1 flex flex-col lg:flex-row overflow-hidden pb-16 lg:pb-0">
  <main class="flex-1 p-4 lg:p-6 overflow-y-auto">
      <!-- Header -->
      <div class="flex justify-between items-center mt-10 mb-10 md:mb-0">
        <div>
          <h1 class="text-xl lg:text-2xl font-normal text-gray-800">Bem-vindo de volta, <?= $userSystem->name_user ?>!</h1>
          <p class="text-gray-500 text-xs lg:text-sm">Aqui está o que está acontecendo hoje</p>
        </div>
      </div>

    <div class="grid sm:grid-cols-3 gap-4 md:gap-6 mb-6 lg:mb-8">
      <!-- Card Candidatos -->
      <div class="p-3 relative">
          <div class="relative z-10 flex items-center justify-between">
              <div>
                  <h2 class="text-3xl md:text-3xl font-light text-blue-800"><?= format_number($workerCount ?? 000); ?></h2>
                  <p class="text-blue-600 text-sm mt-1">Trabalhadres</p>
              </div>
          </div>
      </div>

      <!-- Card Vagas Abertas -->
      <div class="p-3 relative">
          <div class="relative z-10 flex items-center justify-between">
              <div>
                  <h2 class="text-3xl md:text-3xl font-light text-blue-800"><?= format_number($cavancysCount ?? 000); ?></h2>
                  <p class="text-blue-600 text-sm mt-1">Vagas Abertas</p>
              </div>
          </div>
      </div>
      <!-- Card Empresas -->
      <div class="p-3 relative">
        <div class="relative z-10 flex items-center justify-between">
          <div>
            <h2 class="text-3xl md:text-3xl font-light text-blue-800"><?= format_number($enterprisesCount ?? 000); ?></h2>
            <p class="text-blue-600 text-sm mt-1">Empresas</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Search Bar -->
    <div class="relative mb-4 lg:mb-6">
      <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        <i class="fas fa-search text-gray-400"></i>
      </div>
      <input
        data-url="<?= url("/pesquisarcandidato"); ?>"
        name="name-search"
        id="search" 
        type="text" 
        class="block w-full pl-10 pr-12 py-2 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-1 focus:ring-sine-500 focus:border-sine-500" 
        placeholder="Pesquisar candidatos...">
      <button class="cursor-pointer absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
          </svg>
      </button>
    </div>

    <!-- List  -->
    <div id="listMorkes">
      <?= $this->insert("/pageStart/listWorkes", ["workers" => $worker]); ?>
    </div>

  </main>
</div>
<?php $this->start("scripts"); ?>
  <script src="<?= theme("/assets/js/start/page.js", CONF_VIEW_APP) ?>"></script>
<?php $this->stop("scrpts"); ?>