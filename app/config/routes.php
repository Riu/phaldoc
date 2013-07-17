<?php

$router = new \Phalcon\Mvc\Router();

$router->add('/(languages|files|parts)', array(
'controller' => 1,
'action' => 'index'
));

$router->add('/(about|settings)', array(
'controller' => 'index',
'action' => 1
));

$router->add('/lang/{lang:[a-z]{2}}', array(
'controller' => 'index',
'action' => 'lang',
'lang' => 'pl'
));

return $router;
