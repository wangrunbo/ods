<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Applicant[] $applicants
 */
$this->setTitle('后台管理');

$count = 0;
?>
<div>
    <table>
        <thead>
        <tr>
            <th></th>
            <th>姓名</th>
            <th>联系电话</th>
            <th>报名时间</th>
            <th>备注</th>
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

    <div class="pagenation">
        <ul>
            <?= $this->Paginator->numbers([
                'before' => $this->Paginator->hasPrev() ? $this->Paginator->prev('<') : '',
                'after' => $this->Paginator->hasNext() ? $this->Paginator->next('>') : ''
            ])?>
        </ul>
    </div>
</div>
