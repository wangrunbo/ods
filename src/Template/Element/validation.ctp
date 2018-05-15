<?php
/**
 * @var \App\View\AppView $this
 * @var string|bool $field
 * @var array $error
 */
if ($field === true) {
    $field = '{{field}}';
    $error = ['{{message}}'];
}
?>
<?php if (!empty($error)): ?>
    <?php foreach ($error as $message): ?>
        <p class="validation-error" id="<?= h("validation-{$field}") ?>"><?= h($message) ?></p>
    <?php endforeach; ?>
<?php endif; ?>