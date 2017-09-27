<?php
namespace Api\Common;

use Api\Common\Setting as Setting;

class Common
{

	public static function generateText($ln = 10) {

		$text_created = array_merge( range('0', '9'), range('A', 'Z') );
		shuffle($text_created);
		$text_returnd = substr(implode($text_created), 0, $ln);

		return $text_returnd;
	}

	public static function md5encrypt($text) {

		//	text the and convert to md5
		$text_returnd = password_hash($text, PASSWORD_BCRYPT);

		return $text_returnd;
	}

	public static function crYp($text) {

		//	text the and convert to md5
		$text_returnd = md5($text);

		return $text_returnd;
	}

	function url_encode($string){
		return urlencode(utf8_encode($string));
	}

	#===================================================================================

	function url_decode($string){
		return utf8_decode(urldecode($string));
	}

	function splittext($text, $rule = "space"){
		/*
			bellow is list of rule's string
		*/
		$rules = [
			"space" => "/[\s]+/",
			"space_comar" => "/[\s,]+/",
			"comar" => "/[\,]+/",
			"words" => "/\s/",
		];

		/*
			remove whitespace in the rule's string
		*/
		$rule = preg_replace("/\s+/", "", $rule);

		/*
			use the rule's string to split the text
		*/
		$strg = preg_split($rules[ $rule ], $text, 0, PREG_SPLIT_NO_EMPTY);

		if(is_array($strg)){
			return $strg;
		}

		return null;
	}

	function replace($text, $rule = "removespaces", $str = ""){
		/*
			bellow is list of rule's string
		*/
		$rules = [
			"purenumerous" => "/\D/",
			"alphanumeric" => "/[^a-zA-Z0-9\s]/",
			"removespaces" => "/\s+/"
		];

		/*
			remove whitespace in the rule's string
		*/
		$rule = preg_replace($rules['removespaces'], "", $rule);

		/*
			use the rule's string to split the text
		*/
		$strg = preg_replace($rules[ $rule ], $str, $text);

		return $strg;
	}

	public static function pesaformat( $amount, $symbol = '', $nukta = 2 ){
		return $symbol . number_format( sprintf('%0.2f', preg_replace("/[^0-9.]/", "", $amount)), $nukta );
	}

	/*
		gets the data from a URL

		@input params
	*/
	public static function geTdata ( $url, $method = 'GET', array $data, $result = null )
	{
		/*
			-- = ----------------------------------------
			TAKE + BACKEND with MODULE PART
		*/
		$server	= Setting::Web . $url ;
		if((substr($server, 0, 7) == 'http://') || (substr($server, 0, 8) == 'https://')){
			return self::pgcurl( $server, $data, $method );
		}
	}

	public static function pgcurl( $url, array $data, $method )
	{
		$curl = new \Curl\Curl();

		$curl->setHeader("cache-control", "no-cache");
		$curl->setHeader("Authorization", ((isset($_SESSION[SCW_NAM]['jwt_token']))? $_SESSION[SCW_NAM]['jwt_token'] : "5"));
		$curl->setOpts(array(
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_TIMEOUT => 30,
		));

		switch ($method) {
			case 'get':
			case 'GET':
				$curl->get( $url, $data);
			break;
			case 'post':
			case 'POST':
				$curl->post( $url, $data);
			break;
			case 'delete':
			case 'DELETE':
				$curl->delete( $url, $data);
			break;
			case 'put':
			case 'PUT':
				$curl->put( $url, $data);
			break;
		}

		if ($curl->error) {
			//return  echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
			return null;
		} else {
			return $curl->response;
		}

		return null;
	}

}
