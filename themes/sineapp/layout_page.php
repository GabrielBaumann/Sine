<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= theme("/assets/css/message.css"); ?>">
=======
    <link rel="stylesheet" href="public/output.css">
>>>>>>> b8779b66ea268dc55f71b2c9ca89b9b042a495e9
    <title><?= $this->e($title); ?></title>
</head>
<body class="bg-gray-50 font-sans max-w-[1400px] mx-auto">
    <div class="flex min-h-screen max-h-screen overflow-hidden">
        <aside class="w-64 bg-white border-r border-gray-300 shadow-xl p-6 hidden lg:flex flex-col">
            <div class="text-2xl font-semibold mb-20 flex items-center ml-4 text-gray-800">Sistema Sine</div>
        <nav class="flex flex-col gap-3 flex-grow">
            <a href="<?= url("/inicio"); ?>" class="text-gray-700 px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                <span class="menu">Início</span>
            </a>
            <a href="<?= url("/atendimento"); ?>" class="text-gray-700 px-4 py-2 rounded-lg flex items-center gap-2  transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span class="menu">Atendimento</span>
            </a>
            <a href="#" class="text-gray-700 px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
                <span class="menu">Candidatos</span>
            </a>
            <a href="#" class="text-gray-700 px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                </svg>
                <span class="menu">Vagas</span>
            </a>
            <a href="#" class="text-gray-700 px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                </svg>
                <span class="menu">Empresas</span>
            </a>
            <a href="<?= url("/usuario"); ?>" class="text-gray-700  px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                </svg>
                <span class="menu">Usuarios</span>
            </a>
        </nav>

        <!-- User Info -->
        <div class="mt-auto pt-4 border-t border-gray-200">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-sine-100 rounded-full flex items-center justify-center text-sine-800">
                    <i class="fas fa-user"></i>
                </div>
                <div>
                    <p class="font-medium text-gray-900">Marcos Silva</p>
                    <p class="text-xs text-gray-500">Gerente de RH</p>
                </div>
            </div>
            <a href="<?= url("/sair"); ?>" class="text-red-500 px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-red-50 transition-colors">
                <i class="fas fa-sign-out-alt w-5 text-center"></i>
                <span>Sair</span>
            </a>
        </div>
        </aside>
    
        <!-- Sidebar -->
        <?= $this->section("content")?>

    </div>

    <!-- Mobile Bottom Navigation -->
    <?= $this->insert("mobileNavigation"); ?>
    
    <script src="<?= theme("/assets/js/service/sidebar.js", CONF_VIEW_APP)?>"></script>
    <script src="<?= theme("/assets/js/service/mask.js", CONF_VIEW_APP) ?>"></script>
    <script src="<?= theme("/assets/js/service/forms.js", CONF_VIEW_APP) ?>"></script>
    <?= $this->section("scripts") ?>
</body>
</html>