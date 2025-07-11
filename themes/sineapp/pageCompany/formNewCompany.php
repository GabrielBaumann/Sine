<div class="">
    <div class="hidden md:flex items-center justify-left p-2 gap-2">
        <button
            id="btn-back"
            data-url="<?= url("/listaempresas"); ?>"
            data-change="companiesView"
            class="cursor-pointer p-1 px-2 rounded-full border border-gray-400 text-gray-800 hover:bg-blue-800 hover:text-white transition hover:border-blue-900">
            < Voltar
        </button>
        <input type="hidden" id="active-company" value="<?= $company->active ?? ""; ?>">
        <!-- <p class='text-blue-500 flex items-center truncate'>Empresas > Nova Empresa</p> -->
    </div>
    
    <form id="form" action="<?= url("/adicionarempresa") . (isset($company->id_enterprise) ? "/" . $company->id_enterprise : "" ) ?>" method="post">
        <?= csrf_input(); ?>
        <div class="">
            <div class="bg-white px-4">
                <h3 class="text-2xl leading-6 font-semibold text-gray-900 py-10" id="modalTitle">Nova Empresa</h3>                    
                <div class="space-y-4"> 
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="w-full">
                            <label for="cnpj" class="block text-sm font-medium text-gray-700 mb-1">CNPJ *</label>
                            <input 
                                data-url="<?= url("/verificarcnpj") . (isset($company->id_enterprise) ? "/" . $company->id_enterprise : "" ) ?>"
                                name="cnpj"
                                id="cnpj" 
                                type="text"
                                value="<?= maskCNPJ($company->cnpj ?? 00) ?? ""; ?>" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="w-full">
                            <label for="new-enterprise" class="block text-sm font-medium text-gray-700 mb-1">Nome da Empresa *</label>
                            <input 
                                name="new-enterprise"
                                type="text"
                                value="<?= $company->name_enterprise ?? ""; ?>"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="w-full">
                            <label for="email-enterprise" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input name="email-enterprise"
                                type="email"
                                id="email-enterprise"
                                value="<?= $company->email_enterprise ?? ""; ?>"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="w-full">
                            <label for="phone-enterprise" class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                            <input name="phone-enterprise"
                                type=""
                                id="phone-enterprise"
                                value="<?= $company->phone_enterprise ?? ""; ?>"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="responsible-person" class="block text-sm font-medium text-gray-700 mb-1">Pessoa Responsável</label>
                        <input name="responsible-person"
                            type="text"
                            id="responsible-person"
                            value="<?= $company->responsible_enterprise ?? ""; ?>"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>  
                </div>
            </div>
            
            <!-- Botão de confirmação -->
            <?php if(!isset($company->active) || $company->active === "Ativa"): ?>
                <div class="col-span-4 flex justify-end mt-4 md:p-4">
                    <button
                        type="submit" class="cursor-pointer flex items-center px-6 py-2 bg-blue-800 text-white rounded-lg hover:bg-blue-900 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Confirmar
                    </button>
                </div>
            <?php endif;?>
        </div>
    </form>
    <?php if(isset($company->id_enterprise) && in_array($userSystem->type_user, ["dev","adm"])): ?>

        <?php if($company->active === "Ativa"): ?>
            <form action="<?= url("cancelarempresa/{$company->id_enterprise}"); ?>" method="post">
                <button
                    type="submit" class="cursor-pointer flex items-center px-6 py-2 bg-red-800 text-white rounded-lg hover:bg-red-900 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Cancelar
                </button>
            </form>
        <?php else: ?>
            <form action="<?= url("ativarempresa/{$company->id_enterprise}"); ?>" method="post">
                <button
                    type="submit" class="cursor-pointer flex items-center px-6 py-2 bg-green-800 text-white rounded-lg hover:bg-green-900 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Reativar
                </button>
            </form>
        <?php endif;?>
    <?php endif;?>
</div>