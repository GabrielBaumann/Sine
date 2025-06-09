<!-- Header -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 px-4 md:px-6">
    <div class="mb-4 md:mb-0">
        <h1 class="text-2xl lg:text-xl text-gray-800">Bem-vindo de volta, <?= $userSystem->name_user ?>!</h1>
        <p class="text-gray-500 text-sm lg:text-base mt-1">Aqui está o resumo das atividades recentes</p>
    </div>
    <div class="text-xs text-gray-900 border border-gray-400 px-3 py-2 rounded-full">
        <?= date('d M Y, H:i') ?>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 px-4 md:px-6">
    <!-- Trabalhadores -->
    <div class="bg-blue-500 rounded-xl p-6">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-white mb-1">Trabalhadores</p>
                <h3 class="text-3xl font-bold text-white"><?= format_number($workerCount ?? 000) ?></h3>
            </div>
            <div class="p-3 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Vagas -->
    <div class="bg-blue-600 rounded-xl p-6">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-white mb-1">Vagas Abertas</p>
                <h3 class="text-3xl font-bold text-gray-800 dark:text-white"><?= format_number($cavancysCount ?? 000) ?></h3>
            </div>
            <div class="p-3 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
        </div>
       
    </div>

    <!-- Empresas -->
    <div class="bg-blue-700 rounded-xl p-6">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-white mb-1">Empresas</p>
                <h3 class="text-3xl font-bold text-gray-800 dark:text-white"><?= format_number($enterprisesCount ?? 000) ?></h3>
            </div>
            <div class="p-3 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
        </div>
        
    </div>

    <!-- Atendimentos -->
    <div class="bg-blue-800 rounded-xl p-6">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-white mb-1">Total Atendimentos</p>
                <h3 class="text-3xl text-white"><?= format_number($serviceCount ?? 000) ?></h3>
            </div>
            <div class="p-3 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>
        </div>
        
    </div>
</div>

<!-- Geral -->
<div class="mt-8">
    <div class="p-6 bg-transparent">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg text-gray-800">Visão Geral</h2>
            <div class="flex space-x-2">
                <button class="px-3 py-1 text-xs bg-blue-100 dark:bg-blue-900 text-white rounded-full">Semanal</button>
                <button class="px-3 py-1 text-xs bg-gray-100 dark:bg-gray-700 text-white rounded-full">Mensal</button>
                <button class="px-3 py-1 text-xs bg-gray-100 dark:bg-gray-700 text-white rounded-full">Anal</button>
            </div>
        </div>
        <!-- Espaço reservado para gráfico -->
        <div class="h-64 bg-gray-300 rounded-lg flex items-center justify-center">
            <p class="text-gray-500 dark:text-gray-400">futuro gráfico</p>
        </div>
    </div>
</div>