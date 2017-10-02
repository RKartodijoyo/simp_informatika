<?php
echo $this->session->userdata('HAKAKSES_USER');
 if($this->session->userdata('HAKAKSES_USER') == "1"){?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>CodeIgniter | Insert Employee Details into MySQL Database</title>
		<!--link the bootstrap css file-->
		<link href="<?php echo base_url("assets/css/bootstrap.css"); ?>" rel="stylesheet" type="text/css" />
		<!-- link jquery ui css-->
		<link href="<?php echo base_url('assets/jquery/jquery-ui.min.css'); ?>" rel="stylesheet" type="text/css" />
		<!--include jquery library-->
		<script src="<?php echo base_url('assets/js/jquery-1.10.2.js'); ?>"></script>
		<!--load jquery ui js file-->
		<script src="<?php echo base_url('assets/jquery/jquery-ui.min.js'); ?>"></script>
		<style type="text/css">
			.colbox {
				margin-left: 0px;
				margin-right: 0px;
			}
		</style>
		<script type="text/javascript">
			//load datepicker control onfocus
			$(function() {
				$("#hireddate").datepicker();
			});
		</script>
	</head>
	<body>
		<?php
			$attributes = array("class" => "form-horizontal", "id" => "employeeform", "name" => "employeeform");
				echo form_open("depan/ubahpraktikum", $attributes);?>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>NO</th>
					<th>NIM</th>
					<th>Nama praktikum</th>
					<th>Status Pembayaran</th>
					<th>Tanggal Praktek</th>
					<th>Mengikuti Praktek</th>
					<th>Nama Dosen Pembimbing</th>
					<th>Tanggal Pengumpulan</th>
					<th>Pengumpulan Laporan </th>
					<th>Nilai</th>
				</tr>
			</thead>
			<tbody>
			<?php if(empty($qbarang)){ ?>
			<tr>
				<td colspan="6">Data tidak ditemukan</td>
			</tr>
			<?php }else{ $no=0;
				foreach($qbarang as $rowbarang){ $no++;?>
			<tr>
				<td><?=$no?></td>
				<td><?=$rowbarang->nim?></td>
				<?php
				foreach($namaku_praktikum as $kotak){
					if($rowbarang->kode_praktikum==$kotak->id_praktikum){
						$cewek = $kotak->nama_praktikum;
					}
				}
				?>
				<td><?echo $cewek;?></td>
				<td><?php
				if($rowbarang->status_pembayaran=='0'){
					echo "belum";
				}
				else{echo "lunas";}?></td>
				<td><?php
					if($rowbarang->tanggal_praktek == '0000-00-00'){
						echo "belum ditentukan";
					}
				else{echo $rowbarang->tanggal_praktek;}?></td>
				<td><?php
					if($rowbarang->daftar_hadir=='0'){
						echo "belum";
					}
					else{echo "selesai";}?></td>
				<?php
					foreach($namaku_dosen as $kotakku){
						if($rowbarang->nama_dopem=='0'){
							$cowok ="belum";
						}
						else if ($rowbarang->nama_dopem==$kotakku->id){
							$cowok =$kotakku->nama;
						}
					}?>
				<td><?=$cowok?></td>
				<td><?php
					if($rowbarang->bimbingan=='0'){
						echo "belum";
					}
					else{
						echo "selesai";
					}
				?></td>
				<td><?php
					if($rowbarang->tanggal_pengumpulan == '0000-00-00'){
						echo "belum mengumpulkan";
					}
					else{
						echo $rowbarang->pengumpulan;
					}
				?></td>
					<td><?php
						if($rowbarang->nilai==''){
							echo 'E';
						}
					else{
						echo $rowbarang->nilai;
					}
				?></td><td><a href="<?=base_url()?>depan/hapus/<?=$rowbarang->id?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin menghapus data ini?')"><i class="glyphicon glyphicon-trash"></i></a>
</td>
			</tr>
    <?php }}?>
		</tbody>
		</table>
			<?php echo form_close(); ?>
			<?php echo $this->session->flashdata('msg'); ?>
		</div>
    </body>
</html>
<?php }?>
