<?php $this->layout("layout_page"); ?>

<main class="flex-1 overflow-y-auto p-6 pb-20 lg:pb-6">
    <!-- Lista -->
    <div id="usersView">
        <?= $this->insert("/pageUserSystem/listUserSystem"); ?>
    </div>  
</main>

<?php $this->start("scripts"); ?>
    <script src="<?= theme("/assets/js/user/forms.js", CONF_VIEW_APP); ?>"></script>
    <script src="<?= theme("/assets/js/user/mask.js", CONF_VIEW_APP); ?>"></script>
    <script src="<?= theme("/assets/js/user/page.js", CONF_VIEW_APP); ?>"></script>
<?php $this->stop("scripts"); ?>