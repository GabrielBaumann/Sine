<?php $this->layout("layout_page"); ?>
    
    <!-- Lista -->
    <div id="usersView" class="w-full mt-10 pr-5">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-900">Gerenciamento de Usuários</h2>
            <button id="addUserBtn" data-url="<?= url("/adicionarusuario") ?>" data-modal="userModal" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition flex items-center space-x-2 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <span>Adicionar Usuário</span>
            </button>
        </div>

        <?= $this->section("content"); ?>
    </div>  

    <!-- Modal COLOCAR OU TIRAR HIDDEN SE QUISER DESAPARECER ELE  -->
    <div id="modal"></div>

<script src="<?= theme("/assets/js/user/modal.js", CONF_VIEW_APP); ?>"></script>
<script src="<?= theme("/assets/js/user/forms.js", CONF_VIEW_APP); ?>"></script>
<script src="<?= theme("/assets/js/user/mask.js", CONF_VIEW_APP); ?>"></script>
