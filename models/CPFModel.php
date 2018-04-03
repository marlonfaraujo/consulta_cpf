<?php

namespace app\models;

use app\dao\CPFDao;
use app\dao\HistoricoDao;
use app\exceptions\CPFException;
use DateTime;

class CPFModel
{

	public $numero;
	public $status;

	public function salvar($cpf, $status){
		if(empty($cpf))
			throw new CPFException(-1,'CPF inválido');

		$dao = new CPFDao();
		
		$item = $dao->consulta($cpf);
		if(count($item) > 0){
			throw new CPFException(-1,'CPF duplicado');
		}

		$dao->salvar($cpf, $status);
	}

	public function consulta($cpf){
		if(empty($cpf))
			throw new CPFException(-1,'CPF inválido');
		
		$dao = new CPFDao();
		$item = $dao->consulta($cpf);

		$date = new DateTime();
		$historicoDao = new HistoricoDao();
		$historicoDao->gravar($item['numero'], $item['status'], $date->getTimestamp());

		return $item;
	}

	public function alterarStatus($cpf, $status){
		if(empty($cpf))
			throw new CPFException(-1,'CPF inválido');

		$dao = new CPFDao();
		$dao->alterarStatus($cpf, $status);

		return $dao->consulta($cpf);
	}
}

?>