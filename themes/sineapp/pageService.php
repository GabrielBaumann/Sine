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
        <div class="bg-white p-6 rounded-lg border border-gray-200">
                <!-- Tipo de Atendimento -->
                <!-- Motivo do Atendimento -->
                <!-- Formulário -->
                <!-- Formulário -->
                <!-- Serviços do Seguro Desemprego -->
                <!-- Tipo de Requerimento Especial -->
                <!-- Confirmação -->
            <div id="newElement">
                <?= $this->insert("/pageService/initService")?>
                <!-- <?= $this->insert("/pageService/sucessService")?> -->
            </div>
        </div>
    </main>
</div>