<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 pt-2">
    <div class="flex-flex-col">
        <!-- Cabeçalho -->
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-6 md:mb-0 pb-7">
            <div class="flex items-center gap-3">
                <button
                    id="btn-back"
                    data-url=""
                    data-change="content"
                    class="cursor-pointer p-1 px-2 rounded-full border border-gray-300 text-gray-700 hover:bg-[#095998] hover:text-white transition-all duration-200 flex items-center gap-1">
                    < Voltar
                </button>
                <p class='text-blue-600 text-sm md:text-base flex items-center truncate'>
                    <span>Vagas</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-3 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="font-medium truncate max-w-[200px] md:max-w-full">Auxiliar de Agiota</span>
                </p>
            </div>
        </div>
        <!-- Título -->
        <h1 class="hidden md:flex text-2xl font-semibold text-gray-900">Auxiliar de Agiota</h1>
        <h2 class="hidden md:flex text-md font-normal text-gray-600">Empresa Al Cappone Association</h2>
    </div>
    
    <!-- Controles -->
    <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto md:mt-12">
        <!-- Filtros -->
        <div class="flex flex-col sm:flex-row gap-2">
            <select 
                name="search-all-tatus"
                class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                <option value="*">Todos status</option>
                <option>Ativa</option>
                <option>Encerrada</option>
            </select>
            
            <!-- Botão editar -->
            <button 
                data-url=""
                id="btn-new-vacancy" 
                class="cursor-pointer flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 px-4 py-2 text-black font-medium rounded-lg transition-colors duration-200 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
                Editar
            </button>
        </div>
    </div>
</div>
<div id="listVacancy">
<div class="bg-transparent rounded-md overflow-hidden mt-5">
    <div class="overflow-x-auto">
        <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 responsive-table">
            <thead class="">
            <tr>
                <th scope="col" class="w-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    <input type="checkbox" class="h-4 w-4 ml-3 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vaga</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            <!-- Linha 1 -->
            <tr class="hover:bg-blue-100">
                <td class="whitespace-nowrap">
                <input type="checkbox" class="h-4 w-4 ml-3 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                </td>
                <td data-label="Nome" class="px-6 py-3 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="">
                    <div class="text-sm font-medium text-gray-900">Auxiliar de agiota</div>
                    </div>
                </div>
                </td>
                <td data-label="Vaga" class="px-6 py-3 whitespace-nowrap">
                <div class="text-sm text-gray-900">1 / 10</div>
                </td>
                <td data-label="Status" class="px-6 py-3 whitespace-nowrap">
                <span class="text-sm text-gray-700">disponível</span>
                </td>
            </tr>
            <!-- Linha 1 -->
            <tr class="hover:bg-blue-100">
                <td class="whitespace-nowrap">
                <input type="checkbox" class="h-4 w-4 ml-3 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                </td>
                <td data-label="Nome" class="px-6 py-3 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="">
                    <div class="text-sm font-medium text-gray-900">Auxiliar de agiota</div>
                    </div>
                </div>
                </td>
                <td data-label="Vaga" class="px-6 py-3 whitespace-nowrap">
                <div class="text-sm text-gray-900">2 / 10</div>
                </td>
                <td data-label="Status" class="px-6 py-3 whitespace-nowrap">
                <span class="text-sm text-gray-700">disponível</span>
                </td>
            </tr>
            <!-- Linha 1 -->
            <tr class="hover:bg-blue-100">
                <td class="whitespace-nowrap">
                <input type="checkbox" class="h-4 w-4 ml-3 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                </td>
                <td data-label="Nome" class="px-6 py-3 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="">
                    <div class="text-sm font-medium text-gray-900">Auxiliar de agiota</div>
                    </div>
                </div>
                </td>
                <td data-label="Vaga" class="px-6 py-3 whitespace-nowrap">
                <div class="text-sm text-gray-900">3 / 10</div>
                </td>
                <td data-label="Status" class="px-6 py-3 whitespace-nowrap">
                <span class="text-sm text-gray-700">disponível</span>
                </td>
            </tr>
            <!-- Linha 1 -->
            <tr class="hover:bg-blue-100">
                <td class="whitespace-nowrap">
                <input type="checkbox" class="h-4 w-4 ml-3 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                </td>
                <td data-label="Nome" class="px-6 py-3 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="">
                    <div class="text-sm font-medium text-gray-900">Auxiliar de agiota</div>
                    </div>
                </div>
                </td>
                <td data-label="Vaga" class="px-6 py-3 whitespace-nowrap">
                <div class="text-sm text-gray-900">4 / 10</div>
                </td>
                <td data-label="Status" class="px-6 py-3 whitespace-nowrap">
                <span class="text-sm text-gray-700">disponível</span>
                </td>
            </tr>
            <!-- Linha 1 -->
            <tr class="hover:bg-blue-100">
                <td class="whitespace-nowrap">
                <input type="checkbox" class="h-4 w-4 ml-3 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                </td>
                <td data-label="Nome" class="px-6 py-3 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="">
                    <div class="text-sm font-medium text-gray-900">Auxiliar de agiota</div>
                    </div>
                </div>
                </td>
                <td data-label="Vaga" class="px-6 py-3 whitespace-nowrap">
                <div class="text-sm text-gray-900">5 / 10</div>
                </td>
                <td data-label="Status" class="px-6 py-3 whitespace-nowrap">
                <span class="text-sm text-gray-700">disponível</span>
                </td>
            </tr>
            <!-- Linha 1 -->
            <tr class="hover:bg-blue-100">
                <td class="whitespace-nowrap">
                <input type="checkbox" class="h-4 w-4 ml-3 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                </td>
                <td data-label="Nome" class="px-6 py-3 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="">
                    <div class="text-sm font-medium text-gray-900">Auxiliar de agiota</div>
                    </div>
                </div>
                </td>
                <td data-label="Vaga" class="px-6 py-3 whitespace-nowrap">
                <div class="text-sm text-gray-900">6 / 10</div>
                </td>
                <td data-label="Status" class="px-6 py-3 whitespace-nowrap">
                <span class="text-sm text-gray-700">disponível</span>
                </td>
            </tr>
            <!-- Linha 1 -->
            <tr class="hover:bg-blue-100">
                <td class="whitespace-nowrap">
                <input type="checkbox" class="h-4 w-4 ml-3 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                </td>
                <td data-label="Nome" class="px-6 py-3 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="">
                    <div class="text-sm font-medium text-gray-900">Auxiliar de agiota</div>
                    </div>
                </div>
                </td>
                <td data-label="Vaga" class="px-6 py-3 whitespace-nowrap">
                <div class="text-sm text-gray-900">7 / 10</div>
                </td>
                <td data-label="Status" class="px-6 py-3 whitespace-nowrap">
                <span class="text-sm text-gray-700">disponível</span>
                </td>
            </tr>
            
            </tbody>
        </table>
    </div>
</div>

    <!-- falta a paginação aqui -->
</div>
</div>
</div>