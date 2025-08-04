<?php 

use Source\Models\Enterprise;
$enterprise = new Enterprise();

?>

<style>
    .select2-container .select2-selection--multiple {
        padding: 6px;
    }
</style>

<main class="flex-1 overflow-y-auto p-4 md:p-0 pb-20">
    <!-- Header de localização -->
    <header class="flex items-center gap-3 md:gap-5 text-blue-800 text-sm md:text-base">
        <button
            id="btn-back"
            data-url="<?= isset($vacancy->id_vacancy) ? url("/informacaovagas") . "/" . $vacancy->id_vacancy : url("/listavagas") ; ?>"
            data-change="view-form"
            class="cursor-pointer p-1 px-2 rounded-full border border-gray-400 text-gray-800 hover:bg-blue-800 hover:text-white transition hover:border-blue-900">
            < Voltar
        </button>
    </header>

    <div>
        <h1 id="titleForm" class="text-2xl md:text-2xl font-semibold text-gray-900 py-7"><?= ($vacancy->id_vacancy ?? null) ? "Editar vaga" :  "Nova vaga" ?></h1>

        <form id="formService" action="<?= url("/cadastrarvagas") . (isset($vacancy->id_vacancy) ? "/" . $vacancy->id_vacancy : "" ) ; ?>" method="post" class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 md:gap-4">
            <?= csrf_input(); ?>
            <!-- Coluna 1 -->
            <div class="space-y-4">
                <div>
                    <label for="enterprise" class="block text-sm font-medium text-gray-700 mb-1">Empresa *</label>
                    <?php if($vacancy ?? null): ?>
                        <select 
                            id="enterprise" 
                            name="enterprise" 
                            class="bg-white block w-full pl-3 pr-8 py-2 text-base md:text-sm border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 rounded-lg">
                            <option value="">Empresa</option>
                                <?php foreach($companys as $company): ?>        
                                    <option value="<?= $company->id_enterprise; ?>" <?= ($enterprise->findById($vacancy->id_enterprise)->name_enterprise ?? null) === "{$company->name_enterprise}" ? "selected" : "" ?>><?= $company->name_enterprise; ?></option>
                                <?php endforeach; ?>
                        </select>
                    <?php else:?>
                        <select 
                            id="enterprise" 
                            name="enterprise" 
                            class="bg-white block w-full pl-3 pr-8 py-2 text-base md:text-sm border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 rounded-lg">
                            <option value="">Empresa</option>
                                <?php foreach($companys as $company): ?>        
                                    <option value="<?= $company->id_enterprise; ?>"><?= $company->name_enterprise; ?></option>
                                <?php endforeach; ?>
                        </select>
                    <?php endif; ?>
                </div>
                
                <!-- CBO - Ocupação -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">CBO - Ocupação *</label>
                    <select
                        id="cbo-occupation" 
                        name="cbo-occupation"
                        class="js-example-responsive select2-container select2-selection--multiple" multiple="multiple" style="width: 100%">
                        <option value="">CBO ocupação</option>
                        <?php foreach($cbos_occupations as $cbo_occupation): ?>
                            <option value="<?= $cbo_occupation->id_code; ?>" <?= ($vacancy->cbo_occupation ?? null) === "{$cbo_occupation->id_code}" ? "selected" : "" ?>><?= $cbo_occupation->id_code; ?> - <?= $cbo_occupation->occupation; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- PCD -->
                <div>
                    <label for="pcd-vacancy" class="block text-sm font-medium text-gray-700 mb-1">PCD *</label>
                    <select 
                        id="pcd-vacancy" 
                        name="pcd-vacancy"
                        class="bg-white block w-full pl-3 pr-8 py-2 text-base md:text-sm border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 rounded-lg">
                        <option value="">Selecione</option>
                        <option value="Sim" <?= ($vacancy->pcd_vacancy ?? '') === 'Sim' ? 'selected' : '' ?>>Sim</option>
                        <option value="Não" <?= ($vacancy->pcd_vacancy ?? '') === 'Não' ? 'selected' : '' ?>>Não</option>
                    </select>
                </div>

                <!-- APRENDIZ -->
                <div>
                    <label for="apprentice-vacancy" class="block text-sm font-medium text-gray-700 mb-1">Aprendiz *</label>
                    <select 
                        id="apprentice-vacancy" 
                        name="apprentice-vacancy" 
                        class="bg-white block w-full pl-3 pr-8 py-2 text-base md:text-sm border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 rounded-lg">
                        <option value="">Selecione</option>
                        <option value="Sim" <?= ($vacancy->apprentice_vacancy ?? '') === 'Sim' ? 'selected' : '' ?>>Sim</option>
                        <option value="Não" <?= ($vacancy->apprentice_vacancy ?? '') === 'Não' ? 'selected' : '' ?>>Não</option>
                    </select>
                </div>

                <!-- Sexo -->
                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Sexo *</label>
                    <select
                        id="gender" 
                        name="gender" 
                        class="bg-white block w-full pl-3 pr-8 py-2 text-base md:text-sm border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 rounded-lg">
                        <option value="">Selecione</option>
                        <option value="Masculino" <?= ($vacancy->gender_vacancy ?? '') === 'Masculino' ? 'selected' : '' ?>>Masculino</option>
                        <option value="Feminino" <?= ($vacancy->gender_vacancy ?? '') === 'Feminino' ? 'selected' : '' ?>>Feminino</option>
                        <option value="Outro" <?= ($vacancy->gender_vacancy ?? '') === 'Outro' ? 'selected' : '' ?>>Outro</option>
                    </select>
                </div>
            </div>

            <!-- Coluna 2 -->
            <div class="space-y-4">

                <!-- Data de abertura -->
                <div>
                    <label for="date-open-vacancy" class="block text-sm font-medium text-gray-700 mb-1">Data de abertura *</label>
                    <input 
                        value="<?= $vacancy->date_open_vacancy ?? "" ?>" 
                        type="date" 
                        id="date-open-vacancy" 
                        name="date-open-vacancy" 
                        class="bg-white w-full px-3 py-2 text-base md:text-sm border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500 text-gray-900">
                </div>

                <!-- N° de Vagas -->
                <div>
                    <label for="number-vacancy" class="block text-sm font-medium text-gray-700 mb-1">N° de Vagas *</label>
                    <input
                        id="number-vacancy" 
                        value="<?= $vacancy->number_vacancy ?? "" ?>" 
                        type="text"  
                        name="number-vacancy" 
                        class="bg-white w-full px-3 py-2 text-base md:text-sm border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500" 
                        placeholder="00">
                </div>

                <!-- Qtd. por Vaga -->
                <div>
                    <label for="quantity-per-vacancy" class="block text-sm font-medium text-gray-700 mb-1">Qtd. por Vaga *</label>
                    <input 
                        value="<?= $vacancy->quantity_per_vacancy ?? "" ?>" 
                        type="text" 
                        id="quantity-per-vacancy" 
                        name="quantity-per-vacancy" 
                        class="bg-white w-full px-3 py-2 text-base md:text-sm border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500" 
                        placeholder="00">
                </div>
                <!-- Experiência -->
                <div>
                    <label for="exp-vacancy" class="block text-sm font-medium text-gray-700 mb-1">Experiência *</label>
                    <select 
                        id="exp-vacancy" 
                        name="exp-vacancy" 
                        class="bg-white block w-full pl-3 pr-8 py-2 text-base md:text-sm border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 rounded-lg">
                        <option value="">Selecione</option>
                        <option value="Sim" <?= ($vacancy->exp_vacancy ?? '') === 'Sim' ? 'selected' : '' ?>>Sim</option>
                        <option value="Não" <?= ($vacancy->exp_vacancy ?? '') === 'Não' ? 'selected' : '' ?>>Não</option>
                    </select>
                </div>

                <!-- Requisitos da vaga -->
                <div class="col-span-1 md:col-span-3">
                    <label for="request-vacancy" class="block text-sm font-medium text-gray-700 mb-1">Requisitos da vaga (Se houver)</label>
                    <input 
                        value="<?= $vacancy->request_vacancy ?? "" ?>" 
                        type="text" 
                        id="request-vacancy" 
                        name="request-vacancy" 
                        class="bg-white w-full px-3 py-2 text-base md:text-sm border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500" 
                        placeholder="Ex: técnico em informática, CNH D...">
                </div>
            </div>

            <!-- Coluna 3 -->
            <div class="space-y-4">
                
                <!-- Data de encerramento da vaga -->
                <div>
                    <label for="date-close-vacancy" class="block text-sm font-medium text-gray-700 mb-1">Data de encerramento *</label>
                    <input 
                        value="<?= $vacancy->date_closed_vacancy ?? "" ?>" 
                        type="datetime-local" 
                        id="date-close-vacancy" 
                        name="date-close-vacancy" 
                        class="bg-white w-full px-3 py-2 text-base md:text-sm border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500 text-gray-900">
                </div>  

                <!-- Escolaridade -->
                <div>
                    <label for="education-vacancy" class="block text-sm font-medium text-gray-700 mb-1">Escolaridade *</label>
                    <select 
                        id="education-vacancy" 
                        name="education-vacancy" 
                        class="bg-white block w-full pl-3 pr-8 py-2 text-base md:text-sm border border-gray-300 focus:outline-none focus:ring-sine-500 focus:border-sine-500 rounded-lg">
                        <option value="">Selecione</option>
                        <option value="Ensino médio completo" <?= ($vacancy->education_vacancy ?? '') === 'Ensino médio completo' ? 'selected' : '' ?>>Ensino médio completo</option>
                        <option value="Ensino superior completo" <?= ($vacancy->education_vacancy ?? '') === 'Ensino superior completo' ? 'selected' : '' ?>>Ensino superior completo</option>
                    </select>
                </div>

                <!-- Idade Mínima/Máxima -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label for="age-min-vacancy" class="block text-sm font-medium text-gray-700 mb-1">Idade Mínima *</label>
                        <input 
                            value="<?= $vacancy->age_min_vacancy ?? "" ?>" 
                            type="text" 
                            id="age-min-vacancy" 
                            name="age-min-vacancy" 
                            class="bg-white w-full px-3 py-2 text-base md:text-sm border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500" 
                            placeholder="00">
                    </div>
                    <div>
                        <label for="age-max-vacancy" class="block text-sm font-medium text-gray-700 mb-1">Idade Máxima *</label>
                        <input  
                            value="<?= $vacancy->age_max_vacancy ?? "" ?>" 
                            type="text" 
                            id="age-max-vacancy" 
                            name="age-max-vacancy" 
                            class="bg-white w-full px-3 py-2 text-base md:text-sm border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500" 
                            placeholder="00">
                    </div>
                </div>
                
                <!-- Nomenclatura da vaga -->
                <div>
                    <label for="nomeclatura-vacancy" class="block text-sm font-medium text-gray-700 mb-1">Nomenclatura da vaga *</label>
                    <input 
                        value="<?= $vacancy->nomeclatura_vacancy ?? "" ?>" 
                        type="text" 
                        id="nomeclatura-vacancy" 
                        name="nomeclatura-vacancy" 
                        class="bg-white w-full px-3 py-2 text-base md:text-sm border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500" 
                        placeholder="00">
                </div>
            </div>

            <!-- Descrição -->
            <div class="col-span-1 md:col-span-3">
                <label for="description-vacancy" class="block text-sm font-medium text-gray-700 mb-1">Descrição (Opcional)</label>
                <input 
                    value="<?= $vacancy->description_vacancy ?? "" ?>" 
                    type="text" 
                    id="description-vacancy" 
                    name="description-vacancy" 
                    class="bg-white w-full px-3 py-2 text-base md:text-sm border border-gray-300 rounded-lg focus:ring-sine-500 focus:border-sine-500" 
                    placeholder="">
            </div>

            <!-- Botão de confirmação -->
            <div class="col-span-1 md:col-span-3 flex justify-end">
                <button
                    type="submit" class="cursor-pointer flex items-center px-6 py-3 md:py-2 text-base md:text-sm bg-blue-800 text-white rounded-lg hover:bg-blue-900 transition-colors w-full md:w-auto justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Confirmar
                </button>
            </div>
        </form>
    </div>
</main>