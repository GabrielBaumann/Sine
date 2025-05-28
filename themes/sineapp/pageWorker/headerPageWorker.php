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