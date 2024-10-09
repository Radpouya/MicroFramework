<?php

namespace App\Utilities;

class Asset
{
  public static function get(string $route)
  {
    return $_ENV['HOST'] . 'assets/' . $route;
  }

  public static function __callStatic(string $name, array $arguments)
  {
    return self::get($name . '/' . $arguments[0]);
  }
}