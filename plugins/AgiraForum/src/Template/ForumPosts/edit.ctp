<?= $this->Form->create($forumPost,[
'url' => ['controller' => 'ForumPosts', 'action' => 'edit'],
'class'=>'','type'=>'POST'
]) ?>
<fieldset>
    <div class="form-group required clearfix">
        <label class="control-label">Content</label>
        <?= $this->Form->input('content',['type'=>'textarea','class'=>"form-control",'label'=>false]) ?>
        <?= $this->Form->input('forum_forum_id',['type'=>'hidden','value'=>$forumForum->id]) ?>
        <?= $this->Form->input('status',['type'=>'hidden','value'=>1]) ?>
    </div>
    <div class="form-group clearfix">
        <?= $this->Form->button('Submit',['class'=>"btn btn-m btn-success btn-inline  pull-right"]) ?>
    </div>
</fieldset>
<?= $this->Form->end(); ?>