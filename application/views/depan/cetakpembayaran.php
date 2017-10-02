<html>
<head>
<title>CETAK</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
      <div align="center">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="16%"><img src="<?php echo base_url();?>assets/img/logo.gif" width="101" height="97"></td>
            <td width="84%"><div align="center"><font face="Times New Roman, Times, serif">
              <!--YAYASAN BRATA BHAKTI <br>
                DAERAH JAWA TIMUR <br>-->
                <font size="6">UNIVERSITAS BHAYANGKARA</font> <br>
                <font size="2">Kampus : Jl. A. Yani 114 Surabaya Telp. 8285602,
                8285601, 8291055 FAK. 8285601</font></font></div></td>
                <?php
                 foreach ($namanya as $kambing){
$nimku = $kambing->nim;
$namaku = $kambing->nama;
                 }?>
          </tr>
        </table>
      </div>
      <p align="center"><U><font size="4"><strong>KARTU PEMBAYARAN PRAKTIKUM</strong></font></u>
        <strong><br> <font size="2">Online</font></strong></p>
      </td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="0">
        <tr>
          <td width="21%"><font size="2" face="Arial, Helvetica, sans-serif">FAKULTAS</font></td>
          <td width="37%"><font size="2" face="Arial, Helvetica, sans-serif">:&nbsp;TEKNIK</font></td>
          <td width="20%"><font size="2" face="Arial, Helvetica, sans-serif">N I M</font></td>
          <td width="22%"><font size="2" face="Arial, Helvetica, sans-serif">:&nbsp;<?php echo $nimku;?></font></td>
        </tr>
        <tr>
          <td><font size="2" face="Arial, Helvetica, sans-serif">NAMA MAHASISWA</font></td>
          <td><font size="2" face="Arial, Helvetica, sans-serif">:&nbsp;<?php
echo $namaku;
        ?></font></td>
          <td><font size="2" face="Arial, Helvetica, sans-serif">PROGRAM STUDI</font></td>
          <td><font size="2" face="Arial, Helvetica, sans-serif">:&nbsp;TEKNIK ELEKTRO</font></td>
        </tr>

      </table></td>
  </tr>
  <tr>

    <td><table width="100%" border="1" cellpadding="0" cellspacing="0">
        <tr>
          <br>
          <td width="69" bgcolor="#000000"> <div align="center"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">KODE</font></strong></div></td>
          <td width="280" bgcolor="#000000"> <div align="center"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">NAMA
              MATAKULIAH </font></strong></div></td>
          <td width="250" bgcolor="#000000"> <div align="center"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">BIAYA</font></strong></div></td>
          <?php if(empty($datapraktikum)){?>
            <tr>
              <td colspan="6">Data tidak ditemukan</td>
            </tr>
            <?php }else{
$no=0;
 foreach($datapraktikum as $coba){
$no++;
  foreach($mahasiswa as $kotak){

  if ($coba->kode_praktikum==$kotak->id_praktikum){
  $kodeku =$kotak->kode_praktikum;
  $namaku =$kotak->nama_praktikum;}
}?>
      <tr>
          <td> <div align='center'><font size='2' face='Arial, Helvetica, sans-serif'>TEKK<?php echo $kodeku?></font></div></td>
				<td><div align='left'><font size='2' face='Arial, Helvetica, sans-serif'><?php echo $namaku?></font></td>
				<td> <div align='center'><font size='2' face='Arial, Helvetica, sans-serif'>&nbsp;&nbsp;Rp 75.000,00</font></div></td>

				</tr>
<?php       }}?>

        <tr>
				<td> <div align='center'><font size='2' face='Arial, Helvetica, sans-serif'></font></div></td>
				<td><font size='2' face='Arial, Helvetica, sans-serif'>&nbsp;</font></td>
				<td> <div align='center'><font size='2' face='Arial, Helvetica, sans-serif'>&nbsp;&nbsp;</font></div></td>

				</tr>
        <tr>

          <td bgcolor="#FFFFCC" colspan="2"> <div align="center"><font size="2" face="Arial, Helvetica, sans-serif">JUMLAH BIAYA</font></div></td>
          <td bgcolor="#FFFFCC"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;<strong>
          Rp <?php echo 75*$no;?>.000,00</strong></font></div></td>

        </tr>


      </table>
      </td>
  </tr>
  <tr>

    <td><br>Surabaya, <?php echo date('Y-m-d');?> </td>
  </tr>


<!-- <tr>
<td width="31%"><font size="2" face="Arial, Helvetica, sans-serif">AMIRULLAH</font></td><td width="28%">&nbsp;</td><td width="31%"><font size="2" face="Arial, Helvetica, sans-serif">ERWIN NUR CAHYONO</font></td><td width="14%">&nbsp;</td></tr> -->

  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>

    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
