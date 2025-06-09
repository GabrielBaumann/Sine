<?php $this->layout("layout") ?>

<div class="flex flex-col justify-center items-center h-full w-full md:w-1/2 p-8">
    <div class="w-full max-w-md space-y-8">
        <div class="text-center">
        <h1 class="text-5xl font-bold text-blue-800 mb-[100px]">SINE</h1>
        <h2 class="text-3xl font-bold text-gray-800">Seja bem-vindo</h2>
        </div>

        <form action="<?= url("/") ?>" class="space-y-5 md:space-y-12" method="post">
            <div><?= flash(); ?></div>
            <?= csrf_input(); ?>
        <div>
            <label for="cpfuser" class="block text-sm font-medium text-gray-700">CPF</label>
            <div class="flex items-center mt-1 border border-gray-200 rounded-full bg-white shadow-md">
            <input id="user" 
                type="text" 
                required
                name="cpfuser"
                class="w-full p-3 md:p-6 bg-transparent focus:outline-none" placeholder="Digite seu CPF" />
            </div>
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
            <div class="flex items-center mt-1 mb-6 border border-gray-200 rounded-full bg-white shadow-md">
            <input id="password" 
                type="password" 
                required
                name="password"
                class="w-full p-3 md:p-6 bg-transparent focus:outline-none" placeholder="Digite sua senha" />
            </div>
        </div>
                <button
                    type="submit"
                    class="cursor-pointer w-full bg-blue-800 hover:bg-blue-900 text-white p-3 md:p-6 rounded-full font-semibold transition shadow-md md:mb-20">
                    Entrar
                </button>
            <div class="justify-center items-center flex flex-col">
                <p>Desenvolvido por</p>
                <img src="<?= theme("/assets/images/cerberus.png")?>" alt="logo" class="h-20 w-20 object-contain">
            </div>
        </form>
    </div>
</div>