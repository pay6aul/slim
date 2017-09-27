<?php
namespace Api\Common;



class Tokenizer
{

	public static function verifyToken($thetoken){

		/*
			jwt_token, userGroup, username, userId
		*/
	    $token = \Api\Common\Helpers\Tokenizer::factory('verify') ;
		if(isset($thetoken[0])){

			$rsons = json_decode($token->verify($thetoken[0]));
			if(isset($rsons->data->userId)){
				return $rsons;
			}
		}

		return null;
	}

	public static function verifyPwd($entered_password, $db_password){

		if(password_verify( $entered_password, $db_password )){
			return 'success';
		}

		return null;
	}

}
