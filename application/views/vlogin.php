<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Forms</title>

<link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>css/datepicker3.css" rel="stylesheet">
<link href="<?php echo base_url();?>css/login.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

	<body>
		<div class="container">
	    
		<div class="col-sm-8 col-sm-offset-2 main">
		<div class="col-sm-6 left-side">
		<img id="profile-img" class="profile-img-card" src="<?php echo base_url();?>img/siput-logo.png" />
		<h1>SIPUT</h1>
		<p>(Sistem Informasi Keuangan RT)</p>
		</div><!--col-sm-6-->
		
		<div class="col-sm-6 right-side">
		<h1>Login</h1>
		
<!--Form with header-->

<form action="<?php echo base_url('login/aksi_login'); ?>" method="post" role="form">
<fieldset>
<div class="form">
        <div class="form-group">
		    <label for="form2">Username</label>
            <input type="text" id="form2" class="form-control" name="username" autofocus="">
            
        </div>

        <div class="form-group">
		    <label for="form4">Password</label>
            <input type="password" id="form4" class="form-control" name="password" autofocus="">      
        </div>
		<div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
 		<div class="form-group">
	        <input type="submit" class="btn btn-lg btn-primary btn-block" value="Sign in">
	    </div>
	    </div>
	    </fieldset>
	  
</form>

</div>
<!--/Form with header-->

		</div><!--col-sm-6-->
		
		
        </div><!--col-sm-8-->
        
        </div><!--container-->

		

	<script src="<?php echo base_url();?>js/jquery-1.11.1.min.js"></script>
	<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
	
</body>

</html>
