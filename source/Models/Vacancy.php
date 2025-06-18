<?php

namespace Source\Models;

use Source\Core\Model;

class Vacancy extends Model
{
    protected $message;
    
    public function __construct()
    {
        parent::__construct(
            "vacancy", ["id_vacancy"], [],
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
        $this->request_vacancy = $data["request-vacancy"];
        $this->id_user_register = $userId;

        $this->save();

        $idFixedVacancy = $this->id_vacancy;
        $totalNumberVacancy = $data["number-vacancy"];

        for($i = 1; $i < $totalNumberVacancy + 1 ; $i++) {

            // $numberVacancy = $i . "/" . $totalNumberVacancy;

            $vacancy = new static();

            $vacancy->id_vacancy_fixed = $idFixedVacancy;
            $vacancy->id_enterprise = $data["enterprise"];
            $vacancy->cbo_occupation = $data["cbo-occupation"];
            $vacancy->apprentice_vacancy = $data["apprentice-vacancy"];
            $vacancy->gender_vacancy = $data["gender"];
            $vacancy->number_vacancy = $i;
            $vacancy->pcd_vacancy = $data["pcd-vacancy"];
            $vacancy->quantity_per_vacancy = $data["quantity-per-vacancy"];
            $vacancy->date_open_vacancy = $data["date-open-vacancy"];
            $vacancy->education_vacancy = $data["education-vacancy"];
            $vacancy->age_min_vacancy = $data["age-min-vacancy"];
            $vacancy->age_max_vacancy = $data["age-max-vacancy"];
            $vacancy->exp_vacancy = $data["exp-vacancy"];
            $vacancy->description_vacancy = $data["description-vacancy"];
            $vacancy->nomeclatura_vacancy = $data["nomeclatura-vacancy"];
            $vacancy->request_vacancy = $data["request-vacancy"];
            $vacancy->id_user_register = $userId;
            $vacancy->save();
            }

        return true;
    }

    /**
     * Função para atualizar quantidade de vagas
     */
    public function updateVacancy(int $idVacancy, ?array $data = null, ?int $userId = null) : bool
    {   

        // Atualiza as vagas que foram inseridas a primeira vez e que não estejam vínculadas a nenhum usuário    
        $oldVacancy = $this->find("id_vacancy_fixed = :id","id={$idVacancy}")
            ->order("number_vacancy", "DESC")
            ->fetch(true);

        foreach($oldVacancy as $oldVacancyItem) {
            
            $oldVacancyUpdate = new static();

            $oldVacancyUpdate->id_vacancy = $oldVacancyItem->id_vacancy;
            $oldVacancyUpdate->id_enterprise = $data["enterprise"];
            $oldVacancyUpdate->cbo_occupation = $data["cbo-occupation"];
            $oldVacancyUpdate->apprentice_vacancy = $data["apprentice-vacancy"];
            $oldVacancyUpdate->gender_vacancy = $data["gender"];
            $oldVacancyUpdate->pcd_vacancy = $data["pcd-vacancy"];
            $oldVacancyUpdate->quantity_per_vacancy = $data["quantity-per-vacancy"];
            $oldVacancyUpdate->date_open_vacancy = $data["date-open-vacancy"];
            $oldVacancyUpdate->education_vacancy = $data["education-vacancy"];
            $oldVacancyUpdate->age_min_vacancy = $data["age-min-vacancy"];
            $oldVacancyUpdate->age_max_vacancy = $data["age-max-vacancy"];
            $oldVacancyUpdate->exp_vacancy = $data["exp-vacancy"];
            $oldVacancyUpdate->description_vacancy = $data["description-vacancy"];
            $oldVacancyUpdate->nomeclatura_vacancy = $data["nomeclatura-vacancy"];
            $oldVacancyUpdate->request_vacancy = $data["request-vacancy"];
            $oldVacancyUpdate->id_user_update = $userId;

            $oldVacancyUpdate->save();

        }

        // Atualiza o espelho da vaga
            $this->id_vacancy = $idVacancy;
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
            $this->request_vacancy = $data["request-vacancy"];
            $this->id_user_update = $userId;

            $this->save();
        
        
        // Caso a atualização implique em novas vagas, as que forem acrescentadas serão criadas nesse ponto
        // Pesquisa a última vaga para calcular a quantidade de vaga e verificar se o valor solicitado é maior que o valor já cadastrado 
            $lastVacancy = $this->find("id_vacancy_fixed = :id","id={$idVacancy}")
            ->order("number_vacancy", "DESC")
            ->fetch();
        
        if($data["number-vacancy"] > $lastVacancy->number_vacancy) {
            for($i = $lastVacancy->number_vacancy + 1; $i <= $data["number-vacancy"]; $i++) {

                $vacancy = new static();
                $vacancy->id_vacancy_fixed = $idVacancy;
                $vacancy->id_enterprise = $data["enterprise"];
                $vacancy->cbo_occupation = $data["cbo-occupation"];
                $vacancy->apprentice_vacancy = $data["apprentice-vacancy"];
                $vacancy->gender_vacancy = $data["gender"];
                $vacancy->number_vacancy = $i;
                $vacancy->pcd_vacancy = $data["pcd-vacancy"];
                $vacancy->quantity_per_vacancy = $data["quantity-per-vacancy"];
                $vacancy->date_open_vacancy = $data["date-open-vacancy"];
                $vacancy->education_vacancy = $data["education-vacancy"];
                $vacancy->age_min_vacancy = $data["age-min-vacancy"];
                $vacancy->age_max_vacancy = $data["age-max-vacancy"];
                $vacancy->exp_vacancy = $data["exp-vacancy"];
                $vacancy->description_vacancy = $data["description-vacancy"];
                $vacancy->nomeclatura_vacancy = $data["nomeclatura-vacancy"];
                $vacancy->request_vacancy = $data["request-vacancy"];
                $vacancy->id_user_register = $userId;
                $vacancy->save();
            }

        }


        
        


        return false;
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

    /**
     * Lista de empresas filtradas somente por empresas que tenham vagas cadastradas
     */
    public function listEnterpriseVacancy() : array
    {
        $enterpriseVancacy = $this->find()->fetch(true);
        
        if(!$enterpriseVancacy) {
            return [];
        }
            foreach($enterpriseVancacy as $enterpriseVancacyItem) {
                if (empty($ids[$enterpriseVancacyItem->id_enterprise])) {

                    $enterprise = (new Enterprise())->findById($enterpriseVancacyItem->id_enterprise);

                    $enterpriseDistinct[] = 
                    [
                        "id_enterprise" => $enterprise->id_enterprise,    
                        "name_enterprise" => $enterprise->name_enterprise
                    ];

                    $ids[$enterpriseVancacyItem->id_enterprise] = true;
                }
            }

            usort($enterpriseDistinct, function($a, $b) {
                return strcmp($a["name_enterprise"], $b["name_enterprise"]);
            });

            $objetos = array_map(function($item) {
                return (object) $item;
            }, $enterpriseDistinct);

        return $objetos;
    }

    /**
     * Encerrar vagas e atualizar o espelho de vagas
     */
    public function closedVacancy(int $idVacancy, int $idFixedVacancy) : bool
    {

        $vacancyClosed = new static();

        $vacancyClosed->id_vacancy = $idVacancy;
        $vacancyClosed->status_vacancy = "Encerrada";
        $vacancyClosed->save();

        $vacancyTotal = (int)$this->findById($idFixedVacancy)->number_vacancy;
        $vacancyTotalClosed = count($this->find("id_vacancy_fixed = :id AND status_vacancy = :st", "id={$idFixedVacancy}&st=Encerrada")->fetch(true));

        if($vacancyTotal === $vacancyTotalClosed) {
            $this->id_vacancy = $idFixedVacancy;
            $this->status_vacancy = "Encerrada";
            $this->save();
        }
        return true;
    }
}