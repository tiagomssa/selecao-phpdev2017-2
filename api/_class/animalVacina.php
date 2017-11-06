<?php
class AnimalVacina{
	
	private $anv_int_codigo;
	/* @var $animal Animal */
	private $animalCod;
	/* @var $vacina Vacina */
	private $vacinaCod;
	private $anv_dat_programacao;
	private $anv_dti_aplicacao;
	/* @var $usuario Usuario */
	private $usuarioCod;


	public function getAnv_int_codigo() {
		return $this->anv_int_codigo;
	}

	public function setAnv_int_codigo($anv_int_codigo) {
		$this->anv_int_codigo = $anv_int_codigo;
	}

	/** @return Animal */
	public function getAnimalCod() {
		return $this->animalCod;
	}

	/** @param Animal $animal */
	public function setAnimalCod($animalCod) {
		$this->animalCod = $animalCod;
	}

	/** @return Vacina */
	public function getVacinaCod() {
		return $this->vacinaCod;
	}

	/** @param Vacina $vacina */
	public function setVacinaCod($vacinaCod) {
		$this->vacinaCod = $vacinaCod;
	}

	public function getAnv_dat_programacao() {
		return $this->anv_dat_programacao;
	}

	public function setAnv_dat_programacao($anv_dat_programacao) {
		$this->anv_dat_programacao = $anv_dat_programacao;
	}

	public function getAnv_dti_aplicacao() {
		return $this->anv_dti_aplicacao;
	}

	public function setAnv_dti_aplicacao($anv_dti_aplicacao) {
		$this->anv_dti_aplicacao = $anv_dti_aplicacao;
	}

	/** @return Usuario */
	public function getUsuarioCod() {
		return $this->usuarioCod;
	}

	/** @param Usuario $usuario */
	public function setUsuarioCod($usuarioCod) {
		$this->usuarioCod = $usuarioCod;
	}

}
