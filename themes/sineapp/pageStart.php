<?php $this->layout("layout_page"); ?>

<div class="flex-1 flex flex-col lg:flex-row md:overflow-hidden pb-16 lg:pb-0">
  <main class="flex-1 p-4 lg:p-6 overflow-y-auto">
    <div id="content">
      <!-- Header pageStart -->
        <?= $this->insert("/pageStart/headerPageStart"); ?>
      <!-- List  -->
      <div id="listMorkes">
        <?= $this->insert("/pageStart/listWorkes", ["workers" => $worker]); ?>
      </div>
    </div>
  </main>
</div>

<?php $this->start("scripts"); ?>
  <script src="<?= theme("/assets/js/start/page.js", CONF_VIEW_APP) ?>"></script>
<?php $this->stop("scrpts"); ?>