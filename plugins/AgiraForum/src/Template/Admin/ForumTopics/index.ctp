<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Forum Topics') ?></h3>
    <hr>
    <div class="clearfix">
       <?= $this->Html->link('<i class="fa fa-fw fa-plus"></i> '.__('Add'), ['controller' => 'forumTopics', 'action' => 'add'],['escape' => false,'class'=>'pull-right mar5 btn btn-info btn-m']) ?>
    </div>
    <table class="table">
        <thead class="thead-inverse">
            <tr class="thead-inverse">
                <th><?= $this->Paginator->sort('id','#') ?></th>
                <th><?= $this->Paginator->sort('name','Name') ?></th>
                <th><?= $this->Paginator->sort('forum_category_id','Category') ?></th>
                <th><?= $this->Paginator->sort('active','Active?') ?></th>
                <th><?= $this->Paginator->sort('created','Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($forumTopics as $topic): ?>
            <tr>
                <td><?= $this->Number->format($topic->id) ?></td>
                <td><?= h($topic->name) ?></td>
                <td><?= $topic->has('forum_category') ? $this->Html->link($topic->forum_category->name, ['controller' => 'ForumCategories', 'action' => 'view', $topic->forum_category->id]) : '' ?></td>
                <td><?=  ($topic->active)?'Yes':'No' ?></td>
                <td><?= h($topic->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<i class="fa fa-fw fa-pencil"></i> ', ['action' => 'edit', $topic->id],['escape'=>false]) ?>
                    <?= $this->Form->postLink('<i class="fa fa-fw fa-remove"></i> ', ['action' => 'delete', $topic->id], ['confirm' => __('Are you sure you want to delete # {0}?', $topic->name),'escape'=>false]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class="clearfix">
        <div class="paginator pull-right">
            <div class="clearfix">
                <div class="pull-left pagination pagination-counter">
                <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}')]) ?></p>
                </div>
                <div class="pull-left">
                <ul class="pagination">
                    <?= $this->Paginator->first('<<') ?>
                    <?= $this->Paginator->prev('<') ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next('>') ?>
                    <?= $this->Paginator->last('>>') ?>
                </ul>
                </div>
            </div>
        </div>
    </div>
</div>