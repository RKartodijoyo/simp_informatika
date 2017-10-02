<?php
 if($this->session->userdata('HAKAKSES_USER') != "2"){echo "get out";}?>

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
        <legend>Verifikasi Pembayaran</legend>
        <?php
        $attributes = array("class" => "form-horizontal", "id" => "employeeform", "name" => "employeeform");
        echo form_open("depan/verifikasipembayaran", $attributes);?>
        <fieldset>

          <table class="table table-striped">
       <thead>
        <tr>
        <th>NO</th>
        <th>NIM</th>
        <th>Kode_praktikum</th>



        <th></th>
        </tr>
       </thead>
       <tbody>

            <?php if(empty($qbarang)) {?>
            <tr>
              <td colspan="6">Data tidak ditemukan</td>
            </tr>
            <?php }else{$sno = 0; ?>
            <tr>
            <?php foreach ($qbarang as $rowbarang){$no++;?>
              <tr class="tbl_view" id="<?php echo $rowbarang->id ?>">

             <td><?php echo $sno; ?>
         </td>
           <td><?php  echo $rowbarang->nim?></td>
            <?php

            $nimku= $rowbarang->nim;
            if(1==$rowbarang->kode_praktikum) {$kodeku=1231;
            }
            elseif(2==$rowbarang->kode_praktikum) {$kodeku=2236;
            }
            elseif(3==$rowbarang->kode_praktikum) {$kodeku=2237;
            }
            elseif(4==$rowbarang->kode_praktikum) {$kodeku=2234;
            }
            elseif(5==$rowbarang->kode_praktikum) {$kodeku=3238;
            }
            elseif(6==$rowbarang->kode_praktikum) {$kodeku=4239;
            }
            elseif(7==$rowbarang->kode_praktikum) {$kodeku=4232;
            }
            elseif(8==$rowbarang->kode_praktikum) {$kodeku=5233;
            }
            elseif(9==$rowbarang->kode_praktikum) {$kodeku=5235;
            }
            elseif(10==$rowbarang->kode_praktikum) {$kodeku=7241;
            }
            elseif(11==$rowbarang->kode_praktikum) {$kodeku=7240;
            };
            echo $kodeku;

            ?>

                   </tr>
            <?php }
}
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
