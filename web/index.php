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
$app->post("/workorder","ccny\scidiv\cures\ctrl\WorkOrderController::submitWorkOrder")->bind("addWorkOrder");
$app->get("/api/location","ccny\scidiv\cures\ctrl\WOLocationController::getLocations")->bind("getLocations");
$app->get("/api/reqtype","ccny\scidiv\cures\ctrl\WORequestTypeController::getTypes")->bind("getRequestTypes");
$app->get("/confirm","ccny\scidiv\cures\ctrl\WorkOrderController::confirmWorkOrder")->bind("confirmWorkOrder");

$app->run();