<div class="col-md-6 col-md-offset-3">
	<div class="panel panel-default">
	  	<div class="panel-heading">
    		<div class="avatar">Login</div>
	 	</div>
	  	<div class="panel-body">
    		<form id="login-form" method="post" accept-charset="UTF-8" role="form" action="<?php echo base_url('en/login/check_login'); ?>">
				<fieldset>
				  	<div class="form-group">
				    	<input autocomplete="off" class="form-control" placeholder="Tên đăng nhập" name="username" type="text">
					</div>
					<div class="form-group">
					  <input autocomplete="off" class="form-control" placeholder="Mật khẩu" name="password" type="password" >
					</div>
					<?php if(!empty($message)): ?>
					  <div class="alert alert-warning fade in">
					    <?php echo $message; ?>
					    <button type="button" class="close" data-dismiss="alert">×</button>        
					  </div>                
					<?php endif;?>
					<input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
				</fieldset>
	     	</form>     
	    </div>
	</div>
</div>
