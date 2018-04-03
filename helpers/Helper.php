<?php

namespace app\helpers;

class Helper
{
	public static function getBootTime() {

    	$tmp = explode(' ', file_get_contents('/proc/uptime'));
    	return time() - intval($tmp[0]);
	}
}

?>