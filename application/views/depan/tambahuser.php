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
        <legend>Add User</legend>
        <?php
        $attributes = array("class" => "form-horizontal", "id" => "employeeform", "name" => "employeeform");
        echo form_open("depan/tambahuser", $attributes);?>
        <fieldset>

            <div class="form-group">
            <div class="row colbox">

            <div class="col-lg-4 col-sm-4">
                <label for="employeeno" class="control-label">No Induk</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="employeeno" name="employeeno" placeholder="No Induk" type="text" class="form-control"  value="<?php echo set_value('employeeno'); ?>" />
                <span class="text-danger"><?php echo form_error('employeeno'); ?></span>
            </div>
            </div>
            </div>

            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="employeename" class="control-label">Nama</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="employeename" name="employeename" placeholder="Nama Pengguna" type="text" class="form-control"  value="<?php echo set_value('employeename'); ?>" />
                <span class="text-danger"><?php echo form_error('employeename'); ?></span>
            </div>
            </div>
            </div>
            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="employeename1" class="control-label">Password</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="employeename1" name="employeename1" placeholder="Password" type="password" class="form-control"  value="<?php echo set_value('employeename1'); ?>" />
                <span class="text-danger"><?php echo form_error('employeename1'); ?></span>
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
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="department" class="control-label">Hak Akses</label>
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
                            <label for="department1" class="control-label">Status</label>
                        </div>
                        <div class="col-lg-8 col-sm-8">

                            <?php
                            $attributes = 'class = "form-control" id = "department1"';
                            echo form_dropdown('department1',$department1,set_value('department1'),$attributes);?>
                            <span class="text-danger"><?php echo form_error('department1'); ?></span>
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
