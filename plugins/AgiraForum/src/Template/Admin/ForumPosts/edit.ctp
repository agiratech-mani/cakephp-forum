<div class="users form large-9 medium-8 columns content">
<h3><?php echo __('Edit Forum Post'); $this->assign('title', __('Edit Forum Post')); ?></h3>
<hr>
<div class="col-md-8">
    <?= $this->Form->create($forumPost,['class'=>'form-horizontal','type'=>'POST']) ?>
    <fieldset>
        <div class="form-group required">
            <label class="col-sm-4 control-label">Status</label>
            <div class="col-sm-8">
                <?= $this->Form->input('status', ['options' => $statuses,'class'=>"form-control",'label'=>false]); ?>
            </div>
        </div>
        <div class="form-group required">
            
            <div class=" col-md-offset-1">
                <?= $this->Form->input('content',['class'=>"form-control jsTextEditor",'label'=>'Content']) ?>
            </div>
        </div>
        
        <?= $this->Form->button('Submit',['class'=>"btn btn-m btn-success btn-inline btnSubmit pull-right",'type'=>'button']) ?>
    </fieldset>
    <?= $this->Form->end() ?>
</div>
</div>