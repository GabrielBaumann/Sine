<?php $this->layout("layout_page"); ?>

<div class="flex-1 flex flex-col lg:flex-row md:overflow-hidden pb-16 lg:pb-0">
  <main class="flex-1 p-4 lg:p-6 overflow-y-auto">
    <div id="content">
      <!-- Header pageStart -->
        <?= $this->insert("/pageStart/headerPageStart"); ?>
    </div>
  </main>
</div>