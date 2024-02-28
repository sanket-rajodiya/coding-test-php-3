<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserArticleLike $userArticleLike
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit User Article Like'), ['action' => 'edit', $userArticleLike->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User Article Like'), ['action' => 'delete', $userArticleLike->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userArticleLike->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List User Article Likes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User Article Like'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="userArticleLikes view content">
            <h3><?= h($userArticleLike->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $userArticleLike->has('user') ? $this->Html->link($userArticleLike->user->email, ['controller' => 'Users', 'action' => 'view', $userArticleLike->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Article') ?></th>
                    <td><?= $userArticleLike->has('article') ? $this->Html->link($userArticleLike->article->title, ['controller' => 'Articles', 'action' => 'view', $userArticleLike->article->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($userArticleLike->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($userArticleLike->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated At') ?></th>
                    <td><?= h($userArticleLike->updated_at) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
