<!DOCTYPE HTML>
<html>
<head>
<title>Membuat Read More di CodeIgniter</title>
<style type=”text/css”>
#kotak
{
width: 40%;
height: 25%;
background-color:lightgreen;
float: left;
}
.isi
{
color: black;
}
</style>
</head>
<body>
<div id=”kotak”>
<?php
 foreach ($data as $row):?>
<h1><?php echo $row->JUDUL_BERITA;?></h1>
<p><?php echo $row->ISI_BERITA;?></p>
<?php endforeach;?>
</div>
</body>
</html>
