<?php

include __DIR__ . '/../vendor/autoload.php';

$app = new \Silex\Application();

$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../ccny/scidiv/cures/views',
));

$app->register(new Silex\Provider\AssetServiceProvider(), array());

$app->get("/","ccny\scidiv\cures\ctrl\HomeController::indexAction")->bind("home");
$app->get("/workorder","ccny\scidiv\cures\ctrl\WorkOrderController::newWorkOrder")->bind("newWorkOrder");
$app->post("/workorder","ccny\scidiv\cures\ctrl\WorkOrderController::processWorkOrder")->bind("processWorkOrder");
$app->get("/api/location","ccny\scidiv\cures\ctrl\ApiLocationController::listLocations")->bind("listLocations");

$app->run();