<?php $this->layout("layout_page"); ?>

<!-- Conteúdo principal -->
<main class="flex-1 overflow-y-auto p-6 pb-20 lg:pb-6">

  <div id="companiesView">
    <?php $this->insert("/pageCompany/listCompany"); ?>
  </div>

</main>

<?php $this->start("scripts"); ?>
  <script src="<?= theme("/assets/js/company/page.js", CONF_VIEW_APP) ?>"></script>
<?php $this->stop("scripts"); ?>