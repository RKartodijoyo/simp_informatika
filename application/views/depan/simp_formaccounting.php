<?php
  if($this->session->userdata('HAKAKSES_USER') != "3"){echo 'get out';
  }
  else{ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form accounting</title>
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
        <legend>Form Accounting</legend>
        <?php
        $attributes = array("class" => "form-horizontal", "id" => "employeeform", "name" => "employeeform");
        echo form_open("depan/simp_formaccounting", $attributes);?>
        <fieldset>
            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="noaccounting" class="control-label">No Account</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="noaccounting" name="noaccounting" placeholder="No Account" type="text" class="form-control"  value="<?php echo set_value('noaccounting'); ?>" />
                <span class="text-danger"><?php echo form_error('noaccounting'); ?></span>
            </div>
            </div>
            </div>
            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="nokwitansi" class="control-label">No Kwitansi</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="nokwitansi" name="nokwitansi" placeholder="No Kwitansi" type="text" class="form-control"  value="<?php echo set_value('nokwitansi'); ?>" />
                <span class="text-danger"><?php echo form_error('nokwitansi'); ?></span>
            </div>
            </div>
            </div>
            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="nid" class="control-label">Keterangan</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="keterangan" name="keterangan" placeholder="keterangan" type="text" class="form-control"  value="<?php echo set_value('keterangan'); ?>" />
                <span class="text-danger"><?php echo form_error('keterangan'); ?></span>
            </div>
            </div>
            </div>
            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="department" class="control-label">Tipe</label>
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
                <label for="keterangan" class="control-label">jumlah</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="jumlah" name="jumlah" placeholder="jumlah" type="text" class="form-control"  value="<?php echo set_value('jumlah'); ?>" />
                <span class="text-danger"><?php echo form_error('jumlah'); ?></span>
            </div>
            </div>
            </div>
            <div class="form-group">
            <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary" value="Insert" />
                <input id="btn_upt" name="btn_upt" type="submit" class="btn btn-primary" value="Update" />
                <input id="btn_cancel" name="btn_cancel" type="reset" class="btn btn-danger" value="Cancel" />
            </div>
            </div>
        </fieldset>
        <?php echo form_close(); ?>
        <?php echo $this->session->flashdata('msg'); ?>
        </div>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Kode Accounting</th>
              <th>No Account</th>
              <th>No Kwintansi</th>
              <th>Tanggal</th>
              <th>Keterangan</th>
              <th>Jumlah Debit</th>
              <th>Jumlah Kredit</th>
              <th>Saldo</th>
            </tr>
          </thead>
          <tbody>
          <?php if(empty($qbarang)){ ?>
          <tr>
            <td colspan="6">Data tidak ditemukan</td>
          </tr>
          <?php }else{
            $saldo=0;
            $debit=0;
            $kredit=0;
            foreach($qbarang as $rowbarang){ ?>
          <tr>
            <td><?php echo $rowbarang->kode_accounting?></td>
            <td><?php echo $rowbarang->no_account?></td>
            <td><?php echo $rowbarang->no_kwitansi?></td>
            <td><?php echo $rowbarang->tanggal?></td>
            <td><?php echo $rowbarang->keterangan;$debit=0;$kredit=0;?></td>

            <?php if ($rowbarang->tipe==1){$debit=$rowbarang->jumlah;}
            else{$kredit=$rowbarang->jumlah;}?>
            <td><?php echo $debit?></td>
            <td><?php echo $kredit?></td>
            <td><?php if ($debit>0){$saldo+=$debit;}
            else{$saldo-=$kredit;}
                echo $saldo?></td>

          </tr>


        <?php }}?>
        </tbody>
        </table>
    </div>
</div>
</body>
</html>
<?php }?>
