<div id="step-1" class="step-content">
    <h2 class="text-lg font-normal text-gray-800 mb-4">Como está sendo realizado este atendimento?</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 border-none">
            <button
            data-url="<?= url("/atendimentomotivo/presencial"); ?>" 
            class="cursor-pointer p-6 border border-gray-300 rounded-lg hover:bg-gray-300 transition-all flex flex-col items-center gap-3">
                <div class="w-14 h-14 bg-sine-100 rounded-full flex items-center justify-center text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                </div>
                <span class="font-medium text-gray-800">Atendimento Presencial</span>
                <p class="text-sm text-gray-500 text-center">O candidato está presente fisicamente na unidade</p>
            </button>
        <button 
            data-url="<?= url("/atendimentomotivo/telefone"); ?>"
            class="cursor-pointer p-6 border border-gray-300 rounded-lg hover:bg-gray-300 transition-all flex flex-col items-center gap-3">
            <div class="w-14 h-14 bg-sine-100 rounded-full flex items-center justify-center text-sine-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                </svg>
            </div>
            <span class="font-medium text-gray-800">Atendimento por Telefone</span>
            <p class="text-sm text-gray-500 text-center">O candidato está sendo atendido remotamente por telefone</p>
        </button>
    </div>
</div>