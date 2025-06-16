<!-- Gambiarra corrigir logo -->
<!-- Header pageStart -->
<?= $this->insert("/pageWorker/headerPageWorker"); ?>
<!-- List  -->
<div id="listWorkes">
<?= $this->insert("/pageWorker/listWorkes", ["workers" => $worker, "paginator" => $paginator]); ?>
</div>