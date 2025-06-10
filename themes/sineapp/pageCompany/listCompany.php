<?php
use Source\Models\Enterprise;
$entreprise = new Enterprise();
?>
<!-- Cabeçalho com título e botão -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 md:mt-10 mb-10">
        <h1 class="text-2xl text-gray-800">Lista de Empresas</h1>
        <div class="flex flex-col sm:flex-row gap-3">
            <!-- Filtros -->
            <div class="flex gap-2">
                <select 
                    name="search-enterprise"
                    data-url=""
                    data-ajax="listVacancy"
                    class="input-search bg-white border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="*">Todas</option>
                    
                        <option value="">teste</option>
                    
                </select>
                <select 
                    name="search-all-tatus"
                    data-url=""
                    data-ajax="listVacancy"
                    class="input-search bg-white border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="*">Todos Status</option>
                    <option>Ativa</option>
                    <option>Encerrada</option>
                </select>
                <button class="cursor-pointer flex bg-blue-800 px-3 py-2 text-white font-semibold rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Nova empresa
                </button>
            </div>
        </div>
    </div>
<div class="bg-transparent rounded-md overflow-hidden mt-10">
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 responsive-table">
            <thead class="bg-gradient-to-r from-blue-500 to-blue-800 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Vaga</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Empresa</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <!-- Linha 1 -->
                        <tr class="hover:bg-blue-50 bg-white">
                            <td data-label="Nome" class=" whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">pedreiro</div>
                                        
                                    </div>
                                </div>
                            </td>
                            <td data-label="Unidade" class="px-6 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-900">empresa</div>
                            </td>
                            <td data-label="Tipo de Acesso" class="px-6 py-2 whitespace-nowrap">
                                <span class="color-user text-sm text-blue-800 bg-blue-200 rounded-full px-2.5 py-0.5">ok</span>
                            </td>
                            
                            <td data-label="Ação" class="px-6 py-2 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end">
                                    <button 
                                        id="btn-edit" 
                                        class="text-blue-600 p-1 rounded-full cursor-pointer">
                                        Editar
                                    </button>
                                </div>
                            </td>
                        </tr>
            </tbody>
        </table>
    </div>

    <!-- Paginação -->
    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <div class="flex gap-2 text-gray-800">
                    paginator fica aqui
                </div>
            </div>
           <div>Total: </div>
        </div>
    </div>
</div>