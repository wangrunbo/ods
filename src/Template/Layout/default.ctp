<?php
/**
 * @var \App\View\AppView $this
 */
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $this->Html->meta('icon') ?>
    <?= $this->fetch('meta') ?>

    <title><?= $this->title ?></title>

    <?= $this->Html->css('style.css') ?>

    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <?= $this->Html->script('script.js') ?>
    <script>
        let validation_error_template = '<?= str_replace(PHP_EOL, '', $this->element('validation', ['field' => true])); ?>';
    </script>

    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <?= $this->Flash->render() ?>

    <?= $this->fetch('content') ?>
</body>
</html>
