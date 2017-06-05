<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Forum Forum'), ['action' => 'edit', $forumForum->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Forum Forum'), ['action' => 'delete', $forumForum->id], ['confirm' => __('Are you sure you want to delete # {0}?', $forumForum->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Forum Forums'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Forum Forum'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Forum Topics'), ['controller' => 'ForumTopics', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Forum Topic'), ['controller' => 'ForumTopics', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Forum Posts'), ['controller' => 'ForumPosts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Forum Post'), ['controller' => 'ForumPosts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Forum Tags'), ['controller' => 'ForumTags', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Forum Tag'), ['controller' => 'ForumTags', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="forumForums view large-9 medium-8 columns content">
    <h3><?= h($forumForum->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($forumForum->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Forum Topic') ?></th>
            <td><?= $forumForum->has('forum_topic') ? $this->Html->link($forumForum->forum_topic->name, ['controller' => 'ForumTopics', 'action' => 'view', $forumForum->forum_topic->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($forumForum->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $forumForum->has('user') ? $this->Html->link($forumForum->user->id, ['controller' => 'Users', 'action' => 'view', $forumForum->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($forumForum->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($forumForum->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Forum Post Count') ?></th>
            <td><?= $this->Number->format($forumForum->forum_post_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hits') ?></th>
            <td><?= $this->Number->format($forumForum->hits) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($forumForum->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($forumForum->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Forum Posts') ?></h4>
        <?php if (!empty($forumForum->forum_posts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Forum Forum Id') ?></th>
                <th scope="col"><?= __('Content') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($forumForum->forum_posts as $forumPosts): ?>
            <tr>
                <td><?= h($forumPosts->id) ?></td>
                <td><?= h($forumPosts->forum_forum_id) ?></td>
                <td><?= h($forumPosts->content) ?></td>
                <td><?= h($forumPosts->user_id) ?></td>
                <td><?= h($forumPosts->status) ?></td>
                <td><?= h($forumPosts->created) ?></td>
                <td><?= h($forumPosts->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ForumPosts', 'action' => 'view', $forumPosts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ForumPosts', 'action' => 'edit', $forumPosts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ForumPosts', 'action' => 'delete', $forumPosts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $forumPosts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Forum Tags') ?></h4>
        <?php if (!empty($forumForum->forum_tags)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($forumForum->forum_tags as $forumTags): ?>
            <tr>
                <td><?= h($forumTags->id) ?></td>
                <td><?= h($forumTags->name) ?></td>
                <td><?= h($forumTags->created) ?></td>
                <td><?= h($forumTags->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ForumTags', 'action' => 'view', $forumTags->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ForumTags', 'action' => 'edit', $forumTags->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ForumTags', 'action' => 'delete', $forumTags->id], ['confirm' => __('Are you sure you want to delete # {0}?', $forumTags->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
