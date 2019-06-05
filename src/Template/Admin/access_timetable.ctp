<table>
	<thead>
	<tr>
		<td>PERIOD/<br>DAY</td>
		<td>1</td>
		<td>2</td>
		<td>3</td>
		<td>4</td>
		<td></td>
		<td>5</td>
		<td>6</td>
		<td>7</td>
		<td>8</td>
	</tr>
	</thead>
	<tbody>
		<?php 
		foreach ($weekdays as $singleDay){
			
				?>
				<tr>
					<td><?php echo  $singleDay?></td>
					<?php 
					for($count=1;$count<=9;$count++){
						$toCompare=$count;
						if($count==5){
							?>
							<td><?php echo $getRecess[$singleDay]?></td>
							<?php 
							continue;
						}
						if($count>5){
							$toCompare=$count-1;	
						}
						$flag=false;
					foreach ($getTableData as $singleRow){
						if($singleRow['weekday']==$singleDay && $toCompare==$singleRow['period']){
							$flag=true;
							?>
							<td><?php echo $singleRow['subject']['subject_name']." <br>(".$singleRow['teacher']['name'].")"?></td>
							<?php 
						}
					
					}
					if(!$flag){
						?>
						<td></td>
						<?php 
					}
					}?>
				</tr>
				<?php 
			}
		?>
	</tbody>
</table>