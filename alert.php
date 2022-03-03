<?php
function alert($color,$mag,$link = null,$title ="แจ้งเตือน") {
?>

<!-- Modal -->
<div class="modal fade" id="alert">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-<?= $color ?>"><?= $title ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-<?= $color ?>">
                    <?= $mag ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("document").ready(() => {
        $('#alert').modal('show');
        <?php if ($link != null) { ?>
            $("#alert").on("hidden.bs.modal", () => {
                window.location.href = "<?= $link ?>"
            });            
        <?php } ?>
    });
</script>
<?php
}
?>