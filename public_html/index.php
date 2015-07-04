<?php
session_start();

use Propel\Runtime\Propel;
use Propel\Runtime\Connection\ConnectionManagerSingle;

require '../app/vendor/autoload.php';

// Conf
$app = new \Slim\Slim([
    'templates.path' => '../templates',
    'view' => new \Slim\Views\Twig(),
]);

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

// Paramaters for database connections
$parser = new \Symfony\Component\Yaml\Parser;
$yaml   = $parser->parse(file_get_contents(dirname(__FILE__) . '/../app/config/parameters.yml'));

// Propel
$serviceContainer = Propel::getServiceContainer();
$serviceContainer->setAdapterClass('code2be', 'mysql');
$manager = new ConnectionManagerSingle();
$manager->setConfiguration(array (
  'dsn'      => 'mysql:host='.$yaml['database']['host'].';dbname='.$yaml['database']['name'].';charset=UTF8',
  'user'     => $yaml['database']['user'],
  'password' => $yaml['database']['password'],
));
$serviceContainer->setConnectionManager('code2be', $manager);

$js = scandir(__DIR__.'/js');
$css = scandir(__DIR__.'/css');

foreach ($js as $key => $file) {
    if (in_array($file, ['.','..'])) {
        unset($js[$key]);
    } else {
        $js[$key] = 'js/'.$file;
    }
}

foreach ($css as $key => $file) {
    if (in_array($file, ['.','..'])) {
        unset($css[$key]);
    } else {
        $css[$key] = 'css/'.$file;
    }
}

$app->assets = [
    'js' => $js,
    'css' => $css
];

require '../app/routes/routes.php';

// Render
$app->run();

?>
