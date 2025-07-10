<div class="">
    <div class="hidden md:flex items-center justify-left p-2 gap-2">
        <button
            id="btn-back"
            data-url="<?= url("/listausuarios"); ?>"
            data-change="usersView"
            class="cursor-pointer p-1 px-2 rounded-full border border-gray-400 text-gray-800 hover:bg-blue-800 hover:text-white transition hover:border-blue-900">
            < Voltar
        </button>
        <!-- <p class='text-blue-500 flex items-center truncate'>Início > Usuários > Novo usuário</p> -->
    </div>
    <input type="hidden" name="idSystemUser" id="idSystemUser" value="<?= $user->id_user ?? ""; ?>">
    <form id="form" action="<?= url("/adicionarusuario") . (isset($user->id_user) ? "/" . $user->id_user : "" ) ?>" method="post">
        <?= csrf_input(); ?>
        <div class="">
            <div class="bg-white px-4">
                <h3 class="text-2xl leading-6 font-semibold text-gray-900 py-7" id="modalTitle">Novo Usuário</h3>                    
                <div class="space-y-4">
                    <div class="w-full">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nome Completo *</label>
                        <input name="name" 
                            type="text"
                            id="name"
                            value="<?= $user->name_user ?? ""; ?>" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="w-full">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                            <input name="email"
                                type="email"
                                id="email"
                                autocomplete="username"
                                value="<?= $user->email_user ?? ""; ?>"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <div class="w-full">
                            <label for="cpf" class="block text-sm font-medium text-gray-700 mb-1">CPF *</label>
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
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Telefone *</label>
                            <input name="phone"
                                type="text"
                                id="phone"
                                value="<?= mask_phone($user->phone_user ?? ""); ?>"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="w-full">
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Senha *</label>
                            <input name="password"
                                type="password"
                                id="password"
                                autocomplete="new-password"
                                value="<?= $user->password_user ?? ""; ?>"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">                           
                        <div class="w-full md:w-1/2">
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipo de Acesso *</label>
                            <select name="type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="" selected>Selecione</option>
                                <option value="adm" <?= ($user->type_user ?? null) === "adm" ? "selected" : "" ?>>Adm</option>
                                    <?php if($userSystem->type_user === "dev"): ?>
                                        <option value="dev" <?= ($user->type_user ?? null) === "dev" ? "selected" : "" ?>>Dev</option>
                                    <?php endif; ?>
                                <option value="user" <?= ($user->type_user ?? null) === "user" ? "selected" : "" ?>>User</option>
                            </select>
                        </div>
                    </div>
                    
                    <?php if($user ?? ""): ?>
                        <div class="w-full md:w-1/2">
                            <!-- <label class="block text-sm font-medium text-gray-700 mb-1">Status</label> -->
                            <select hidden id="active-user" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="" selected disabled>Selecione</option>
                                <option value="1" <?= ($user->active ?? null) === 1 ? "selected" : ""?>>Ativo</option>
                                <option value="2" <?= ($user->active ?? null) === 2 ? "selected" : ""?>>Cancelado</option>
                            </select>
                        </div>
                    <?php else: ?>
                    <?php endif; ?>    
                </div>

            </div>
        <?php if(($user->active ?? null) != "2"):?>    
            <!-- Botão de confirmação -->
            <div class="col-span-4 flex justify-end mt-4 md:p-3">
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
    <?php if(isset($user->id_user)):?>   
        <?php if($user->active == "1"):?>
            <form action="<?= url("/cancelarusuario/{$user->id_user}"); ?>" method="post">
                <button
                    type="submit" class="cursor-pointer flex items-center px-6 py-2 bg-red-800 text-white rounded-lg hover:bg-red-900 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Cancelar
                </button>
            </form>
        <?php else:?>
            <form action="<?= url("/reativarusuario/{$user->id_user}"); ?>" method="post">
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