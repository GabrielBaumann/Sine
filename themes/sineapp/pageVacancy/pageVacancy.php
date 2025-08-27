<?php $this->layout("layout_page"); ?>
<?php $this->start("css"); ?>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php $this->stop("css"); ?>
<!-- Conteúdo principal -->

  <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
    <!-- Tabela Responsiva -->
    <!-- Alterei para mostrar o formulário, mas deve ser mostrado apenas a tabela nessa pagina atual -->
     <div id="view-form">
      <?php $this->insert("/pageVacancy/listVacancy"); ?>
    </div>
  </main>

<?php $this->start("scripts"); ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
  <script src="<?= theme("/assets/js/vacancy/page.js", CONF_VIEW_APP); ?>"></script>
  <script src="<?= theme("/assets/js/vacancy/forms.js", CONF_VIEW_APP); ?>"></script>
<?php $this->stop("scripts"); ?>