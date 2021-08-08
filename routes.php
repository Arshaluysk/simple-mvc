<?php 

$routes = [
    'login' => array('controller' => 'LoginController', 'method'=> 'index', 'req'=> 'GET' ),
    'log-out' => array('controller' => 'LoginController', 'method'=> 'logout', 'req'=> 'GET' ),
    'login-store' => array('controller' => 'LoginController', 'method'=> 'login', 'req'=> 'POST' ),
    'register' => array('controller' => 'RegisterController', 'method'=> 'index', 'req'=> 'GET' ),
    'register-store' => array('controller' => 'RegisterController', 'method'=> 'register', 'req'=> 'POST' ),
    'task' => array('controller' => 'TaskController', 'method'=> 'index', 'req'=> 'GET' ),
    'admin-task' => array('directory'=> 'admin', 'controller' => 'TaskController', 'method'=> 'index', 'req'=> 'GET' ),
    'task-list' => array('controller' => 'TaskController', 'method'=> 'getlist', 'req'=> 'POST' ),
    'task-create' => array('controller' => 'TaskController', 'method'=> 'create', 'req'=> 'GET' ),
    'task-store' => array('controller' => 'TaskController', 'method'=> 'store', 'req'=> 'POST' ),
    'task-edit' => array('directory'=> 'admin','controller' => 'TaskController', 'method'=> 'edit', 'req'=> 'POST' )
];
