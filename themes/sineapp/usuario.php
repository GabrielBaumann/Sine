<?php $this->layout('layout_user', ['usuarios' => $users]); ?>

<div class="overflow-x-auto">
    <div class="align-middle inline-block min-w-full">
        <div class="shadow overflow-hidden border-b border-gray-200 rounded-lg">
            <?= $this->insert("/user/listUserSystem"); ?>
        </div>
    </div>
</div>
