<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $this->e($title)?></title>
  <link rel="stylesheet" href="src/output.css">
  <!-- <script src="https://cdn.tailwindcss.com"></script> -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="<?= theme("/assets/css/message.css")?>">
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="h-screen flex flex-col md:flex-row bg-gray-100">

  <!-- Formulário -->
    <?= $this->section("content"); ?>

  <!-- Área visual -->
  <div class="hidden md:flex flex-col justify-center items-center w-full md:w-1/2">
    <img src="<?= theme("/assets/images/sine.png")?>" alt="Ilustração de construção" class="h-full w-full object-cover" />
  </div>
<script src="<?= theme("/assets/js/forms.js") ?>"></script>
</body>
</html>