<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Barcode Labels</title>
    <style>
    body {
        width: 8.5in;
        margin: .3in 0 0 0;
    }
    .label{
        width: 1.525in; /* plus .6 inches from padding */
        height: .600in; /* plus .125 inches from padding */
        padding: .232in 0 0 0; /* .300in .3in 0;*/
        margin-right: .125in; /* the gutter */
        float: left;
        text-align: center;
        /*overflow: hidden;*/
        /*outline: 1px dotted;  outline doesn't occupy space like border does */
    }
	.label img { vertical-align: middle !important;  }
    .page-break  {
        clear: left;
        display:block;
        page-break-after:always;
        }
    img { padding-left: 10px;
          padding-bottom: 50px;
        }
        .fixedheight { height: 100px; position:relative; }
        .bottomaligned {position:relative; top:80%; height:4em; margin-top:0em}
        legend { margin:3px; text-align:center;width:100%}
    </style>
    <link href="<?php echo base_url('css/bootstrap.min.css') ?>" rel="stylesheet" />
</head>
<body>
<body>
    <br>
    <ul class='thumbnails'>
  <?php
    $cpname=$this->radhe->getrowarray("select * from companies where id=".$this->session->userdata('company_id'));
   
    foreach ($new_barcode as $key => $value) {
      for ($i=0; $i < $new_quantity[$key]; $i++) {
        $price=$this->radhe->getrowarray("select * from purchase_details where barcode='".$value."'");

                echo "<li class='span3'>";
                    echo "<div class='thumbnail'>";
                        echo "<h5 align='center'>".$cpname['name']."</h5>";
                        echo "<img src=".base_url('barcodegen/test_1D.php?text='.$value)." alt=''>";
                        echo "<p align='center' style='height : 50px'>MRP: <b><i>INR ".$price['mrp']."/-</i></b> </p>";
                    echo "</div>";
                echo "</li>";
      }
    }
  ?>
</ul>
</body>
</html>