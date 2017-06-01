<div class="users form large-9 medium-8 columns content">
    <h3><?= __('Add User') ?></h3>
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
        <div class="form-group required">
            <label class="col-sm-4 control-label">Email</label>
            <div class="col-sm-8">
                <?= $this->Form->input('email',['class'=>"form-control",'label'=>false]) ?>
            </div>
        </div>
        <div class="form-group required">
            <label class="col-sm-4 control-label">Role</label>
            <div class="col-sm-8">
                <?=  $this->Form->select('role', 
                    ['user'=>'User','admin'=>'Admin','moderator'=>'Moderator'],
                    [
                        'multiple' => false,
                        'class'=>"form-control",'label'=>false
                    ]); ?>
            </div>
        </div>
        <div class="form-group required">
            <label class="col-sm-4 control-label">Username</label>
            <div class="col-sm-8">
                <?= $this->Form->input('username',['class'=>"form-control",'label'=>false]) ?>
                <?= $this->Form->input('role',['class'=>"form-control",'label'=>false,'type'=>'hidden','value'=>'user']) ?>
            </div>
        </div>
        <div class="form-group required">
            <label class="col-sm-4 control-label">Password</label>
            <div class="col-sm-8">
                <?= $this->Form->input('password',['class'=>"form-control",'label'=>false]) ?>
            </div>
        </div>
        <div class="form-group required">
            <label class="col-sm-4 control-label">Confirm Password</label>
            <div class="col-sm-8">
                <?= $this->Form->input('confirm_password',['class'=>"form-control",'label'=>false,'type'=>'password']) ?>
            </div>
        </div>
        <?= $this->Form->button('Submit',['class'=>"btn btn-m btn-success btn-inline  pull-right"]) ?>
    </fieldset>
<?= $this->Form->end() ?>
</div>
</div>
