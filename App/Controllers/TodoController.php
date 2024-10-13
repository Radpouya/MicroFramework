<?php
namespace App\Controllers;

class TodoController {
  public function list() {
    $data = [
      'tasks' => ['firstTask', 'secondTask', 'thirdTask', '7thTask']
    ];
    view('todo.list', $data);
  }
}