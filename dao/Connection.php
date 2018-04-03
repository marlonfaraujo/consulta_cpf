<?php

namespace app\dao;

use SQLite3;

class Connection
{
	private static $instance = null;

	private function __construct(){

	}

	public static function getConnection(){
		if(self::$instance === null){

			self::$instance = new SQLite3(__DIR__ . '/consulta_cpf.db');
			self::$instance->exec('CREATE TABLE IF NOT EXISTS cpf (numero TEXT, status INTEGER)');
			self::$instance->exec('CREATE TABLE IF NOT EXISTS historico (numero TEXT, status INTEGER, data FLOAT)');	
			
		}
		return self::$instance;
	}
}

?>