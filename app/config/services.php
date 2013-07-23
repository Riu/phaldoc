<?php


/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new \Phalcon\DI\FactoryDefault();

/**
 * The config service return array with configuration
 */
$di->set('config', function () use ($config) {
    return $config;
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->set('url', function() use ($config) {
	$url = new \Phalcon\Mvc\Url();
	$url->setBaseUri($config->application->baseUri);
	return $url;
});

/**
 * Setting up the view component
 */

$di->set('view', function() use ($config){
	$view = new \Phalcon\Mvc\View();
	$view->setViewsDir($config->application->viewsDir);
	$view->setTemplateBefore('main');
	$view->registerEngines(array(
		'.volt' => function($view, $di) use ($config) {
			$volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);
			$volt->setOptions(array(
				'compiledPath' => $config->application->cacheDir.'volt/',
				'compiledExtension' => '.php'
			));
			return $volt;
		}
	));
	return $view;
}, true);

/**
 * Database connection is created based in the parameters defined in the configuration file
 */

$di->set('db', function() use ($config) {
	$connection = new \Phalcon\Db\Adapter\Pdo\Mysql(array(
		"host" => $config->database->host,
		"username" => $config->database->username,
		"password" => $config->database->password,
		"dbname" => $config->database->dbname,
		"charset" => $config->database->charset,
		"collation" => $config->database->collation
	));
	return $connection;
});

/**
 * Start the session the first time some component request the session service
 */
$di->set('session', function() {
	$session = new \Phalcon\Session\Adapter\Files();
	$session->start();
	return $session;
});

/**
* Loading routes from the routes.php file
*/
$di->set('router', function() {
	return require __DIR__ . '/routes.php';
});

/**
* Flash service with custom CSS classes
*/
$di->set('flash', function(){
	$flash = new \Phalcon\Flash\Direct(array(
		'error' => 'alert alert-error',
		'success' => 'alert alert-success',
		'notice' => 'alert alert-info',
	));
	return $flash;
});

$di->set('flashSession', function(){
	return new \Phalcon\Flash\Session(array(
		'error' => 'alert alert-error',
		'success' => 'alert alert-success',
		'notice' => 'alert alert-info',
	));
});

/**
 * Cookies service
 */
$di->set('cookies', function() use ($di){
	$cookies = new \Phalcon\Http\Response\Cookies();
	$cookies->useEncryption(false);
	return $cookies;
});


/**
 * Dispatcher
 */

$di->set('dispatcher', function() use ($di) {
	$dispatcher = new \Phalcon\Mvc\Dispatcher();
	return $dispatcher;
});

/**
 * Models Manager
 */
$di->set('modelsManager', new \Phalcon\Mvc\Model\Manager());

/**
 * Storage docs
 */
$di->set('storage', function() use ($config){
    return new Storage($config->application->docsDir);
}, true);
