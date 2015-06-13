<?php
error_reporting(E_ALL);
$config = new \Phalcon\Config\Adapter\Ini('../config/config.ini');
$routers = new \Phalcon\Config\Adapter\Ini('../config/router.ini');
$di = new \Phalcon\DI\FactoryDefault();
$namespace = array();
$loader = new \Phalcon\Loader();
if(!empty($config->library)) 
{
    foreach($config->library as $name => $patch) 
    {
                $namespace[$name] = '../'.$config->app->library.$patch;
    }
}
$loader->registerNamespaces($namespace);
$loader->register();

$di->setShared('config', function () use ($config) {
    return $config;
});

$di->setShared('crypt', function() use ($config) {
    $crypt = new \Phalcon\Crypt();
    $crypt->setKey($config->app->cookieHash); 
    return $crypt;
});

$di->setShared('cookies', function() {
    $cookies = new \Phalcon\Http\Response\Cookies();
    return $cookies;
});

$di->setShared('session', function() {
    $session = new \Phalcon\Session\Adapter\Files();
    $session->start();
    return $session;
});

//Specify routes for modules
$di->setShared('router', function () use ($config, $routers) {
    $router = new \Phalcon\Mvc\Router(false);
    $router->clear();
    $router->removeExtraSlashes(true);
    $router->clear();
    $router->setDefaultModule($config->app->defaultApp);
    $router->setDefaultController($config->app->defaultController);
    $router->setDefaultAction($config->app->defaultAction);
    if(!empty($routers)) {
        foreach($routers as $name => $rule) {
            $pattern = $rule->pattern;
            unset($rule->pattern);
            $router->add($pattern, $rule->toArray())->setName($name);
       }
    }
    return $router;

});

$di->setShared('db', function() use ($config) {
    $connection = new \Phalcon\Db\Adapter\Pdo\Mysql(array(
        "host" => $config->database->host,
        "username" => $config->database->username,
        "password" => $config->database->password,
        "dbname" => $config->database->name,
        "charset" => $config->database->charset,
        "collation" => $config->database->collation
    ));
    return $connection;
});

$di->set('modelsManager', new \Phalcon\Mvc\Model\Manager());

$di->setShared('url', function() use ($config) {
    $url = new \Phalcon\Mvc\Url();
    $url->setBaseUri($config->app->base);
    return $url;
});

try 
{

    $application = new Phalcon\Mvc\Application();
    $application->setDI($di);

    if(!empty($config->apps)) 
    {
        foreach($config->apps as $name => $app) 
        {
            $apps[$name] = array(
                'className' => $app.'\Module',
                'path'      => '../'.$config->app->apps.$name.DIRECTORY_SEPARATOR.'Module.php'
            );
        }
    } 

    $application->registerModules($apps);
    echo $application->handle()->getContent();
} 
catch(Exception $e) 
{
    echo $e->getMessage();
}
