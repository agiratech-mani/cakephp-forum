<div class="col-md-6 col-md-offset-3">
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Register</h3>
        </div>
        <div class="panel-body">
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
                    <!--<div class="checkbox">
                        <label>
                            <input name="remember" type="checkbox" value="Remember Me">Remember Me
                        </label>
                    </div>-->
                    <!-- Change this to a button or input when using this as a form -->
                    <?= $this->Html->link(__('Log In'),['controller' => 'Users', 'action' => 'login','prefix'=>false],['escape' => false,'class'=>"btn btn-m btn-info btn-inline  pull-left col-md-offset-1 col-sm-offset-1"]) ?>
                    <?= $this->Form->button('Register',['class'=>"btn btn-m btn-success btn-inline  pull-right"]) ?>
                </fieldset>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>