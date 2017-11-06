<?php
class Animal{
	private $ani_int_codigo;
	private $ani_var_nome;
	private $ani_cha_vivo;
	private $ani_dec_peso;
	private $raca_int_codigo;
	private $prop_int_codigo;


	public function getAni_int_codigo() {
		return $this->ani_int_codigo;
	}

	public function setAni_int_codigo($ani_int_codigo) {
		$this->ani_int_codigo = $ani_int_codigo;
	}

	public function getAni_var_nome() {
		return $this->ani_var_nome;
	}

	public function setAni_var_nome($ani_var_nome) {
		$this->ani_var_nome = $ani_var_nome;
	}

	public function getAni_cha_vivo() {
		return $this->ani_cha_vivo;
	}

	public function setAni_cha_vivo($ani_cha_vivo) {
		$this->ani_cha_vivo = $ani_cha_vivo;
	}

	public function getAni_dec_peso() {
		return $this->ani_dec_peso;
	}

	public function setAni_dec_peso($ani_dec_peso) {
		$this->ani_dec_peso = $ani_dec_peso;
	}

	public function getAni_var_raca() {
		return $this->raca_int_codigo;
	}

	public function setAni_var_raca($raca_int_codigo) {
		$this->raca_int_codigo = $raca_int_codigo;
	}

	public function getAni_int_prop() {
		return $this->prop_int_codigo;
	}

	public function setAni_int_prop($prop_int_codigo) {
		$this->prop_int_codigo = $prop_int_codigo;
	}

}