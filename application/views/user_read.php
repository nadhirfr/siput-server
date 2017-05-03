<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">User Read</h2>
        <table class="table">
	    <tr><td>User Username</td><td><?php echo $user_username; ?></td></tr>
	    <tr><td>User Displayname</td><td><?php echo $user_displayname; ?></td></tr>
	    <tr><td>User Password</td><td><?php echo $user_password; ?></td></tr>
	    <tr><td>User Tipe</td><td><?php echo $user_tipe; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('user') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>