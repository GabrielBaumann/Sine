<div class="">
    <div class="hidden md:flex items-center justify-left p-2 gap-2">
        <a href="<?= url("/usuarios"); ?>">
            <button
                data-url="<?= url("/usuarios"); ?>"
                class="cursor-pointer p-1 px-2 rounded-full border border-gray-400 text-gray-800 hover:bg-blue-800 hover:text-white transition hover:border-blue-900">
                < Voltar
            </button>
        </a>
        <p class='text-blue-500 flex items-center truncate'>Início > Usuários > Novo usuário</p>
    </div>
    <input type="number" id="idSystemUser" name="idSystemUser" value="<?= $user->id_user ?? ""; ?>">
    <form id="form" action="<?= url("/adicionarusuario") . (isset($user->id_user) ? "/" . $user->id_user : "" ) ?>" method="post">
        <?= csrf_input(); ?>
        <div class="">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="modalTitle">Adicionar Novo Usuário</h3>                    
                <div class="space-y-4">
                    <div class="w-full">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nome Completo *</label>
                        <input name="name" 
                            type="text"
                            value="<?= $user->name_user ?? ""; ?>" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="w-full">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input name="email"
                                type="email"
                                value="<?= $user->email_user ?? ""; ?>"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <div class="w-full">
                            <label class="block text-sm font-medium text-gray-700 mb-1">CPF</label>
                            <input name="cpf"
                                type="text"
                                id="cpf"
                                value="<?= formatCPF($user->cpf_user ?? ""); ?>"
                                data-url="<?= url("/verificarcpf"); ?>"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="w-full">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                            <input name="phone"
                                type="text"
                                id="telephone"
                                value="<?= mask_phone($user->phone_user ?? ""); ?>"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="w-full">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
                            <input name="password"
                                type="password"
                                value="<?= $user->password_user ?? ""; ?>"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">                           
                        <div class="w-full md:w-1/2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de Acesso</label>
                            <select name="type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
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
                        <div class="w-full md:w-1/2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="" selected disabled>Selecione</option>
                                <option value="1" <?= ($user->active ?? null) === 1 ? "selected" : ""?>>Ativo</option>
                                <option value="0" <?= ($user->active ?? null) === 0 ? "selected" : ""?>>Cancelado</option>
                            </select>
                        </div>
                    <?php else: ?>
                    <?php endif; ?>    
                </div>

            </div>
            
            <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button id="btnSave" class="w-full inline-flex justify-center rounded-md border border-transparent px-4 py-2 bg-blue-700 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Salvar
                </button>
            </div>
        </div>
    </form>   
</div>