<?php
  namespace Api\Common\Helpers\Token;

  interface Configuration  {

    /*
    |--------------------------------------------------------------------------
    | Token Issurer
    |--------------------------------------------------------------------------
    | Specify the token issurer this will be set as a domain name of the
    | site that will be issuing the token eg. https:\\www.rmp.costech.or.tz
    |
    */
    const ISS =  'https:\\www.mrlenga.com';

    /*
    |--------------------------------------------------------------------------
    | Token Subject
    |--------------------------------------------------------------------------
    | Specify the token issurer this will be set as a domain name of the
    | site that will be issuing the token eg. https:\\www.mrlenga.com
    |
    */
    const SUB =  'Authorization';



    /*
    |--------------------------------------------------------------------------
    | JWT Authentication Secret
    |--------------------------------------------------------------------------
    |
    | Don't forget to set this, as it will be used to sign your tokens.
    | A helper command is provided for this: `php artisan jwt:generate`
    |
    */
    const SECRET =  'oNNChXZJdhrB5wEivNRDRyHudKHocV7N';
    /*
    |--------------------------------------------------------------------------
    | JWT time to live
    |--------------------------------------------------------------------------
    |
    | Specify the length of time (in minutes) that the token will be valid for.
    | Defaults to 1 hour
    |
    */
    const TTL =  60 ;
    /*
    |--------------------------------------------------------------------------
    | Refresh time to live
    |--------------------------------------------------------------------------
    |
    | Specify the length of time (in minutes) that the token can be refreshed
    | within. I.E. The user can refresh their token within a 2 week window of
    | the original token being created until they must re-authenticate.
    | Defaults to 2 weeks
    |
    */
    const REFRESH_TTL =  20160 ;

    /*
    |--------------------------------------------------------------------------
    | JWT hashing algorithm
    |--------------------------------------------------------------------------
    |
    | Specify the hashing algorithm that will be used to sign the token.
    |
    | See here: https://github.com/namshi/jose/tree/2.2.0/src/Namshi/JOSE/Signer
    | for possible values
    |
    */
    const ALGORITHM  =  'HS256' ;

  }
