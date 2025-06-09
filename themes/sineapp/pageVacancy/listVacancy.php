<?php
use Source\Models\Enterprise;
$entreprise = new Enterprise();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <style>
        @media (max-width: 640px) {
            .responsive-table thead {
                display: none;
            }
            .responsive-table tr {
                display: block;
                margin-bottom: 1rem;
                border-radius: 0.5rem;
                box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
            }
            .responsive-table td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.75rem;
                text-align: right;
                border-bottom: 1px solid #f3f4f6;
            }
            .responsive-table td:before {
                content: attr(data-label);
                font-weight: 600;
                color: #374151;
                margin-right: 1rem;
                text-align: left;
            }
            .responsive-table td:last-child {
                border-bottom: none;
            }
            .status-badge {
                margin-left: auto;
            }
        }
    </style>
</head>
<body>
    <div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 responsive-table">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vaga</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Empresa</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- Linha 1 -->
                <?php if (!empty($totalVacancy)): ?>
                    <?php foreach($totalVacancy as $vacancy): ?>
                        <tr class="cursor-pointer hover:bg-blue-200">
                            <td data-label="Nome" class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900"><?= $vacancy->nomeclatura_vacancy; ?></div>
                                    </div>
                                </div>
                            </td>
                            <td data-label="Unidade" class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900"><?= $entreprise->findById($vacancy->id_enterprise)->name_enterprise; ?></div>
                            </td>
                            <td data-label="Tipo de Acesso" class="px-6 py-4 whitespace-nowrap">
                                <span class="color-user text-sm text-blue-800 bg-blue-200 rounded-full px-2.5 py-0.5"><?= $vacancy->status_vacancy; ?></span>
                            </td>
                            
                            <td data-label="Ação" class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end">
                                    <button 
                                        id="btn-edit" 
                                        class="text-blue-600 hover:text-blue-900 p-1 rounded-full hover:bg-blue-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">Não há vagas cadastradas!</div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Paginação -->
    <div class="px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <div class="flex gap-2">
                    <?= $paginator; ?>
                </div>
            </div>
           <div>Total: <?= format_number($countVacancy); ?></div>
        </div>
    </div>
</div>
</body>
</html>
