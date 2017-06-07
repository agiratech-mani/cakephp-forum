<div>
    <h3>Posts</h3>
    <hr>
    <ul class="list-group">
    <?php 
    if(!$forumPosts->isEmpty())
    {
        foreach ($forumPosts as $forumPost): 
    ?>  
            <li class="list-group-item " style="margin-bottom:10px;">
                    <?php
                        if($forumPost->status == 1)
                        {
                    ?>
                            <span class="pull-right btn btn-xs btn-success"><?= "Active"; ?></span>
                    <?php
                        }
                        else if($forumPost->status == 0)
                        {
                            ?>
                            <span class="pull-right btn btn-xs btn-warning"><?= "Disabled"; ?></span>
                    <?php
                        }
                        else if($forumPost->status == 2)
                        {
                    ?>
                            <span class="pull-right btn btn-xs btn-danger"><?= "Deleted"; ?></span>
                    <?php
                        }
                    ?>
                <?= $this->Text->truncate($forumPost->content,200,
                [
                    'ellipsis' => '...',
                   'exact' => true,
                    'html' => true
                ]) ?>
                <hr>
                <div class="text-muted"> 
                <span>
                in <?= $this->Html->link($forumPost->forum_forum->title,['controller'=>'ForumForums','action'=>'view',$forumPost->forum_forum->slug,"#" => "Comment-".$forumPost->id]) ?>
                </span>
                <span>Comment on <?php echo $this->Forum->date($forumPost->created); ?></span>
                </div>
            </li>
    <?php 
        endforeach; 
    }
    else
    {
    ?>
        <li class="list-group-item">No post availbles.</li>
    <?php
    }
    ?>
    </ul>
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