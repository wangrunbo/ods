<?php
/**
 * @var \App\View\AppView $this
 * @var bool $error
 * @var array $default
 */
?>
<div>
    <h1><?= SITE_NAME ?>后台管理系统</h1>

    <?php if (isset($error) && $error): ?>
        <div id="error-auth">
            <p class="validation-error">验证失败，请重新输入</p>
        </div>
    <?php endif; ?>

    <div>
        <?= $this->Form->create() ?>
            <?= $this->Form->text('auth_code', ['value' => $default['auth_code'] ?? '']) ?>
            <button type="submit">验证登录</button>
        <?= $this->Form->end() ?>
    </div>
</div>
