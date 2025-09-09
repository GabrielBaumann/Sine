<?php

namespace Source\Models\Views;

use Source\Core\Model;
use Source\Models\Vacancy;

class VwVacancy extends Model
{
    public function __construct()
    {
        parent::__construct(
            "vw_vacancy_list",
            ["id_vacancy"],
            [],
            "id_vacancy"
        );        
    }

    /**
     * Função para verificar se somente a vaga espelho está ativa, significa que o usuário reativou a vaga, mas as vagas fixas estão preenchidas
     */
    public function checkedVacancyMirroActive(int $idVacancy) : bool
    {
        $vacancyStatus = $this->findById($idVacancy);

        if($vacancyStatus->status_vacancy === "Ativa") {

            $vacancFixed = (new Vacancy())->find("id_vacancy_fixed = :id","id={$idVacancy}")->fetch(true);

            $countVacancy = count(array_filter($vacancFixed, function($e){
                return $e->data->status_vacancy === "Encerrada";
            }));

            if($vacancyStatus->number_vacancy === $countVacancy) {
                return true;
            }
        }
        return false;
    }
}