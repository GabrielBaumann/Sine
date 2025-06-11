<?php $this->layout("layout") ?>

<div class="text-center mb-8">
    <h1 class="text-3xl text-gray-800">Bem-vindo</h1>
    <p class="text-gray-600 mt-2">Faça login para continuar</p>
</div>

<form class="space-y-6" action="<?= url("/") ?>" method="post">
    <div><?= flash(); ?></div>
    <?= csrf_input(); ?>
    <div>
        <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
        <input 
            id="user" 
            type="text" 
            required
            name="cpfuser"
            placeholder="000.000.000-00" 
            class="mt-1 block w-full px-4 p-5 md:py-3 border border-gray-300 transition-all"
        >
    </div>
    
    <div>
        <label for="senha" class="block text-sm font-medium text-gray-700">Senha</label>
        <input 
            id="password" 
            type="password" 
            required
            name="password"
            placeholder="••••••••" 
            class="mt-1 block w-full px-4 p-5 md:py-3 border border-gray-300 transition-all"
        >
    </div>
    <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-blue-800 text-white p-5 md:py-3 px-4 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
        Entrar
    </button>
</form>