<h3>
    <?= $title ?>
</h3>
<hr>
<div class="col-md-4 col-md-offset-4">
    <div class="login-panel panel panel-default">
        <div class="panel-body">
            <?= $this->Form->create($user,['type'=>'POST']) ?>
                <fieldset>
                    <div class="form-group required">
                        <?= $this->Form->input('old_password',['class'=>"form-control",'type' => 'password' , 'label'=>'Old password']) ?>
                    </div>
                    <div class="form-group required">
                        <?= $this->Form->input('password',['class'=>"form-control",'type' => 'password' , 'label'=>'New  password']) ?>
                    </div>
                    <div class="form-group required">
                        <?= $this->Form->input('confirm_password',['class'=>"form-control",'type' => 'password' , 'label'=>'Confirm New password']) ?>
                    </div>
                    <!-- Change this to a button or input when using this as a form -->
                    <?= $this->Form->button('Save',['class'=>"btn btn-lg btn-success btn-block"]) ?>
                </fieldset>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>