<?php $this->layout("layout_page"); ?>

<div class="flex-1 flex flex-col lg:flex-row overflow-hidden pb-16 lg:pb-0">
    <main class="flex-1 p-4 lg:p-6 lg:w-2/3 overflow-y-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-4 lg:mb-6">
        <div>
            <h1 class="text-xl lg:text-2xl font-normal text-gray-800">Bem-vindo de volta, Fulano!</h1>
            <p class="text-gray-500 text-xs lg:text-sm">Aqui está o que está acontecendo hoje</p>
        </div>
        <div class="flex items-center gap-2 lg:gap-4">
        </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-4 lg:mb-6">
        <div class="bg-white p-4 rounded-lg border border-gray-300 shadow-xl hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl lg:text-2xl font-bold text-gray-800">307</h2>
                <p class="text-gray-500 text-xs">Candidatos</p>
            </div>
            <div class="bg-blue-100 text-blue-800 p-2 rounded-lg">
                <i class="fas fa-users"></i>
            </div>
            </div>
            <p class="text-green-600 text-xs mt-2 flex items-center gap-1">
            <i class="fas fa-arrow-up text-xs"></i> 30% Este mês
            </p>
        </div>
        <div class="bg-white p-4 rounded-lg border border-gray-300 shadow-xl hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl lg:text-2xl font-bold text-gray-800">58</h2>
                <p class="text-gray-500 text-xs">Vagas Abertas</p>
            </div>
            <div class="bg-green-100 text-green-800 p-2 rounded-lg">
                <i class="fas fa-briefcase"></i>
            </div>
            </div>
            <p class="text-red-600 text-xs mt-2 flex items-center gap-1">
            <i class="fas fa-arrow-down text-xs"></i> 15% Este mês
            </p>
        </div>
        <div class="bg-white p-4 rounded-lg border border-gray-300 shadow-xl hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl lg:text-2xl font-bold text-gray-800">24</h2>
                <p class="text-gray-500 text-xs">Empresas</p>
            </div>
            <div class="bg-indigo-100 text-indigo-800 p-2 rounded-lg">
                <i class="fas fa-building"></i>
            </div>
            </div>
            <p class="text-green-600 text-xs mt-2 flex items-center gap-1">
            <i class="fas fa-arrow-up text-xs"></i> 23% Este mês
            </p>
        </div>
        </div>

        <!-- Search Bar -->
        <div class="relative mb-4 lg:mb-6">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-search text-gray-400"></i>
        </div>
        <input type="text" class="block w-full pl-10 pr-3 py-2 border-2 border-gray-400 rounded-lg bg-white focus:outline-none focus:ring-1 focus:ring-sine-500 focus:border-sine-500" placeholder="Pesquisar candidatos...">
        </div>

        <!-- Desktop Table -->
        <div class="bg-white p-4 lg:p-6 rounded-lg border border-gray-300">
        <div class="flex justify-between items-center mb-3">
            <h3 class="text-base lg:text-lg font-semibold text-gray-800">Candidatos Recentes</h3>
            <button class="text-xs lg:text-sm text-sine-600 flex items-center gap-1 hover:text-sine-800">
            <span>Ver todos</span>
            <i class="fas fa-chevron-right text-xs"></i>
            </button>
        </div>
        
        <!-- Desktop Version -->
        <div class="hidden lg:block overflow-auto">
            <table class="w-full text-sm text-left">
            <thead class="text-gray-500 border-b border-gray-200">
                <tr>
                <th class="py-3 font-medium text-left">Nome</th>
                <th class="py-3 font-medium text-left">CPF</th>
                <th class="py-3 font-medium text-left">Status</th>
                <th class="py-3 font-medium text-right">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-300 hover:bg-gray-50">
                <td class="py-3 font-medium">João Silva</td>
                <td class="py-3">123.456.789-00</td>
                <td class="py-3">
                    <span class="px-2 py-1 rounded-full bg-green-100 text-green-800 text-xs">
                    Ativo
                    </span>
                </td>
                <td class="py-3 text-right">
                    <div class="flex gap-4 text-sm justify-end">
                    <a href="#" class="text-sine-600 hover:text-sine-800 hover:underline">Ver</a>
                    <a href="#" class="text-yellow-600 hover:text-yellow-800 hover:underline">Editar</a>
                    <a href="#" class="text-red-600 hover:text-red-800 hover:underline">Excluir</a>
                    </div>
                </td>
                </tr>
                <tr class="border-b border-gray-300 hover:bg-gray-50">
                <td class="py-3 font-medium">Maria Souza</td>
                <td class="py-3">987.654.321-00</td>
                <td class="py-3">
                    <span class="px-2 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs">
                    Pendente
                    </span>
                </td>
                <td class="py-3 text-right">
                    <div class="flex gap-4 text-sm justify-end">
                    <a href="#" class="text-sine-600 hover:text-sine-800 hover:underline">Ver</a>
                    <a href="#" class="text-yellow-600 hover:text-yellow-800 hover:underline">Editar</a>
                    <a href="#" class="text-red-600 hover:text-red-800 hover:underline">Excluir</a>
                    </div>
                </td>
                </tr>
                <tr class="hover:bg-gray-50">
                <td class="py-3 font-medium">Carlos Oliveira</td>
                <td class="py-3">456.789.123-00</td>
                <td class="py-3">
                    <span class="px-2 py-1 rounded-full bg-red-100 text-red-800 text-xs">
                    Inativo
                    </span>
                </td>
                <td class="py-3 text-right">
                    <div class="flex gap-4 text-sm justify-end">
                    <a href="#" class="text-sine-600 hover:text-sine-800 hover:underline">Ver</a>
                    <a href="#" class="text-yellow-600 hover:text-yellow-800 hover:underline">Editar</a>
                    <a href="#" class="text-red-600 hover:text-red-800 hover:underline">Excluir</a>
                    </div>
                </td>
                </tr>
            </tbody>
            </table>
        </div>

        <!-- Mobile Version -->
        <div class="lg:hidden space-y-3">
            <!-- Mobile Card 1 -->
            <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                <h4 class="font-medium text-gray-900">João Silva</h4>
                <p class="text-sm text-gray-500 mt-1">123.456.789-00</p>
                </div>
                <span class="px-2 py-1 rounded-full bg-green-100 text-green-800 text-xs">
                Ativo
                </span>
            </div>
            <div class="mt-3 pt-3 border-t border-gray-100 flex justify-between">
                <a href="#" class="text-sine-600 text-sm hover:text-sine-800 hover:underline">Ver</a>
                <a href="#" class="text-yellow-600 text-sm hover:text-yellow-800 hover:underline">Editar</a>
                <a href="#" class="text-red-600 text-sm hover:text-red-800 hover:underline">Excluir</a>
            </div>
            </div>

            <!-- Mobile Card 2 -->
            <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                <h4 class="font-medium text-gray-900">Maria Souza</h4>
                <p class="text-sm text-gray-500 mt-1">987.654.321-00</p>
                </div>
                <span class="px-2 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs">
                Pendente
                </span>
            </div>
            <div class="mt-3 pt-3 border-t border-gray-100 flex justify-between">
                <a href="#" class="text-sine-600 text-sm hover:text-sine-800 hover:underline">Ver</a>
                <a href="#" class="text-yellow-600 text-sm hover:text-yellow-800 hover:underline">Editar</a>
                <a href="#" class="text-red-600 text-sm hover:text-red-800 hover:underline">Excluir</a>
            </div>
            </div>

            <!-- Mobile Card 3 -->
            <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                <h4 class="font-medium text-gray-900">Carlos Oliveira</h4>
                <p class="text-sm text-gray-500 mt-1">456.789.123-00</p>
                </div>
                <span class="px-2 py-1 rounded-full bg-red-100 text-red-800 text-xs">
                Inativo
                </span>
            </div>
            <div class="mt-3 pt-3 border-t border-gray-100 flex justify-between">
                <a href="#" class="text-sine-600 text-sm hover:text-sine-800 hover:underline">Ver</a>
                <a href="#" class="text-yellow-600 text-sm hover:text-yellow-800 hover:underline">Editar</a>
                <a href="#" class="text-red-600 text-sm hover:text-red-800 hover:underline">Excluir</a>
            </div>
            </div>
        </div>
        </div>
    </main>


    <!-- Right Sidebar - Desktop Only -->
    <aside class="p-4 lg:p-6 border-l border-gray-300 lg:border-t-0 lg:border-l lg:w-1/3 overflow-y-auto hidden lg:block">
        <div class="bg-transparent p-4 lg:p-6 rounded-lg mb-4 lg:mb-6">
        <h3 class="text-normal lg:text-lg font-semibold mb-3 text-gray-800">Atividades Recentes</h3>
        <div class="space-y-3">
            <div class="flex gap-3">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center text-blue-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium">Novo candidato cadastrado</p>
                <p class="text-xs text-gray-500">2 minutos atrás</p>
            </div>
            </div>
            <div class="flex gap-3">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center text-green-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium">Nova vaga publicada</p>
                <p class="text-xs text-gray-500">15 minutos atrás</p>
            </div>
            </div>
            <div class="flex gap-3">
            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center text-purple-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium">Nova empresa cadastrada</p>
                <p class="text-xs text-gray-500">1 hora atrás</p>
            </div>
            </div>
            <div class="flex gap-3">
            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center text-yellow-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6.115 5.19l.319 1.913A6 6 0 008.11 10.36L9.75 12l-.387.775c-.217.433-.132.956.21 1.298l1.348 1.348c.21.21.329.497.329.795v1.089c0 .426.24.815.622 1.006l.153.076c.433.217.956.132 1.298-.21l.723-.723a8.7 8.7 0 002.288-4.042 1.087 1.087 0 00-.358-1.099l-1.33-1.108c-.251-.21-.582-.299-.905-.245l-1.17.195a1.125 1.125 0 01-.98-.314l-.295-.295a1.125 1.125 0 010-1.591l.13-.132a1.125 1.125 0 011.3-.21l.603.302a.809.809 0 001.086-1.086L14.25 7.5l1.256-.837a4.5 4.5 0 001.528-1.732l.146-.292M6.115 5.19A9 9 0 1017.18 4.64M6.115 5.19A8.965 8.965 0 0112 3c1.929 0 3.716.607 5.192 1.64" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium">Candidato vinculado à vaga</p>
                <p class="text-xs text-gray-500">3 horas atrás</p>
            </div>
            </div>
        </div>
        </div>

        <div class="bg-transparent p-4 lg:p-6 rounded-lg">
        <h3 class="text-base lg:text-lg font-semibold mb-3 text-gray-800">Ações Rápidas</h3>
        <div class="grid grid-cols-2 gap-3">
            <button class="p-3 rounded-lg border border-gray-200 hover:border-sine-300 hover:bg-sine-50 flex flex-col items-center gap-2 transition-all hover:shadow-sm">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center text-blue-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                </svg>
            </div>
            <span class="text-xs font-medium text-gray-700">Novo Candidato</span>
            </button>
            <button class="p-3 rounded-lg border border-gray-200 hover:border-sine-300 hover:bg-sine-50 flex flex-col items-center gap-2 transition-all hover:shadow-sm">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center text-green-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                </svg>
            </div>
            <span class="text-xs font-medium text-gray-700">Nova Vaga</span>
            </button>
            <button class="p-3 rounded-lg border border-gray-200 hover:border-sine-300 hover:bg-sine-50 flex flex-col items-center gap-2 transition-all hover:shadow-sm">
            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center text-purple-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                </svg>
            </div>
            <span class="text-xs font-medium text-gray-700">Nova Empresa</span>
            </button>
        </div>
        </div>
    </aside>
</div>
