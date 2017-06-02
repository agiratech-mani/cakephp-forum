<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Forum Tag'), ['action' => 'edit', $forumTag->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Forum Tag'), ['action' => 'delete', $forumTag->id], ['confirm' => __('Are you sure you want to delete # {0}?', $forumTag->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Forum Tags'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Forum Tag'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="forumTags view large-9 medium-8 columns content">
    <h3><?= h($forumTag->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($forumTag->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($forumTag->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($forumTag->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($forumTag->modified) ?></td>
        </tr>
    </table>
</div>
