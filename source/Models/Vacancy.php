<?php

namespace Source\Models;

use Source\Core\Model;

class Vacancy extends Model
{
    protected $message;
    
    public function __construct()
    {
        parent::__construct(
            "vacancy", ["id_vacancy"], ["id_enterprise", "cbo_occupation", "pcd_vacancy", "apprentice_vacancy", "gender_vacancy",
            "number_vacancy", "quantity_per_vacancy", "date_open_vacancy", "education_vacancy", "age_min_vacancy", "age_max_vacancy", 
            "exp_vacancy", "nomeclatura_vacancy"],
            "id_vacancy"
        );
    }

    /**
     * Função para cadastrar vagas e criar vaga espelho e vaga fixas
     */
    public function createVacancy(array $data, int $userId) : bool
    {
        if (!isset($data["number-vacancy"]) || !is_numeric($data["number-vacancy"]) || $data["number-vacancy"] < 1 ) {
            return false;
        }

        $this->id_enterprise = $data["enterprise"];
        $this->cbo_occupation = $data["cbo-occupation"];
        $this->apprentice_vacancy = $data["apprentice-vacancy"];
        $this->gender_vacancy = $data["gender"];
        $this->number_vacancy = $data["number-vacancy"];
        $this->pcd_vacancy = $data["pcd-vacancy"];
        $this->quantity_per_vacancy = $data["quantity-per-vacancy"];
        $this->date_open_vacancy = $data["date-open-vacancy"];
        $this->education_vacancy = $data["education-vacancy"];
        $this->age_min_vacancy = $data["age-min-vacancy"];
        $this->age_max_vacancy = $data["age-max-vacancy"];
        $this->exp_vacancy = $data["exp-vacancy"];
        $this->description_vacancy = $data["description-vacancy"];
        $this->nomeclatura_vacancy = $data["nomeclatura-vacancy"];
        $this->id_user_register = $userId;

        $this->save();

        $idFixedVacancy = $this->id_vacancy;
        $totalNumberVacancy = $data["number-vacancy"];

        for($i = 1; $i < $totalNumberVacancy + 1 ; $i++) {

            $numberVacancy = $i . "/" . $totalNumberVacancy;

            $vacancy = new static();

            $vacancy->id_vacancy_fixed = $idFixedVacancy;
            $vacancy->id_enterprise = $data["enterprise"];
            $vacancy->cbo_occupation = $data["cbo-occupation"];
            $vacancy->apprentice_vacancy = $data["apprentice-vacancy"];
            $vacancy->gender_vacancy = $data["gender"];
            $vacancy->number_vacancy = $numberVacancy;
            $vacancy->pcd_vacancy = $data["pcd-vacancy"];
            $vacancy->quantity_per_vacancy = $data["quantity-per-vacancy"];
            $vacancy->date_open_vacancy = $data["date-open-vacancy"];
            $vacancy->education_vacancy = $data["education-vacancy"];
            $vacancy->age_min_vacancy = $data["age-min-vacancy"];
            $vacancy->age_max_vacancy = $data["age-max-vacancy"];
            $vacancy->exp_vacancy = $data["exp-vacancy"];
            $vacancy->description_vacancy = $data["description-vacancy"];
            $vacancy->nomeclatura_vacancy = $data["nomeclatura-vacancy"];
            $vacancy->id_user_register = $userId;
            $vacancy->save();
            }

        return true;
    }

    public function chartVacancy() : array
    {
        $chart = $this->find("id_vacancy_fixed <> :id", "id=0")->fetch(true);

        foreach($chart as $char) {
            $chartList[] = $char->status_vacancy;
        }

        $charCount =  array_count_values($chartList);

        foreach($charCount as $key => $value ) {
            $label[] = $key;
            $total[] = $value;
        }
        return ["label" => $label, "total" => $total];
    }
    
    public function chartVacancyGender() : array
    {
        $chart = $this->find("id_vacancy_fixed <> :id", "id=0")->fetch(true);
        foreach($chart as $char) {
            $chartList[] = $char->gender_vacancy;
        }

        $charCount =  array_count_values($chartList);

        foreach($charCount as $key => $value ) {
            $label[] = $key;
            $total[] = $value;
        }
        return ["label" => $label, "total" => $total];
    }
    
}