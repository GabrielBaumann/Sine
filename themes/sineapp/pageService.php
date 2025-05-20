<?php $this->layout('layout_page'); ?>

<!-- Main Content -->
<div class="flex-1 flex flex-col lg:flex-row overflow-hidden pb-16 lg:pb-0">
    <main class="flex-1 p-4 lg:p-6 overflow-y-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-xl lg:text-2xl font-bold text-gray-800">Atendimento ao Candidato</h1>
                <p class="text-gray-500 text-xs lg:text-sm">Preencha as informações abaixo para registrar o atendimento</p>
            </div>
        </div>

        <!-- Form Steps -->
        <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
                <!-- Tipo de Atendimento -->
                <!-- Motivo do Atendimento -->
                <!-- Formulário -->
                <!-- Formulário -->
                 <!-- Serviços do Seguro Desemprego -->
            <div id="newElement">
                <?= $this->insert("/pageService/initService")?>
            </div>

            <!-- Tipo de Requerimento Especial -->
            <div id="step-4" class="step-content">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Qual o tipo de Requerimento Especial?</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <button class="p-4 border-2 border-gray-200 rounded-lg hover:border-sine-300 hover:bg-sine-50 transition-all flex items-start gap-3 text-left">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center text-blue-800 mt-1 flex-shrink-0">
                            <i class="fas fa-gavel"></i>
                        </div>
                        <div>
                            <span class="font-medium text-gray-800 block mb-1">Sentença Judicial</span>
                            <p class="text-sm text-gray-500">Requerimento baseado em decisão judicial</p>
                        </div>
                    </button>
                    <button class="p-4 border-2 border-gray-200 rounded-lg hover:border-sine-300 hover:bg-sine-50 transition-all flex items-start gap-3 text-left">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center text-green-800 mt-1 flex-shrink-0">
                            <i class="fas fa-file-contract"></i>
                        </div>
                        <div>
                            <span class="font-medium text-gray-800 block mb-1">PDO</span>
                            <p class="text-sm text-gray-500">Programa de Demissão Voluntária</p>
                        </div>
                    </button>
                </div>
                <button class="mt-6 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Voltar
                </button>
            </div>

            <!-- Confirmação -->
            <div id="step-5" class="step-content">
                <div class="text-center py-8">
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center text-green-600 mx-auto mb-4">
                        <i class="fas fa-check text-3xl"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Atendimento registrado com sucesso!</h2>
                    <p class="text-gray-600 mb-6">O atendimento foi registrado no sistema e já está disponível para consulta.</p>
                    <div class="bg-gray-50 p-4 rounded-lg mb-6 text-left max-w-md mx-auto">
                        <div class="flex justify-between border-b border-gray-200 pb-2 mb-2">
                            <span class="text-gray-500">Tipo:</span>
                            <span class="font-medium" id="confirm-type"></span>
                        </div>
                        <div class="flex justify-between border-b border-gray-200 pb-2 mb-2">
                            <span class="text-gray-500">Motivo:</span>
                            <span class="font-medium" id="confirm-reason"></span>
                        </div>
                        <div class="flex justify-between border-b border-gray-200 pb-2 mb-2" id="confirm-service-container">
                            <span class="text-gray-500">Serviço:</span>
                            <span class="font-medium" id="confirm-service"></span>
                        </div>
                        <div class="flex justify-between" id="confirm-request-container">
                            <span class="text-gray-500">Requerimento:</span>
                            <span class="font-medium" id="confirm-request"></span>
                        </div>
                    </div>
                    <button class="px-6 py-3 bg-sine-600 text-white rounded-lg hover:bg-sine-700 transition-colors">
                        <i class="fas fa-home mr-2"></i> Voltar para a página inicial
                    </button>
                </div>
            </div>
        </div>
    </main>
</div>