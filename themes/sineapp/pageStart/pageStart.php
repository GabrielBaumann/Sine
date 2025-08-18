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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<?php $this->stop("scripts"); ?>