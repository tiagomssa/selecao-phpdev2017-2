
<?php
require_once("animal.php");

class AnimalDao {
    /** @param Animal $animal */
    public function selectByIdForm($animal) {
        $ret = array();
        try {
            $mysql = new GDbMysql();
            $mysql->execute("SELECT ani_int_codigo,ani_var_nome,ani_cha_vivo,ani_dec_peso,raca_int_codigo, prop_int_codigo FROM vw_animal WHERE ani_int_codigo = ? ", array("i", $animal->getAni_int_codigo()), true, "");
            if ($mysql->fetch()) {
                $ret = $mysql->res;
            }
            $mysql->close();
        } catch (GDbException $e) {
            echo $e->getError();
        }
        return $ret;
    }

    /** @param Animal $animal */
    public function insert($animal) {

        $return = array();
        $param = array(
            $animal->getAni_var_nome(),
            $animal->getAni_dec_peso(),
            $animal->getAni_var_raca(),
            $animal->getAni_cha_vivo(),
            $animal->getAni_int_prop()           
            );
            $param[1] = str_replace(',', '.', $param[1]);
        try{
            $mysql = new GDbMysql();
            $mysql->execute("CALL sp_animal_ins('".$param[0]."',".$param[1].",".$param[2].",'".$param[3]."',".$param[4].", @p_status, @p_msg, @p_insert_id);", null, false);
            $mysql->execute("SELECT @p_status, @p_msg, @p_insert_id");
            $mysql->fetch();
            $return["status"] = ($mysql->res[0]) ? true : false;
            $return["msg"] = $mysql->res[1];
            $return["insertId"] = $mysql->res[2];
            $mysql->close();
        } catch (GDbException $e) {
            $return["status"] = false;
            $return["msg"] = $e->getError();
        }
        return $return;
    }

    /** @param Animal $animal */
    public function update($animal) {

        $return = array();
        $ani_var_nome = $animal->getAni_var_nome();
        $ani__int_codigo = strval($animal->getAni_int_codigo());
        $ani__dec_peso = strval($animal->getAni_dec_peso());
        $raca_int_codigo = strval($animal->getAni_var_raca());
        $prop_int_codigo = strval($animal->getAni_int_prop());
        $ani_cha_vivo = $animal->getAni_cha_vivo();
        try{
            $query = "UPDATE animal SET ani_var_nome ='".$ani_var_nome."',";
            $query.="ani_cha_vivo = '".$ani_cha_vivo."',";
            $query.="ani_dec_peso = ".str_replace(',', '.', $ani__dec_peso).",";
            $query.="raca_int_codigo = ".$raca_int_codigo.", ";
            $query.="prop_int_codigo = ".$prop_int_codigo." ";
            $query.= "WHERE ani_int_codigo =".$ani__int_codigo.";";
            $mysql = new GDbMysql();
            if(!empty($ani__int_codigo) && !empty($ani_var_nome) && !empty($ani_cha_vivo) && !empty($ani__dec_peso) && !empty($raca_int_codigo))
            {
                $mysql->execute($query, null, false);
                $return["status"] = true;
                $return["msg"] = "Animal alterado com Sucesso!";
                $mysql->close();
            }
            
        } catch (GDbException $e) {
            $return["status"] = false;
            $return["msg"] = $e->getError();
        }
        return $return;
    }

    /** @param Animal $animal */
    public function delete($animal) {

        $return = array();
        $param = array("i",$animal->getAni_int_codigo());
        try {
            $mysql = new GDbMysql();
            $mysql->execute("CALL sp_animal_del(?, @p_status, @p_msg);", $param, false);
            $mysql->execute("SELECT @p_status, @p_msg");
            $mysql->fetch();
            $return["status"] = ($mysql->res[0]) ? true : false;
            $return["msg"] = $mysql->res[1];
            $mysql->close();
        } catch (GDbException $e) {
            $return["status"] = false;
            $return["msg"] = $e->getError();
        }
        return $return;
    }
}