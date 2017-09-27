<?php
//  USE TOKENIZER
use Api\Common\Tokenizer as Tokenizer;

/*
    Here is for a user to success movin to the route
    HTTP_AUTHORIZATION is required
*/

$mdw = function ($request, $response, $next) {
    $thetoken = Tokenizer::verifyToken( $request->getHeader('HTTP_AUTHORIZATION') );

    if($thetoken != null){
        /*
            Here we store the session of token result into
            request variable
            $request->mdt = $thetoken->data->userId ;
        */
        $response = $next($request->withAttribute("user_token_id", $thetoken->data->userId), $response);
    }

	return $response;
};
