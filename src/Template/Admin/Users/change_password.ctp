<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Change Password') ?></h3>
    <hr>
    <div class="col-md-8">
            <?= $this->Form->create($user,['class'=>'form-horizontal','type'=>'POST']) ?>
                <fieldset>
                    <div class="form-group required">
                        <label class="col-sm-4 control-label">Old Password</label>
                        <div class="col-sm-8">
                           <?= $this->Form->input('old_password',['class'=>"form-control",'type' => 'password' , 'label'=>false]) ?>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-4 control-label">New  password</label>
                        <div class="col-sm-8">
                            <?= $this->Form->input('password',['class'=>"form-control",'type' => 'password' , 'label'=>false]) ?>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-4 control-label">Confirm New password</label>
                        <div class="col-sm-8">
                            <?= $this->Form->input('confirm_password',['class'=>"form-control",'type' => 'password' , 'label'=>false]) ?>
                        </div>
                    </div>
                    
                    <!-- Change this to a button or input when using this as a form -->
                    <?= $this->Form->button('Submit',['class'=>"btn btn-lg btn-success btn-line pull-right"]) ?>
                </fieldset>
            <?= $this->Form->end() ?>
    </div>
</div>
