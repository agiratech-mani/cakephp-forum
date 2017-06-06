<div>
    <h3>Forums</h3>
    <hr>
    <div class="clearfix">
       <?= $this->Html->link('<i class="fa fa-fw fa-plus"></i> '.__('New Forum'), ['controller' => 'ForumForums', 'action' => 'add'],['escape' => false,'class'=>'pull-right mar5 btn btn-info btn-m']) ?>
    </div>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>FORUM</th>
                    <th>TOPIC</th>
                    <th>STATUS</th>
                    <th>POST</th>
                    <th>VIEWS</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            if(!$forumForums->isEmpty())
            {
                foreach ($forumForums as $forumForum): 
            ?>
                <tr>
                    <td><?= $this->Html->link($forumForum->title, ['controller' => 'ForumForums', 'action' => 'view', $forumForum->slug]) ?></td>
                    <td><?= h($forumForum->forum_topic->name); ?></td>
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
                    <td class="text-center">
                    <?php
                    if($forumForum->status == 1)
                    {
                        echo $this->Html->link('<i class="fa fa-pencil"></i>', ['controller' => 'ForumForums', 'action' => 'forumEdit', $forumForum->id],['escape'=>false]);
                    }
                    ?>
                    </td>
                </tr>
            <?php 
                endforeach; 
            }
            else
            {
            ?>
                <tr>
                    <td colspan="5" class="text-center">
                        <p>No forum availbles.</p>
                    </td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>