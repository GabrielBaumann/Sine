<?php $this->layout('layout_page'); ?>

<?php $this->start("css"); ?>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php $this->stop("css"); ?>

<!-- Main Content -->
<div class="flex-1 flex flex-col lg:flex-row overflow-hidden pb-16 lg:pb-0">
    <main class="flex-1 p-4 lg:p-6 overflow-y-auto">
        <!-- Form Steps -->
        <div class="">
            
                <!-- Tipo de Atendimento -->
                <!-- Motivo do Atendimento -->
                <!-- Formulário -->
                <!-- Formulário -->
                <!-- Serviços do Seguro Desemprego -->
                <!-- Tipo de Requerimento Especial -->
                <!-- Confirmação -->
                 
            <div id="newElement">
                <?= $this->insert("/pageService/initService")?>
            </div>
        </div>
    </main>
</div>
<?php $this->start("scripts"); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="<?= theme("/assets/js/service/mask.js", CONF_VIEW_APP) ?>"></script>
    <script src="<?= theme("/assets/js/service/forms.js", CONF_VIEW_APP) ?>"></script>
    <script src="<?= theme("/assets/js/service/navigation.js", CONF_VIEW_APP) ?>"></script>
<?php $this->stop("scripts"); ?>