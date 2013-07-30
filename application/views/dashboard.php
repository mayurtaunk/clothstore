
    <script type="text/javascript">
     $(function(){       
    $('*[data-href]').click(function(){
        window.location = $(this).data('href');
        return false;
    });
});
</script>


<div class="row-fluid">
  <div class="span10">
  
  <fieldset>    
  <table class="table table-striped ">
    <thead>
      <tr>

        <?php 
        foreach ($list['heading'] as $value) {
          echo "<th>".$value."<th>";
        }
        ?>
      </tr>
    </thead>
    <tbody>
        <?php

        //$this->firephp->info($rows);exit;

        foreach ($rows as $value) {
          echo "<tr>";
          foreach($fields as $col){
            if(isset($link_col) && isset($link_url) && $link_col == $col)
            echo "<td>".anchor($link_url . $value[$col], $value[$col])."<td>";
            else
            echo "<td>".$value[$col]."<td>";
          }
          echo "</tr>";
        }

        ?>
    </tbody>
  </table>
  <br>
  <?php echo $this->pagination->create_links(); ?>
  <!-- <fieldset>
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span4">
        </div>
        <div class="span8">
          <?php
            $attr = array('class' => 'well span6', 'id' => 'loginform');
            //$loc = base_url("main/login_validation");
            echo form_open(base_url("#"),$attr);
            echo validation_errors(); ?>
            <fieldset>
            <div id="legend">
              <legend class="">HIT Barcode</legend>
            </div>
            <div class="control-group" >
              <div class="controls">
                <input type="text" id="username" name="username" placeholder="" class="input-xlarge span12">
              </div>
            </div>
            <div class="control-group">
            <div class="controls">
              <button class="btn btn-success">Continue</button>
              <a href=<?php echo base_url("main/signup");?>> SignUp </a>
            </div>
          </div>
          </fieldset>
   -->        </form>
        </div>
      </div>
    </div>
  	
</body>
</html>
