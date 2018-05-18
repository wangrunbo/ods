<?php
/**
 * @var \App\View\AppView $this
 */
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width">
    <title><?= SITE_NAME ?>后台管理系统</title>

    <?= $this->Html->css('admin.css') ?>

    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <?= $this->Html->script('script.js') ?>

    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
<header id="header">
    <div class="headerUtil">
        <h1 class="logo"><?= SITE_NAME ?>后台管理系统</h1>
    </div>
</header>

<?= $this->fetch('content') ?>

<footer id="footer">
    <div class="container">
        <p>Copyright &copy; <?= SITE_NAME ?></p>
    </div>
</footer>
</body>
</html>
