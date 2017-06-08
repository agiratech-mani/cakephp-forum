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
            <br>
            <h4 class="text-center">OR</h4>
            <div class="social-buttons">
            <span>Login via </span>
            <br>
            <?php 
            echo $this->Form->postLink(
                '<i class="fa fa-facebook"></i> Facebook',
                ['controller' => 'Users', 'action' => 'login', '?' => ['provider' => 'Facebook']],['escape'=>false,'class'=>'btn btn-fb']
            );
            ?>
            <?php 
            echo $this->Form->postLink(
                '<i class="fa fa-twitter"></i> Twitter',
                ['controller' => 'Users', 'action' => 'login', '?' => ['provider' => 'Twitter']],['escape'=>false,'class'=>'btn btn-tw']
            );
            ?>
            </div>
        </div>
    </div>
</div>