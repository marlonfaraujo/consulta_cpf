<?php

namespace app\dao;

/**
* 
*/
class CPFDao
{
	protected $db;

	public function __construct()
	{
		$this->db = Connection::getConnection();
	}

	public function salvar($cpf, $status){
		$this->db->exec('insert into cpf (numero, status) values ("'. $cpf .'", '. $status .')');
	}

	public function consulta($cpf){
		$result = $this->db->querySingle('select numero, status, case when status = 1 then "FREE" else "BLOCK" end as statusDescricao from cpf where numero like "'. $cpf .'"', true);
		return $result;
	}

	public function alterarStatus($cpf, $status){
		$this->db->query('update cpf set status = '. $status .' where numero like "'. $cpf . '"');
	}
}

?>