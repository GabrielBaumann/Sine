<div class="bg-transparent p-4 lg:p-6">
    <div class="flex justify-between items-center mb-3">
        <h3 class="text-base lg:text-lg font-normal text-gray-800">Candidatos Recentes</h3>
    </div>

    <!-- Container da tabela com scroll condicional -->
    <div class="overflow-auto max-h-[70vh] lg:max-h-[65vh]">
    <?php if(!empty($workers)): ?>    
        <table class="w-full text-sm text-left">
<<<<<<< HEAD
            <thead class="text-gray-500 border-b border-gray-200">
                <tr>
                <th class="py-3 font-medium text-left">Nome</th>
                <th class="py-3 font-medium text-left hidden md:flex">CPF</th>
                <th class="py-3 font-medium text-left">Status</th>
=======
        <thead class="text-gray-500 border-b border-gray-200">
            <tr>
            <th class="py-3 font-medium text-left">Nome</th>
            <th class="py-3 font-medium text-left hidden md:flex">CPF</th>
            <th class="py-3 font-medium text-left">Status</th>
            </tr>
        </thead>
        <tbody>
            <!-- Linha da tabela - Coloquei um Array Slice pra mostrar somente 6 linhas por causa do erro da barra de rolagem -->
            <?php foreach(array_slice($workers, 0, 6) as $work): ?> 
                <tr class="border-b border-gray-200 cursor-pointer">
                    <!-- Nome (sempre visível) -->
                    <td class="py-4 font-medium">
                        <div class="lg:hidden font-semibold mb-1"><?= $work->name_worker; ?></div>
                        <div class="hidden lg:block"><?= $work->name_worker; ?></div>
                        <div class="text-xs text-gray-500 lg:hidden"><?= $work->name_worker; ?></div>
                    </td>
                    <td class="py-4 hidden md:flex"><?= $work->name_worker; ?></td>
                    
                    <!-- Status -->
                    <td class="py-4">
                        <span class="px-2.5 py-1 rounded-lg bg-green-100 text-green-800 text-xs whitespace-nowrap">
                        Ativo
                        </span>
                    </td>
>>>>>>> 2d51766d6e32a53ed2ba0e1ce480eedac77b538c
                </tr>
            </thead>
        
            <tbody>
                <!-- Linha da tabela - versão responsiva -->
                
                    <?php foreach($workers as $work): ?> 
                        <tr class="border-b border-gray-200 hover:bg-gray-300 transition-colors duration-200 cursor-pointer group">
                            <!-- Nome (sempre visível) -->
                            <td class="py-4 font-medium">
                                <div class="lg:hidden font-semibold mb-1"><?= $work->name_worker; ?></div>
                                <div class="hidden lg:block"><?= $work->name_worker; ?></div>
                                <div class="text-xs text-gray-500 lg:hidden"><?= formatCPF($work->cpf_worker); ?></div>
                            </td>
                            <td class="py-4 hidden md:flex"><?= formatCPF($work->cpf_worker); ?></td>
                            
                            <!-- Status -->
                            <td class="py-4">
                                <span class="px-2.5 py-1 rounded-lg bg-green-100 text-green-800 text-xs whitespace-nowrap">
                                Ativo
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<<<<<<< HEAD
</div>
<?php else: ?>
    <div>Não existe dados para esse filtro!!!</div>
<?php endif;?>
=======
    <div class="flex justify-between items-center mt-4 px-2">
        <div class="text-sm text-gray-500">
            Mostrando 1 a 6 de <?= count($workers) ?> registros
        </div>
        <div class="flex space-x-1">
            <button class="px-3 py-1 border border-gray-500 rounded text-gray-700 bg-white hover:bg-gray-50">
                Anterior
            </button>
            <button class="px-3 py-1 border border-gray-500 rounded bg-blue-500 text-white">
                1
            </button>
            <button class="px-3 py-1 border border-gray-500 rounded text-gray-700 bg-white hover:bg-gray-50">
                2
            </button>
            <button class="px-3 py-1 border border-gray-500 rounded text-gray-700 bg-white hover:bg-gray-50">
                Próximo
            </button>
        </div>
    </div>
</div>
>>>>>>> 2d51766d6e32a53ed2ba0e1ce480eedac77b538c
