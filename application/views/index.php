<?php
if (isset($page) && ! file_exists(APPPATH.'/views/'.$page.'.php')) {
  show_error("View file \"$page\" is missing");
}
$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
$this->output->set_header('Pragma: no-cache');
$this->output->set_header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <?php
           
         if(isset($title))
            echo "<title>".$title."</title>";
         else
            echo "<title>Cloth Store</title>"
    ?> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?php echo base_url("css/bootstrap.css") ?>" rel="stylesheet"/>
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }

      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
      }
      search-query
      {
        padding-right: 3px;
        padding-right: 4px \9;
        padding-left: 3px;
        padding-left: 4px \9;
        margin-bottom: 0;
        -webkit-border-radius: 3px;
        moz-border-radius: 3px;
        border-radius: 3px;
      }
      #custom-search-form {
        margin:0;
        margin-top: 5px;
        padding: 0;
     }
     #custom-search-form .search-query {
        padding-right: 3px;
        padding-right: 4px \9;
        padding-left: 3px;
        padding-left: 4px \9;
        /* IE7-8 doesn't have border-radius, so don't indent the padding */
 
        margin-bottom: 0;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }
     #custom-search-form button {
        border: 0;
        background: none;
        /** belows styles are working good */
        padding: 2px 5px;
        margin-top: 2px;
        position: relative;
        left: -28px;
        /* IE7-8 doesn't have border-radius, so don't indent the padding */
        margin-bottom: 0;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
     }
     .search-query:focus + button {
        z-index: 3;   
    }
    </style>
    <link href="<?php echo base_url('css/jquery-ui.css') ?>" rel="stylesheet" />
    <script src="<?php echo base_url('js/jquery-1.9.1.js') ?>"></script>
    <script src="<?php echo base_url('js/jquery-ui.js') ?>"></script>
    <script src="<?php echo base_url('js/jquery-1.8.3.min.js') ?>"></script>
    <script src="<?php echo base_url('js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('js/bootstrap-notify.js') ?>"></script>
    <script src="<?php echo base_url('js/jquery.highlight-2.js') ?>"></script>
    <script src="<?php echo base_url('js/jquery.popupwindow.js') ?>"></script>
    <script src="<?php echo base_url('js/jquery-ui-1.9.2.min.js') ?>"></script>
    <script src="<?php echo base_url('js/chosen.jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('js/jquery-timing.min.js') ?>"></script>
    <?php if (isset($javascript)) {
        foreach ($javascript as $js) {
          echo "<script src=\"" . base_url("js/$js") . "\"></script>\n\t";
        }
      } 
    ?>
    <link href="<?php echo base_url('css/bootstrap.min.css') ?>" rel="stylesheet" />
    <link href="<?php echo base_url('css/bootstrap-notify.css') ?>" rel="stylesheet" />
    <link href="<?php echo base_url('css/lightness-1.9.2/jquery-ui.min.css') ?>" rel="stylesheet" />
    <link href="<?php echo base_url('css/default.css') ?>" rel="stylesheet" />
    <link href="<?php echo base_url('css/picons.css') ?>" rel="stylesheet" />
    <link href="<?php echo base_url('css/chosen.jquery.css') ?>" rel="stylesheet" />
    <link href="<?php echo base_url('css/bootstrap-responsive.min.css') ?>" rel="stylesheet" />
    <?php if (isset($stylesheet)) {
       foreach ($stylesheet as $css) {
         echo "<link href=\"" . base_url("css/$css") . "\" rel=\"stylesheet\" />\n\t";
        }
      } 
    ?>
    <script>
    $(function() {
      $("#ajaxName").autocomplete({
        source: "<?php echo site_url($cname.'/search')?>",
        minLength: 0,
        focus: function(event, ui) {
          $("#ajaxName").val( ui.item.name);
          return false;
        },
        select: function(event, ui) {
          $("#ajaxName").val(ui.item.name);
          $("#ajaxProductId").val(ui.item.id);
          return false;
        },
        response: function(event, ui) {
             if (ui.content.length == 0) {
                $("#ajaxName").val('');
            $("#ajaxProductId").val(0);
             }
            }
      })
      .data("autocomplete")._renderItem = function(ul, item) {
        return $("<li></li>")
          .data("item.autocomplete", item)
          .append('<a><span class="blueDark">' + item.name +  '</span></a>')
          .appendTo(ul);
      }
      /*$(".DateTime").datepicker({
        duration: '',
        dateFormat: "dd-mm-yy",
        yearRange: "-50:+1",
        mandatory: true,
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true,
        showOtherMonths: true,
        showStatus: true,
        showOn: "button",
        buttonImage: "<?php echo base_url('img/calendar.png'); ?>",
        buttonImageOnly: true
      });*/
    });
    </script>
  <script>

      $(function() {
           $( "#datepicker" ).datepicker({
        numberOfMonths: 3,
        showButtonPanel: true
        });
        $( "#datepicker" ).datepicker("option", "dateFormat", "dd-mm-yy" );
        $( "#datepicker" ).datepicker( "option", "showAnim", "slideDown");
        
      });
      $(function() {
         $( "#datepicker1" ).datepicker({
        numberOfMonths: 3,
        showButtonPanel: true
        });
        $( "#datepicker1" ).datepicker("option", "dateFormat", "dd-mm-yy" );
       $( "#datepicker1" ).datepicker( "option", "showAnim", "slideDown");
    
      });
      </script>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
  </head>
  <body>
  <?php if(isset($okalert)) {?>
  <div class="alert alert-success pull-right">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Warning!</strong><?php echo $okalert;?>
</div>
  <?php } ?>
  <?php if(isset($notokalert)) {?>
  <div class="alert alert-error pull-right">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Warning!</strong><?php echo $notokalert;?>
</div>
  <?php } ?>
   <?php if(isset($infoalert)) {?>
  <div class="alert alert-info pull-right">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Information!  </strong><?php echo $infoalert;?>
</div>
  <?php } ?>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </a>
          <a class="brand" href=<?php echo base_url("index.php/main/master") ?>>Cloth Store Management</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
                <li class="divider-vertical"></li>
                <li  <?php if($this->session->userdata('current_tab') == 'dash') { echo "class='active'"; } ?>><a href=<?php echo base_url("index.php/main/master") ?>><i class="icon-home icon-white"></i> Home</a></li>
            </ul>
            <div class="pull-right">
              <ul class="nav pull-right">
                  <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome, <?php echo $this->session->userdata('username')?> <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                          <li><a href=<?php echo base_url("index.php/company") ?>><i class="icon-cog"></i> Preferences</a></li>
                          <li><a href="/help/support"><i class="icon-envelope"></i> Contact Support</a></li>
                          <li class="divider"></li>
                          <li><a href=<?php echo base_url("index.php/main/logout") ?>><i class="icon-off"></i> Logout</a></li>
                      </ul>
                  </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="navbar">
            <div class="navbar-inner">
              <div class="container">
                <ul class="nav">
                  <li <?php if($this->session->userdata('current_tab') == 'party') { echo "class='active'"; } ?>> <a href=<?php echo site_url('party');?>><img src=<?php echo base_url('img/tags/party.png'); ?> style="width : 70px; height : 70px;">Party</a></li>
                  <li <?php if($this->session->userdata('current_tab') == 'product') { echo "class='active'"; } ?>> <a href=<?php echo site_url('product');?>><img src=<?php echo base_url('img/tags/products.png'); ?> style="width : 70px; height : 70px;">Product</a></li>
                  <li <?php if($this->session->userdata('current_tab') == 'purchase') { echo "class='active'"; } ?>> <a href=<?php echo site_url('purchase');?>><img src=<?php echo base_url('img/tags/purchase.png'); ?> style="width : 70px; height : 70px;">Purchase</a></li>
                  <li class="divider-vertical"></li>
                  <li <?php if($this->session->userdata('current_tab') == 'sales') { echo "class='active'"; } ?>> <a href=<?php echo site_url('sales');?>><img src=<?php echo base_url('img/tags/sale.png'); ?> style="width : 70px; height : 70px;">Sales</a></li>
                  <li class="divider-vertical"></li>
                  <li <?php if($this->session->userdata('current_tab') == 'barcode') { echo "class='active'"; } ?>> <a href=<?php echo site_url('barcode');?>><img src=<?php echo base_url('img/tags/barcode.png'); ?> style="width : 70px; height : 70px;"> Barcode</a></li>
                  <li class="divider-vertical"></li>
                  <!-- <li ><?php echo anchor('account', 'Add Account'); ?></li> -->
                  <?php  $ch=$this->session->userdata('current_tab'); ?>
                  <li class="dropdown <?php if( $ch == 'trans' || $ch == 'translight' || $ch == 'transtele' || $ch == 'transsal' || $ch == 'tax' || $ch == 'other') { echo 'active'; } ?>" >
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src=<?php echo base_url('img/tags/trans.png'); ?> style="width : 70px; height : 70px;">Transaction</a>
                      <ul class="dropdown-menu">
                        <li <?php if($this->session->userdata('current_tab') == 'trans') { echo "class='active'"; } ?>> <a href=<?php echo site_url('transaction/edit/0');?>><img src=<?php echo base_url('img/tags/transman.png'); ?> style="width : 50px; height : 50px;"> Transaction</a></li>
                        <li <?php if($this->session->userdata('current_tab') == 'translight') { echo "class='active'"; } ?>> <a href=<?php echo site_url('transaction/edit/lightbill');?>><img src=<?php echo base_url('img/tags/elect.png'); ?> style="width : 50px; height : 50px;">Light Bill</a></li>
                        <li <?php if($this->session->userdata('current_tab') == 'transtele') { echo "class='active'"; } ?>> <a href=<?php echo site_url('transaction/edit/telephonebill');?>><img src=<?php echo base_url('img/tags/tele.png'); ?> style="width : 50px; height : 50px;">Telephone Bill</a></li>
                        <li <?php if($this->session->userdata('current_tab') == 'transsal') { echo "class='active'"; } ?>> <a href=<?php echo site_url('transaction/edit/employeesalary');?>><img src=<?php echo base_url('img/tags/emp.png'); ?> style="width : 50px; height : 50px;">Employee Salary</a></li>
                        <li <?php if($this->session->userdata('current_tab') == 'tax') { echo "class='active'"; } ?>> <a href=<?php echo site_url('transaction/edit/taxes');?>><img src=<?php echo base_url('img/tags/tax.png'); ?> style="width : 50px; height : 50px;">Tax</a></li>
                        <li <?php if($this->session->userdata('current_tab') == 'other') { echo "class='active'"; } ?>> <a href=<?php echo site_url('transaction/edit/other');?>><img src=<?php echo base_url('img/tags/misc.png'); ?> style="width : 50px; height : 50px;">Misc</a></li>
                        <li class="divider"></li>
                        <li <?php if($this->session->userdata('current_tab') == 'inbnd') { echo "class='active'"; } ?>> <a href=<?php echo site_url('transaction/edit/inbound');?>><img src=<?php echo base_url('img/tags/inbo.png'); ?> style="width : 50px; height : 50px;">INbound</a></li>
                      </ul>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src=<?php echo base_url('img/tags/repo.png'); ?> style="width : 70px; height : 70px;">Reports</a>
                      <ul class="dropdown-menu">
                        <li <?php if($this->session->userdata('current_tab') == 'cst_rep') { echo "class='active'"; } ?>> <a href=<?php echo site_url('reports/creditreport');?>><img src=<?php echo base_url('img/tags/salerpt.png'); ?> style="width : 50px; height : 50px;">Customer Credit</a></li>
                        <li <?php if($this->session->userdata('current_tab') == 'pur_rep') { echo "class='active'"; } ?>> <a href=<?php echo site_url('reports/purchasecredit');?>><img src=<?php echo base_url('img/tags/salerpt.png'); ?> style="width : 50px; height : 50px;">Purchase Credit</a></li>
                        <li <?php if($this->session->userdata('current_tab') == 'sale_rep') { echo "class='active'"; } ?>> <a href=<?php echo site_url('reports/sale_report');?>><img src=<?php echo base_url('img/tags/salerpt.png'); ?> style="width : 50px; height : 50px;">Sale Report</a></li>
                        <li <?php if($this->session->userdata('current_tab') == 'account_rep') { echo "class='active'"; } ?>> <a href=<?php echo site_url('reports/account_statement');?>><img src=<?php echo base_url('img/tags/acc_rep.png'); ?> style="width : 50px; height : 50px;">Account Report</a></li>
                      </ul>
                  </li>
                </ul> 
              </div>
            </div>
          </div>
        <!-- <div class="span2">
        <div class="well sidebar-nav">
          <ul class="nav nav-list">
            <li class="nav-header">Feed Data</li>
            <li <?php if($this->session->userdata('current_tab') == 'party') { echo "class='active'"; } ?>>
            <?php echo anchor('party', 'Party List'); ?></li>
            <li <?php if($this->session->userdata('current_tab') == 'product') { echo "class='active'"; } ?>>
            <?php echo anchor('product', 'Product List'); ?></li>
            <li <?php if($this->session->userdata('current_tab') == 'purchase') { echo "class='active'"; } ?>>
            <?php echo anchor('purchase', 'Purchase List'); ?></li>
            <li class="nav-header">Sales</li>
            <li <?php if($this->session->userdata('current_tab') == 'sales') { echo "class='active'"; } ?>>
              <?php echo anchor('sales', 'Sales List'); ?></li>
            </li>
            <li class="nav-header">Print</li>
            <li <?php if($this->session->userdata('current_tab') == 'barcode') { echo "class='active'"; } ?>>
              <?php echo anchor('barcode', 'Print Barcode'); ?></li>
            </li>
            <li class="nav-header">Banking</li>
            <!-- <li ><?php echo anchor('account', 'Add Account'); ?></li>
            <li <?php if($this->session->userdata('current_tab') == 'trans') { echo "class='active'"; } ?>><?php echo anchor('transaction/edit/0', 'Make a Transaction'); ?></li>
            <li class="nav-header">Reports</li>
            <li <?php if($this->session->userdata('current_tab') == 'sale_rep') { echo "class='active'"; } ?>><?php echo anchor('reports/sale_report', 'Sale Report'); ?></li>
            <li <?php if($this->session->userdata('current_tab') == 'account_rep') { echo "class='active'"; } ?>><?php echo anchor('reports/account_statement', 'Account Statement'); ?></li>
            <li><a href="#">Yearly Report(Finacial)</a></li>
            <li class="nav-header">Out Bound Transaction</li>
            <li <?php if($this->session->userdata('current_tab') == 'translight') { echo "class='active'"; } ?>><?php echo anchor('transaction/edit/lightbill', 'Light Bills'); ?></li>
            <li <?php if($this->session->userdata('current_tab') == 'transtele') { echo "class='active'"; } ?>><?php echo anchor('transaction/edit/telephonebill', 'Telephone Bills'); ?></li>
            <li <?php if($this->session->userdata('current_tab') == 'transsal') { echo "class='active'"; } ?>><?php echo anchor('transaction/edit/employeesalary','Employee Salary');?></li>
            <li <?php if($this->session->userdata('current_tab') == 'tax') { echo "class='active'"; } ?>><?php echo anchor('transaction/edit/taxes','Taxes');?></li>
            <li <?php if($this->session->userdata('current_tab') == 'other') { echo "class='active'"; } ?>><?php echo anchor('transaction/edit/other','Others');?></li>
            <li class="nav-header">In Bound Transaction</li>
            <li <?php if($this->session->userdata('current_tab') == 'inbnd') { echo "class='active'"; } ?>><?php echo anchor('transaction/edit/inbound','In Bound');?></li>
          </ul>
        </div>/.well
        </div>/span-->
        <div class="row-fluid">      
        <div class="container-fluid">
        <div class="span1">
          </div>
        <div class="well span10">
        <?php if(isset($cname)){?>
          <div class="thumbnail span12 center well well-small text-center">
            <form id="custom-search-form" class="form-search form-horizontal pull-right">
              <?php echo "(". $help; ?>
              <?php echo "<b>". $hhelp. "</b>) (<i>Please Wait for 'wait cursor' then press enter</i>)"; ?>
              <div class="input-append">
                <input type="text" class="search-query"  id="ajaxName" placeholder=<?php echo $dta; ?>>
                <button type="submit" class='btn' href=<?php $this->uri->uri_string() ?>><i class="icon-search"></i></button>
              </div>
            </form>
          </div>
        <?php }?>
        <?php
          if(isset($page))
          $this->load->view($page);
        ?> 
        </div>

      </div><!--/row  fluid-->
  </div><!--/.fluid-container-->
  <footer>
        <p>&copy; Radhe Developers 2013</p>
      </footer>
</body>
</html>


