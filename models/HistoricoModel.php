<?php

namespace app\models;

use app\dao\HistoricoDao;
use DateTime;
use app\helpers\Helper;

class HistoricoModel
{

	public $uptime;
	public $blacklist;
	public $consultas;

	public function historico(){

		$historicoDao = new HistoricoDao();
		
		$time = Helper::getBootTime();

		$this->blacklist = $historicoDao->quantidadeBlacklist();
		$this->consultas = $historicoDao->quantidadeConsultas($time);
		
		$dataAtual = new DateTime();
		$dateUptime = new DateTime();
		$dateUptime->setTimestamp($time);
		//$this->uptime = $dateUptime->format('d/m/Y H:i:s');
		
		$dateDiff = $dateUptime->diff($dataAtual);
		$this->uptime = $dateDiff->format("%D %H:%I:%S");
		
		return $this;
	}
}

?>