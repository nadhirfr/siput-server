<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SIPUT <SISTEM KEUANGAN RT> </title>

<link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>css/datepicker3.css" rel="stylesheet">
<link href="<?php echo base_url();?>css/styles.css" rel="stylesheet">

<!--Icons-->
<script src="<?php echo base_url();?>js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>SIPUT</span> Sistem Keuangan RT</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?php echo $data_user[0]->user_username;?> <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
							<li><a href="#"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Settings</a></li>
							<li><a href="<?php echo base_url('login/logout'); ?>"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>

	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">
			<li class="active"><a href="<?php echo base_url('home')?>"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-home"></use></svg> Beranda</a></li>
			<li><a href="<?php echo base_url('pemasukan')?>"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Pemasukan </a></li>
			<li><a href="<?php echo base_url('grafik')?>"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Grafik Pemasukan dan Pengeluaran</a></li>
			<li><a href="<?php echo base_url('warga')?>"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Data Warga</a></li>
		
			<li class="parent ">
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> Dropdown 
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li>
						<a class="" href="#">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 1
						</a>
					</li>
					<li>
						<a class="" href="#">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 2
						</a>
					</li>
					<li>
						<a class="" href="#">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 3
						</a>
					</li>
				</ul>
			</li>
			<li role="presentation" class="divider"></li>

		</ul>
		<div class="attribution">SIPUT <a href="http://www.medialoot.com/item/lumino-admin-bootstrap-template/"></a><br/><a href="http://www.glyphs.co" style="color: #333;">Icons by Glyphs</a></div>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Icons</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Selamat Datang <?php echo $data_user[0]->user_displayname; ?> </h1>
			</div>
		</div><!--/.row-->
		<div class="alert bg-success" role="alert">
					<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> SIPUT adalah Sistem Informasi Manajemen Keuangan yang disediakan untuk warga dalam memantau keuangan dalam lingkup RT. Dengan adanya sistem informasi ini diharapkan warga dapat memantau semua dana masuk dan keluar. <a href="#" class="pull-right"></a>
				</div>
		
		<div class="row">
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked arrow down"><use xlink:href="#stroked-arrow-down"/></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">Rp <?php echo $total_pemasukan[0]->Jumlah; ?></div>
							<div class="text-muted">Pemasukan</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked arrow up"><use xlink:href="#stroked-arrow-up"/></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">Rp <?php echo $total_pengeluaran[0]->Jumlah; ?></div>
							<div class="text-muted">Pengeluaran</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $total_user;?></div>
							<div class="text-muted">Jumlah User</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-red panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked app-window-with-content"><use xlink:href="#stroked-app-window-with-content"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">Rp <?php echo $deposit[0]->deposit_jumlah;; ?></div>
							<div class="text-muted">Deposit</div>
						</div>
					</div>
				</div>
			</div>
			
			
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Iuran Yang Harus Dibayar</div>
					<div class="panel-body">
						<table data-toggle="table"  data-url="x" data-show-refresh="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
						        <th data-sortable="true">Nama Iuran</th>
						        <th data-sortable="true">Status</th>
						        <th data-sortable="true">Jenis Iuran</th>
						        <th data-sortable="true">Kategori Iuran</th>
						        <th data-sortable="true">Nominal (@iuran)</th>
						        <th data-sortable="true">Kekurangan</th>
						    </tr>
						    </thead>
							<tbody>
							<?php foreach ($data_iuran_user as $key => $value) { ?>
							<tr>
								<td><?php echo $value->iuran_nama ?></td>
								<td><?php $tampil = $value->iuran_user_status == 1 ? "Lunas" : $tampil = "Belum Lunas";
											echo $tampil;?></td>
								<td><?php echo $value->iuran_jenis_nama ?></td>
								<td><?php echo $value->iuran_kategori_nama ?></td>
								<td><?php echo $value->iuran_nominal ?></td>
								<td><?php $tampil = $value->iuran_user_status == 1 ? "0" : $value->iuran_kekurangan;
											echo $tampil; ?></td>
							</tr>
							<?php } ?>
							</tbody>
						</table>
						<p>
							<?php //var_dump($data_iuran_user);?>
						</p>
					</div>
				</div>
			</div>
		</div>				
	
	<!--<div class="col-md-4">
	
				<div class="panel panel-red">
					<div class="panel-heading dark-overlay"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg>Calendar</div>
					<div class="panel-body">
						<div id="calendar"></div>
					</div>
				</div>
	</div>-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url();?>js/bootstrap-table.js"></script>
	<script>
		$('#calendar').datepicker({
		});

		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>
