<?php
/**
 * @var \App\View\AppView $this
 */

$this->setScriptVars('validation_error_template', $this->element('validation', ['field' => true]), ['is_html' => true]);
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="留学桥官网,交大留学桥,国际课程,预备课程,留学预科,出国留学,留学咨询,留学服务,留学申请" />
    <meta name="description" content="上海交通大学留学桥是专为计划出国留学人员打造国际预备课程，旨在汇聚东西方智慧资源、研发优质课程，
    推动全球范围的教育交流与合作，促进全球范围的教育理解与融合。">
    <?= $this->Html->meta('icon') ?>
    <?= $this->fetch('meta') ?>

    <title><?= $this->title ?></title>

    <?= $this->Html->css('../lib/bootstrap/bootstrap.css') ?>
    <?= $this->Html->css('../lib/fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.min.css') ?>
    <?= $this->Html->css('style.css') ?>

    <?= $this->fetch('css') ?>

    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?= $this->Html->script('../lib/bootstrap/bootstrap.js') ?>
    <?= $this->Html->script('script.js') ?>

    <?= $this->fetch('vars') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
<div>
    <div class="container">
        <header>
            <div class="header clearfix">
                <nav>
                    <ul class="nav nav-pills pull-right">
                        <li role="presentation"><a href="http://liuxue.sjtu.edu.cn/zty2.aspx?ID=21#" target="_blank">法国留学专题</a></li>
                        <li role="presentation"><a href="<?= $this->Url->build(['controller' => 'Apply', 'action' => 'index', '#' => 'signin']) ?>">咨询预约</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <?= $this->Flash->render() ?>

        <?= $this->fetch('content') ?>
    </div>
</div>
</body>
</html>
