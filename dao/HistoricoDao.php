<?php

namespace app\dao;

class HistoricoDao
{
	protected $db;

	public function __construct()
	{
		$this->db = Connection::getConnection();
	}

	public function quantidadeBlacklist(){
		return $this->db->querySingle('select count(*) as blacklist
		 from cpf where status = 2', true)['blacklist'];
	}

	public function quantidadeConsultas($time){
		return $this->db->querySingle('select count(*) as consultas
		 from historico where data > ' . $time, true)['consultas'];
	}

	public function gravar($cpf, $status, $data){
		$result = $this->db->exec('insert into historico (numero, status, data) values ("'. $cpf .'", '. $status .', '. $data .')');
		
	}
}

?>