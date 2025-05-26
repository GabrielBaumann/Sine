<?php $this->layout("layout_page"); ?>

<div class="flex-1 flex flex-col lg:flex-row overflow-hidden pb-16 lg:pb-0">
    <main class="flex-1 p-4 lg:p-6 overflow-y-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mt-10 mb-10 md:mb-0">
        <div>
            <h1 class="text-xl lg:text-2xl font-normal text-gray-800">Bem-vindo de volta, Fulano!</h1>
            <p class="text-gray-500 text-xs lg:text-sm">Aqui está o que está acontecendo hoje</p>
        </div>
        <div class="flex items-center gap-2 lg:gap-4">
        </div>
        </div>

        <div class="grid sm:grid-cols-3 gap-4 md:gap-6 mb-6 lg:mb-8">

    <!-- Card Candidatos -->
    <div class="p-3 relative">
        <div class="relative z-10 flex items-center justify-between">
            <div>
                <h2 class="text-3xl md:text-3xl font-light text-blue-800">307</h2>
                <p class="text-blue-600 text-sm mt-1">Candidatos</p>
            </div>
        </div>
    </div>
    <!-- Card Vagas Abertas -->
    <div class="p-3 relative">
        <div class="relative z-10 flex items-center justify-between">
            <div>
                <h2 class="text-3xl md:text-3xl font-light text-blue-800">58</h2>
                <p class="text-blue-600 text-sm mt-1">Vagas Abertas</p>
            </div>
        </div>
    </div>
    <!-- Card Empresas -->
    <div class="p-3 relative">
        <div class="relative z-10 flex items-center justify-between">
            <div>
                <h2 class="text-3xl md:text-3xl font-light text-blue-800">24</h2>
                <p class="text-blue-600 text-sm mt-1">Empresas</p>
            </div>
        </div>
    </div>
</div>

        <div class="bg-transparent p-4 lg:p-6">
  <div class="flex justify-between items-center mb-3">
    <h3 class="text-base lg:text-lg font-normal text-gray-800">Candidatos Recentes</h3>
  </div>
  
  <!-- Container da tabela com scroll condicional -->
  <div class="overflow-auto max-h-[70vh] lg:max-h-[65vh]">
    <table class="w-full text-sm text-left">
      <thead class="text-gray-500 border-b border-gray-200">
        <tr>
          <th class="py-3 font-medium text-left">Nome</th>
          <th class="py-3 font-medium text-left hidden md:flex">CPF</th>
          <th class="py-3 font-medium text-left">Status</th>
        </tr>
      </thead>
      <tbody>
        <!-- Linha da tabela - versão responsiva -->
        <tr class="border-b border-gray-200 hover:bg-gray-300 transition-colors duration-200 cursor-pointer group">
          <!-- Nome (sempre visível) -->
          <td class="py-4 font-medium">
            <div class="lg:hidden font-semibold mb-1">João Silva</div>
            <div class="hidden lg:block">João Silva</div>
            <div class="text-xs text-gray-500 lg:hidden">123.456.789-00</div>
          </td>
          <td class="py-4 hidden md:flex">123.456.789-00</td>
          
          <!-- Status -->
          <td class="py-4">
            <span class="px-2.5 py-1 rounded-lg bg-green-100 text-green-800 text-xs whitespace-nowrap">
              Ativo
            </span>
          </td>
          
        </tr>
      </tbody>
    </table>
  </div>
</div>
    </main>
</div>
