<?php  if($this->session->userdata('HAKAKSES_USER') == "1"){?>


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
  <?php if(is_array($qbarang)){?>
    <?php foreach($qbarang as $row){
      $id=$row->id;
      $nim=$row->nim;
      $nama=$row->nama;
      $jurusan=$row->jurusan;
      $alamat=$row->alamat;
      $nohp=$row->nohp;
      $email=$row->email;
    }}
  else{
  $id='';
  $nim='';
  $nama='';
  $jurusan='';
  $alamat='';
  $nohp='';
  $email='';
}
if($jurusan==2){$jurusanku='Elektronika';}
else if($jurusan==3){$jurusanku='Sistem Tenaga';}
else{$jurusanku='Elektro';}

?>


<div class="container">
    <div class="row">
        <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
        <legend>Lihat Profil</legend>
        <?php
        $attributes = array("class" => "form-horizontal", "id" => "employeeform", "name" => "employeeform");
        echo form_open("depan/lihatprofil", $attributes);

        ?>

        <fieldset>

            <div class="form-group">
            <div class="row colbox">

            <div class="col-lg-4 col-sm-4">
                <label for="employeeno" class="control-label">NIM</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="employeeno" name="employeeno" placeholder="NIM User" type="text" class="form-control"  readonly="readonly" value="<?=$nim?>" />
                <span class="text-danger"></span>
            </div>
            </div>
            </div>

            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="employeename" class="control-label">Name</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="employeename" name="employeename" placeholder="Name user" type="text" class="form-control"  readonly="readonly"value="<?=$nama?>" />
                <span class="text-danger"><?php echo form_error('employeename'); ?></span>
            </div>
            </div>
            </div>

            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="employeename" class="control-label">Jurusan</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="employeename" name="employeename" placeholder="Jurusan" type="text" class="form-control"readonly="readonly"  value="<?=$jurusanku?>" />
                <span class="text-danger"><?php echo form_error('employeename'); ?></span>
            </div>
            </div>
            </div>

                        <div class="form-group">
                        <div class="row colbox">
                        <div class="col-lg-4 col-sm-4">
                            <label for="employeename" class="control-label">Alamat</label>
                        </div>
                        <div class="col-lg-8 col-sm-8">
                            <input id="employeename" name="employeename" placeholder="Alamat" type="text" class="form-control" readonly="readonly" value="<?=$alamat?>" />
                            <span class="text-danger"><?php echo form_error('employeename'); ?></span>
                        </div>
                        </div>
                        </div>

                                    <div class="form-group">
                                    <div class="row colbox">
                                    <div class="col-lg-4 col-sm-4">
                                        <label for="employeename" class="control-label">No Hp</label>
                                    </div>
                                    <div class="col-lg-8 col-sm-8">
                                        <input id="employeename" name="employeename" placeholder="Nomor Handphone" type="text" class="form-control" readonly="readonly"  value="<?=$nohp?>" />
                                        <span class="text-danger"><?php echo form_error('employeename'); ?></span>
                                    </div>
                                    </div>
                                    </div>

                                                <div class="form-group">
                                                <div class="row colbox">
                                                <div class="col-lg-4 col-sm-4">
                                                    <label for="employeename" class="control-label">Email</label>
                                                </div>
                                                <div class="col-lg-8 col-sm-8">
                                                    <input id="employeename" name="employeename" placeholder="Email" type="text" class="form-control"readonly="readonly"  value="<?=$email?>" />
                                                    <span class="text-danger"><?php echo form_error('employeename'); ?></span>
                                                </div>
                                                </div>
                                                </div>
        </fieldset>
        <?php echo form_close(); ?>
        <?php echo $this->session->flashdata('msg'); ?>
        </div>
    </div>
</div>
</body>
</html>
<?php }else{echo 'get out';}?>
