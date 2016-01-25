<?php

$router = new \Phalcon\Mvc\Router(false);
$router->setDefaultController('index');
$router->setDefaultAction('index');
$router->setDefaultNamespace('Controllers');
$router->notFound([
    'controller' => 'Index',
    'action'=> 'error'
]);
$router->add(
    '/{id:[0-9]+}', [
        'controller' => 'index',
        'action' => 'index'
]);
$router->add('/', [
    'controller' => 'index',
    'action' => 'index'
]);
$router->add('/login', [
    'controller' => 'index',
    'action' => 'login'
]);
$router->add('/logout', [
    'controller' => 'index',
    'action' => 'logout'
]);
$router->add('/(person|phone|place|user|position)', [
    'controller' => 1,
    'action' => 'index',
]);
$router->add('/(person|phone|place|user|position)/([0-9]+)', [
    'controller' => 1,
    'action' => 'index',
    'params' => 2,
]);
$router->add('/(person|phone|place|user|position)/(add|edit|delete|index|search|copy|order)', [
    'controller' => 1,
    'action' => 2,
]);
$router->add('/(person|phone|place|user|position)/(add|edit|delete|index|search|copy)/([0-9]+)', [
    'controller' => 1,
    'action' => 2,
    'params' => 3,
]);

return $router;