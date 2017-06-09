<div class="col-md-4 col-md-offset-4">
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $this->assign('title', 'Request Password Reset'); ?><?php echo __('Forgot Password'); ?></h3>
        </div>
        <div class="panel-body">
        	<?= $this->Form->create() ?>
              <fieldset>
                  <div class="form-group required">
                      <?= $this->Form->input('email',['autofocus' => true,'label' => 'Email address','required'=>true, 'class'=>"form-control"]) ?>
                  </div>
                  <?= $this->Form->button('Submit',['class'=>"btn btn-lg btn-success btn-block"]) ?>
              </fieldset>
          <?= $this->Form->end() ?>
        </div>
    </div>
</div>