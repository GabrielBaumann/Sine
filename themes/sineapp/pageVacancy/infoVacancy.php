<!-- back button -->
<button
    id="btn-back"
    data-url="<?= url("/listavagas"); ?>"
    data-change="view-form"
    class="cursor-pointer p-1 mb-4 px-2 rounded-full text-blue-500 hover:text-blue-900 transition-all duration-200 flex items-center gap-1">
    < Voltar à página de vagas
</button>

<div class="bg-white p-4 flex flex-col md:flex-row items-center justify-between w-full rounded-2xl">

    <div class="flex flex-col">
        <!-- Título -->
        <h1 class="text-2xl font-semibold text-gray-900"><?= $vacancyInfo->nomeclatura_vacancy; ?></h1>
        <h2 class="text-md font-normal text-gray-600"><?= $vacancyInfo->name_enterprise; ?></h2>
    </div>

    <!-- Controles -->
    <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
        <!-- Filtros -->
        <div class="flex flex-col sm:flex-row gap-2">
            <select 
                name="search-status"
                data-url="<?= url("/pesquisarstatus/" . $vacancyInfo->id_vacancy); ?>"
                data-ajax="list-info-vacancy"
                class="input-search px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                <option value="">Todos status</option>
                <option value="Ativa">Ativa</option>
                <option value="Encerrada">Encerrada</option>
            </select>

            <!-- Botão encerrar empelho -->
            <?php if($chekedVacancyMirrorActive): ?>
                <button 
                    data-url="<?= url("/encerrarvaga") . "/" . fncEncrypt($vacancyInfo->id_vacancy); ?>"
                    id="btn-closed-mirror-vacancy" 
                    class="cursor-pointer flex items-center gap-2 bg-gray-300 hover:bg-gray-400 px-4 py-2 text-black font-medium rounded-lg transition-colors duration-200 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Encerrar Vaga
                </button>
            <?php endif; ?>

            <!-- Botão Ocultar vaga e mostrar vaga -->
            <?php if($vacancyInfo->hide_panel == "0"): ?>
                <?php if($vacancyInfo->status_vacancy == "Ativa" && $vacancyInfo->hide_vacancy == 0): ?>
                    <button 
                        data-url="<?= url("/janelaocultarpainel/1/") . fncEncrypt($vacancyInfo->id_vacancy); ?>"
                        id="btn-hide-vacancy" 
                        class="cursor-pointer flex items-center gap-2 bg-gray-500 hover:bg-gray-600 px-4 py-2 text-white font-medium rounded-md transition-colors duration-300 ">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                        <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                        <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
                        </svg>
                        Ocultar
                    </button>
                <?php elseif($vacancyInfo->status_vacancy == "Ativa" && $vacancyInfo->hide_vacancy == 1): ?>
                    <button 
                        data-url="<?= url("/janelaocultarpainel/2/") . fncEncrypt($vacancyInfo->id_vacancy); ?>"
                        id="btn-hide-vacancy" 
                        class="cursor-pointer flex items-center gap-2 bg-green-500 hover:bg-green-600 px-4 py-2 text-black font-medium rounded-lg transition-colors duration-200 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>

                        Mostrar
                    </button>
                <?php else: ?>
                <?php endif; ?>
            <?php else: ?>
            <?php endif; ?>

            <!-- Botão editar -->
            <?php if($vacancyInfo->status_vacancy == "Encerrada"): ?>
                <button 
                    data-url="<?= url("/reativarvagas") . "/" . fncEncrypt($vacancyInfo->id_vacancy); ?>"
                    id="btn-reactivate-vacancy" 
                    class="cursor-pointer flex items-center gap-2 bg-green-500 hover:bg-green-600 px-4 py-2 text-black font-medium rounded-lg transition-colors duration-200 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd" d="M14.615 1.595a.75.75 0 0 1 .359.852L12.982 9.75h7.268a.75.75 0 0 1 .548 1.262l-10.5 11.25a.75.75 0 0 1-1.272-.71l1.992-7.302H3.75a.75.75 0 0 1-.548-1.262l10.5-11.25a.75.75 0 0 1 .913-.143Z" clip-rule="evenodd" />
                    </svg>
                    Reativar
                </button>
            <?php else: ?>
                <button 
                    data-url="<?= url("/editarvagas") . "/" . $vacancyInfo->id_vacancy; ?>"
                    id="btn-new-vacancy" 
                    class="cursor-pointer flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 px-4 py-2 text-black font-medium rounded-lg transition-colors duration-200 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                    Editar
                </button>
            <?php endif; ?>

            <!-- Botão de excluir -->
            <button 
                data-url="<?= url("/excluirvaga") . "/" . fncEncrypt($vacancyInfo->id_vacancy); ?>"
                id="btn-delete-vacancy" 
                class="cursor-pointer flex items-center gap-2 bg-red-500 hover:bg-red-600 px-4 py-2 text-white font-medium rounded-lg transition-colors duration-200 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                </svg>
                Excluir
            </button>
        </div>
    </div>
    
    
</div>
<div id="list-info-vacancy">
    <?php $this->insert("/pageVacancy/componentListInfoVacancy") ?>
</div>