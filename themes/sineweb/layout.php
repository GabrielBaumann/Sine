<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $this->e($title)?></title>
  <!-- <link rel="stylesheet" href="src/output.css"> -->
   <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="stylesheet" href="<?= theme("/assets/css/message.css")?>">
</head>
<body class="h-screen flex flex-col md:flex-row bg-gradient-to-b from-white to-blue-200">

  <!-- Formulário -->
    <?= $this->section("content"); ?>

  <!-- Área visual -->
  <div class="hidden md:flex flex-col justify-center items-center w-full md:w-1/2 p-4">
    <img src="<?= theme("/assets/images/sine.png")?>" alt="Ilustração de construção" class="h-full w-full object-cover rounded-xl brightness-70" />
  </div>
<script src="<?= theme("/assets/js/forms.js") ?>"></script>
</body>
</html>