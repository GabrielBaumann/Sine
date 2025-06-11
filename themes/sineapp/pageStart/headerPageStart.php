<!-- Header -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 px-4 md:px-6">
    <div class="mb-4 md:mb-0">
        <h1 class="text-2xl lg:text-xl text-gray-800">Bem-vindo de volta, <?= $userSystem->name_user ?>!</h1>
        <p class="text-gray-500 text-sm lg:text-base mt-1">Aqui está o resumo das atividades recentes</p>
    </div>
    
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 px-4 md:px-6">
    <!-- Trabalhadores -->
    <div class="bg-blue-500 rounded-xl p-4 overflow-hidden relative">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-white mb-1">Trabalhadores</p>
                <h3 class="text-3xl text-white"><?= format_number($workerCount ?? 000) ?></h3>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-blue-100 absolute right-[-20px] bottom-[-20px]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>
    </div>

    <!-- Vagas -->
    <div class="bg-blue-600 rounded-xl p-4 overflow-hidden relative">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-white mb-1">Vagas Abertas</p>
                <h3 class="text-3xl text-white"><?= format_number($cavancysCount ?? 000) ?></h3>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-blue-100 absolute right-[-20px] bottom-[-20px]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
        </div>
       
    </div>

    <!-- Empresas -->
    <div class="bg-blue-700 rounded-xl p-4 overflow-hidden relative">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-white mb-1">Empresas</p>
                <h3 class="text-3xl text-white"><?= format_number($enterprisesCount ?? 000) ?></h3>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-blue-100 absolute right-[-20px] bottom-[-20px]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
        </div>
        
    </div>

    <!-- Atendimentos -->
    <div class="bg-blue-800 rounded-xl p-4 overflow-hidden relative">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm text-white mb-1">Total Atendimentos</p>
                <h3 class="text-3xl text-white"><?= format_number($serviceCount ?? 000) ?></h3>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-blue-100 absolute right-[-20px] bottom-[-20px]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
        </div>
        
    </div>
</div>

<!-- Seção de Gráficos -->
<div class="mt-8 p-5 md:p-0">
    <!-- Linha 1 -->
    <div class="flex flex-col md:flex-row -mx-2">
        <!-- Gráfico 1 -->
        <div class="w-full lg:w-2/3 px-2 mb-3">
            <div class="p-3 bg-white rounded-lg shadow-xs">
                <div class="flex justify-between items-center mb-3">
                    <h2 class="text-xs font-medium text-gray-700">Total por mês</h2>
                    <div class="flex space-x-1">
                        <button class="cursor-pointer px-2 py-0.5 text-xs bg-blue-800 text-white rounded-full">Mês</button>
                        <button class="cursor-pointer px-2 py-0.5 text-xs bg-gray-200 text-gray-600 rounded-full">Ano</button>
                    </div>
                </div>
                <div class="h-40 sm:h-48 md:h-40 lg:h-55">
                    <canvas id="graficoVisaoGeral"></canvas>
                </div>
            </div>
        </div>

        <!-- Gráfico 2 -->
        <div class="w-full lg:w-1/3 px-2 mb-3">
            <div class="p-3 bg-white rounded-lg shadow-xs h-full">
                <div class="flex justify-between items-center mb-3">
                    <h2 class="text-xs font-medium text-gray-700">Status trabalhadores</h2>
                    <div class="flex space-x-1">
                        <button class="cursor-pointer px-2 py-0.5 text-xs bg-blue-800 text-white rounded-full">Dia</button>
                        <button class="cursor-pointer px-2 py-0.5 text-xs bg-gray-200 text-gray-600 rounded-full">Semana</button>
                    </div>
                </div>
                <div class="h-40 sm:h-48 md:h-40 lg:h-55">
                    <canvas id="graficoStatus"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Linha 2  -->
    <div class="flex flex-col md:flex-row -mx-2 mt-1">
        <!-- Gráfico 3 -->
        <div class="w-full md:w-1/2 px-2 mb-3">
            <div class="p-3 bg-white rounded-lg shadow-xs">
                <div class="flex justify-between items-center">
                    <h2 class="text-xs font-medium text-gray-700">Status Vagas</h2>
                    <div class="flex space-x-1">
                        <button class="cursor-pointer px-2 py-0.5 text-xs bg-blue-800 text-white rounded-full">Mês</button>
                        <button class="cursor-pointer px-2 py-0.5 text-xs bg-gray-200 text-gray-600 rounded-full">Ano</button>
                    </div>
                </div>
                <div class="h-32 sm:h-36 md:h-40"> 
                    <canvas id="graficoTipos"></canvas>
                </div>
            </div>
        </div>

        <!-- Gráfico 4 -->
        <div class="w-full md:w-1/2 px-2 mb-3">
            <div class="p-3 bg-white rounded-lg shadow-xs">
                <div class="flex justify-between items-center">
                    <h2 class="text-xs font-medium text-gray-700">Vagas pro Gênero</h2>
                    <div class="flex space-x-1">
                        <button class="cursor-pointer px-2 py-0.5 text-xs bg-blue-800 text-white rounded-full">Mês</button>
                        <button class="cursor-pointer px-2 py-0.5 text-xs bg-gray-200 text-gray-600 rounded-full">Ano</button>
                    </div>
                </div>
                <div class="h-32 sm:h-36 md:h-40"> 
                    <canvas id="graficoTempo"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Código dos gráficos -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gráfico 1: Linha (original)
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
                    backgroundColor: 'rgba(23, 76, 221, 0.2)',
                    borderColor: 'rgb(18, 72, 219)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: 'rgb(12, 51, 158)',
                    pointBorderColor: '#fff',
                    pointHoverRadius: 6
                }]
            },
            options: getCommonOptions()
        });

        // Gráfico 2: Doughnut (ao lado do principal)
        const vStatusLabe = <?= json_encode($chartWorkerLabel); ?>;
        const vStatusValue = <?= json_encode($chartWorkerTotal); ?>;
        const ctx2 = document.getElementById('graficoStatus').getContext('2d');
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: vStatusLabe,
                datasets: [{
                    data: vStatusValue,
                    backgroundColor: [
                        'rgba(70, 159, 243, 0.8)',
                        'rgba(71, 156, 236, 0.5)',
                        'rgba(82, 147, 245, 0.2)'
                    ],
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            },
            options: {
                ...getCommonOptions(),
                cutout: '75%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 10,
                            padding: 15,
                            font: {
                                size: 10
                            },
                            color: 'rgb(12, 51, 158)'
                        }
                    }
                }
            }
        });

        // Gráfico 3: Barra horizontal
        const vVacancyLabel = <?= json_encode($chartVacancyLabel); ?>;
        const vVacancyTotal = <?= json_encode($chartVacancyTotal); ?>;
        const ctx3 = document.getElementById('graficoTipos').getContext('2d');
        new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: vVacancyLabel,
                datasets: [{
                    label: 'Atendimentos',
                    data: vVacancyTotal,
                    backgroundColor: [
                        'rgb(77, 163, 243)',
                        'rgb(58, 161, 245)',
                        'rgb(48, 138, 240)',
                        'rgb(72, 144, 240)'
                    ],
                    borderColor: '#fff',
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: {
                ...getCommonOptions(),
                indexAxis: 'y',
                scales: {
                    x: {
                        display: false,
                        grid: {
                            display: false
                        },
                        ticks: {
                            display: false
                        }
                    },
                    y: {
                        display: true,
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: 'rgb(28, 77, 212)',
                            font: {
                                size: 11
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Gráfico 4: Barra horizontal invertido (da direita para esquerda)
        const ctx4 = document.getElementById('graficoTempo').getContext('2d');
        new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: ['Manhã', 'Tarde', 'Noite', 'Madrugada'],
                datasets: [{
                    label: 'Minutos',
                    data: [12, 19, 8, 15],
                    backgroundColor: 'rgb(48, 125, 240)',
                    borderColor: '#fff',
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: {
                ...getCommonOptions(),
                indexAxis: 'y',
                scales: {
                    x: {
                        display: false,
                        reverse: true, // Inverte o eixo X (da direita para esquerda)
                        grid: {
                            display: false
                        },
                        ticks: {
                            display: false
                        }
                    },
                    y: {
                        display: true,
                        position: 'right', // Rótulos do eixo Y à direita
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: 'rgb(12, 51, 158)',
                            font: {
                                size: 11
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Função para opções comuns
        function getCommonOptions() {
            return {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        backgroundColor: 'rgba(12, 51, 158, 0.9)',
                        titleFont: { weight: 'bold', size: 12 },
                        bodyFont: { size: 11 },
                        padding: 10,
                        cornerRadius: 6,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y !== undefined ? 
                                    context.parsed.y : context.parsed;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: false
                        },
                        ticks: {
                            display: false
                        },
                        border: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            display: false
                        },
                        border: {
                            display: false
                        }
                    }
                }
            };
        }
    });
</script>