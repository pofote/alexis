<?php

namespace Fufu\DimocoBundle\Dimoco\Util;

/**
 * @author Salva Nadal < salvanadal@gmail.com >
 * @version 1.0
 */

class ReturnCodes {

	private static $returnCodes = array(

		'-1'    =>	'STATUS_INVALID // Error during processing start / start-subscription.',
		'0'     =>	'STATUS_OPEN // Start-subscription was successful.',
		'1' 	=>	'STATUS_PENDING // Authorize in progress.',
		'2'	    =>	'STATUS_NOTPAID // Authorize successful.',
		'4' 	=>	'STATUS_PAID // Capture successful.',
		'5' 	=>	'STATUS_CLOSED // Transaction closed after successful capture.'

    );

	public static function getReason($code) {

		if(array_key_exists($code, self::$returnCodes)) {

			return self::$returnCodes[$code];
		} else {

			return null;
		}
	}
}