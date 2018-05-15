<?php
/**
 * @var \App\View\AppView $this
 * @var array $errors
 * @var array $default
 */
$this->Html->script('Apply/index.js', ['block' => true]);
?>
<div>
    <?= $this->Form->create(null, ['id' => 'form-apply']) ?>
        <dl>
            <dt>姓名：</dt>
            <dd>
                <?= $this->Form->text('name', ['value' => $default['name'] ?? '']) ?>
                <?php if (isset($errors['name'])): ?>
                    <?= $this->element('validation', ['field' => 'name', 'error' => $errors['name']]) ?>
                <?php endif; ?>
            </dd>

            <dt>联系电话：</dt>
            <dd>
                <?= $this->Form->text('tel', ['value' => $default['tel'] ?? '']) ?>
                <?php if (isset($errors['name'])): ?>
                    <?= $this->element('validation', ['field' => 'tel', 'error' => $errors['tel']]) ?>
                <?php endif; ?>
            </dd>
        </dl>

        <button type="submit">申请</button>
    <?= $this->Form->end(); ?>
</div>
