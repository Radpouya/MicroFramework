<?php

namespace App\Core;

use App\Utilities\Url;

class StupidRouter {
  private array $routes;

  public function __construct()
  {
    $this->routes = [
      '/hasan/blue' => 'colors/blue.php',
      '/hasan/red' => 'colors/red.php',
      '/hasan/green' => 'colors/green.php',
    ];
  }

  public function run() {
    $current_route = Url::current_route();
    foreach ($this->routes as $route => $view) {
      if ($current_route == $route)
        $this->includeAndDie(BASE_PATH . "views/$view");
    }

    header("HTTP/1.0 404 Not Found");
    $this->includeAndDie(BASE_PATH . "views/errors/404.php");
  }

  private function includeAndDie($viewPath) {
    include $viewPath;
    die();
  }
}
