<!-- Header -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 px-4 md:px-6">
    <div class="mb-4 md:mb-0">
        <h1 class="text-2xl lg:text-2xl font-medium text-gray-800">Bem-vindo de volta, <?= $userSystem->name_user ?>!</h1>
        <p class="text-gray-500 text-sm lg:text-base mt-1">Aqui está o resumo das atividades recentes</p>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 px-4 md:px-6">
    <!-- Atendimentos -->
    <div class="bg-[rgb(18,143,238)] rounded-2xl p-4 overflow-hidden relative">
        <div class="flex justify-between items-start">
            <div>
                <h3 class="text-4xl font-medium text-white"><?= format_number($serviceCount ?? 000) ?></h3>
                <p class="text-sm text-white mb-1">Atendimentos</p>
            </div>
            <div class="p-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="absolute -right-[25px] -bottom-[25px] h-25 w-25 text-white">
                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Vagas -->
    <div class="bg-[rgb(15,118,197)] rounded-2xl p-4 overflow-hidden relative">
        <div class="flex justify-between items-start">
            <div>
                <h3 class="text-4xl font-medium text-white"><?= format_number($vavancysCount ?? 000) ?></h3>
                <p class="text-sm text-white mb-1">Vagas Abertas</p>
            </div>
            <div class="p-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="absolute -right-[25px] -bottom-[25px] h-25 w-25 text-white">
                <path fill-rule="evenodd" d="M7.5 5.25a3 3 0 0 1 3-3h3a3 3 0 0 1 3 3v.205c.933.085 1.857.197 2.774.334 1.454.218 2.476 1.483 2.476 2.917v3.033c0 1.211-.734 2.352-1.936 2.752A24.726 24.726 0 0 1 12 15.75c-2.73 0-5.357-.442-7.814-1.259-1.202-.4-1.936-1.541-1.936-2.752V8.706c0-1.434 1.022-2.7 2.476-2.917A48.814 48.814 0 0 1 7.5 5.455V5.25Zm7.5 0v.09a49.488 49.488 0 0 0-6 0v-.09a1.5 1.5 0 0 1 1.5-1.5h3a1.5 1.5 0 0 1 1.5 1.5Zm-3 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                <path d="M3 18.4v-2.796a4.3 4.3 0 0 0 .713.31A26.226 26.226 0 0 0 12 17.25c2.892 0 5.68-.468 8.287-1.335.252-.084.49-.189.713-.311V18.4c0 1.452-1.047 2.728-2.523 2.923-2.12.282-4.282.427-6.477.427a49.19 49.19 0 0 1-6.477-.427C4.047 21.128 3 19.852 3 18.4Z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Trabalhadores -->
    <div class="bg-[rgb(10,102,173)] rounded-2xl p-4 overflow-hidden relative">
        <div class="flex justify-between items-start">
            <div>
                <h3 class="text-4xl font-medium text-white"><?= format_number($workerCount ?? 000) ?></h3>
                <p class="text-sm text-white mb-1">Trabalhadores</p>
            </div>
            <div class="p-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="absolute -right-[25px] -bottom-[25px] h-25 w-25 text-white">
                <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
                <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Empresas -->
    <div class="bg-[rgb(9,89,152)] rounded-2xl p-4 overflow-hidden relative">
        <div class="flex justify-between items-start">
            <div>
                <h3 class="text-4xl font-medium text-white"><?= format_number($enterprisesCount ?? 000) ?></h3>
                <p class="text-sm text-white mb-1">Empresas</p>
            </div>
            <div class="p-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="absolute -right-[25px] -bottom-[25px] h-25 w-25 text-white">
                <path fill-rule="evenodd" d="M4.5 2.25a.75.75 0 0 0 0 1.5v16.5h-.75a.75.75 0 0 0 0 1.5h16.5a.75.75 0 0 0 0-1.5h-.75V3.75a.75.75 0 0 0 0-1.5h-15ZM9 6a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5H9Zm-.75 3.75A.75.75 0 0 1 9 9h1.5a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM9 12a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5H9Zm3.75-5.25A.75.75 0 0 1 13.5 6H15a.75.75 0 0 1 0 1.5h-1.5a.75.75 0 0 1-.75-.75ZM13.5 9a.75.75 0 0 0 0 1.5H15A.75.75 0 0 0 15 9h-1.5Zm-.75 3.75a.75.75 0 0 1 .75-.75H15a.75.75 0 0 1 0 1.5h-1.5a.75.75 0 0 1-.75-.75ZM9 19.5v-2.25a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-.75.75h-4.5A.75.75 0 0 1 9 19.5Z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Seção de Gráficos -->
<div class="mt-4 px-4 md:px-6">
    <!-- Linha 1 -->
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Gráfico 1 e Tabela Top Cadastradores -->
        <div class="w-full lg:w-2/3 flex flex-col gap-6">
            <!-- Gráfico -->
            <div class="bg-white rounded-lg py-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-sm font-semibold text-gray-700 flex items-center">Total por mês</h2>
                </div>
                <div class="h-60">
                    <canvas id="graficoVisaoGeral"></canvas>
                </div>
            </div>
            
            <!-- Cards Top Cadastradores -->
            <div class="bg-white rounded-lg">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-sm font-semibold text-gray-700 flex items-center">Top Cadastradores</h2>
                </div>
                <div class="overflow-x-auto">
                    <div id="top-cadastradores-body" class="flex gap-3 flex-wrap">
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabela Histórico Geral -->
        <div class="w-full lg:w-1/3">
            <div class="h-full py-5">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-sm font-semibold text-gray-700 flex items-center">Últimas atividades</h2>
                </div>
                <div class="overflow-y-auto max-h-[500px]">
                    <table class="w-full">
                        <tbody id="historico-geral-body">
                            <!-- Dados serão inseridos via JavaScript -->
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
                    backgroundColor: 'rgba(255, 255, 255, 0.1)', 
                    borderColor: '#095998', 
                    borderWidth: 4,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: 'rgb(30, 66, 124)', // bg-blue-800
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
                        backgroundColor: 'rgba(30, 66, 124, 0.9)', // bg-blue-800
                        titleFont: { weight: 'bold', size: 12 },
                        bodyFont: { size: 11 },
                        padding: 10,
                        cornerRadius: 6,
                        displayColors: false
                    }
                },
                scales: {
                    x: {
                        display: false, // Remove eixo X
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        display: false, // Remove eixo Y
                        grid: {
                            display: false
                        }
                    }
                },
                elements: {
                    line: {
                        tension: 0.4 // Suaviza a linha
                    }
                }
            }
        });

        // Dados para os cards Top Cadastradores
        const topCadastradores = [
            { nome: 'Maria Silva', atendimentos: 24, ultimo: '2h atrás', foto: 'https://randomuser.me/api/portraits/women/44.jpg' },
            { nome: 'João Oliveira', atendimentos: 18, ultimo: '1h atrás', foto: 'https://randomuser.me/api/portraits/men/32.jpg' },
            { nome: 'Ana Souza', atendimentos: 15, ultimo: '3h atrás', foto: 'https://randomuser.me/api/portraits/women/65.jpg' },
            { nome: 'Maria Silva', atendimentos: 24, ultimo: '2h atrás', foto: 'https://randomuser.me/api/portraits/women/44.jpg' },
            { nome: 'João Oliveira', atendimentos: 18, ultimo: '1h atrás', foto: 'https://randomuser.me/api/portraits/men/32.jpg' },
            { nome: 'Ana Souza', atendimentos: 15, ultimo: '3h atrás', foto: 'https://randomuser.me/api/portraits/women/65.jpg' }
        ];

        // Dados para a tabela Histórico Geral
        const historicoGeral = [
            { acao: 'Seguro Desemprego', data: '10/06 14:30', icon: 'plus-circle' },
            { acao: 'Orientação para o Mercado de trabalho', data: '10/06 13:45', icon: 'refresh' },
            { acao: 'Nova vaga publicada', data: '10/06 12:20', icon: 'briefcase' },
            { acao: 'Cadastro de trabalhador', data: '10/06 11:10', icon: 'user-add' },
            { acao: 'Atendimento concluído', data: '09/06 17:35', icon: 'check-circle' },
            { acao: 'Empresa cadastrada', data: '09/06 16:20', icon: 'cloud-upload' },
            { acao: 'Relatório gerado', data: '09/06 15:40', icon: 'document-report' },
            { acao: 'Nova vaga publicada', data: '10/06 12:20', icon: 'briefcase' }
        ];

        // Ícones HeroIcons
        const icons = {
            'plus-circle': 'M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z',
            'refresh': 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15',
            'briefcase': 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
            'user-add': 'M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z',
            'check-circle': 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
            'cloud-upload': 'M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12',
            'document-report': 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
            'database': 'M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4'
        };

        // Preencher cards Top Cadastradores 
        const topCadastradoresBody = document.getElementById('top-cadastradores-body');
        topCadastradores.forEach(item => {
            const card = document.createElement('div');
            card.className = 'flex items-center rounded-lg p-2 pr-4 gap-3';
            card.innerHTML = `
                <img src="${item.foto}" alt="${item.nome}" class="w-10 h-10 rounded-full object-cover">
                <div class="flex flex-col">
                    <h4 class="text-sm font-medium text-gray-700">${item.nome}</h4>
                    <span class="text-xs text-gray-700">${item.atendimentos} atendimentos</span>
                    
                </div>
            `;
            topCadastradoresBody.appendChild(card);
        });

        // Preencher tabela Histórico Geral
        const historicoGeralBody = document.getElementById('historico-geral-body');
        historicoGeral.forEach(item => {
            const row = document.createElement('tr');
            row.className = 'border-b border-gray-100 hover:bg-gray-50 transition-colors';
            row.innerHTML = `
                <td class="py-3 text-xs text-gray-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#095998] mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${icons[item.icon]}" />
                    </svg>
                    ${item.acao}
                </td>
                <td class="py-3 text-xs text-gray-500 text-right">${item.data}</td>
            `;
            historicoGeralBody.appendChild(row);
        });

        // Função para opções comuns
        function getCommonOptions() {
            return {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(9, 89, 152, 0.9)',
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
                            display: true,
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            color: '#6B7280'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#6B7280'
                        }
                    }
                }
            };
        }
    });
</script>