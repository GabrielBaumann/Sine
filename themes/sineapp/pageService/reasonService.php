<div id="step-2" class="step-content">
    <div id="typeService" hidden><?= $type ?></div>
    <div class="hidden md:flex items-center justify-left p-2 gap-2">
        <button
            id="bntBack"
            data-url="<?= url("/atendimentotipo"); ?>"
            class="cursor-pointer p-1 px-2 rounded-full border border-gray-400 text-gray-800 hover:bg-blue-800 hover:text-white transition hover:border-blue-900">
            < Voltar
        </button>
        <p class="text-blue-500 flex items-center truncate navigation">
            <!-- <button class="cursor-pointer">Atendimento > </button> Modo > Motivo -->
        </p>
    </div>
    <main class="grid min-h-full place-items-center px-6 md:py-10 lg:px-8 mb-10">
        <div class="text-center">
            <h1 class="mt-4 text-2xl font-semibold tracking-tight text-balance text-gray-800 sm:text-5xl">Qual o motivo deste atendimento?</h1>
        </div>
    </main>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <button 
            data-idservice = "<?= $type === "telefone" ? "16" : "1" ?>"
            data-url="<?= url("/formularioAtendimento/atendimento/") . $type ?>"
            class="cursor-pointer hover:bg-white hover:shadow-xl hover:border-gray-300 p-4 border border-gray-200 rounded-lg hover:border-sine-300 hover:bg-sine-50 transition-all flex items-start gap-3 text-left">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center text-blue-800 mt-1 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                </svg>
            </div>
            <div>
                <span class="font-medium text-gray-800 block mb-1">Cadastrar pessoas/Atualizar cadastro</span>
                <p class="text-sm text-gray-500">Cadastro ou atualização de informações no sistema</p>
            </div>
        </button>

        <button
            data-idservice = "<?= $type === "telefone" ? "17" : "2" ?>"
            data-url="<?= url("/formularioAtendimento/atendimento/"). $type ?>"
            class="cursor-pointer hover:bg-white hover:shadow-xl hover:border-gray-300 p-4 border border-gray-200 rounded-lg hover:border-sine-300 hover:bg-sine-50 transition-all flex items-start gap-3 text-left">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center text-blue-800 mt-1 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" />
                </svg>
            </div>
            <div>
                <span class="font-medium text-gray-800 block mb-1">Orientações para carteira de trabalho digital</span>
                <p class="text-sm text-gray-500">Informações sobre como acessar e usar a CTPS digital</p>
            </div>
        </button>

        <button 
            data-idservice = "<?= $type === "telefone" ? "55" : "3" ?>"
            data-url="<?= url("/formularioAtendimento/atendimento/"). $type ?>"
            class="cursor-pointer hover:bg-white hover:shadow-xl hover:border-gray-300 p-4 border border-gray-200 rounded-lg hover:border-gray-300 hover:bg-sine-50 transition-all flex items-start gap-3 text-left">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center text-blue-800 mt-1 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                </svg>
            </div>
            <div>
                <span class="font-medium text-gray-800 block mb-1">Orientações para o mercado de trabalho</span>
                <p class="text-sm text-gray-500">Dicas e informações sobre como se inserir no mercado</p>
            </div>
        </button>
        
        <?php if($type != "telefone"): ?>
            <button
                data-idservice = "<?= $type === "telefone" ? "56" : "4" ?>"
                data-url="<?= url("/formularioAtendimento/atendimento/"). $type . "/". ($type === "telefone" ? "56" : "4") ?>"
                class="cursor-pointer hover:bg-white hover:shadow-xl hover:border-gray-300 p-4 border border-gray-200 rounded-lg hover:border-sine-300 hover:bg-sine-50 transition-all flex items-start gap-3 text-left">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center text-blue-800 mt-1 flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                    </svg>
                </div>
                <div>
                    <span class="font-medium text-gray-800 block mb-1">Encaminhamento para entrevistas</span>
                    <p class="text-sm text-gray-500">Agendamento e preparação para entrevistas de emprego</p>
                </div>
            </button>
        <?php endif; ?>

        <button
            data-idservice = "<?= $type === "telefone" ? "57" : "5" ?>" 
            data-url="<?= url("/formularioAtendimento/atendimento/"). $type ?>"
            class="cursor-pointer hover:bg-white hover:shadow-xl hover:border-gray-300 p-4 border border-gray-200 rounded-lg hover:border-sine-300 hover:bg-sine-50 transition-all flex items-start gap-3 text-left">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center text-blue-800 mt-1 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                </svg>
            </div>
            <div>
                <span class="font-medium text-gray-800 block mb-1">Orientação sobre Abono Salárial</span>
                <p class="text-sm text-gray-500">Informações sobre direito ao abono salarial</p>
            </div>
        </button>

        <button
            data-url="<?= url("/segurodesemprego/"). $type ?>" 
            class="cursor-pointer hover:bg-white hover:shadow-xl hover:border-gray-300 p-4 border border-gray-200 rounded-lg hover:border-sine-300 hover:bg-sine-50 transition-all flex items-start gap-3 text-left">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center text-blue-800 mt-1 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>
            <div>
                <span class="font-medium text-gray-800 block mb-1">Seguro desemprego</span>
                <p class="text-sm text-gray-500">Orientações sobre solicitação e benefício do seguro-desemprego</p>
            </div>
        </button>
    </div>

</div>