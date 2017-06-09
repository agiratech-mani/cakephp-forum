<div class="users index large-9 medium-8 columns content">
	<h3><?= $title ?></h3>
  <hr>
  <div class="pull-right">
  		 <?= $this->Html->link('Back',['controller'=>'Users','action'=>'index'],['escape'=>false,'class'=>'btn btn-default pull-right ']) ?> 
  		 <?= $this->Html->link('Edit',['controller'=>'Users','action'=>'edit',$user->id],['escape'=>false,'class'=>'btn btn-primary mr-10']) ?>
  </div>
  <div  class="col-md-7">
  	
	  <table class="table-bordered table">
	  	<tr>
	  		<th class="col-md-2 text-right">Name :</th><td><?php echo $user->first_name." ".$user->last_name; ?></td>
	  	</tr>
	  	<tr>
	  		<th class="col-md-2  text-right">Username :</th><td><?php echo $user->username; ?></td>
	  	</tr>
	  	<tr>
	  		<th class="col-md-2  text-right">Email :</th><td><?php echo $user->email; ?></td>
	  	</tr>
	  	<tr>
	  		<th class="col-md-2  text-right">Role :</th><td><?php echo $user->role; ?></td>
	  	</tr>
	  	<tr>
	  		<th class="col-md-2  text-right">Active :</th><td><?php echo $user->active?'Yes':'No'; ?></td>
	  	</tr>
	  </table>
  </div>
</div>