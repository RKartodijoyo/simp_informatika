<?php
  if($this->session->userdata('HAKAKSES_USER') != "3"){echo 'get out';
  }
  else{ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Dosen</title>
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
        <legend>Tambah Assisten Praktikum</legend>
        <?php
        $attributes = array("class" => "form-horizontal", "id" => "employeeform", "name" => "employeeform");
        echo form_open("depan/simp_tambahassisten", $attributes);?>
        <fieldset>
            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="nid" class="control-label">No Induk</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="nia" name="nia" placeholder="No Induk Assisten" type="text" class="form-control"  value="<?php echo set_value('nia'); ?>" />
                <span class="text-danger"><?php echo form_error('nia'); ?></span>
            </div>
            </div>
            </div>
            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="nama" class="control-label">Nama</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="nama" name="nama" placeholder="Nama Pengguna" type="text" class="form-control"  value="<?php echo set_value('nama'); ?>" />
                <span class="text-danger"><?php echo form_error('nama'); ?></span>
            </div>
            </div>
            </div>
            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="[password]" class="control-label">Password</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="password" name="password" placeholder="Password" type="password" class="form-control"  value="<?php echo set_value('password'); ?>" />
                <span class="text-danger"><?php echo form_error('password'); ?></span>
            </div>
            </div>
            </div>
            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="assisten" class="control-label">No Urut assisten</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="assitenid" name="assitenid" placeholder="No Urut Assisten" type="text" class="form-control"  value="<?php echo set_value('assitenid'); ?>" />
                <span class="text-danger"><?php echo form_error('dosenid'); ?></span>
            </div>
            </div>
            </div>

            <div class="form-group">
            <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary" value="Insert" />
                <input id="btn_cancel" name="btn_cancel" type="reset" class="btn btn-danger" value="Cancel" />
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
<?php }?>
