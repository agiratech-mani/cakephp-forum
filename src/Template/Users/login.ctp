<div class="col-md-4 col-md-offset-4">
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Please Sign In</h3>
        </div>
        <div class="panel-body">
            <?= $this->Form->create() ?>
                <fieldset>
                    <div class="form-group">
                        <?= $this->Form->input('username',['class'=>"form-control"]) ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->input('password',['class'=>"form-control"]) ?>
                    </div>
                    <!--<div class="checkbox">
                        <label>
                            <input name="remember" type="checkbox" value="Remember Me">Remember Me
                        </label>
                    </div>-->
                    <!-- Change this to a button or input when using this as a form -->
                    <?= $this->Form->button('Login',['class'=>"btn btn-lg btn-success btn-block"]) ?>
                </fieldset>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>