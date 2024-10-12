<?php
use App\Core\Routing\Route;

Route::get('/null');
Route::add(['get', 'post'], '/', function () {
  echo "welcome";
});
Route::post('/saveForm', function () {
  echo "save ok";
});
Route::put('/pururi', ['Controller', 'Method']);
Route::get('/pururi', 'Controller@Method');
