<?php
/**
 * @var \App\View\AppView $this
 * @var string $name
 * @var string $text
 * @var string|array $url
 */
?>
<div class="textEditor">
    <span class="textEditor-text">
        <span class="textContainer"><?= h($text) ?></span>
        <span class="buttonContainer"><i class="fas fa-edit"></i></span>
    </span>

    <span class="textEditor-editor">
        <?= $this->Form->create(null, ['url' => $url]) ?>
            <?= $this->Form->text($name, ['value' => $text]) ?>
            <div class="buttonContainer">
                <button type="submit"><i class="fas fa-check"></i></button>
                <button class="cancel" type="button"><i class="fas fa-times"></i></button>
            </div>
            <div class="validation validationContainer-<?= $name ?>"></div>
        <?= $this->Form->end() ?>
    </span>
</div>