<article class="module width_full">
<form method="post" action="<?= site_url("admin/configurations/save")?>">
	<header>
		<h3 class="tabs_involved">Edit Options</h3>
		<div class="submit_link">
			<input type="submit" value="Save Options" class="alt_btn">
		</div>
	</header>

	<div class="tab_content" id="tab1" style="display: block;">
		<table cellspacing="0" class="tablesorter"> 
			<thead> 
				<tr> 
   					<th class="header" width="50">OrderNum</th> 
    				<th class="header" width="300">KEY</th> 
    				<th class="header" width="300">VALUE</th> 
    				<th class="header">Description</th>
				</tr> 
			</thead> 
			<tbody> 
			<?
			 	$query = $this->db->order_by("ordernum")->get('configurations');
				$configurations = $query->result();
			        
				foreach ($configurations as $configuration) {
			?>	   
				<tr class='editRow'>
					<td>
						<input type="text" name="ordernum[]" value="<?= $configuration->ordernum?>"style="width: 50px; text-align: right;" />
					</td>
					<td>
						<?= $configuration->name?>
						<input type="hidden" name="name[]" value="<?= $configuration->name?>">
					</td>
					<td>
						<input type="text" name="value[]" value="<?= $configuration->value?>" style="width: 98%">
					</td>
			        <td>
			        	<input type="text" name="comment[]" value="<?= $configuration->comment?>" style="width: 99%">
			        </td>
				</tr>
			<?php
				}
			?> 
			</tbody> 
		</table>
	</div>
	
	<footer>
		<div class="submit_link">
			<input type="submit" value="Save Options" class="alt_btn">
		</div>
	</footer>
</form>
</article>