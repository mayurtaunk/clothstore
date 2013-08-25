<div class="thumbnail span12 center well well-small text-center">
  	<FONT COLOR="BULE"> <B><?php echo $headd; ?></B></FONT> 
</div>
<?php
	echo start_widget($page_title);
	echo form_open($this->uri->uri_string(), 'class="form-horizontal"');
?>
<fieldset>		
	<div class="row-fluid">
		<div class="span4">
			<div class="data-block">
				<h6 class="data-heading">Customer Name</h6>
					<input type="hidden" id ="customerID"  name="customer_id" value="<?php echo $customer_id ?>" />
					<input type="text" class="Text" id="customerName" name="customerName" value="<?php echo $customer_name; ?>" />
			</div>
		</div>
		<div class="span4">
			<div class="data-block">
				<h6 class="data-heading">From</h6>
				<div class="control-group">
					<input type="text" class="DateTime" name="from_date" value="<?php echo $from_date ?>" />
				</div>
			</div>
		</div>
		<div class="span4">
			<div class="data-block">
				<h6 class="data-heading">To</h6>
					<input type="text" class="DateTime" name="to_date" value="<?php echo $to_date ?>" />
			</div>
		</div>
	</div>
</fieldset>
<div class="row-fluid">
	<div class="span12">
		<fieldset>
		<legend>Bill Items</legend>
			<table class="table table-condensed ">
				<thead>	
				</tr>
						<?php if(isset($heading)) {
							foreach ($heading as $h) {
								echo '<th>
									  '.$h.'</th>';
							}
						}
				?>
				</tr>
				</thead>
				<tbody>
					<?php
					
						foreach ($rows as $value) {
							
							echo "<tr class='info'>";
							foreach($fields as $col){
								if(isset($link_col) && isset($link_url) && $link_col == $col)
								echo "<td>".anchor($link_url . $value[$col], $value[$col])."</td>";
								else
								echo "<td>".$value[$col]."</td>";
							}
							echo "</tr>";
						}
					?>
					<tr></tr>
					<?php if(isset($summary))
					{
						if(isset($summary['totalbill']))
						{
							$totalbill="Rupees " .number_format($summary['totalbill']). "/-";
							$paid="Rupees " .number_format($summary['paid'])."/-";
							$topay="Rupees " .number_format($summary['topay'])."/-";
						}
						else
						{
							$totalbill="Tota Bill";
							$paid="Total Paid";
							$topay="Total To Pay";
						}
						echo "<tr class='success'>
							<td></td>
							<td></td>
							<td></td>
							<td><b>Total Summary</b></td>
							<td><b>". $totalbill ."</b></td>
							<td><b>". $paid."</b></td>
							<td><b>". $topay."</b></td>
							</tr>";
						
					}?>
				</tbody>
			</table>

					
		</fieldset>
	</div>
</div>
<div class="form-actions">
	<button type="submit" name="submit" value="1" class="btn btn-success" id="Update">Search</button>
</div>
</form>
<?php echo end_widget(); ?>
<script>
$(document).ready(function() {
	$("#customerName").autocomplete({
				source: "<?php echo site_url($ajaxurl); ?>",
				minLength: 0,
				focus: function(event, ui) {
					$("#customerName").val( ui.item.cname);
					return false;
				},
				select: function(event, ui) {
					$("#customerName").val(ui.item.cname);
					return false;
				},
				response: function(event, ui) {
		         if (ui.content.length == 0) {
		            $("#customerName").val('');
		         }
		        }
			})
			.data("autocomplete")._renderItem = function(ul, item) {
				return $("<li></li>")
					.data("item.autocomplete", item)
					.append('<a><span class="blueDark">' + item.cname +  '</span></a>')
					.appendTo(ul);
			}

});

</script>
