<?php
  namespace Api\Common\Helpers;

  use Carbon\Carbon;
  use Firebase\JWT\JWT as jwt;
  use Common\Helpers\TokenConfiguration as config ;


  class TokenGenerate {

     /**
       * @var Array
       */
       private $credentials;

     /**
       * @var string
       */
       private $secret;

     /**
       * @var string
       */
       private $alg;

       public function __construct()
       {
         $this->secret = config::SECRET ;
         $this->algo = config::ALGORITHM ;
       }


      /**
       * Get the token
       *
       * @return jwt_token
       */
        public function token()
        {
          $payload  = $this->getPayload();
          $secretKey = $this->getSecret() ;
          $alg = $this->getAlg();
          return $this->encode(
            $payload,
            $secretKey,
            $alg
          );
        }


      /**
       * Generate Key
       * @param bin2hex
       * @param openssl_random_pseudo_bytes
       * @return $key
       */

       private function getApiKey()
       {
          return bin2hex(openssl_random_pseudo_bytes(16));
       }

     /**
      * Decode a Token and return the Payload.
      *
      * @param  \firebase\JWT $token
      * @return base_64_encoded $token
      */
      private function encode($payload, $secret, $algo)
      {
        return jwt::encode($payload, $secret);
      }


    /**
     * Decode a Token and return the Payload.
     *
     * @param  \firebase\JWT $token
     * @return base_64_encoded $token
     */
      private function getPayload()
      {
        $payload = $this->getCredentials();
        return $payload;
      }

      /**
       * Get the Carbon instance for the current time.
       *
       * @return \Carbon\Carbon
       */
      private static function getCurrentTime()
      {
          return Carbon::now();
      }

    /**
      * Set time Elapsed
      * @param currentTime
      * @param time-window in minutes
      * @return expiry time
      */
       private function setTokenExpiredTime($minutes=1)
       {
          return Carbon::now() + ($minutes * 60) ;
       }


      /**
       * Get the Carbon instance for the timestamp.
       *
       * @param  int  $timestamp
       * @return \Carbon\Carbon
       */
      private static function timestamp($timestamp)
      {
          return Carbon::createFromTimeStampUTC($timestamp);
      }



    /**
     * Get the value of Claims
     *
     * @return string
     */
    public function getCredentials()
    {
      $credentials = array(
        "iss" => "http://example.org",
        "aud" => $this->getApiKey(),
        "sub" => 'Authorization',
        "username" => 'username',
        "iat" => $this->getCurrentTime(),
        "nbf" => $this->setTokenExpiredTime()
      );
      $this->credentials = $credentials;
      return $this->credentials;
    }

    /**
     * Get the value of Secret
     *
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * Get the value of Alg
     *
     * @return string
     */
    public function getAlg()
    {
        return $this->alg;
    }

}
