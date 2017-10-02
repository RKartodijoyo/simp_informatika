<?php
 if($this->session->userdata('HAKAKSES_USER') != "3"){echo 'get out';
}
else{ ?>


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

<div class="container">
    <div class="row">
        <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
        <legend>Verifikasi Kehadiran</legend>
        <?php
        $attributes = array("class" => "form-horizontal", "id" => "employeeform", "name" => "employeeform");
        echo form_open("depan/verifikasikehadiran", $attributes);?>
        <fieldset>

          <table class="table table-striped">
       <thead>
      <?php ?>
        <tr>
        <th>NO</th>
        <th>NIM</th>
        <th>Nama praktikum</th>


        <?php
        $no=0;
if(empty($qbarang)){?>
  <tr>
    <td colspan="6">Data tidak ditemukan</td>
  </tr><?php
}else{
        foreach($qbarang as $rowbarang): $no++;?>
        <tr class="tbl_view" id="<?php echo $rowbarang->id ?>">

        <td><?php echo $no?></td>
        <td><?php echo $rowbarang->nim?></td>
        <?php
$kodeku="kosong";
        $nimku= $rowbarang->nim;
        foreach($praktikum as $namanya):
        if($namanya->id_praktikum==$rowbarang->kode_praktikum){$kodeku=$namanya->nama_praktikum;}
      endforeach;
        ?>
        <td><?php echo $kodeku?></td>

              <td>
                     <a href="<?=base_url()?>depan/verkehadiran/<?=$rowbarang->kode_praktikum,'i',$rowbarang->nim?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin menghapus data ini?')"><i class="glyphicon glyphicon-trash"></i></a>

                    </td>
                   </tr>
                 <?php endforeach;}?>
                  </tbody>
                 </table>
        </fieldset>
        <?php echo form_close(); ?>
        <?php echo $this->session->flashdata('msg'); ?>
        </div>
    </div>
</div>
</body>
</html>
<?php }?>
