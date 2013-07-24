<?php

$router = new \Phalcon\Mvc\Router();

$router->add('/', array(
'controller' => 'files',
'action' => 'index'
));

$router->add('/(files|parts)/(delete|move|add|create|edit|save)/([0-9]+)', array(
'controller' => 1,
'action' => 2,
'id' => 3
));

$router->add('/(files|parts)/([0-9]+)', array(
'controller' => 1,
'action' => 'index',
'parent' => 2
));


$router->add('/(languages|parts)', array(
'controller' => 1,
'action' => 'index'
));

$router->add('/languages/(delete)/([0-9]+)', array(
'controller' => 'languages',
'action' => 1,
'id' => 2
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

$router->add('/setup/([0-9]+)', array(
'controller' => 'setup',
'action' => 'index',
'part' => 1
));

return $router;
