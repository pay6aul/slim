<?php
  namespace Api\Common\Helpers;

  use Api\Common\Helpers\Token\CreateToken;
  use Api\Common\Helpers\Token\VerifyToken;
  use Api\Common\Helpers\Token\TokenizerInterface;

  final class Tokenizer {

    /**
     * @param string $type
     *
     * @return TokenizerInterface
     */

    public static function factory($type)
    {
      if($type == 'create'){
        return new CreateToken() ;
      }

      if($type == 'verify'){
        return new VerifyToken() ;
      }

      throw new \InvalidArgumentException('Unknown Token Method');
    }
  }
