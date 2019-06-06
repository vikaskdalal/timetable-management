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

<div id="display-timetable">

</div>


<!-- Write jquery code here -->

<script>
	$(document).ready(function(){
		var days = [];
		days.push('MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY');
		var recess={}
		recess["MONDAY"]="R";
		recess["TUESDAY"]="E";
		recess["WEDNESDAY"]="C";
		recess["THURSDAY"]="E";
		recess["FRIDAY"]="S";
		recess["SATURDAY"]="S";
			$(".get-classbased-timetable").change(function(){
					var grade_id=$(this).val();
					$.ajax({
				        type:'POST',
				        beforeSend: function(xhr){
				             xhr.setRequestHeader('X-CSRF-Token', csrfToken);}, 
				        url: "/Admin/getTimeTable/"+grade_id,
				        success: function(result){
				        	var parseResult=$.parseJSON(result);
				        	var finalHTMLResult="";
				        	finalHTMLResult+="<div class='text-center'><b>CLASS - "+grade_id+"</b></div>";
				        	finalHTMLResult+="<table class='time-table-show'><thead><tr><td>PERIOD/<br>DAY</td><td>1</td><td>2</td><td>3</td><td>4</td><td></td><td>5</td><td>6</td><td>7</td><td>8</td></tr></thead><tbody>";

				        	 $.each(days, function(i, singleWeekDay) {
				        		 var count;
				        		 finalHTMLResult+="<tr><td>"+singleWeekDay+"</td>";
				        		 for (count = 1; count <=9; count++) {
					        		 var to_compare=count;
					        		 if(count==5){
					        			 finalHTMLResult+="<td>"+recess[singleWeekDay]+"</td>";
					        			 continue;
						        		 }
					        		 if(count>5){
											to_compare=count-1;	
										}
										var flag=false;
						        	 $.each(parseResult, function(i, item) {
							        	 if(item['weekday'].toUpperCase()==singleWeekDay && to_compare==item['period']){
							        		 	flag=true;
								        	 	finalHTMLResult+="<td>"+item['subject']['subject_name']+"<br>("+item['teacher']['name']+")</td>";
							        		 }
						        	 });
						        		if(!flag){
						        			finalHTMLResult+="<td></td>";
							        		}		   
				        		 }

				        		 finalHTMLResult+="</tr>"; 
				        	 });
				        	 finalHTMLResult+="</tbody></table>"; 		
				        	 $("#display-timetable").html(finalHTMLResult);		        	
				        },
				        error: function(xhr,textStatus,error){
				            // alert(xhr);
				        }
				    });
				});
		});

</script>