<?php

namespace App\Core;

class Request {
  private $params;
  private $method;
  private $agent;
  private $ip;
  private $uri;

  public function __construct() {
    $this->params = $_REQUEST;
    $this->method = strtolower($_SERVER['REQUEST_METHOD']);
    $this->agent = $_SERVER['HTTP_USER_AGENT'];
    $this->ip = $_SERVER['REMOTE_ADDR'];
    $this->uri = strtok($_SERVER['REQUEST_URI'], '?');
  }

  public function __get(string $name) {
    return $this->params[$name] ?? null;
  }

  public function uri() {
    return $this->uri;
  }

  public function method() {
    return $this->method;
  }

  public function params() {
    return $this->params;
  }
  public function agent() {
    return $this->agent;
  }
  public function ip() {
    return $this->ip;
  }

  public function input($key) {
    return $this->params[$key] ?? null;
  }

  public function isset($key) {
    return isset($this->params[$key]);
  }

  public function redirect($route) {
    header("Location: " . site_url($route));
    die();
  }
}
