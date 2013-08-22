<div class="thumbnail span12 center well well-small text-center">
  	<FONT COLOR="BULE"> <B>View Credit Report</B></FONT> 
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
					<input type="hidden" id ="customerID"  name="customer_id" value="<?php echo $customer_id; ?>" />
					<input type="text" class="span12" id="customerName" name="customerName" value="<?php echo $customer_name; ?>" />
			</div>
		</div>
		<div class="span4">
			<div class="data-block">
				<h6 class="data-heading">From</h6>
					<input type="text" id="datepicker" name="from_date" value="<?php echo $from_date; ?>" />
			</div>
		</div>
		<div class="span4">
			<div class="data-block">
				<h6 class="data-heading">To</h6>
					<input type="text" id="datepicker1" name="to_date" value="<?php echo $to_date; ?>" />
			</div>
		</div>
	</div>
</fieldset>
<div class="row-fluid">
	<div class="span12">
		<fieldset>
		<legend>Bill Items</legend>
			<table class="table table-condensed table-striped">
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
					<?php if(isset($rows)) {
							foreach ($rows as $r) {
								echo '<tr>
									  <td>'.$r['id'].'</td>
									  <td>'.$r['party_name'].'</td>
								      <td>'.$r['party_contact'].'</td>
								      <td>'.$r['date'].'</td>
								      <td>'.$r['totalbill'].'</td>
								      <td>'.$r['paid'].'</td>
								      <td>'.$r['topay'].'</td>
									  </tr>';
							}
						}
					 ?>
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
				source: "<?php echo site_url('reports/creditreport/ajaxCustomer') ?>",
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