<?php
class Proprietario{
	private $prop_int_codigo;
	private $prop_var_nome;
	private $prop_var_email;
	private $prop_var_telefone;


	public function getProp_int_codigo() {
		return $this->prop_int_codigo;
	}

	public function setProp_int_codigo($prop_int_codigo) {
		$this->prop_int_codigo = $prop_int_codigo;
	}

	public function getProp_var_nome() {
		return $this->prop_var_nome;
	}

	public function setProp_var_nome($prop_var_nome) {
		$this->prop_var_nome = $prop_var_nome;
    }
    
    public function getProp_var_email() {
		return $this->prop_var_email;
	}

	public function setProp_var_email($prop_var_email) {
		$this->prop_var_email = $prop_var_email;
    }
    
    public function getProp_var_telefone() {
		return $this->prop_var_telefone;
	}

	public function setProp_var_telefone($prop_var_telefone) {
		$this->prop_var_telefone = $prop_var_telefone;
	}

}