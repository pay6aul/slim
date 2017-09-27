<?php
  namespace Api\Common\Helpers\Token;

  use Carbon\Carbon;
  use Firebase\JWT\JWT as jwt;
  use Api\Common\Helpers\Token\Configuration;


  class VerifyToken implements TokenizerInterface {

        /**
         * Token Secret
         *
         * @var String
         */
         protected $iss;

         /**
          * Token Userid
          *
          * @var String
          */
          protected $userId;

        /**
         * Token Secret
         *
         * @var String
         */
         protected $secret;

         /**
          * Token Subject
          *
          * @var String
          */
          protected $sub;

         /**
          * Token Algorithms
          *
          * @var String
          */
         protected $algorithm;

         /**
          * Json Web Token
          *
          * @var String
          */
         protected $token ;


         /**
          * Json Web Token Payload
          *
          * @var Array
          */
         protected $payload = [] ;


         /**
          * Json Web Token Time To Live (TTL)
          *
          * @var Interger
          */
         protected $ttl ;

         public function __construct()
         {
           $this->setSecret(Configuration::SECRET);
           $this->setAlgo(Configuration::ALGORITHM);
           $this->setTokenExpiredTime(Configuration::TTL);
           $this->setIssurer(Configuration::ISS) ;
           $this->setSubject(Configuration::SUB);
         }


         /**
          * Verify  JWT Token
          *
          *@param  String $token
          * @return String $token
          */

          public function verify($token)
          {

            $this->verifyTokenStructure($token);
            $payload = $this->decodeToken();
            $userId = $payload[0]->userId;
            return $this->resultArray(
                'ok',
                'valid token',
                 array('userId' => $userId)
             );
          }



        /**
        * token verification
        *
        * @param  \Firebase\php-jwt  $jwt_token
        * @return JSON  $payload
        */

        public function verifyTokenStructure($token)
        {
          $parts = explode('.', $token);
          $parts = array_filter(array_map('trim', $parts));
          if (count($parts) !== 3 || implode('.', $parts) !== $token) {
              return $this->resultArray('failed', 'wrong token parts') ;
          }
          return $this->setToken($token) ;
        }

        /**
        * Ecoding Payload with secret
        *
        * @param  Array   $payload
        * @param  String  $secret
        * @param  String  $algorithim
        * @return \Firebase\php-jwt  $jwt_toke
        */

        public function encodeToken(){}

        /**
        * Decode a Token and return the Payload.
        *
        * @param  String $token
        * @param  String $secret
        * @param  String $algoritm
        * @return Json   $payload
        */

        public function decodeToken()
        {
          return jwt::decode(
            $this->getToken(),
            $this->getSecret(),
            array($this->getAlgo())
          );
        }

        /**
        * Creating Json web Token Payload
        *
        * @param Array
        * @return Void
        */

        public function setPayload(){}

        /**
        * Retrieve Json web Token Payload
        *
        * @return Array  $payload
        */

        public function getPayload()
        {
           return $this->payload ;
        }

        /**
        * Setting Token Issurer
        *
        * @param String
        * @return  void
        */

        public function setIssurer($iss)
        {
          $this->iss = $iss;
        }

        /**
        * Setting Token secret
        *
        * @return  String $secret
        */

        public function getIssurer()
        {
           return $this->iss ;
        }


        /**
        * Setting Token secret
        *
        * @param String
        * @return  void
        */

        public function setSecret($secret)
        {
          $this->secret = $secret;
        }

        /**
        * Setting Token secret
        *
        * @return  String $secret
        */

        public function getSecret()
        {
           return $this->secret ;
        }

        /**
        * Setting Token Encryption Algorithm
        *
        * @param String
        * @return  void
        */

        public function setAlgo($algorithim)
        {
          $this->algorithm = $algorithim ;
        }

        /**
        * Get Token Encryption Algorithm
        *
        * @return  String Algorithm
        */

        public function getAlgo()
        {
          return $this->algorithm;
        }

        /**
        * Set  Token Subject
        *
        * @param String
        * @return  void
        */

        public function setSubject($sub)
        {
          $this->sub = $sub;
        }

        /**
        * Get Token Subject
        *
        * @return  String $userId
        */

        public function getSubject()
        {
          return $this->sub;
        }

        /**
        * Set  User Id
        *
        * @param String
        * @return  void
        */

        public function setUserId($id)
        {
          $this->userId = $id ;
        }

        /**
        * Get Token User Id
        *
        * @return  String $userId
        */

        public function getUserId()
        {
          return $this->userId ;
        }

        /**
        * Set Token
        * @param String $jwt_token
        * @return  Null
        */

        public function setToken($token)
        {
          $this->token = $token;
        }

        /**
        * Get Token
        *
        * @return  String $token
        */

        public function getToken()
        {
          return $this->token ;
        }

        /**
        * Get Token ApiKey
        *
        * @return  String $key
        */

        public function getApiKey(){}

        /**
        * Get Current Time
        *
        * @return  \Carbon  $time
        */

        public function getCurrentTime(){}

        /**
         * Set Token Expired  Time
         *
         * @param Integer
         * @return  Null
         */

        public function setTokenExpiredTime($minute){}

        /**
         * Get Token Expired  Time
         *
         * @return  Integer
         */

        public function getTokenExpiredTime(){}

        /**
         * Private Result Array Initilizer
         * Utility function
         *
         * @return Array $result
         */

         private function resultArray($status="", $msg="", $data=[]){
           $res =  array(
             "status" => $status,
             "msg"    => $msg,
             "data"   => $data
           );
           return json_encode($res) ;
         }

         private function sysOut($obj) {
           var_dump($obj) ;
           die();
         }
    }
