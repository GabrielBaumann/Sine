<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $this->e($title)?></title>
  <!-- <link rel="stylesheet" href="src/output.css"> -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="<?= theme("/assets/css/message.css")?>">
</head>
<body class="bg-white md:bg-blue-100 min-h-screen flex items-center justify-center p-4 overflow-hidden">
<div class="hidden md:block absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl md:-top-80" aria-hidden="true">
    <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-blue-400 to-blue-600 opacity-30 md:left-[calc(50%-30rem)] md:w-[72.1875rem]" 
         style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
</div>
<div class="hidden md:absolute md:block md:-top-10 md:right-0 md:z-[-10] md:mr-10 md:transform-gpu md:blur-3xl" aria-hidden="true">
    <div class="aspect-[1097/845] w-[68.5625rem] bg-gradient-to-r from-blue-400 to-blue-400 opacity-20" 
         style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
</div>
  <div class="bg-white flex flex-col lg:flex-row h-[700px] w-full max-w-[1100px] overflow-hidden rounded-xl md:shadow-xl">
    <div class="w-full lg:w-2/5 p-8 flex flex-col justify-center">
      <!-- Formulário -->
      <?= $this->section("content"); ?>
    </div>

    <!-- Parte da Imagem (direita) -->
    <div class="hidden lg:block lg:w-3/5 bg-blue-600 relative overflow-hidden">
        <img 
            src="<?= theme("/assets/images/sine.png")?>" 
            alt="Background login"
            class="w-full h-full object-cover brightness-50"
        >
        <div class="absolute inset-0 bg-gradient-to-r from-gray-900 to-gray-900 opacity-10 z-10"></div> 
        <div class="absolute inset-0 flex items-center justify-center p-20 z-20 transform -translate-y-40"> 
            <img src="<?= theme("/assets/images/logo_sine.png")?>" alt="logo">
        </div>
    </div>
  </div>
<script src="<?= theme("/assets/js/forms.js") ?>"></script>
</body>
</html>