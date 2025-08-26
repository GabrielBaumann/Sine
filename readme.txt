Atualizações no banco:
Crianção da view: 'vw_char_day':

VIEW `vw_char_day` AS
    SELECT 
        COUNT(0) AS `total`,
        DAYOFMONTH(`service`.`date_register`) AS `day`,
        MONTH(`service`.`date_register`) AS `month`,
        YEAR(`service`.`date_register`) AS `year`
    FROM
        `service`
    GROUP BY YEAR(`service`.`date_register`) , MONTH(`service`.`date_register`) , DAYOFMONTH(`service`.`date_register`)
    ORDER BY `year` , `month` , `day`


Atualização para painel com fases
Criar campo 'version_panel'
na view vw_vacancy_list
preciso do date_register, version_panel