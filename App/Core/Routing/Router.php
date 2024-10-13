<?php

namespace App\Core\Routing;

use App\Core\Request;
use Closure;

class Router
{
  private $request;
  private $routes;
  private $current_route;

  public function __construct()
  {
    $this->request = new Request();
    $this->routes = Route::routes();
    $this->current_route = $this->findRoute($this->request) ?? null;
  }

  public function findRoute(Request $request)
  {
    foreach ($this->routes as $route) {
      if ($request->uri() == $route['uri']) {
        return $route;
      }
    }
    return null;
  }

  public function dispatch405() {
    header('HTTP/1.0 405 Method Not Allowed');
    view('errors.405');
    die();
  }

  public function dispatch404() {
    header('HTTP/1.0 404 Not Found');
    view('errors.404');
    die();
  }

  public function run()
  {
    # 405: invalid request method
    if (!in_array($this->request->method(), $this->current_route['methods']))
      $this->dispatch405();
    # 404: uri not found
    if (is_null($this->current_route))
      $this->dispatch404();

    $this->dispatch($this->current_route);
  }

  private function dispatch($route) {
    $action = $route['action'];
    # action: null
    if (is_null($action) || empty($action)) {
      return;
    }
    # action: clouser
    if ($action instanceof Closure) {
      $action();
    }
    # action: controller@method
    if (is_string($action)) {
      [$class_name, $method] = explode('@', $action);
      $this->callController($class_name, $method);
    }
    # action: ['controller', 'method']
    if (is_array($action)) {
      $this->callController($action[0], $action[1]);
    }
  }

  private function callController($class, $method)
  {
    $controllerStr = "\App\Controllers\\$class";
    $controller = new $controllerStr();
    $controller->$method();
  }
}
