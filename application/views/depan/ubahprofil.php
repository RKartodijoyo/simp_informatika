<?php if($this->session->userdata('HAKAKSES_USER') == "1"){?>

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
        <legend>Ubah Profil</legend>
        <?php
        $attributes = array("class" => "form-horizontal", "id" => "employeeform", "name" => "employeeform");
        echo form_open("depan/ubahprofil", $attributes);?>
        <fieldset>

            <div class="form-group">
            <div class="row colbox">

            <div class="col-lg-4 col-sm-4">
                <label for="employeeno" class="control-label">NIM</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="employeeno" name="employeeno" placeholder="NIM User" type="text" class="form-control" readonly="readonly"  value="<?php echo $this->session->userdata('NIM_USER'); ?>" />
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
                <input id="employeename" name="employeename" placeholder="Name user" type="text" class="form-control"  value="<?php echo set_value('employeename'); ?>" />
                <span class="text-danger"><?php echo form_error('employeename'); ?></span>
            </div>
            </div>
            </div>

            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="department" class="control-label">Jurusan</label>
            </div>
            <div class="col-lg-8 col-sm-8">

                <?php
                $attributes = 'class = "form-control" id = "department"';
                echo form_dropdown('department',$department,set_value('department'),$attributes);?>
                <span class="text-danger"><?php echo form_error('department'); ?></span>
            </div>
            </div>
            </div>



            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="employeename"1 class="control-label">Alamat</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="employeename1" name="employeename1" placeholder="Alamat" type="text" class="form-control"  value="<?php echo set_value('employeename1'); ?>" />
                <span class="text-danger"><?php echo form_error('employeename1'); ?></span>
            </div>
            </div>
            </div>

            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="salary" class="control-label">No Hp</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="salary" name="salary" placeholder="No Handphone" type="text" class="form-control" value="<?php echo set_value('salary'); ?>" />
                <span class="text-danger"><?php echo form_error('salary'); ?></span>
            </div>
            </div>
            </div>
            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="employeename2" class="control-label">Email</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="employeename2" name="employeename2" placeholder="Email" type="text" class="form-control"  value="<?php echo set_value('employeename2'); ?>" />
                <span class="text-danger"><?php echo form_error('employeename2'); ?></span>
            </div>
            </div>
            </div>

            <div class="form-group">
            <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary" value="update" />
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
<?php }else{echo 'get out';}?>
