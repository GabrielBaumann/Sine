<div class="">
    <div class="hidden md:flex items-center justify-left p-2 gap-2">
        <a href="<?= url("/empresas"); ?>">
            <button
                data-url="<?= url("/empresas"); ?>"
                class="cursor-pointer p-1 px-2 rounded-full border border-gray-400 text-gray-800 hover:bg-blue-800 hover:text-white transition hover:border-blue-900">
                < Voltar
            </button>
        </a>
        <p class='text-blue-500 flex items-center truncate'>Empresas > Nova Empresa</p>
    </div>
    <input type="number" id="idCompany" name="idCompany" value="<?= $user->id_user ?? ""; ?>">
    <form id="form" action="<?= url("/adicionarempresa") . (isset($user->id_user) ? "/" . $user->id_user : "" ) ?>" method="post">
        <?= csrf_input(); ?>
        <div class="">
            <div class="bg-white px-4">
                <h3 class="text-2xl leading-6 font-semibold text-gray-900 py-10" id="modalTitle">Nova Empresa</h3>                    
                <div class="space-y-4"> 
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="w-full">
                            <label class="block text-sm font-medium text-gray-700 mb-1">CNPJ *</label>
                            <input name="" 
                                type=""
                                value="" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="w-full">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nome da Empresa *</label>
                            <input name=""
                                type=""
                                value=""
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="w-full">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input name=""
                                type=""
                                id=""
                                value=""
                                data-url=""
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="w-full">
                            <label for="" class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                            <input name=""
                                type=""
                                id=""
                                value="<?= $user->phone_enterprise ?? "" ?>"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div class="w-full">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pessoa Responsável</label>
                        <input name=""
                            type=""
                            value=""
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>  
                </div>

            </div>
            
            <!-- Botão de confirmação -->
            <div class="col-span-4 flex justify-end mt-4 md:p-4">
                <button
                    type="submit" class="cursor-pointer flex items-center px-6 py-2 bg-blue-800 text-white rounded-lg hover:bg-blue-900 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Confirmar
                </button>
            </div>
        </div>
    </form>   
</div>