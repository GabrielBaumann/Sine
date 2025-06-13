<?php $this->layout("layout") ?>

<!-- Formulário de Login (Esquerda) -->
<div class="w-full md:w-2/5 p-12 flex flex-col justify-center">
    <div class="text-center mb-10">
        <img src="<?= theme("/assets/images/logo_sine.png")?>" alt="sine" class="h-[60px] mx-auto text-[#095998]">
    </div>
    
    <form class="space-y-6" action="<?= url("/") ?>" method="post">
        <div><?= flash(); ?></div>
        <?= csrf_input(); ?>
        <div>
            <label for="cpf" class="block text-sm font-light text-gray-700 mb-1">CPF</label>
            <input 
                type="text"
                id="user"
                type="text"
                required
                name="cpfuser"
                placeholder="000.000.000-00"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#095998] focus:border-[#095998] outline-none transition duration-200 font-light"
            >
        </div>
        
        <div>
            <label for="password" class="block text-sm font-light text-gray-700 mb-1">Senha</label>
            <input 
                id="password"
                type="password"
                required
                name="password"
                placeholder="********"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#095998] focus:border-[#095998] outline-none transition duration-200 font-light"
            >
        </div>
        
        <div>
            <button 
                type="submit"
                class="shadow-xl w-full flex justify-center py-3 px-4 border border-transparent rounded-full md:rounded-lg md:shadow-sm text-sm font-light text-white bg-[#095998] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition duration-200"
            >
                Entrar
            </button>
        </div>
    </form>
</div>