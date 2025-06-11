<div>
    <div class="flex items-center justify-center ">
        <input type="number" id="idSystemUser" name="idSystemUser" value="<?= $user->id_user ?? ""; ?>">
        <form id="form" action="<?= url("/adicionarusuario") . (isset($user->id_user) ? "/" . $user->id_user : "" ) ?>" method="post">
            <?= csrf_input(); ?>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="modalTitle">Adicionar Novo Usuário</h3>                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nome Completo</label>
                            <input name="name" 
                                type="text"
                                value="<?= $user->name_user ?? ""; ?>" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input name="email" 
                                type="email"
                                value="<?= $user->email_user ?? ""; ?>" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">CPF</label>
                            <input name="cpf" 
                                type="text"
                                id="cpf"
                                value="<?= formatCPF($user->cpf_user ?? ""); ?>"
                                data-url="<?= url("/verificarcpf"); ?>" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                            <input name="phone" 
                                type="text"
                                id="telephone"
                                value="<?= mask_phone($user->phone_user ?? ""); ?>" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
                            <input name="password" 
                                type="password"
                                value="<?= $user->password_user ?? ""; ?>" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">                           
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de Acesso</label>
                                <select name="type" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="" selected>Selecione</option>
                                    <option value="adm" <?= ($user->type_user ?? null) === "adm" ? "selected" : "" ?>>Adm</option>
                                        <?php if($user->type_user === "dev"): ?>
                                            <option value="dev" <?= ($user->type_user ?? null) === "dev" ? "selected" : "" ?>>Dev</option>
                                        <?php endif; ?>
                                    <option value="user" <?= ($user->type_user ?? null) === "user" ? "selected" : "" ?>>User</option>
                                </select>
                            </div>
                        </div>
                        
                        <?php if($user ?? ""): ?>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="" selected disabled>Selecione</option>
                                    <option value="1" <?= ($user->active ?? null) === 1 ? "selected" : ""?>>Ativo</option>
                                    <option value="0" <?= ($user->active ?? null) === 0 ? "selected" : ""?>>Cancelado</option>
                                </select>
                            </div>
                        <?php else: ?>
                        <?php endif; ?>    
                    </div>

                </div>
                
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button id="btnSave" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Salvar
                    </button>
                    <button id="closeModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm cancel-modal">
                        Cancelar
                    </button>
                </div>
            </div>
        </form>   
    </div>
</div>