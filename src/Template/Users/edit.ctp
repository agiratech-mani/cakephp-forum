<h3>
    <?= $title ?>
</h3>
<hr>
<div class="col-md-6 col-md-offset-3">
    <div class="login-panel panel panel-default">
       
        <div class="panel-body">
            <?= $this->Form->create($user,['class'=>'form-horizontal','type'=>'POST']) ?>
                <fieldset>
                    <div class="form-group ">
                        <label class="col-sm-4 control-label">Email</label>
                        <div class="col-sm-8">
                           <label class="control-label"> <?= $user['email'] ?></label>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="col-sm-4 control-label">Username</label>
                        <div class="col-sm-8">
                            <label class="control-label"> <?= $user['username'] ?></label>
                        </div>
                    </div>
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
</div>