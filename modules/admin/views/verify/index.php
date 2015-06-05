<?php
$resources = base_url().'resources/';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="<?php echo base_url('resources/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('modules/admin/resources/css/verify.css'); ?>">    
    <title><?php echo 'FPT Login' ?></title>
</head>
<body>
<div class="container">
    <div class="row vertical-offset-100">
    	<div class="col-md-6 col-md-offset-3">
    		<div class="login-panel panel panel-default">
			  	<div class="panel-heading">
            		<div class="avatar"></div>
			 	</div>
			  	<div class="panel-body">
		            <form id="fpt-login-form" method="post" accept-charset="UTF-8" role="form" action="<?php echo base_url('admin/verify/auth'); ?>">
		              	<fieldset>
		                  	<div class="form-group">
		                    	<input autofocus id="username" class="form-control" placeholder="Tên đăng nhập" name="username" type="text">
			                </div>
			                <div class="form-group">
			                  <input  class="form-control" placeholder="Mật khẩu" name="password" type="password">
			                </div>
			                
			                <?php if(!empty($message)): ?>
			                  <div class="alert alert-warning fade in">
			                    <?php echo $message; ?>
			                    <button type="button" class="close" data-dismiss="alert">×</button>        
			                  </div>                
			                <?php endif;?>
			                <input class="btn btn-lg btn-success btn-block" type="submit" value="Đăng nhập">
		              	</fieldset>
			     	</form>     
			    </div>
			</div>
		</div>
	</div>
</div>

<!-- script -->

<script type="text/javascript">
    Verify.run();
</script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo base_url('resources/js/jquery-2.1.3.min.js'); ?>"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url('resources/js/bootstrap.min.js'); ?>"></script>
</body>
</html>
