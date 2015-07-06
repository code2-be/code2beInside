<?php
session_start();

require '../app/vendor/autoload.php';
define('__ROOT__', dirname(__FILE__).'/..');

// Conf
$app = new \Slim\Slim([
    'templates.path' => '../templates',
    'view' => new \Slim\Views\Twig(),
]);
$app->add(new \Code2be\Middleware\Security());
// View templates
$view = $app->view();
$view->parserOptions = array(
    'debug' => true,
    'strict_variables' => true,
    'cache' => dirname(__FILE__) . '/../app/cache'
);

$view->parserExtensions = array(
    new \Twig_Extension_Debug(),
    new \Slim\Views\TwigExtension(),
);

$app->view = $view;

$twig = $app->view->getEnvironment();
$twig->addExtension(new \Code2be\Twig\Extension);

\Code2be\Connection\Connection::connect();

require '../app/routes/routes.php';

// Render
$app->run();

?>
