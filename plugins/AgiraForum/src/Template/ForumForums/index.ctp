<div>
    <h3>Forums</h3>
    <hr>
    <div class="clearfix">
       <?= $this->Html->link('<i class="fa fa-fw fa-plus"></i> '.__('Post new Forum'), ['controller' => 'ForumForums', 'action' => 'add'],['escape' => false,'class'=>'pull-right mar5 btn btn-info btn-m']) ?>
    </div>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>FORUM</th>
                    <th>TOPIC</th>
                    <th>STARTED BY</th>
                    <th>POST</th>
                    <th>VIEWS</th>
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
                    <td><?= (!empty($forumForum->user->first_name)?$forumForum->user->first_name." ".$forumForum->user->last_name:$forumForum->user->username) ?></td>
                    <td><?= h($forumForum->forum_post_count) ?></td>
                    <td><?= h($forumForum->hits) ?></td>
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