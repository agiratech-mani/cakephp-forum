<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Forum Categories') ?></h3>
    <hr>
    <div class="clearfix">
       <?= $this->Html->link('<i class="fa fa-fw fa-plus"></i> '.__('Add'), ['controller' => 'forumCategories', 'action' => 'add'],['escape' => false,'class'=>'pull-right mar5 btn btn-info btn-m']) ?>
    </div>
    <table class="table">
        <thead class="thead-inverse">
            <tr class="thead-inverse">
                <th><?= $this->Paginator->sort('id','#') ?></th>
                <th><?= $this->Paginator->sort('name','Name') ?></th>
                <th><?= $this->Paginator->sort('active','Active?') ?></th>
                <th><?= $this->Paginator->sort('created','Created') ?></th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($forumCategories as $forumCategory): ?>
            <tr>
                <td><?= $this->Number->format($forumCategory->id) ?></td>
                <td><?= h($forumCategory->name) ?></td>
                <td><?=  ($forumCategory->active)?'Yes':'No' ?></td>
                <td><?= h($forumCategory->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<i class="fa fa-fw fa-pencil"></i> ', ['action' => 'edit', $forumCategory->id],['escape'=>false]) ?>
                    <?= $this->Form->postLink('<i class="fa fa-fw fa-remove"></i> ', ['action' => 'delete', $forumCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $forumCategory->name),'escape'=>false]) ?>
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
