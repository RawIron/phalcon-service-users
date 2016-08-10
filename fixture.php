<?php

use \Phalcon\Db\Column as Column;


// Create a Mysql connection with PDO
$connection = new \Phalcon\Db\Adapter\Pdo\Mysql(
    array(
        "host"     => "localhost",
        "username" => "admin",
        "password" => "similarly-secure-password",
        "dbname"   => "customers",
    )
);

$connection->createTable(
    "customers",
    null,
    array(
       "columns" => array(
            new Column(
                "id",
                array(
                    "type"          => Column::TYPE_INTEGER,
                    "notNull"       => true,
                    "autoIncrement" => false,
                    "primary"       => true,
                )
            ),
            new Column(
                "name",
                array(
                    "type"    => Column::TYPE_VARCHAR,
                    "size"    => 32,
                    "notNull" => true,
                )
            ),
        )
    )
);

// Phalcon has no batch insert
// this will do for now
$success = $connection->insertAsDict(
   "customers",
   array(
      "id" => 1,
      "name" => "Phil"
   )
);

$success = $connection->insertAsDict(
   "customers",
   array(
      "id" => 2,
      "name" => "Mark"
   )
);
