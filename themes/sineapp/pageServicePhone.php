<?php $this->layout('layout_page'); ?>

<!-- Main Content -->
<div class="flex-1 flex flex-col lg:flex-row md:overflow-hidden pb-16 lg:pb-0">
  <main class="flex-1 p-4 lg:p-6 overflow-y-auto">
    <div id="content">
      <!-- Header pageStart -->
        <?= $this->insert("/pageWorkerPhone/headerPageWorkerPhone"); ?>
      <!-- List  -->
      <div id="listWorkes">
        <?= $this->insert("/pageWorkerPhone/listWorkesPhone"); ?>
      </div>
    </div>
  </main>
</div>

<?php $this->start("scripts"); ?>
    <script src="<?= theme("/assets/js/service/mask.js", CONF_VIEW_APP) ?>"></script>
    <script src="<?= theme("/assets/js/service/forms.js", CONF_VIEW_APP) ?>"></script>
    <script src="<?= theme("/assets/js/service/navigation.js", CONF_VIEW_APP) ?>"></script>
<?php $this->stop("scripts"); ?>