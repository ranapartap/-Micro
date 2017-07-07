<?php
$flashes = $this->flashes();
if (!$flashes)
    return;
?>
<div class="row flashes">
    <div class="col-md-12">

        <?php
        foreach ($flashes as $type => $messages) {
            foreach ($messages as $msg) {
                ?>

                <div class="flash-messages alert alert-<?= $type ?> alert-dismissable">
                    <p><?= $msg ?></p>
                </div>

                <?php
            }
        }
        ?>

    </div>
</div>

<script>
    setTimeout(function () {
        $(".flash-messages").slideUp("slow");
    }, 10000);
</script>
