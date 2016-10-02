<?php

require __DIR__ . '/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'pgsql',
    'host'      => 'localhost',
    'database'  => 'ancest',
    'username'  => 'postgres',
    'port'      => 5433,
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Make this Capsule instance available globally via static methods...
$capsule->setAsGlobal();

// Setup the Eloquent ORM...
$capsule->bootEloquent();

// UTC is a good default
date_default_timezone_set('UTC');

// The object which will act as our router
$router = new Ancestry\Router($argv);

// Start up app in a shell
\Psy\Shell::debug(['r' => $router]);

