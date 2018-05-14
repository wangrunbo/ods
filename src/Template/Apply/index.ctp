<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div>
    <?= $this->Form->create() ?>
        <?= $this->Form->text('name') ?>
        <button type="submit">申请</button>
    <?= $this->Form->end(); ?>
</div>
