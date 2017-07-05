<?php
//if(!count($this->flashes())) return;

foreach($this->flashes() as $type=>$messages) {
    foreach($messages as $msg) {
        ?>

        <div class="flash-messages alert alert-<?= $type ?> alert-dismissable">
            <p><?= $msg ?></p>
        </div>

        <?php
    }
}
?>

<script>
    setTimeout(function(){ $( ".flash-messages" ).slideUp( "slow" ); }, 10000);
</script>
