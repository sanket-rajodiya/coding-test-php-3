<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\UserArticleLike> $userArticleLikes
 */
?>
<div class="userArticleLikes index content">
    <?= $this->Html->link(__('New User Article Like'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('User Article Likes') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('article_id') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('updated_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userArticleLikes as $userArticleLike): ?>
                <tr>
                    <td><?= $this->Number->format($userArticleLike->id) ?></td>
                    <td><?= $userArticleLike->has('user') ? $this->Html->link($userArticleLike->user->email, ['controller' => 'Users', 'action' => 'view', $userArticleLike->user->id]) : '' ?></td>
                    <td><?= $userArticleLike->has('article') ? $this->Html->link($userArticleLike->article->title, ['controller' => 'Articles', 'action' => 'view', $userArticleLike->article->id]) : '' ?></td>
                    <td><?= h($userArticleLike->created_at) ?></td>
                    <td><?= h($userArticleLike->updated_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $userArticleLike->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $userArticleLike->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $userArticleLike->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userArticleLike->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
