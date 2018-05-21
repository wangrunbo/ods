<?php
/**
 * @var \App\View\AppView $this
 */
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $this->Html->meta('icon', 'stone.ico') ?>

    <title>法国留学桥信息录入管理系统</title>

    <?= $this->Html->css('../lib/bootstrap/bootstrap.css') ?>
    <?= $this->Html->css('../lib/fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.min.css') ?>
    <?= $this->Html->css('admin.css') ?>

    <?= $this->fetch('css') ?>

    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?= $this->Html->script('../lib/bootstrap/bootstrap.js') ?>
    <?= $this->Html->script('script.js') ?>

    <?= $this->fetch('script') ?>
</head>

<body>

<?= $this->fetch('content') ?>

</body>
</html>
