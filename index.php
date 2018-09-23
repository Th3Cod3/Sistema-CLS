<?php 

require_once 'vendor/autoload.php';
include_once 'config.php';
session_start();
$baseDir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
$baseUrl = 'http://' . $_SERVER['HTTP_HOST'] . $baseDir;
define('BASE_URL', $baseUrl);


$route = $_GET['route'] ?? '/';



$router = new Phroute\Phroute\RouteCollector();

$router->filter('auth', function(){
	if(!isset($_SESSION['member_id'])){
		header('Location: ' . BASE_URL . 'login');
		return false;
	}
});


$router->controller('/', App\Controllers\IndexController::class);

$router->group(['before' => 'auth'], function ($router) {
  $router->controller('points', App\Controllers\System\EventsController::class);
	$router->controller('points/card', App\Controllers\System\PointsController::class);
	$router->controller('admin', App\Controllers\System\AdminController::class);
	
});



$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $route);

echo $response;
?>