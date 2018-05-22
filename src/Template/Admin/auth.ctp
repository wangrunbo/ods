<?php
/**
 * @var \App\View\AppView $this
 * @var bool $error
 * @var array $default
 */
?>
<div class="container">
    <div class="header clearfix">
        <nav>
            <ul class="nav nav-pills pull-right">
                <li role="presentation"><a href="http://liuxue.sjtu.edu.cn/zty2.aspx?ID=21#" target="_blank">法国留学专题</a></li>
                <li role="presentation"><a href="http://liuxue.sjtu.edu.cn/#" target="_blank">国际教育官网</a></li>
                <li role="presentation"><a href="http://106.75.223.18/jd-crm/login.do" target="_blank">交大信息录入系统</a></li>
            </ul>
        </nav>
    </div>
    <div>
        <h3 class="text-muted">法国留学桥信息录入管理系统</h3>
    </div>
    <div class="alert alert-success" role="alert">
        <p class="text-muted">*可在多设备同时登陆</p>
        <br/>
        <?= $this->Form->create(null, ['autocomplete' => 'off']) ?>
            <label class="sr-only">认证码</label>
            <?= $this->Form->password('auth_code', ['value' => $default['auth_code'] ?? '', 'class' => ['form-control'], 'placeholder' => '认证码']) ?>
            <?php if (isset($error) && $error): ?>
                <div id="error-auth">
                    <p class="validation-error">验证失败，请重新输入</p>
                </div>
            <?php endif; ?>
            <br/>
            <button class="btn btn-lg btn-primary btn-block" type="submit">验证登录</button>
        <?= $this->Form->end() ?>
    </div>
</div>
