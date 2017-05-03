<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>

<head>
	<title>Profil</title>
	<?php echo link_tag('assets/css/style.css'); ?>
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
</head>

<body>
	<div class="wrapper">
		<header>
			<div class="banner">
			</div>
			<nav>
				<ul>
					<a href="<?php echo base_url() ?>">
						<li>Beranda</li>
					</a>
					<a href="<?php echo base_url('profil') ?>">
						<li>Profil</li>
					</a>
					<a href="<?php echo base_url('pengajuan') ?>">
						<li>Pengajuan</li>
					</a>
					<a href="<?php echo base_url('alur') ?>">
						<li>Alur Pendaftaran</li>
					</a>
					<a href="<?php echo base_url('kontak') ?>">
						<li>Kontak</li>
					</a>
					<a href="<?php echo base_url('logout') ?>">
						<li style="float:right">Logout</li>
					</a>
				</ul>
			</nav>
		</header>

		<section class="courses">

			<hgroup>
				<table style="width: 980px;">
					<tr>
						<td rowspan="15" width="250px">
						</td>
					</tr>
					<tr>
						<td><b>NIM</b></td>
						<td>:</td>
						<td>
							<?php echo $nim ?>
						</td>
					</tr>
					<tr>
						<td><b>Nama</b></td>
						<td>:</td>
						<td>
							<?php echo $nama ?>
						</td>
					</tr>
					<tr>
						<td><b>Tanggal Lahir</b></td>
						<td>:</td>
						<td>
							<?php echo $tanggal_lahir ?>
						</td>
					</tr>
					<tr>
						<td><b>Jenis Kelamin</b></td>
						<td>:</td>
						<td>
							<?php echo $jenis_kelamin ?>
						</td>
					</tr>
					<tr>
						<td><b>Asal</b></td>
						<td>:</td>
						<td>
							<?php echo $asal ?>
						</td>
					</tr>
					<tr>
						<td><b>Jurusan</b></td>
						<td>:</td>
						<td>
							<?php echo $jurusan ?>
						</td>
					</tr>
					<tr>
						<td><b>Angkatan</b></td>
						<td>:</td>
						<td>
							<?php echo $angkatan ?>
						</td>
					</tr>
					<tr>
						<td><b>No.HP</b></td>
						<td>:</td>
						<td>
							<?php echo $no_hp ?>
						</td>
					</tr>
				</table>
			</hgroup>
		</section>

		<footer>
			&copy; 2017 SISTEM INFORMASI KP
		</footer>
	</div>
</body>

</html>
