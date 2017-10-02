<?php
 if($this->session->userdata('HAKAKSES_USER') == "2"){?><!DOCTYPE html>
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

</head><body>

<div class="container">
    <div class="row">
        <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
        <legend>Atur Dosen Pembimbing</legend>
        <?php
        $attributes = array("class" => "form-horizontal", "id" => "employeeform", "name" => "employeeform");
        echo form_open("depan/dosenbimbingan", $attributes);?>

        <fieldset>

        <table class="table">
            <thead>
                <tr>
                    <th>NO.</th>
                    <th>Nama Praktikum</th>
                    <th>Nama Mahasiswa</th>
                </tr>
            </thead>
            <tbody>


              <?php if(empty($result)){?>
                  <tr>
                    <td colspan="6">Data tidak ditemukan</td>
                  </tr>
                <?php }else{$sno = 0; ?>
                <?php foreach ($result as $row){$sno++;?>

                    <tr class="tbl_view" id="<?php echo $row->id?>">
                        <td>
                            <?php echo $sno; ?>
                      </td>
              <?php
               foreach($namaku_praktikum as $kotak){

               if ($row->kode_praktikum==$kotak->id_praktikum){
               $cewek =$kotak->nama_praktikum;
               }}?>


                        <td><?echo $cewek;
               ?>
                          <?php
                 foreach($namaku_mahasiswa as $kotak1){

                 if ($row->nim==$kotak1->nim){
                 $cewek =$kotak1->nama;
                 }}?>
                    <td><?echo $cewek;?>
                </td>
                </tr>
                    <?php }}
                ?>

            </tbody>

        </table>

        </fieldset>

</div>
</div>
        <?php echo form_close(); ?>
        <?php echo $this->session->flashdata('msg'); ?>
        </div>
              </body>
</html>
<?php }else{echo 'get out';
}?>
