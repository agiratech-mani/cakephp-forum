<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $forumForum->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $forumForum->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Forum Forums'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Forum Topics'), ['controller' => 'ForumTopics', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Forum Topic'), ['controller' => 'ForumTopics', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Forum Posts'), ['controller' => 'ForumPosts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Forum Post'), ['controller' => 'ForumPosts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Forum Tags'), ['controller' => 'ForumTags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Forum Tag'), ['controller' => 'ForumTags', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="forumForums form large-9 medium-8 columns content">
    <?= $this->Form->create($forumForum) ?>
    <fieldset>
        <legend><?= __('Edit Forum Forum') ?></legend>
        <?php
            echo $this->Form->input('slug');
            echo $this->Form->input('forum_topic_id', ['options' => $forumTopics]);
            echo $this->Form->input('title');
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('status');
            echo $this->Form->input('forum_post_count');
            echo $this->Form->input('hits');
            echo $this->Form->input('forum_tags._ids', ['options' => $forumTags]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
