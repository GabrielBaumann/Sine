<?php $this->layout("layout_page"); ?>

<!-- Conteúdo principal -->
<main class="flex-1 overflow-y-auto p-6 pb-20 lg:pb-6">
  <?php $this->insert("/pageCompany/listCompany"); ?>
</main>

<?php $this->start("scripts"); ?>
  <script src="<?= theme("/assets/js/vacancy/page.js", CONF_VIEW_APP) ?>"></script>
<?php $this->stop("scripts"); ?>