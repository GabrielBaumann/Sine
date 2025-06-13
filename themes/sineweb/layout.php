<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->e($title)?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= theme("/assets/css/message.css")?>">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Montserrat', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        },
                    }
                }
            }
        }
    </script>
    <style>
        .screenshot {
            border-radius: 8px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="md:bg-gray-100 font-sans antialiased text-gray-800 gradient-bg min-h-screen flex items-center justify-center md:p-4">
    <div class="login-container bg-white rounded-xl overflow-hidden flex flex-col md:flex-row w-full max-w-6xl md:shadow-xl">
        
        <?= $this->section("content"); ?>
        
        <!-- Demonstração do Sistema (Direita) -->
        <div class="w-full md:w-3/5 bg-[#095998] text-white p-12 hidden md:flex flex-col justify-center relative overflow-hidden">
            <div class="absolute inset-0 opacity-30" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHBhdHRlcm5Vbml0cz0idXNlclNwYWNlT25Vc2UiIHBhdHRlcm5UcmFuc2Zvcm09InJvdGF0ZSg0NSkiPjxyZWN0IHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjA1KSIvPjwvcGF0dGVybj48L2RlZnM+PHJlY3Qgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0idXJsKCNwYXR0ZXJuKSIvPjwvc3ZnPg==')"></div>
            
            <div class="relative z-10">
                <h2 class="text-2xl font-light mb-6">Seja bem vindo(a) de volta!</h2>
                <p class="font-light leading-relaxed opacity-90 mb-8 max-w-md">
                    O Sistema Sine oferece uma experiência integrada com dashboards intuitivos, relatórios detalhados e ferramentas eficientes e modernas para uma gestão eficiente.
                </p>
            </div>
            
            <div class="relative z-10 screenshot-container flex justify-center items-start gap-6 mt-8">
                <!-- Screenshot 1 - Dashboard -->
                <div class="screenshot screenshot-1 w-1/2 bg-white p-1">
                    <div class="image-placeholder">
                        <img src="<?= theme("/assets/images/dash.png") ?>" alt="">
                    </div>
                </div>
                
                <!-- Screenshot 2 - Relatórios -->
                <div class="screenshot screenshot-2 w-1/2 bg-white p-1 -ml-16 mt-8">
                    <div class="image-placeholder">
                        <img src="<?= theme("/assets/images/form.png") ?>" alt="">
                    </div>
                </div>
                
                <!-- Screenshot 3 - Configurações -->
                <div class="screenshot screenshot-3 w-1/2 bg-white p-1 -ml-16 mt-16">
                    <div class="image-placeholder">
                        <img src="<?= theme("/assets/images/lista.png") ?>" alt="">
                    </div>
                </div>
            </div>

            <!-- Texto centralizado abaixo das fotos -->
            <div class="relative z-10 mt-16 text-center">
                <p class="font-light text-sm opacity-90 max-w-lg mx-auto">
                     Desenvolvido para facilitar o controle dos dados internos de SINEs municipais, o Sistema Sine pode ser acessado tanto pelo computador quanto pelo celular, oferecendo flexibilidade para quem precisa utilizá-lo em diferentes situações.
                </p>
                <div class="mt-4 flex justify-center">
                    <div class="h-px w-16 bg-white opacity-30"></div>
                </div>
                <p class="font-light text-xs opacity-70 mt-2">
                    Desenvolvido por Cerberus. Saiba mais.
                </p>
            </div>
        </div>
    </div>
<script src="<?= theme("/assets/js/forms.js") ?>"></script>
</body>
</html>