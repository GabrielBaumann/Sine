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
 * AppStart
 */
// Start
$route->get("/inicio", "AppStart:startPage");


/**
 * AppServer
 */
// System User
$route->get("/usuarios", "AppUserSystem:userSystem");
$route->get("/usuarios/p/{page}", "AppUserSystem:userSystem");

$route->get("/listausuarios", "AppUserSystem:listUserSystem");
$route->post("/pesquisarusuarios", "AppUserSystem:listUserSystem");

$route->get("/adicionarusuario", "AppUserSystem:formAddUser");
$route->post("/adicionarusuario", "AppUserSystem:formAddUser");

$route->get("/adicionarusuario/{idUserSystem}", "AppUserSystem:modelAddUser");
$route->post("/adicionarusuario/{idUserSystem}", "AppUserSystem:modelAddUser");
$route->post("/verificarcpf", "AppUserSystem:checkCpf");



/**
 * AppWorker
 */
// Worker
$route->get("/trabalhador", "AppWorker:startWorker");
$route->get("/listatrabalhador", "AppWorker:listtWorker");

$route->get("/listatrabalhador/p/{page}", "AppWorker:startPagePaginator");
$route->get("/inicio/p/{page}/{idWorker}", "AppWorker:startHistory");
$route->post("/pesquisarcandidato", "AppWorker:startWorker");
$route->get("/historicoatendimento/{idWorker}", "AppWorker:startHistory");

/**
 * AppVacancy
 */
$route->get("/vagas", "AppVacancy:startVacancy");
$route->get("/listavagas", "AppVacancy:listVacancy");
$route->post("/listavagas", "AppVacancy:listVacancy");

$route->post("/pesquisarvagas", "AppVacancy:startVacancy");
$route->get("/pesquisarvagas/p/{page}", "AppVacancy:startVacancy");
$route->get("/cadastrarvagas", "AppVacancy:addVacancy");
$route->post("/cadastrarvagas", "AppVacancy:addVacancy");

/**
 * AppCompany - CRIADO DE EXEMPLO PELO GABRIEL
 */
$route->get("/empresas", "AppCompany:startCompany");
$route->get("/listaempresas", "AppCompany:listCompany");
$route->post("/pequisarempresas", "AppCompany:listCompany");

$route->get("/adicionarempresa", "AppCompany:formCompany");
$route->post("/adicionarempresa", "AppCompany:formCompany");
$route->post("/verificarcnpj", "AppCompany:verificCnpj");
$route->get("/pesquisarempresa/p/{page}", "AppCompany:startCompany");



// Service page
$route->get("/formularioAtendimento/{type}/{typeservice}", "AppServer:formService");
$route->post("/formularioAtendimento", "AppServer:formService");
$route->post("/formularioAtendimento/{idWorker}", "AppServer:formService");

$route->post("/verificarCpfAtendimento", "AppServer:formCpfCheck");
$route->get("/segurodesemprego/{type}", "AppServer:serviceInsurance");
$route->get("/atendimento", "AppServer:servicePage");
$route->get("/atendimentotipo", "AppServer:serviceType");
$route->get("/atendimentomotivo/{type}", "AppServer:serviceReason");
$route->get("/requerimentoEspecial/{type}", "AppServer:serviceRequired");
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