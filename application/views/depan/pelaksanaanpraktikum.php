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
  </head>

     <body>

       <div class="container">
           <div class="row">

         <div class="container">
             <div class="row clear_fix">



                             <style>
                         #response{display: none}
                         div #fb, div #gp, div #tw{display: inline-block;}
                         #fb{width: 180px;}
                         #gp{width:  100px;}
                         #tw{width: 180px;}
                     </style>

 					<div id="fb">
                         <div class="fb-like" data-href="https://www.facebook.com/TryCatchClasses/" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                     </div>
 					<br/>

                         </div>
                     </div>
                     <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
                     <legend>Pelaksanaan Praktikum</legend>

 <script src="<?php echo base_url('assets/jquery/jquery-1.5.2.min.js'); ?>"></script>
 <script type="text/javascript">
  $(document).ready(function() {
   $("input[name='checkAll']").click(function() {
    var checked = $(this).attr("checked");
    $("#myTable tr td input:checkbox").attr("checked", checked);
   });
  });
 </script>
</head>
<body>
 <form action="<?php echo site_url('depan/delete_multiple1'); ?>" method="post">
  <fieldset>
        <div class="row clear_fix">
  <div class="row clear_fix"><div class="col-md-12" id="respose" style="margin-top:3% "></div></div>



  <table class="table">
      <thead>
          <tr>
     <th><input type="checkbox" id="checkAll" name="checkAll"></th>

     <th>NIM</th>
     <th>Nama</th>
     <th>Nama Praktikum</th>
     </tr>
   </thead>
   <tbody>
    <?php
    if (count($qbarang)>0) {

     foreach ($qbarang as $data):
      ?>
      <tr>
       <td><input type="checkbox" name="msg[]" value="<?php echo $data->id; ?>"></td>
       <td><?php echo $data->nim  ; ?></td>

       <td  ><?php foreach($namaku_mahasiswa as $namamu):
     if($namamu->nim==$data->nim){echo $namamu->nama;}
     endforeach;
                                           ?></td>

        <td>
        <?php foreach($praktikum as $namanya):
      if($namanya->id_praktikum==$data->kode_praktikum){echo $namanya->nama_praktikum;}
      endforeach;
                                            ?></td>
     </tr>
      <?php
     endforeach;
    }
    else {
     echo "<tr><td colspan=5>DATA KOSONG!!</td></tr>";
    }
    ?>


   </tbody>
  </table>
<div>
    <input id="hireddate" name="action" placeholder="Tanggal" type="date" class="form-control"   value="" />
    <span class="text-danger"></span>
<?php} }?>
</div>
<br>
  <input type="submit" class="btn btn-warning btn-sm pull-left" name="submit" value="Action">
      <span class="text-danger"></span>
  <p></p>

 </form>

 </fieldset>
 <?php echo form_close(); ?>
 <?php echo $this->session->flashdata('msg'); ?>
 </div>
 </div>

 </div>
</script>
</body>
</html>
