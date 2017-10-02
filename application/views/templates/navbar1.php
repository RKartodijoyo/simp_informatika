<div class="col-md-12 margin-top-30">
<div id="hornav" class="pull-right visible-lg">
  <ul class="nav navbar-nav">
    <li><a href="<?php echo site_url("depan/index")?>">Home</a></li>
    <?php if ($this->session->userdata('HAKAKSES_USER') == "1"): ?>
      <li><span>Profil</span>
        <ul>
          <li><a href="<?php echo site_url("depan/lihatprofil")?>">Lihat Profil</a></li>
          <li><a href="<?php echo site_url("depan/ubahprofil")?>">Ubah Profil</a></li>
          <li><a href="<?php echo site_url("depan/ubahpassmahasiswa")?>">Ubah Password</a></li>
        </ul>
      </li>
      <li><span>Praktikum</span>
        <ul>
          <li><a href="<?php echo site_url("depan/lihatpraktikum")?>">Lihat Praktikum</a></li>
          <li><a href="<?php echo site_url("depan/tambahpraktikum")?>">Tambah Praktikum</a></li>
          <li><a href="<?php echo site_url("depan/ubahpraktikum")?>">Ubah Praktikum</a></li>
          <li><a href="<?php echo site_url("depan/cetakpembayaran")?>">Cetak Form Pembayaran</a></li>
          <li><a href="<?php echo site_url("depan/konfirmasipembayaran")?>">Konfirmasi Pembayaran</a></li>
          <li><a href="<?php echo site_url("depan/cetakkartu")?>">Cetak kartu</a></li>
        </ul>
      </li>
      <li><span>Tanggungan</span>
        <ul>
          <li><a href="<?php echo site_url("depan/prosespraktikum")?>">Proses Praktikum</a></li>
          <li><a href="<?php echo site_url("depan/tanyamahasiswa")?>">Tanya</a></li>
          <li><a href="<?php echo site_url("depan/questioner_mahasiswa")?>">Questioner Mahasiswa</a></li>
        </ul>
      </li>
<?php endif; ?>
<?php if ($this->session->userdata('HAKAKSES_USER') == "2"): ?>
<li><span>Profil</span>
<ul>
<li><a href="view-profile-dosen.php">Lihat Profil</a></li>
<li><a href="edit-profile-dosen.php">Ubah Profil</a></li>
<li><a href="questioner-dosen">Questioner</a></li>
</ul>
</li>
<li><span>Bimbingan</span>
<ul>
<li><a href="<?php echo site_url("depan/dosenbimbingan")?>">Daftar Bimbingan</a></li>
<li><a href="<?php echo site_url("depan/bimbingan")?>">Proses Bimbingan</a></li>
<li><a href="score-bimbingan.php">Nilai Bimbingan</a></li>
</ul>
</li>
</li>		                <?php endif; ?>
<?php if ($this->session->userdata('HAKAKSES_USER') == "3"): ?>
<li><span>Verifikasi</span>
<ul>


<li><a href="register-login.php">Verifikasi Login</a></li>
<li><a href="<?php echo site_url("depan/verifikasipembayaran")?>">Verifikasi Pembayaran</a></li>
<li><a href="<?php echo site_url("depan/verifikasikehadiran")?>">Verifikasi Kehadiran</a></li>
<li><a href="<?php echo site_url("depan/verifikasipengumpulan")?>">Verifikasi Pengumpulan</a></li>
</ul>
</li>
<li><span>Input data</span>
<ul>
<li><a href="<?php echo site_url("depan/pelaksanaanpraktikum")?>">Pelaksanaan Praktikum</a></li>
<li><a href="<?php echo site_url("depan/dosenpembimbing")?>">Dosen Pembimbing</a></li>
<li><a href="verification-manual.php">Verifikasi Manual</a></li>
<li><a href="<?php echo site_url("depan/tambahuser")?>">Tambah User</a></li>
<li><a href="<?php echo site_url("depan/tambahberita")?>">Tambah Berita</a></li>

</ul>
</li>
<li><span>Cetak dan Kirim</span>
<ul>
<li><a href="list-name.php">Pengumuman daftar nama</a></li>
<li><a href="letter-bimbingan">Surat Bimbingan</a></li>
<li><a href="Score-praktikum">Surat Pengantar Nilai Praktikum</a></li>
</ul>
</li>
<?php endif; ?>
      <li><a href="<?php echo site_url('user/logout');?>">Logout</a></li>


    </ul>
</div>
</div>
  <div class="clear">

  </div>

<!-- End Top Menu -->
</div>
</div>
<!-- === END HEADER === -->
<!-- === BEGIN CONTENT === -->
<div id="content" class="container">
<div class="row margin-top-30">
<div class="pull-right">Selamat Datang, <?php echo $this->session->userdata('NAMA_USER')?></div>

</div>
<!-- End Side Column -->
</div>
