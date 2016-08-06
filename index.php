<?php

use Phalcon\Mvc\Micro;
use Phalcon\Loader;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;


// Use Loader() to autoload our model
$loader = new Loader();

$loader->registerDirs(
    array(
        __DIR__ . '/models/'
    )
)->register();


// Inject Dependencies
$di = new FactoryDefault();

// Set up the database service
$di->set('db', function () {
    return new PdoMysql(
        array(
            "host"     => "localhost",
            "username" => "admin",
            "password" => "similarly-secure-password",
            "dbname"   => "customers"
        )
    );
});


// Application
$app = new Micro($di);


$app->get('/api/customers', function () use ($app) {
    $phql = "SELECT * FROM Customers ORDER BY name";
    $customers = $app->modelsManager->executeQuery($phql);

    $data = array();
    foreach ($customers as $customer) {
        $data[] = array(
            'id'   => $customer->id,
            'name' => $customer->name
        );
    }

    echo json_encode($data);
});


$app->handle();
