<?php $this->layout("layout_page"); ?>

<!-- Conteúdo principal -->
<main class="flex-1 overflow-y-auto p-6 pb-20 lg:pb-6">
  <!-- Tabela Responsiva -->
  <!-- Alterei para mostrar o formulário, mas deve ser mostrado apenas a tabela nessa pagina atual -->
  <?php $this->insert("/pageVacancy/listVacancy"); ?>
</main>

<?php $this->start("scripts"); ?>
  <script src="<?= theme("/assets/js/vacancy/page.js", CONF_VIEW_APP) ?>"></script>
<?php $this->stop("scripts"); ?>