<div class="bg-transparent p-4 lg:p-6">
    <div class="flex justify-between items-center mb-3">
        <h3 class="text-base lg:text-lg font-normal text-gray-800">Candidatos Recentes</h3>
    </div>

    <!-- Container da tabela com scroll condicional -->
    <div class="overflow-auto max-h-[70vh] lg:max-h-[65vh]">
    <?php if(!empty($workers)): ?>    
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
</div>
<?php else: ?>
    <div>Não existe dados para esse filtro!!!</div>
<?php endif;?>
