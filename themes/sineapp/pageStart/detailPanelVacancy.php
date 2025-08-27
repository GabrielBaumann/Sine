<h2 class="mx-auto text-black font-semibold text-xl mb-2 justify-center text-center mx-auto">PAINEL DO DIA</h2>
<div class="flex flex-col w-full md:max-h-[450px] 2xl:max-h-[600px] overflow-y-auto gap-4 p-1 pt-0">
    <?php if($panelVacancy): ?>
        <?php foreach($panelVacancy as $panelVacancyItem) :?>
            <div class="bg-gradient-to-br from-blue-400 to-blue-500 text-white flex flex-col md:flex-row justify-between w-full p-4 rounded-xl shadow-xl">
                <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-1">
                    <div class="flex flex-col">
                        <span class="font-semibold text-xs md:text-xs 2xl:text-xl text-white" title="">
                            <?= $panelVacancyItem->nomeclatura_vacancy; ?>
                        </span>
                        <span class="text-xs 2xl:text-sm mt-1">CBO: <?= $panelVacancyItem->id_code; ?></span>
                        <span class="mt-1 flex items-center text-sm"><?= $panelVacancyItem->name_fantasy_enterpise; ?></span>
                    </div>
                </div>
                <div class="mt-4 md:mt-0 flex flex-col items-start md:items-end  md:w-30">
                    <span class="font-semibold py-1 rounded-full text-md mb-2 text-sm">QTD: <?= $panelVacancyItem->total_vancacy_general; ?></span>
                    <span class="flex items-center text-sm"><?= $panelVacancyItem->gender_vacancy; ?></span>
                    <span class="text-sm flex text-right truncate"><?= $panelVacancyItem->accept_curriculum === 1 ? "PEGAR CURRÍCULO" : ""; ?></span>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        Não há vagas lançadas!!!
    <?php endif;?>
</div>