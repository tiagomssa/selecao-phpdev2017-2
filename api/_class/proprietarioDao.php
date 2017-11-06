
<?php
require_once("proprietario.php");

class ProprietarioDao {

    /** @param Proprietario $proprietario */
    public function insert($proprietario) {

        $return = array();
        $param = array(
            $proprietario->getProp_var_nome(),
            $proprietario->getProp_var_email(),
            $proprietario->getProp_var_telefone()        
            );
        try{
            $mysql = new GDbMysql();
            $mysql->execute("CALL sp_proprietario_ins('".$param[0]."','".$param[1]."','".$param[2]."', @p_status, @p_msg, @p_insert_id);", NULL, false);
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
}