<?php

use Phalcon\Mvc\Micro;
use Phalcon\Loader;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;


$settings = [];

if (gethostname() == "vagrant") {
    $settings = [
        "mysql" => [
                "host"     => "127.0.0.1",
                "port"     => 3306,
                "username" => "admin",
                "password" => "similarly-secure-password",
                "dbname"   => "customers"
                ]
        ];
}
else {
    $settings = [
        "mysql" => [
                "host"     => "172.17.0.5",
                "port"     => 3306,
                "username" => "admin",
                "password" => "similarly-secure-password",
                "dbname"   => "customers"
                ]
        ];
}


// Use Loader() to autoload our model
$loader = new Loader();

$loader->registerDirs(
    array(
        __DIR__ . '/models/'
    )
)->register();


// Inject Dependencies
$di = new FactoryDefault();

// it is no possible to set config to the settings array directly
// and Phalcon\\Config cannot be passed into Pdo\Mysql
$di->set('config', function() use ($settings) { return $settings; });

// Set up the database service
$di->set('db', function () {
    $config = $this->get("config");
    return new PdoMysql($config["mysql"]);
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
