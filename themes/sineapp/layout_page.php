<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atendimento - SINE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        <!-- Sidebar -->

        <?= $this->section("content")?>

    </div>

    <!-- Mobile Bottom Navigation -->
    <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 flex justify-around py-2 lg:hidden z-10 shadow-md">
        <a href="#" class="flex flex-col items-center text-xs px-2 text-gray-600 hover:text-sine-700">
            <i class="fas fa-home text-lg mb-1"></i>
            <span>Início</span>
        </a>
        <a href="#" class="flex flex-col items-center text-xs px-2 text-sine-700">
            <i class="fas fa-headset text-lg mb-1"></i>
            <span>Atendimento</span>
        </a>
        <a href="#" class="flex flex-col items-center text-xs px-2 text-gray-600 hover:text-sine-700">
            <i class="fas fa-users text-lg mb-1"></i>
            <span>Candidatos</span>
        </a>
        <a href="#" class="flex flex-col items-center text-xs px-2 text-gray-600 hover:text-sine-700">
            <i class="fas fa-cog text-lg mb-1"></i>
            <span>Configurações</span>
        </a>
    </div>
</body>
</html>