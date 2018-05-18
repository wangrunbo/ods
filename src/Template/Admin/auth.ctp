<?php
/**
 * @var \App\View\AppView $this
 * @var bool $error
 * @var array $default
 */
?>
<div id="login" class="main">
    <div class="section box">
        <h2>身份验证</h2>

        <?php if (isset($error) && $error): ?>
            <div id="error-auth">
                <p class="validation-error">验证失败，请重新输入</p>
            </div>
        <?php endif; ?>

        <?= $this->Form->create(null, ['autocomplete' => 'off']) ?>
            <dl class="formDataList">
                <dt>认证码</dt>
                <dd><?= $this->Form->text('auth_code', ['value' => $default['auth_code'] ?? '']) ?></dd>
            </dl>
            <div class="buttonContainer">
                <button type="submit">验证登录</button>
            </div>
        <?= $this->Form->end() ?>
    </div>
</div>
