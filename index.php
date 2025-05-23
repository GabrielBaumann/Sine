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
$route->get("/usuario", "AppServer:userSystem");
$route->get("/adicionarusuario", "AppServer:modelAddUser");
$route->get("/adicionarusuario/{idUserSystem}", "AppServer:modelAddUser");
$route->post("/adicionarusuario/{idUserSystem}", "AppServer:modelAddUser");
$route->post("/verificarcpf", "AppServer:checkCpf");
$route->post("/adicionarusuario", "AppServer:modelAddUser");


// Init page
$route->get("/inicio", "AppStart:initPage");



// Service page
$route->get("/formularioAtendimento/{type}", "AppServer:formService");
$route->post("/formularioAtendimento", "AppServer:formService");
$route->post("/formularioAtendimento/{idWorker}", "AppServer:formService");

$route->post("/verificarCpfAtendimento", "AppServer:formCpfCheck");
$route->get("/segurodesemprego", "AppServer:serviceInsurance");
$route->get("/atendimento", "AppServer:servicePage");
$route->get("/atendimentotipo", "AppServer:serviceType");
$route->get("/atendimentomotivo", "AppServer:serviceReason");
$route->get("/requerimentoEspecial", "AppServer:serviceRequired");
$route->get("/sucessoAtendimento", "AppServer:serviceSucess");

$route->get("/sair", "AppServer:logout");

// ERROR ROUTES

$route->namespace("Source\AppServer")->group("/ops");
$route->get("/{errcode}", "Web:error");

// ROUTE

$route->dispatch();

// ERROR REDIRECT

if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}

ob_end_flush();