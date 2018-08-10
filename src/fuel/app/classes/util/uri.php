<?php

class Util_Uri {
  public static function getHostname () {
    $uri = Uri::base(false);
    $pattern = '/.+:\/\/(.*)\//';
    preg_match($pattern, $uri, $result);
    return $result[1];
  }

  public static function getOilPath () {
    return realpath(APPPATH.'/../../').DIRECTORY_SEPARATOR;
  }

}