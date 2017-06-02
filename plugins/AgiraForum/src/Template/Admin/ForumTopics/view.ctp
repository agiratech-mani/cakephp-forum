<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Forum Topic'), ['action' => 'edit', $forumTopic->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Forum Topic'), ['action' => 'delete', $forumTopic->id], ['confirm' => __('Are you sure you want to delete # {0}?', $forumTopic->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Forum Topics'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Forum Topic'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Forum Categories'), ['controller' => 'ForumCategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Forum Category'), ['controller' => 'ForumCategories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="forumTopics view large-9 medium-8 columns content">
    <h3><?= h($forumTopic->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($forumTopic->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Forum Category') ?></th>
            <td><?= $forumTopic->has('forum_category') ? $this->Html->link($forumTopic->forum_category->name, ['controller' => 'ForumCategories', 'action' => 'view', $forumTopic->forum_category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $forumTopic->has('user') ? $this->Html->link($forumTopic->user->id, ['controller' => 'Users', 'action' => 'view', $forumTopic->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($forumTopic->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($forumTopic->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($forumTopic->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $forumTopic->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
