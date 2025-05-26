<!-- Header -->
    <div class="flex justify-between items-center mt-10 mb-10 md:mb-0">
        <div>
            <h1 class="text-xl lg:text-2xl font-normal text-gray-800">Bem-vindo de volta, <?= $userSystem->name_user ?>!</h1>
            <p class="text-gray-500 text-xs lg:text-sm">Aqui está o que está acontecendo hoje</p>
        </div>
    </div>

    <div class="flex flex-col md:flex-row gap-4 p-4">
        <!-- Vagas Abertas -->
        <div class="flex-1 p-3">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl md:text-3xl font-light text-blue-800">58</h2>
                    <p class="text-blue-600 text-sm mt-1">Trabalhadores</p>
                </div>
                <div class="p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
        </div>
        
        <!-- Empresas -->
        <div class="flex-1 p-3">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl md:text-3xl font-light text-blue-800">24</h2>
                    <p class="text-blue-600 text-sm mt-1">Vagas</p>
                </div>
                <div class="p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
            </div>
        </div>
        
        <!-- Total -->
        <div class="flex-1 p-3">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl md:text-3xl font-light text-blue-800">642</h2>
                    <p class="text-blue-600 text-sm mt-1">Empresas</p>
                </div>
                <div class="p-2 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="flex-1 p-3">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl md:text-3xl font-light text-blue-800">1.332</h2>
                    <p class="text-blue-600 text-sm mt-1">Total de atendimentos</p>
                </div>
                <div class="p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
<!-- Search Bar -->
<div class="relative mb-4 lg:mb-6 max-w-[400px]">
    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
    <i class="fas fa-search text-gray-400"></i>
    </div>
    <input
    data-url="<?= url("/pesquisarcandidato"); ?>"
    name="name-search"
    id="search" 
    type="text" 
    class="block w-full pl-10 pr-12 py-2 border-gray-300 rounded-lg bg-white focus:outline-none border focus:ring-2 focus:ring-blue-500" 
    placeholder="Pesquisar por Nome ou CPF...">
    <button class="cursor-pointer absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
        </svg>
    </button>
</div>