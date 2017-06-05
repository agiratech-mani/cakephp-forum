<?= $this->Form->create($forumPost,[
'url' => ['controller' => 'ForumForums', 'action' => 'edit',$forumid,$forumPost->id],
'class'=>'formPostEdit ajaxForm','type'=>'POST',

]) ?>
<fieldset>
    <div class="form-group required clearfix">
        <!--<label class="control-label">Content</label>-->
        <?= $this->Form->input('content',['type'=>'textarea','class'=>"form-control jsTextEditor","id"=>"postdata-".$forumPost->id,'label'=>false]) ?>
       
        <?= $this->Form->input('forum_forum_id',['type'=>'hidden','value'=>$forumid]) ?>
        <?= $this->Form->input('status',['type'=>'hidden','value'=>1]) ?>
    </div>
    <div class="form-group clearfix">
        <a href="#" class="btn btn-m btn-default btn-inline btnCommentCancel" data-id="<?= $forumPost->id ?>">Cancel</a>

        <?= $this->Form->button('Save Comment',['class'=>"btn btn-m btn-success btn-inline pull-right btnSubmit",'type'=>'button']) ?>
    </div>
</fieldset>
<?= $this->Form->end(); ?>