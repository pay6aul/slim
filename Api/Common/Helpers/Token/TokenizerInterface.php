<?php

  namespace Api\Common\Helpers\Token;

  interface TokenizerInterface {

        /**
        * token verification
        *
        * @param  String  $jwt_token
        * @return JSON  $payload
        */

        public function verifyTokenStructure($token) ;

        /**
        * Ecoding Payload with secret
        *
        * @param  Array   $payload
        * @param  String  $secret
        * @param  String  $algorithim
        * @return \Firebase\php-jwt  $jwt_token
        */

        public function encodeToken();

        /**
        * Decode a Token and return the Payload.
        *
        * @param  String $token
        * @param  String $secret
        * @param  String $algoritm
        * @return Json   $payload
        */

        public function decodeToken();

        /**
        * Crafting Json web Token Payload
        *
        * @return Void
        */

        public function setPayload();

        /**
        * Retrieve Json web Token Payload
        *
        * @return Array  $payload
        */

        public function getPayload();


        /**
        * Set Token secret
        *
        * @param String
        * @return  void
        */

        public function setSecret($secret);

        /**
        * Setting Token secret
        *
        * @return  String $secret
        */

        public function getSecret();

        /**
        * Set  User Id
        *
        * @param String
        * @return  void
        */

        public function setUserId($id);

        /**
        * Get Token User Id
        *
        * @return  String $userId
        */

        public function getUserId();

        /**
        * Set  Token Subject
        *
        * @param String
        * @return  void
        */

        public function setSubject($id);

        /**
        * Get Token Subject
        *
        * @return  String $userId
        */

        public function getSubject();



        /**
        * Setting Token Issurer
        *
        * @return  String $secret
        */

        public function getIssurer();

        /**
        * Set Token Issurer
        *
        * @param String
        * @return  void
        */

        public function setIssurer($iss);



        /**
        * Setting Token Encryption Algorithm
        *
        * @param String
        * @return  void
        */

        public function setAlgo($algorithm);

        /**
        * Get Token Encryption Algorithm
        *
        * @return  String Algorithm
        */

        public function getAlgo();

        /**
        * Set Token
        * @param String $jwt_token
        * @return  Null
        */

        public function setToken($token);

        /**
        * Get Token
        *
        * @return  String JWT
        */

        public function getToken();

        /**
        * Get Token ApiKey
        *
        * @return  String $key
        */

        public function getApiKey();

        /**
        * Get Current Time
        *
        * @return  Timestamp $time
        */

        public function getCurrentTime();

        /**
         * Get Token Expired  Time
         *
         * @return  Timestamp $ttl
         */

        public function setTokenExpiredTime($minute);

}
