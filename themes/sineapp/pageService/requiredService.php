<div id="step-4" class="step-content">
    <div id="typeService" hidden><?= $type ?></div>
    <div class="hidden md:flex items-center justify-left p-2 gap-2">
        <button
            data-url="<?= url("/segurodesemprego/") . $type; ?>"
            class="cursor-pointer p-1 px-2 rounded-full border border-gray-400 text-gray-800 hover:bg-blue-800 hover:text-white transition hover:border-blue-900">
            < Voltar
        </button>
        <p class='text-blue-500 flex items-center truncate'>Atendimento > Modo > Motivo > Seguro Desemprego > Requerimento Especial</p>
    </div>
    <main class="grid min-h-full place-items-center px-6 md:py-10 lg:px-8 mb-10">
        <div class="text-center">
            <h1 class="mt-4 text-3xl font-semibold tracking-tight text-balance text-gray-800 sm:text-5xl">Qual o tipo de <span class="text-blue-800">Requerimento Especial</span>?</h1>
        </div>
    </main>
    <h2 class="text-lg font-semibold text-gray-800 mb-4"></h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <button
            data-idservice = "<?= $type === "telefone" ? "64" : "14" ?>"   
            data-url="<?= url("/formularioAtendimento/especial/") . $type ?>"
            class="cursor-pointer p-4 border-2 border-gray-200 rounded-lg hover:bg-white hover:shadow-xl hover:border-gray-300 transition-all flex items-start gap-3 text-left">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center text-blue-800 mt-1 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                </svg>
            </div>
            <div>
                <span class="font-medium text-gray-800 block mb-1">Sentença Judicial</span>
                <p class="text-sm text-gray-500">Requerimento baseado em decisão judicial</p>
            </div>
        </button>

        <button
            data-idservice = "<?= $type === "telefone" ? "65" : "15" ?>"   
            data-url="<?= url("/formularioAtendimento/especial/") . $type ?>"
            class="cursor-pointer p-4 border-2 border-gray-200 rounded-lg hover:bg-white hover:shadow-xl hover:border-gray-300 transition-all flex items-start gap-3 text-left">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center text-blue-800 mt-1 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.75H6.912a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859M12 3v8.25m0 0-3-3m3 3 3-3" />
                </svg>
            </div>
            <div>
                <span class="font-medium text-gray-800 block mb-1">PDO</span>
                <p class="text-sm text-gray-500">Programa de Demissão Voluntária</p>
            </div>
        </button>
        
    </div>
</div>