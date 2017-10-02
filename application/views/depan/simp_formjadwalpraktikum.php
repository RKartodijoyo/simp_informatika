<?php
  if ($this->session->userdata('HAKAKSES_USER') != "3") {
      echo 'get out';
  } else {
      ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Kelompok</title>
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
    $(function(){
        $("#hireddate").datepicker();
    });
    </script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
        <legend>Form Praktikum</legend>
        <?php
        $attributes = array("class" => "form-horizontal", "id" => "employeeform", "name" => "employeeform");
      echo form_open("depan/simp_formjadwalpraktikum", $attributes); ?>
        <fieldset>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Kode Praktikum</th>
                <th>Nama Praktikum</th>
                <th>Masuk</th>
              </tr>
            </thead>
            <tbody>
            <?php if (empty($qbarang)) {
          ?>
            <tr>
              <td colspan="6">Data tidak ditemukan</td>
            </tr>
            <?php
      } else {
          foreach ($qbarang as $rowbarang) {
              ?>
            <tr>
              <td><?php echo $rowbarang->kode_praktikum?></td>
              <td><?php echo $rowbarang->jenis_praktikum?></td>
            </td><td><a href="<?=base_url()?>depan/simp_formjadwalpraktikumke2/<?=$rowbarang->id_praktikum?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin menghapus data ini?')"><i class="glyphicon glyphicon-trash"></i></a>
            </tr>
          <?php
          }
      } ?>
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
<?php
  }?>
