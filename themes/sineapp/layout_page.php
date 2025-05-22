<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= theme("/assets/css/message.css"); ?>">
    <title><?= $this->e($title); ?></title>
    <script>
        tailwind.config = {
            theme: {
                fontFamily: {
                    sans: ['Inter', 'sans-serif'],
                },
                extend: {
                    colors: {
                        'sine': {
                            '50': '#f0f9ff',
                            '100': '#e0f2fe',
                            '200': '#bae6fd',
                            '300': '#7dd3fc',
                            '400': '#38bdf8',
                            '500': '#0ea5e9',
                            '600': '#0284c7',
                            '700': '#0369a1',
                            '800': '#075985',
                            '900': '#0c4a6e',
                            '950': '#082f49',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans">

    <div class="flex min-h-screen max-h-screen overflow-hidden">
        <aside class="w-64 bg-white border-r border-gray-200 p-6 hidden lg:flex flex-col">
            <div class="text-2xl font-bold mb-10 flex items-center gap-2 text-sine-900">
                <div class="bg-sine-700 rounded-full p-2 text-white">
                    <i class="fas fa-briefcase"></i>
                </div>
                SINE
            </div>
        <nav class="flex flex-col gap-3 flex-grow">
            <a href="<?= url("/inicio"); ?>" class="text-gray-700 hover:bg-gray-100 px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                <i class="fas fa-home w-5 text-center"></i>
                <span class="menu">Início</span>
            </a>
            <a href="<?= url("/atendimento"); ?>" class="px-4 py-2 rounded-lg flex items-center gap-2  transition-colors">
                <i class="fas fa-headset w-5 text-center"></i>
                <span class="menu">Atendimento</span>
            </a>
            <a href="#" class="text-gray-700 hover:bg-gray-100 px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                <i class="fas fa-users w-5 text-center"></i>
                <span class="menu">Candidatos</span>
            </a>
            <a href="#" class="text-gray-700 hover:bg-gray-100 px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                <i class="fas fa-briefcase w-5 text-center"></i>
                <span class="menu">Vagas</span>
            </a>
            <a href="#" class="text-gray-700 hover:bg-gray-100 px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                <i class="fas fa-building w-5 text-center"></i>
                <span class="menu">Empresas</span>
            </a>
            <a href="<?= url("/usuario"); ?>" class="text-gray-700 hover:bg-gray-100 px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                <i class="fas fa-hammer w-5 text-center"></i>
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