<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserArticleLike $userArticleLike
 * @var string[]|\Cake\Collection\CollectionInterface $users
 * @var string[]|\Cake\Collection\CollectionInterface $articles
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $userArticleLike->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $userArticleLike->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List User Article Likes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="userArticleLikes form content">
            <?= $this->Form->create($userArticleLike) ?>
            <fieldset>
                <legend><?= __('Edit User Article Like') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('article_id', ['options' => $articles]);
                    echo $this->Form->control('created_at');
                    echo $this->Form->control('updated_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
