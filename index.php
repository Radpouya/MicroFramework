<?php

use App\Utilities\Url;

include 'bootstrap/init.php';

$route = Url::current_route();
echo $route;
