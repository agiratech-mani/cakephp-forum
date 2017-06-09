<div class="col-md-4 col-md-offset-4">
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $this->assign('title', 'Reset Password'); ?><?php echo __('Reset Password'); ?></h3>
        </div>
        <div class="panel-body">
            <?= $this->Form->create() ?>
              <fieldset>
                  <div class="form-group required">
                      <?= $this->Form->input('password',['autofocus' => true,'label' => 'Password','required'=>true, 'class'=>"form-control"]) ?>
                  </div>
                  <div class="form-group required">
                      <?= $this->Form->input('confirm_password',['type' => 'password','label' => 'Confirm Password','required'=>true, 'class'=>"form-control"]) ?>
                  </div>
                  <?= $this->Form->button('Submit',['class'=>"btn btn-lg btn-success btn-block"]) ?>
              </fieldset>
          <?= $this->Form->end() ?>
        </div>
    </div>
</div>


<?php $this->assign('title', 'Reset Password'); ?>
<div class="users form large-9 medium-8 columns content">
    <?php echo $this->Form->create($user) ?>
    <fieldset>
        <legend><?php echo __('Reset Password') ?>
    <?php
        echo $this->Form->input('password', ['required' => true, 'autofocus' => true]); ?>
        <p class="helper">Passwords must be at least 8 characters and contain at least 1 number, 1 uppercase, 1 lowercase and 1 special character</p>
    <?php 
        echo $this->Form->input('confirm_password', ['type' => 'password', 'required' => true]);
    ?>
    </fieldset>
 	<?php echo $this->Form->button(__('Submit')); ?>
    <?php echo $this->Form->end(); ?>
</div>