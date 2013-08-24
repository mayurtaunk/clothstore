<script type="text/javascript">
     $(function(){       
    $('*[data-href]').click(function(){
        window.location = $(this).data('href');
        return false;
    });

	});
     
</script>
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
	<hr>
	<?php echo $this->pagination->create_links(); ?>
	<fieldset>
        <div id="legend">
             <div class="span4 offset9">
             	<?php 
    				$h=base_url().'index.php/'.$link."0";
    				echo "<a href='";
    				echo $h;
    				echo "'>"
    			?>
            	<button class="btn btn-success span8">
            	<i class="icon-plus icon-white">
            	</i>  <?php echo $button_text ?></button></a>
        	</div>
        </div>
    </fieldset>
</fieldset>
