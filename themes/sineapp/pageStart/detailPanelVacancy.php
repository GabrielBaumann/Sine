<h2 class="mx-auto text-black font-semibold text-xl pt-3 justify-center text-center mx-auto bg-white rounded-t-2xl">PAINEL DO DIA</h2>
<div class="flex flex-col w-full md:max-h-[450px] 2xl:max-h-[620px] overflow-y-auto gap-4 p-5 bg-white rounded-b-2xl">
    <?php if($panelVacancy): ?>
        <?php foreach($panelVacancy as $panelVacancyItem) :?>
            <div class="bg-white text-gray-900 flex flex-col md:flex-row justify-between w-full p-4 border-t border-gray-300">
                <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-1">
                    <div class="flex flex-col">
                        <span class="font-semibold md:text-sm xl:text-md text-gray-800" title="">
                            <?= $panelVacancyItem->nomeclatura_vacancy; ?>
                        </span>
                        <span class="text-xs 2xl:text-sm mt-1">CBO: <?= $panelVacancyItem->id_code; ?></span>
                        <span class="mt-1 flex items-center text-xs"><?= $panelVacancyItem->name_fantasy_enterpise; ?></span>
                    </div>
                </div>
                <div class="mt-4 md:mt-0 flex flex-col items-start md:items-end justify-between md:w-30">
                    <span class="font-semibold py-1 rounded-full text-md mb-2 text-sm">QTD: <?= $panelVacancyItem->total_vancacy_general; ?></span>
                    <span class="flex items-center text-sm"><?= $panelVacancyItem->gender_vacancy; ?></span>
                    <span class="text-xs flex text-right truncate bg-yellow-200 text-yellow-900 rounded-full px-2"><?= $panelVacancyItem->accept_curriculum === 1 ? "PEGAR CURRÍCULO" : ""; ?></span>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="bg-white p-5 flex flex-col justify-center items-center mx-auto w-full h-[700px] rounded-b-2xl text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-30">
            <path d="M19.906 9c.382 0 .749.057 1.094.162V9a3 3 0 0 0-3-3h-3.879a.75.75 0 0 1-.53-.22L11.47 3.66A2.25 2.25 0 0 0 9.879 3H6a3 3 0 0 0-3 3v3.162A3.756 3.756 0 0 1 4.094 9h15.812ZM4.094 10.5a2.25 2.25 0 0 0-2.227 2.568l.857 6A2.25 2.25 0 0 0 4.951 21H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-2.227-2.568H4.094Z" />
            </svg>
            <span class="flex justify-center text-center mx-auto">Ainda não há vagas cadastradas para a versão do painel especificada, tente filtrar por uma versão diferente</span>
        </div>
    <?php endif;?>
</div>