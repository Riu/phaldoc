<?php

$router = new \Phalcon\Mvc\Router();

$router->add('/:action', array(
'controller' => 'index',
'action' => 1
));

$router->add('/lang/{lang:[a-z]{2}}', array(
'controller' => 'index',
'action' => 'lang',
'lang' => 'pl'
));

return $router;
