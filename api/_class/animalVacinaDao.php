<?php
require_once("animalVacina.php");

class AnimalVacinaDao {
    /** @param AnimalVacina $animalVacina */
    public function selectByIdForm($animalVacina) {
        $ret = array();
        try {
            $mysql = new GDbMysql();
            $mysql->execute("SELECT anv_int_codigo,ani_int_codigo,vac_int_codigo,anv_dat_programacao,anv_dti_aplicacao,usu_int_codigo FROM vw_animal_vacina WHERE anv_int_codigo = ? ", array("i", $animalVacina->getAnv_int_codigo()), true, MYSQL_ASSOC);
            if ($mysql->fetch()) {
                $ret = $mysql->res;
            }
            $mysql->close();
        } catch (GDbException $e) {
            echo $e->getError();
        }
        return $ret;
    }

    /** @param AnimalVacina $animalVacina */
    public function insert($animalVacina) {

        $return = array();
        $param = array($animalVacina->getAnimalCod(),$animalVacina->getVacinaCod(),$animalVacina->getAnv_dat_programacao(),$animalVacina->getUsuarioCod());
        try{
            $query = "INSERT INTO animal_vacina(ani_int_codigo, vac_int_codigo, usu_int_codigo, anv_dat_programacao, anv_dti_inclusao) VALUES";
            $query .= "(".$param[0].",".$param[1].",".$param[3].",'".$param[2]."', NOW());";
            $mysql = new GDbMysql();
            $return = $mysql->execute($query, null, false);
            $insertId = $mysql->stmt->insert_id;
            if($insertId >= 1){
                $return["status"] = true;
                $return["msg"] = 'Agendamento realizado com sucesso!';
                $return["insertId"] = $insertId;
                $mysql->close();
            }else{
                $return["status"] = false;
                $return["msg"] = 'Erro ao agendar vacina! Verifique se foi enviado os dados corretamente!';
            }
        } catch (GDbException $e) {
            $return["status"] = false;
            $return["msg"] = $e->getError();
        }
        return $return;
    }

    /** @param AnimalVacina $animalVacina */
    public function update($animalVacina) {

        $return = array();
        $anv_int_codigo = $animalVacina->getAnv_int_codigo();
        try{
            $query = "UPDATE animal_vacina SET anv_dti_aplicacao = NOW() WHERE anv_int_codigo =";
            $query.=$anv_int_codigo." AND anv_dti_aplicacao IS NULL;";
            $mysql = new GDbMysql();
            $mysql->execute($query, null, false);
            $affectedRows = $mysql->stmt->affected_rows;
            if($affectedRows == 1){
                $return["status"] = true;
                $return["msg"] = 'Aplicacao realizada com sucesso!';
                $mysql->close();
            }else{
                $return["status"] = false;
                $return["msg"] = 'Ja foi aplicada a vacina!';
            }
        } catch (GDbException $e) {
            $return["status"] = false;
            $return["msg"] = $e->getError();
        }
        return $return;
    }
}
