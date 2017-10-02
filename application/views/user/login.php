<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


		<div class="signinpanel">
    <div class="row">
    <div class="col-md-7">
    <div class="signin-info">
    <div class="mb5"></div>
          <h5><strong>SISTEM INFORMASI PRAKTIKUM - TEKNIK ELEKTRO</strong></h5>
          <ul>
          <li></i> Berita Terbaru</li>


                        	<?php $noku=1;foreach ($data as $row):?>
														<?php $dakon=$row->ID_BERITA; if($noku<=3){?>
		<div class="alert alert-success" role="alert">
					<strong><?php  $noku++;echo $row->JUDUL_BERITA;?></strong> <br>
							  	<?php echo character_limiter($row->ISI_BERITA,50); ?><br>
					<a  href="<?php echo site_url();?>user/selanjutnya/<?php echo $row->ID_BERITA;?>">Baca Selengkapnya..</a>
		</div>
	<?php } endforeach;?>
		<div class="mb20"></div>
					<strong>Lihat semua berita? <a href="<?php echo site_url("user/semuaberita")?>"> Klik Disini !!</a></strong>
                    	</ul>
    </div><!-- signin0-info -->
    </div><!-- col-sm-7 -->
    <div class="col-md-5">
					<form action="<?php echo site_url('user/login');?>" class="form-act form-horizontal" role="form" method="post" accept-charset="utf-8">
					<input type="hidden" name="sipteu-token" value="00c0d986e04ef4a07cb263c8a067da5b" style="display:none;" />
					<h4 class="nomargin">Masuk</h4>
          <p class="mt5 mb20">Masukkan Nama Pengguna dan Kata Sandi.</p>
					<input type="text" name="NAMA_USER" value="" class="uname form-control" placeholder="Nama Pengguna/NIM" title="Nama Pengguna/NIM" id="NAMA_USER"  />
					<p class=""></p>
					<input type="password" name="KATASANDI_USER" value="" class="pword form-control" placeholder="Kata Sandi" title="Kata Sandi" id="KATASANDI_USER"  />
					<p class=""></p>
					<button data-loading-text="Tunggu..." class="btn btn-info btn-block">Masuk</button>
					</form>
		</div><!-- col-sm-5 -->
    </div><!-- row -->

    <div class="signup-footer">
    <div class="pull-left">
                Create by <a href="ecmsdev.com" target="_blank">ecmsdev  </a> &copy; 2017. All Rights Reserved.
    </div>
    <div class="pull-right">
                Halaman dimuat dalam <strong>{elapsed_time}</strong> detik
		</div>
		</div>
		</div><!-- signin -->
