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

// $route->get("/inicio/p/{page}/{idWorker}", "AppWorker:startHistory");
$route->post("/pesquisarcandidato", "AppWorker:startWorker");
$route->get("/historicoatendimento/{idWorker}", "AppWorker:startHistory");

$route->post("/pesquisartiposervico/{idWorker}", "AppWorker:searchService");

$route->get("/historicotrabalhador/p/{idWorker}/{page}", "AppWorker:searchService");

$route->get("/trabalhadoratendimento/{idService}", "AppWorker:serviceOfWorker");
$route->post("/editarservicotrabalhador/{typeService}", "AppWorker:serviceOfWorker");

/**
 * AppVacancy
 */
$route->get("/vagas", "AppVacancy:startVacancy");
$route->get("/listavagas", "AppVacancy:listVacancy");
$route->post("/listavagas", "AppVacancy:listVacancy");

$route->get("/informacaovagas/{idvacancy}", "AppVacancy:infoVacancy");
$route->get("/paginarvagas/p/{idvacancy}/{page}", "AppVacancy:infoVacancy");
$route->post("/pesquisarstatus/{idvacancy}", "AppVacancy:searchVacancy");
$route->post("/informacaovagas", "AppVacancy:infoVacancy");

$route->post("/pesquisarvagas", "AppVacancy:startVacancy");
$route->get("/pesquisarvagas/p/{page}", "AppVacancy:startVacancy");

$route->get("/cadastrarvagas", "AppVacancy:addVacancy");
$route->get("/editarvagas/{idvacancy}", "AppVacancy:addVacancy");

$route->post("/cadastrarvagas", "AppVacancy:addVacancy");
$route->post("/cadastrarvagas/{idvacancy}", "AppVacancy:addVacancy");

/**
 * AppCompany - CRIADO DE EXEMPLO PELO GABRIEL
 */
$route->get("/empresas", "AppCompany:startCompany");
$route->get("/listaempresas", "AppCompany:listCompany");
$route->post("/pequisarempresas", "AppCompany:listCompany");

$route->get("/adicionarempresa", "AppCompany:formCompany");
$route->post("/adicionarempresa", "AppCompany:formCompany");
$route->post("/adicionarempresa/{idcompany}", "AppCompany:formCompany");
$route->post("/verificarcnpj", "AppCompany:verificCnpj");
$route->get("/pesquisarempresa/p/{page}", "AppCompany:startCompany");

$route->post("/cancelarempresa/{idCompany}", "AppCompany:cancelCompany");
$route->post("/ativarempresa/{idCompany}", "AppCompany:activeCompany");

$route->get("/editarempresa/{idCompany}", "AppCompany:editCompany");


// Service
$route->get("/formularioAtendimento/{type}/{typeservice}", "AppServer:formService");
$route->get("/formularioAtendimento/{type}/{typeservice}/{interview}", "AppServer:formService");
$route->post("/formularioAtendimento", "AppServer:formService");
$route->post("/formularioAtendimento/{idWorker}", "AppServer:formService");

$route->post("/verificarCpfAtendimento", "AppServer:formCpfCheck");
$route->get("/segurodesemprego/{type}", "AppServer:serviceInsurance");
$route->get("/atendimento", "AppServer:servicePage");
$route->get("/atendimentotipo", "AppServer:serviceType");
$route->get("/atendimentomotivo/{type}", "AppServer:serviceReason");
$route->get("/requerimentoEspecial/{type}", "AppServer:serviceRequired");
$route->get("/sucessoAtendimento", "AppServer:serviceSucess");

$route->get("/selecionarempresa", "AppServer:listSelectEnterprise");
$route->get("/selecionarempresa/{idcompany}", "AppServer:listSelectEnterprise");


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