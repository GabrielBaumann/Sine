<?php $this->layout("layout_page"); ?>

<div class="flex-1 flex flex-col lg:flex-row md:overflow-hidden pb-16 lg:pb-0">
  <main class="flex-1 p-4 lg:p-6 overflow-y-auto">
    <div id="content">
      <!-- Header pageStart -->
        <?= $this->insert("/pageWorker/headerPageWorker"); ?>
      <!-- List  -->
      <div id="listWorkes">
        <?= $this->insert("/pageWorker/listWorkes", ["workers" => $worker, "paginator" => $paginator]); ?>
      </div>
    </div>
  </main>
</div>

<?php $this->start("scripts"); ?>
  <script src="<?= theme("/assets/js/worker/page.js", CONF_VIEW_APP) ?>"></script>
<?php $this->stop("scrpts"); ?>