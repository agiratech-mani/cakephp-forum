<div class="users form large-9 medium-8 columns content">
    <h3><?= __('Edit User') ?></h3>
    <hr>
    <div class="col-md-8">
     <?= $this->Form->create($user,['class'=>'form-horizontal','type'=>'POST']) ?>
    <fieldset>
        <div class="form-group required">
            <label class="col-sm-4 control-label">First Name</label>
            <div class="col-sm-8">
                <?= $this->Form->input('first_name',['class'=>"form-control",'label'=>false]) ?>
            </div>
        </div>
        <div class="form-group required">
            <label class="col-sm-4 control-label">Last Name</label>
            <div class="col-sm-8">
                <?= $this->Form->input('last_name',['class'=>"form-control",'label'=>false]) ?>
            </div>
        </div>
        <?= $this->Form->button('Submit',['class'=>"btn btn-m btn-success btn-inline  pull-right"]) ?>
    </fieldset>
<?= $this->Form->end() ?>
</div>
</div>
