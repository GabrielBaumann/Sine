<!-- Header -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 px-4 md:px-0">
    <div class="mb-4 md:mb-0">
        <h1 class="text-2xl lg:text-2xl font-medium text-gray-800">Bem-vindo de volta, <?= $userSystem->name_user ?>!</h1>
        <p class="text-gray-500 text-sm lg:text-base mt-1">Aqui está o resumo das atividades recentes</p>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 px-4 md:px-0">
    <!-- Atendimentos -->
    <div class="bg-blue-500 rounded-2xl p-4 overflow-hidden relative">
        <div class="flex justify-between items-start">
            <div>
                <h3 class="text-4xl font-medium text-white"><?= format_number($serviceCount ?? 000) ?></h3>
                <p class="text-sm text-gray-100 mb-1">Atendimentos</p>
            </div>
            <div class="p-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-white">
                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Vagas -->
    <div class="bg-blue-600 rounded-2xl p-4 overflow-hidden relative">
        <div class="flex justify-between items-start">
            <div>
                <h3 class="text-4xl font-medium text-white"><?= format_number($vavancysCount ?? 000) ?></h3>
                <p class="text-sm text-gray-100 mb-1">Vagas Abertas</p>
            </div>
            <div class="p-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-white">
                <path fill-rule="evenodd" d="M7.5 5.25a3 3 0 0 1 3-3h3a3 3 0 0 1 3 3v.205c.933.085 1.857.197 2.774.334 1.454.218 2.476 1.483 2.476 2.917v3.033c0 1.211-.734 2.352-1.936 2.752A24.726 24.726 0 0 1 12 15.75c-2.73 0-5.357-.442-7.814-1.259-1.202-.4-1.936-1.541-1.936-2.752V8.706c0-1.434 1.022-2.7 2.476-2.917A48.814 48.814 0 0 1 7.5 5.455V5.25Zm7.5 0v.09a49.488 49.488 0 0 0-6 0v-.09a1.5 1.5 0 0 1 1.5-1.5h3a1.5 1.5 0 0 1 1.5 1.5Zm-3 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                <path d="M3 18.4v-2.796a4.3 4.3 0 0 0 .713.31A26.226 26.226 0 0 0 12 17.25c2.892 0 5.68-.468 8.287-1.335.252-.084.49-.189.713-.311V18.4c0 1.452-1.047 2.728-2.523 2.923-2.12.282-4.282.427-6.477.427a49.19 49.19 0 0 1-6.477-.427C4.047 21.128 3 19.852 3 18.4Z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Trabalhadores -->
    <div class="bg-blue-700 rounded-2xl p-4 overflow-hidden relative">
        <div class="flex justify-between items-start">
            <div>
                <h3 class="text-4xl font-medium text-white"><?= format_number($workerCount ?? 000) ?></h3>
                <p class="text-sm text-gray-100 mb-1">Trabalhadores</p>
            </div>
            <div class="p-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-white">
                <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
                <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Empresas -->
    <div class="bg-blue-800 rounded-2xl p-4 overflow-hidden relative">
        <div class="flex justify-between items-start">
            <div>
                <h3 class="text-4xl font-medium text-white"><?= format_number($enterprisesCount ?? 000) ?></h3>
                <p class="text-sm text-gray-100 mb-1">Empresas</p>
            </div>
            <div class="p-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-white">
                <path fill-rule="evenodd" d="M4.5 2.25a.75.75 0 0 0 0 1.5v16.5h-.75a.75.75 0 0 0 0 1.5h16.5a.75.75 0 0 0 0-1.5h-.75V3.75a.75.75 0 0 0 0-1.5h-15ZM9 6a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5H9Zm-.75 3.75A.75.75 0 0 1 9 9h1.5a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM9 12a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5H9Zm3.75-5.25A.75.75 0 0 1 13.5 6H15a.75.75 0 0 1 0 1.5h-1.5a.75.75 0 0 1-.75-.75ZM13.5 9a.75.75 0 0 0 0 1.5H15A.75.75 0 0 0 15 9h-1.5Zm-.75 3.75a.75.75 0 0 1 .75-.75H15a.75.75 0 0 1 0 1.5h-1.5a.75.75 0 0 1-.75-.75ZM9 19.5v-2.25a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-.75.75h-4.5A.75.75 0 0 1 9 19.5Z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Seção de Gráficos -->
<div class="mt-6">
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Coluna esquerda - Gráficos -->
        <div class="w-full lg:w-2/3 flex flex-col">
            <!-- Gráfico de linha -->
            <div class="">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-normal text-gray-700">Atendimentos por mês</h2>
                </div>
                <div class="h-100">
                    <canvas id="graficoVisaoGeral"></canvas>
                </div>
            </div> 
        </div>

        <!-- Coluna direita - Tabela -->
        <div class="w-full lg:w-1/3">
            <div class="rounded-lg flex flex-col">
                <div class="mb-3">
                    <div class="flex justify-between items-center">
                        <h2 class="text-lg font-normal text-gray-700">Painel de vagas</h2>
                        <div class="flex space-x-2">

                            <!-- botao de imrpimir -->
                            <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a51.299 51.299 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                                </svg>
                            </button>

                            <!-- botao de visualizar em pdf -->
                            <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                            </button>

                        </div>
                    </div>
                </div>
                
                <div class="overflow-x-auto flex-grow rounded-md overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
                        <thead class="bg-blue-500">
                            <tr>
                                <th scope="col" class="px-5 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Vaga</th>
                                <th scope="col" class="py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Qt</th>
                            </tr>
                        </thead>
                            <tbody class="divide-y divide-gray-200">
                                <?php if($panelVacancy): ?>
                                    <?php foreach($panelVacancy as $panelVacancyItem): ?>    
                                        <!-- This is a line -->
                                        <tr>
                                            <td class="px-5 py-3 whitespace-nowrap text-sm font-medium text-gray-900"><?= $panelVacancyItem->nomeclatura_vacancy; ?></td>
                                            <td class="py-3 whitespace-nowrap text-sm text-black"><?= $panelVacancyItem->total_vacancy_active; ?></td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php else: ?>
                                    <!-- If there are no vacancies -->
                                    <tr>
                                        <td class="px-5 py-3 whitespace-nowrap text-sm font-medium text-gray-900">Não há vagas cadastradas</td>
                                    </tr>
                                <?php endif;?>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Código dos gráficos e tabelas -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gráfico de Atendimentos por mês
        const vMonthService = <?= json_encode($chartServiceLabel); ?>;
        const vMonthServiceTotal = <?= json_encode($chartServiceTotal); ?>;
        const ctx1 = document.getElementById('graficoVisaoGeral').getContext('2d');
        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: vMonthService,
                datasets: [{
                    label: 'Atendimentos',
                    data: vMonthServiceTotal,
                    backgroundColor: 'rgba(9, 89, 152, 0.1)', 
                    borderColor: '#095998', 
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: 'rgb(30, 66, 124)',
                    pointBorderColor: '#fff',
                    pointHoverRadius: 6,
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(30, 66, 124, 0.9)',
                        titleFont: { weight: 'bold', size: 12 },
                        bodyFont: { size: 11 },
                        padding: 10,
                        cornerRadius: 6,
                        displayColors: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    }
                }
            }
        });
    });
</script>