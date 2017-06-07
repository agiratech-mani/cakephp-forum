<div class="users form large-9 medium-8 columns content">
    <h3><?= $title ?></h3>
    <hr>
    <div class="col-md-8">
        <?= $this->Form->create($forumTag,['class'=>'form-horizontal','type'=>'POST']) ?>
        <fieldset>
            <div class="form-group required">
                <label class="col-sm-4 control-label">Name</label>
                <div class="col-sm-8">
                    <?= $this->Form->input('name',['class'=>"form-control",'label'=>false]) ?>
                </div>
            </div>
            <div class="form-group ">

                <label class="col-sm-4 control-label"></label>
                <div class="col-sm-8 checkbox">
                    <?= $this->Form->input('active',['label'=>'Active?','type'=>'checkbox']) ?>
                </div>
            </div>
            <?= $this->Form->button('Submit',['class'=>"btn btn-m btn-success btn-inline  pull-right"]) ?>
            <?= $this->Html->link('Cancel',['action'=>'index'],['class'=>'btn btn-default btn-inline  pull-right mr-10']) ?>
        </fieldset>
        <?= $this->Form->end() ?>
    </div>
</div>