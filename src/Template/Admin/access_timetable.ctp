<div class="select-class">
             <?php 
             echo $this->Form->control('grade_id', array(
             		'type'=>'select',
             		'label'=>['class' => 'required-label','text' => 'Select Class'],
             		'options'=>$getAllGrades,
             		'empty'=>'Select Class',
             		'class'=>'form-control get-classbased-timetable',
             		'required'=>false
             ));
             ?>
</div>

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



<!-- Write jquery code here -->

<script>
	$(document).ready(function(){
			$(".get-classbased-timetable").change(function(){
					var grade_id=$(this).val();
					$.ajax({
				        type:'POST',
				        beforeSend: function(xhr){
				             xhr.setRequestHeader('X-CSRF-Token', csrfToken);}, 
				        url: "Admin/getTimeTable/",
				        success: function(result){
				        	
				        },
				        error: function(xhr,textStatus,error){
				            // alert(xhr);
				        }
				    });
				});
		});

</script>