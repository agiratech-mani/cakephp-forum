<div class="users index large-9 medium-8 columns content">
    <h3><?php echo $title; ?></h3>
    <hr>
    <div class="clearfix">
       <?php //echo $this->Html->link('<i class="fa fa-fw fa-plus"></i> '.__('Add'), ['controller' => 'forumForums', 'action' => 'add'],['escape' => false,'class'=>'pull-right mar5 btn btn-info btn-m']) ?>
    </div>
    <table class="table">
        <thead class="thead-inverse">
            <tr class="thead-inverse">
                <th class="col-md-5"><?= $this->Paginator->sort('content','Content') ?></th>
                <th><?= $this->Paginator->sort('user_id','Posted By') ?></th>
                <th><?= $this->Paginator->sort('status','Status') ?></th>
                <th><?= $this->Paginator->sort('created','Created') ?></th>
                <th><?= $this->Paginator->sort('modified','Updated') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($forumPosts as $forumPost): ?>
            <tr>
                <td><?= $this->Text->truncate($forumPost->content,100,
                [
                    'ellipsis' => '...',
                   'exact' => true,
                    'html' => true
                ]) ?>
                </td>
                <td><?= $forumPost->has('user') ? $forumPost->user->username : '' ?></td>
                <td>
                    <?php
                        if($forumPost->status == 1)
                        {
                            echo "Active";
                        }
                        else if($forumPost->status == 0)
                        {
                            echo "Disabled";
                        }
                        else if($forumPost->status == 2)
                        {
                            echo "Deleted";
                        }
                    ?>
                </td>
                
                <td><?= $this->Forum->date($forumPost->created) ?></td>
                <td><?= $this->Forum->date($forumPost->modified) ?></td>
                <td class="actions text-center">
                    <?php echo $this->Html->link('<i class="fa fa-fw fa-pencil"></i> ', ['action' => 'edit', $forumPost->id],['escape'=>false]) ?>
                    <?php
                    if($forumPost->is_original != 1)
                    {
                        if($forumPost->status == 1)
                        {
                            echo  $this->Form->postLink('<i class="fa fa-fw fa-unlock"></i> ', ['action' => 'changeStatus', $forumPost->id,0], ['confirm' => __('Are you sure you want to disable this content?'),'escape'=>false,'title'=>'To disable this content']);
                        }
                        else if($forumPost->status == 0)
                        {
                            echo  $this->Form->postLink('<i class="fa fa-fw fa-lock"></i> ', ['action' => 'changeStatus', $forumPost->id,1], ['confirm' => __('Are you sure you want to enable this content?'),'escape'=>false,'title'=>'To enable this content']);
                        }
                        ?>

                        <?php
                        if($forumPost->status != 2)
                        {
                             echo  $this->Form->postLink('<i class="fa fa-fw fa-trash"></i> ', ['action' => 'changeStatus', $forumPost->id,2], ['confirm' => __('Are you sure you want to delete this content?'),'escape'=>false,'title'=>'To delete this content']);
                        }
                    }
                    ?>
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