<div id="step-1" class="step-content">
    <main class="grid min-h-full place-items-center px-6 md:py-10 lg:px-8 mb-10">
        <div class="text-center">
            <p class="text-base font-semibold text-blue-600">Novo atendimento</p>
            <h1 class="mt-4 text-2xl font-semibold tracking-tight text-balance text-gray-800 sm:text-5xl">De que forma está sendo realizado este atendimento?</h1>
            
        </div>
    </main>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 border-none mt-10 p-5">
        
        <button
            data-url="<?= url("/atendimentomotivo/presencial"); ?>" 
            class="cursor-pointer p-5 border border-gray-300 hover:shadow-xl hover:bg-red-100 hover:border-gray-300 rounded-lg transition-all flex flex-col items-center gap-3">
            <div class="w-14 h-14 flex items-center justify-center text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                </svg>
            </div>
            <span class="text-2xl text-gray-900">Atendimento Presencial</span>
            <p class="text-sm text-gray-900 text-center">O candidato está presente fisicamente na unidade</p>
        </button>
        <button 
            data-url="<?= url("/atendimentomotivo/telefone"); ?>"
            
            class="cursor-pointer p-5 border border-gray-300 hover:shadow-xl rounded-lg hover:bg-green-100 transition-all flex flex-col items-center gap-3">
            <div class="w-14 h-14 flex items-center justify-center text-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                </svg>
            </div>
            <span class="text-2xl text-gray-900">Atendimento por Telefone</span>
            <p class="text-sm text-gray-900 text-center">O candidato está sendo atendido remotamente por telefone</p>
        </button>
    </div>
</div>