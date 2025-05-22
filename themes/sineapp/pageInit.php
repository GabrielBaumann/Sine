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
        <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-1 focus:ring-sine-500 focus:border-sine-500 shadow-sm" placeholder="Pesquisar candidatos...">
        </div>

        <!-- Desktop Table -->
        <div class="bg-white p-4 lg:p-6 rounded-lg border border-gray-300 shadow-sm">
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
                <tr class="border-b border-gray-200 hover:bg-gray-50">
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
                <tr class="border-b border-gray-200 hover:bg-gray-50">
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
    <aside class="shadow-xl p-4 lg:p-6 border-l border-gray-300 lg:border-t-0 lg:border-l lg:w-1/3 overflow-y-auto hidden lg:block">
        <div class="bg-white p-4 lg:p-6 rounded-lg border border-gray-300 shadow-xl mb-4 lg:mb-6">
        <h3 class="text-normal lg:text-lg font-semibold mb-3 text-gray-800">Atividades Recentes</h3>
        <div class="space-y-3">
            <div class="flex gap-3">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center text-blue-800">
                <i class="fas fa-user-plus"></i>
            </div>
            <div>
                <p class="text-sm font-medium">Novo candidato cadastrado</p>
                <p class="text-xs text-gray-500">2 minutos atrás</p>
            </div>
            </div>
            <div class="flex gap-3">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center text-green-800">
                <i class="fas fa-briefcase"></i>
            </div>
            <div>
                <p class="text-sm font-medium">Nova vaga publicada</p>
                <p class="text-xs text-gray-500">15 minutos atrás</p>
            </div>
            </div>
            <div class="flex gap-3">
            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center text-purple-800">
                <i class="fas fa-building"></i>
            </div>
            <div>
                <p class="text-sm font-medium">Nova empresa cadastrada</p>
                <p class="text-xs text-gray-500">1 hora atrás</p>
            </div>
            </div>
            <div class="flex gap-3">
            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center text-yellow-800">
                <i class="fas fa-handshake"></i>
            </div>
            <div>
                <p class="text-sm font-medium">Candidato vinculado à vaga</p>
                <p class="text-xs text-gray-500">3 horas atrás</p>
            </div>
            </div>
        </div>
        </div>

        <div class="bg-white p-4 lg:p-6 rounded-lg border border-gray-300 shadow-xl">
        <h3 class="text-base lg:text-lg font-semibold mb-3 text-gray-800">Ações Rápidas</h3>
        <div class="grid grid-cols-2 gap-3">
            <button class="p-3 rounded-lg border border-gray-200 hover:border-sine-300 hover:bg-sine-50 flex flex-col items-center gap-2 transition-all hover:shadow-sm">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center text-blue-800">
                <i class="fas fa-user-plus"></i>
            </div>
            <span class="text-xs font-medium text-gray-700">Novo Candidato</span>
            </button>
            <button class="p-3 rounded-lg border border-gray-200 hover:border-sine-300 hover:bg-sine-50 flex flex-col items-center gap-2 transition-all hover:shadow-sm">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center text-green-800">
                <i class="fas fa-briefcase"></i>
            </div>
            <span class="text-xs font-medium text-gray-700">Nova Vaga</span>
            </button>
            <button class="p-3 rounded-lg border border-gray-200 hover:border-sine-300 hover:bg-sine-50 flex flex-col items-center gap-2 transition-all hover:shadow-sm">
            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center text-purple-800">
                <i class="fas fa-building"></i>
            </div>
            <span class="text-xs font-medium text-gray-700">Nova Empresa</span>
            </button>
        </div>
        </div>
    </aside>
</div>
