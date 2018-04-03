<?php
namespace app\routes;

require("../vendor/autoload.php");

use app\models\CPFModel;
use app\models\HistoricoModel;
use app\exceptions\CPFException;

$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
	case 'GET':
		if(!empty($_GET['q'])){
			if(strcasecmp($_GET['q'], 'status') >= 0){
				historico();	
			}else{
				consulta(preg_replace('/[^0-9]/s', '', $_GET['q']));
			}
		}
		break;
	case 'POST':
		$json = file_get_contents('php://input');
		$params = json_decode($json);

		if($params != null && !empty($params->numero) && $params->status > 0){
			salvar(preg_replace('/[^0-9]/s', '', $params->numero), $params->status);
		}else{
			header('HTTP/1.1 500 Internal Server Error');
			echo json_encode(new CPFException(-1, 'Os campos CPF e Status são obrigatórios.'));
		}
		break;
	case 'PUT':
		$json = file_get_contents('php://input');
		$params = json_decode($json);
		alterarStatus(preg_replace('/[^0-9]/s', '', $params->numero), $params->status);
		break;
	case 'DELETE':
		break;
	default:
		break;
}

function salvar($cpf, $status){
	try{
		$model = new CPFModel();
		$model->salvar($cpf, $status);
	}catch(CPFException $e){
		header('HTTP/1.1 500 Internal Server Error');
		echo json_encode($e);
	}
}

function consulta($cpf){
	try{
		$model = new CPFModel();
		$items = $model->consulta($cpf);

		if (count($items) == 0){
			echo json_encode(array('items' => []));		
		}else{	
			echo json_encode(array('items' => array($items)));
		}
	}catch(CPFException $e){
		header('HTTP/1.1 500 Internal Server Error');
		echo json_encode($e);
	}
}

function alterarStatus($cpf, $status){
	try{
		$model = new CPFModel();
		echo json_encode(array('items' => array($model->alterarStatus($cpf, $status))));
	}catch(CPFException $e){
		header('HTTP/1.1 500 Internal Server Error');
		echo json_encode($e);
	}
}

function historico(){
	$model = new HistoricoModel();
	echo json_encode(array($model->historico()));
}


?>