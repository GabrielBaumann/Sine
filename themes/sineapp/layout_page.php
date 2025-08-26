<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= theme("/assets/css/message.css", CONF_VIEW_APP); ?>">
    <link rel="stylesheet" href="<?= theme("/assets/css/style.css", CONF_VIEW_APP); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="<?= theme("/assets/images/favicon_sine.png")?>">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

    <!-- <link rel="stylesheet" href="src/output.css"> -->
    <?= $this->section("css") ?>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- graficos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title><?= $this->e($title); ?></title>
    <style>
        @media (max-width: 640px) {
            .responsive-table thead {
                display: none;
            }
            .responsive-table tr {
                display: block;
                margin-bottom: 1rem;
                border-radius: 0.5rem;
                box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
            }
            .responsive-table td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.75rem;
                text-align: right;
                border-bottom: 1px solid #f3f4f6;
            }
            .responsive-table td:before {
                content: attr(data-label);
                font-weight: 600;
                color: #374151;
                margin-right: 1rem;
                text-align: left;
            }
            .responsive-table td:last-child {
                border-bottom: none;
            }
            .status-badge {
                margin-left: auto;
            }
        }
    </style>
</head>
<body class="h-screen flex bg-gray-100">
    <!-- LEFT DESKTOP SIDEBAR -->
     <aside class="menu-desktop h-full hidden md:flex md:flex-col font-semibold text-gray-700 text-sm 2xl:text-md pt-7 gap-10 2xl:min-w-[270px] 2xl:max-w-[270px] max-w-[250px] bg-white justify-between">
        <img src="<?= theme("/assets/images/logo_sine.png")?>" alt="" class="w-[150px] items-center justify-center mx-auto">
        <div class="flex flex-col">
            <a href="<?= url("/inicio"); ?>" class="menu text-left flex items-center gap-3 cursor-pointer hover:bg-gray-100 hover:text-blue-500 py-5 px-10 hover:border-l-7 hover:border-blue-500 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                <span class="menu" data-sidebar="inicio">Início</span>
            </a>
            <a href="<?= url("/atendimento"); ?>" class="menu text-left flex items-center gap-3 cursor-pointer hover:bg-gray-100 hover:text-blue-500 py-5 px-10 hover:border-l-7 hover:border-blue-500 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 0 0 2.25-2.25V6a2.25 2.25 0 0 0-2.25-2.25H6A2.25 2.25 0 0 0 3.75 6v2.25A2.25 2.25 0 0 0 6 10.5Zm0 9.75h2.25A2.25 2.25 0 0 0 10.5 18v-2.25a2.25 2.25 0 0 0-2.25-2.25H6a2.25 2.25 0 0 0-2.25 2.25V18A2.25 2.25 0 0 0 6 20.25Zm9.75-9.75H18a2.25 2.25 0 0 0 2.25-2.25V6A2.25 2.25 0 0 0 18 3.75h-2.25A2.25 2.25 0 0 0 13.5 6v2.25a2.25 2.25 0 0 0 2.25 2.25Z" />
                </svg>
                <span class="menu" data-sidebar="atendimento">Atendimento</span>
            </a>
            <a href="<?= url("/trabalhadortelefone"); ?>" class="menu text-left flex items-center gap-3 cursor-pointer hover:bg-gray-100 hover:text-blue-500 py-5 px-10 hover:border-l-7 hover:border-blue-500 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                </svg>
                <span class="menu" data-sidebar="trabalhadortelefone">Atend. p/ Telefone</span>
            </a>
            <a href="<?= url("/trabalhador"); ?>" class="menu text-left flex items-center gap-3 cursor-pointer hover:bg-gray-100 hover:text-blue-500 py-5 px-10 hover:border-l-7 hover:border-blue-500 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
                <span class="menu" data-sidebar="trabalhador">Trabalhador</span>
            </a>
            <a href="<?= url("/vagas"); ?>" class="menu text-left flex items-center gap-3 cursor-pointer hover:bg-gray-100 hover:text-blue-500 py-5 px-10 hover:border-l-7 hover:border-blue-500 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                </svg>
                <span class="menu" data-sidebar="vagas">Vagas</span>
            </a>
            <a href="<?= url("/empresas"); ?>" class="menu text-left flex items-center gap-3 cursor-pointer hover:bg-gray-100 hover:text-blue-500 py-5 px-10 hover:border-l-7 hover:border-blue-500 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                </svg>
                <span class="menu" data-sidebar="empresas">Empresas</span>
            </a>
        <?php if(in_array($userSystem->type_user, ["DEV","ADM"])): ?>
            <a href="<?= url("/usuarios"); ?>" class="menu text-left flex items-center gap-3 cursor-pointer hover:bg-gray-100 hover:text-blue-500 py-5 px-10 hover:border-l-7 hover:border-blue-500 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
                <span class="menu" data-sidebar="usuarios">Usuários</span>
            </a>
        <?php endif;?>
        </div>
        <div class="text-sm font-normal mb-10">
            <p class="ml-10"><?= $userSystem->name_user ?? null; ?></p>
            <p class="ml-10 mb-4"><?= $userSystem->profession_user ?? null; ?></p>
            <a href="<?= url("/sair"); ?>" class="ml-10 text-gray-700 font-semibold text-md text-red-500 cursor-pointer">Sair do sistema</a>
        </div>
     </aside>

    <?= $this->section("content")?>
     
    <!-- Mobile Bottom Navigation -->
    <?= $this->insert("/mobile/mobileNavigation"); ?>
        <script src="<?= theme("/assets/js/default/default.js", CONF_VIEW_APP)?>"></script>
    <?= $this->section("scripts") ?>
</body>
</html>