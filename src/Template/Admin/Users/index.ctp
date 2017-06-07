<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Users') ?></h3>
    <hr>
    <div class="clearfix">
       <?= $this->Html->link('<i class="fa fa-fw fa-plus"></i> '.__('Add'), ['controller' => 'Users', 'action' => 'add'],['escape' => false,'class'=>'pull-right mar5 btn btn-info btn-m']) ?>
    </div><?php
                        $loguser = $this->request->session()->read('Auth.User');
                    ?>
    <table class="table">
        <thead class="thead-inverse">
            <tr class="thead-inverse">
                <th><?= $this->Paginator->sort('id','#') ?></th>
                <th><?= $this->Paginator->sort('first_name','First Name') ?></th>
                <th><?= $this->Paginator->sort('last_name','Last Name') ?></th>
                <th><?= $this->Paginator->sort('username','Username') ?></th>
                <th><?= $this->Paginator->sort('email','Email') ?></th>
                <th><?= $this->Paginator->sort('role','Role') ?></th>
                <th><?= $this->Paginator->sort('active','Status?') ?></th>
                <th><?= $this->Paginator->sort('created','Created') ?></th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $this->Number->format($user->id) ?></td>
                <td><?= h($user->first_name) ?></td>
                <td><?= h($user->last_name) ?></td>
                <td><?= $this->Html->link($user->username, ['action' => 'view', $user->id],['escape'=>false]) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= h($user->role) ?></td>
                <td><?= h($user->active?'Active':'Deactive') ?></td>
                <td><?= h($user->created) ?></td>
                <td class="actions text-center">
                    <?= $this->Html->link('<i class="fa fa-fw fa-pencil"></i> ', ['action' => 'edit', $user->id],['escape'=>false]) ?>
                    <?php if($loguser['id'] != $user->id): ?>
                    <?= $this->Form->postLink('<i class="fa fa-fw fa-remove"></i> ', ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->username),'escape'=>false]) ?>
                    <?php endif; ?>
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
