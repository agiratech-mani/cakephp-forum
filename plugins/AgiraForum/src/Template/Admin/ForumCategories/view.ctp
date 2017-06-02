<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Forum Category'), ['action' => 'edit', $forumCategory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Forum Category'), ['action' => 'delete', $forumCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $forumCategory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Forum Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Forum Category'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Forum Topics'), ['controller' => 'ForumTopics', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Forum Topic'), ['controller' => 'ForumTopics', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="forumCategories view large-9 medium-8 columns content">
    <h3><?= h($forumCategory->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($forumCategory->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($forumCategory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($forumCategory->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($forumCategory->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $forumCategory->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Forum Topics') ?></h4>
        <?php if (!empty($forumCategory->forum_topics)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Forum Category Id') ?></th>
                <th scope="col"><?= __('Active') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($forumCategory->forum_topics as $forumTopics): ?>
            <tr>
                <td><?= h($forumTopics->id) ?></td>
                <td><?= h($forumTopics->name) ?></td>
                <td><?= h($forumTopics->forum_category_id) ?></td>
                <td><?= h($forumTopics->active) ?></td>
                <td><?= h($forumTopics->created) ?></td>
                <td><?= h($forumTopics->modified) ?></td>
                <td><?= h($forumTopics->user_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ForumTopics', 'action' => 'view', $forumTopics->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ForumTopics', 'action' => 'edit', $forumTopics->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ForumTopics', 'action' => 'delete', $forumTopics->id], ['confirm' => __('Are you sure you want to delete # {0}?', $forumTopics->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
