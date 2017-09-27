<?php

namespace Api\Common\Helpers;


class StatusUtil {

  /**
   * Unified System Status Messages
   *
   * @param String $role
   * @param String $code
   * @return String Message
   */
   public static function decodeStatusCode($role, $code)
   {

    $_data = json_decode(
      file_get_contents('./status.json'),
      true
    );
    return $_data[$role][$code] ;
   }
}
