<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Forums') ?></h3>
    <hr>
    <div class="clearfix">
       <?php echo $this->Html->link('<i class="fa fa-fw fa-plus"></i> '.__('Add'), ['controller' => 'forumForums', 'action' => 'add'],['escape' => false,'class'=>'pull-right mar5 btn btn-info btn-m']) ?>
    </div>
    <table class="table">
        <thead class="thead-inverse">
            <tr class="thead-inverse">
                <th><?= $this->Paginator->sort('id','#') ?></th>
                <th><?= $this->Paginator->sort('forum_topic_id','Topic') ?></th>
                <th><?= $this->Paginator->sort('title','Title') ?></th>
                <th><?= $this->Paginator->sort('user_id','Posted By') ?></th>
                <th><?= $this->Paginator->sort('status','Status') ?></th>
                <th><?= $this->Paginator->sort('forum_post_count','Posts') ?></th>
                <th><?= $this->Paginator->sort('hits','Views') ?></th>
                <th><?= $this->Paginator->sort('created','Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($forumForums as $forumForum): ?>
            <tr>
                <td><?= $this->Number->format($forumForum->id) ?></td>
                <td><?= $forumForum->has('forum_topic') ? $forumForum->forum_topic->name : '' ?></td>
                <td class="col-md-4"><?= $this->Html->link($forumForum->title, ['controller'=>'ForumPosts','action' => 'index', $forumForum->id,'prefix'=>'admin'], ['escape'=>false]); ?></td>
                <td><?= $forumForum->has('user') ? $forumForum->user->username : '' ?></td>
                <td>
                    <?php
                        if($forumForum->status == 1)
                        {
                            echo "Active";
                        }
                        else if($forumForum->status == 0)
                        {
                            echo "Deactive";
                        }
                        else if($forumForum->status == 2)
                        {
                            echo "Deleted";
                        }
                        else if($forumForum->status == 3)
                        {
                            echo "Closed";
                        }
                    ?>
                </td>
                <td><?= $this->Number->format($forumForum->forum_post_count) ?></td>
                <td><?= $this->Number->format($forumForum->hits) ?></td>
                <td><?= $this->Forum->date($forumForum->created) ?></td>

                <td class="actions text-center">
                    
                    <?php
                    if($forumForum->status == 1 || $forumForum->status == 0)
                    {
                        echo $this->Html->link('<i class="fa fa-fw fa-pencil"></i> ', ['action' => 'edit', $forumForum->id],['escape'=>false]);
                    }
                    if($forumForum->status == 1)
                    {
                        echo  $this->Form->postLink('<i class="fa fa-fw fa-close"></i> ', ['action' => 'changeStatus', $forumForum->id,3], ['confirm' => __('Are you sure you want to close this discussion # {0}?', $forumForum->title),'escape'=>false,'title'=>'To close the discussion']);
                    }
                    ?>

                    <?php
                    if($forumForum->status != 2)
                    {   

                        echo $this->Form->postLink('<i class="fa fa-fw fa-trash"></i> ', ['action' => 'delete', $forumForum->id], ['confirm' => __('Are you sure you want to delete # {0}?', $forumForum->title),'escape'=>false,'title'=>'To delete the discussion']);
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