<!-- Header -->
<div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-6 md:mb-0">
    <div class="flex items-center gap-3">
        <button
            id="btn-back"
            data-url="<?= url("/"); ?>"
            data-change="content"
            class="cursor-pointer p-1 px-2 rounded-full border border-gray-300 text-gray-700 hover:bg-[#095998] hover:text-white transition-all duration-200 flex items-center gap-1">
            < Voltar
        </button>
        <p class='text-blue-600 text-sm md:text-base flex items-center truncate'>
            <span class="hidden md:flex">Início</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-1 hidden md:flex" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="hidden md:flex">Trabalhador</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-1 hidden md:flex" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="hidden md:flex"><?= $worker->name_worker; ?></span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-1 hidden md:flex" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="font-medium truncate max-w-[200px] md:max-w-full">Encaminhamento para entrevista</span>
        </p>
    </div>
</div>

<div class="overflow-hidden">
<div class="container mx-auto py-8">
    <!-- Worker Info Section -->
    <div class="mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex-1">
                <h3 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
                    <?= $worker->name_worker; ?>
                </h3>
                <div class="mt-2">
                    <p class="text-md text-gray-600">CPF: <?= formatCPF($worker->cpf_worker); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Interview Section -->
    <div class="mb-6">
        <div class="flex items-center mb-6 gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-blue-700">
            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm4.28 10.28a.75.75 0 0 0 0-1.06l-3-3a.75.75 0 1 0-1.06 1.06l1.72 1.72H8.25a.75.75 0 0 0 0 1.5h5.69l-1.72 1.72a.75.75 0 1 0 1.06 1.06l3-3Z" clip-rule="evenodd" />
            </svg>
            <h1 class="text-xl font-normal text-gray-900">Encaminhamento para entrevista</h1>
        </div>
        

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Date -->
            <div class="col-span-2 md:col-span-1">
                <p class="text-sm font-medium text-gray-700 mb-1">Data:</p>
                <p class="text-lg bg-gray-100 text-gray-600 p-4">21/06/2025</p>
            </div>
            <!-- Observation -->
            <div class="col-span-2">
                <label for="observation" class="block text-sm font-medium text-gray-700 mb-2">Observação</label>
                <div id="observation" name="observation" class="bg-gray-100 w-full p-4 rounded-md  min-h-32 text-gray-600">
                    Observação bem observada
                </div>
            </div>
        </div>
    </div>

    <!-- Actions Section -->
    <div class="">
        <div class="flex flex-col sm:flex-row gap-4">
            <label for=""></label>
            <select class="flex-1 border border-gray-300 p-2 rounded-md cursor-pointer">
                <option value="">motivo um</option>
                <option value="">motivo dois</option>
                <option value="">motivo tres</option>
            </select>
            
            <div class="flex flex-col sm:flex-row gap-3">
                <button class="flex-1 cursor-pointer bg-green-600 hover:bg-green-700 text-white font-medium py-3 md:py-0 px-4 rounded-md transition duration-200">
                    <span>Salvar</span>
                </button>
                <button class="flex-1 cursor-pointer border border-red-400 hover:bg-red-500 hover:text-white text-red-500 py-3 md:py-0 font-medium px-4 rounded-md transition duration-200">
                    <span>Excluir</span>
                </button>
            </div>
        </div>
    </div>
</div>
</div>
