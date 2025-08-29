<?php $this->layout("layout_page"); ?>

<div class="flex-1 flex flex-col lg:flex-row md:overflow-hidden pb-16 lg:pb-0">
  <main class="w-full">
    <div id="content">
      <!-- Header pageStart -->
        <?= $this->insert("/pageStart/headerPageStart"); ?>
    </div>
  </main>
</div>

<?php $this->start("scripts"); ?>
  <script src="<?= theme("/assets/js/start/page.js", CONF_VIEW_APP); ?>"></script>
<?php $this->stop("scripts"); ?>