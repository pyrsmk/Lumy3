<?php

use Symfony\Component\ClassLoader\Psr4ClassLoader;

########################################################### Prepare

error_reporting(E_ALL);

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/vendor/autoload.php';

$loader = new Psr4ClassLoader;
$loader->addPrefix('Lumy\\', '../src');
$loader->register();

ob_start();

########################################################### Tests

$app = new Lumy\App();

$app['twig'] = $app->service(function($app) {
  $loader = new Twig_Loader_Filesystem('.');
  return new Twig_Environment($loader, ['debug', true]);
});

$app->get('/', function($request, $response) {
	return $this['twig']->render('index.twig');
});

$app->run();