<?php

ob_start();

require __DIR__ . "/vendor/autoload.php";

// BOOTSTRAP

use Source\Core\Session;
use CoffeeCode\Router\Router;

$session = new Session();
$route = new Router(url(), ":");

// WEB
// Login
$route->namespace("Source\App");
$route->get("/", "Web:login");
$route->post("/", "Web:login");

/**
 * APP
 */
// System User
$route->get("/usuario", "App:userSystem");
$route->get("/adicionarusuario", "App:modelAddUser");
$route->get("/adicionarusuario/{idUserSystem}", "App:modelAddUser");
$route->post("/adicionarusuario/{idUserSystem}", "App:modelAddUser");
$route->post("/verificarcpf", "App:checkCpf");
$route->post("/adicionarusuario", "App:modelAddUser");


// Init page
$route->get("/inicio", "App:initPage");

$route->get("/sair", "App:logout");

// ERROR ROUTES

$route->namespace("Source\App")->group("/ops");
$route->get("/{errcode}", "Web:error");

// ROUTE

$route->dispatch();

// ERROR REDIRECT

if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}

ob_end_flush();