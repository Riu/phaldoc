<?php

$router = new \Phalcon\Mvc\Router();

$router->add('/', array(
'controller' => 'files',
'action' => 'index'
));

$router->add('/files/(delete|move|add|create)/([0-9]+)', array(
'controller' => 'files',
'action' => 1,
'id' => 2
));

$router->add('/files/([0-9]+)', array(
'controller' => 'files',
'action' => 'index',
'parent' => 1
));


$router->add('/(languages|parts)', array(
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

$router->add('/setup/([0-9]+)', array(
'controller' => 'setup',
'action' => 'index',
'part' => 1
));

return $router;
