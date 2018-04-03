<?php

namespace app\exceptions;

use Exception;

class CPFException extends \Exception
{
	public $code;
	public $message;

	public function __construct($code, $message){
		$this->code = $code;
		$this->message = $message;
	}

}