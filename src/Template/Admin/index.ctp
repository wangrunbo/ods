<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Applicant[] $applicants
 */
$count = 0;
?>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= $this->Url->build(['controller' => 'Admin', 'action' => 'index']) ?>">法国留学桥信息录入系统</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?= $this->Url->build(['controller' => 'Apply', 'action' => 'index']) ?>">邀请函页面</a></li>
                <li><?= $this->Form->postLink('注销', ['controller' => 'Admin', 'action' => 'clear']) ?></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
            </ul>

            <form id="form-search" class="navbar-form navbar-right" method="get" action="<?= $this->Url->build(); ?>">
                <input type="text" name="tel" placeholder="电话查找">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li class="active"><a href="<?= $this->Url->build(['controller' => 'Admin', 'action' => 'index']) ?>">总览</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">报名信息查看</h1>
            <div class="table-responsive">
                <table id="list-apply" class="table table-striped">
                    <thead>
                    <tr>
                        <th class="count">编号</th>
                        <th class="name">姓名</th>
                        <th class="tel">联系电话</th>
                        <th class="created">报名时间</th>
                        <th class="note">备注</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($applicants as $applicant): ?>
                        <tr>
                            <td><?= ++$count; ?></td>
                            <td><?= h($applicant->name); ?></td>
                            <td><?= h($applicant->tel); ?></td>
                            <td><?= h($applicant->created->format(DATE_FORMAT['DATETIME'])); ?></td>
                            <td><?= $this->element('text_editor', ['name' => 'note', 'text' => $applicant->note, 'url' => ['controller' => 'Admin', 'action' => 'edit', $applicant->id]]) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="pagenation">
            <ul>
                <?= $this->Paginator->numbers([
                    'before' => $this->Paginator->hasPrev() ? $this->Paginator->prev('<') : '',
                    'after' => $this->Paginator->hasNext() ? $this->Paginator->next('>') : ''
                ])?>
            </ul>
        </div>
    </div>
</div>
