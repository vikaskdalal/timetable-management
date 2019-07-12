<div class="form-row col-11 mx-auto  mb-5">
	<div class="col-lg-4 col-12">
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
	</div>
	<div class="col-lg-4 col-12">
		<div class="select-teacher">
		             <?php 
		             echo $this->Form->control('teacher_id', array(
		             'type'=>'select',
		             'label'=>['class' => 'required-label','text' => 'Select Teacher'],
		             'options'=>$teachers,
		             'empty'=>'Select Teacher',
		             'class'=>'form-control get-teacherbased-timetable',
		             'required'=>false
		             ));
		             
		             ?>
		</div>
	</div>
	<div class="col-lg-4 col-12">
		<div class="select-weekday">
		             <?php 
		             echo $this->Form->control('weekday', array(
		             		'type'=>'select',
		             		'label'=>['class' => 'required-label','text' => 'Select WeekDay'],
		             		'options'=>$weekdays,
		             		'empty'=>'Select WeekDay',
		             		'class'=>'form-control get-weekdaybased-timetable',
		             		'required'=>false
		             ));
		             ?>
		 </div>
	</div>
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
					$(".get-teacherbased-timetable").val("");
					$(".get-weekdaybased-timetable").val("");
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
				        	finalHTMLResult+="<table border='1px' class='time-table-show'><thead><tr><td>PERIOD/<br>DAY</td><td>1</td><td>2</td><td>3</td><td>4</td><td></td><td>5</td><td>6</td><td>7</td><td>8</td></tr></thead><tbody>";

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
						        			finalHTMLResult+="<td class='empty-table-cell'></td>";
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


			$(".get-teacherbased-timetable").change(function(){
				$(".get-classbased-timetable").val("");
				$(".get-weekdaybased-timetable").val("");
				var teacher_id=$(this).val();
				$.ajax({
			        type:'POST',
			        beforeSend: function(xhr){
			             xhr.setRequestHeader('X-CSRF-Token', csrfToken);}, 
			        url: "/Admin/getTimeTableTeacherBased/"+teacher_id,
			        success: function(result){
			        	var parseResult=$.parseJSON(result);
			        	var finalHTMLResult="";
			        	finalHTMLResult+="<div class='text-center'><b>TEACHER - "+parseResult[0]['name']+" ("+parseResult[0]['designation']+")</b></div>";
			        	finalHTMLResult+="<table border='1px' class='time-table-show'><thead><tr><td>PERIOD/<br>DAY</td><td>1</td><td>2</td><td>3</td><td>4</td><td></td><td>5</td><td>6</td><td>7</td><td>8</td></tr></thead><tbody>";

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
					        		 $.each(item['timetables'], function(i, another_item) {
						        	 if(another_item['weekday'].toUpperCase()==singleWeekDay && to_compare==another_item['period']){
						        		 	flag=true;
							        	 	finalHTMLResult+="<td>"+another_item['subject']['subject_name']+"<br>("+another_item['grade']['grade_name']+")</td>";
						        		 }
					        		 });
					        	 });
					        		if(!flag){
					        			finalHTMLResult+="<td class='empty-table-cell'></td>";
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



			$(".get-weekdaybased-timetable").change(function(){
				$(".get-classbased-timetable").val("");
				$(".get-teacherbased-timetable").val("");
				var weekday=$(this).val();
				$.ajax({
			        type:'POST',
			        beforeSend: function(xhr){
			             xhr.setRequestHeader('X-CSRF-Token', csrfToken);}, 
			        url: "/Admin/getTimeTableDayWise/"+weekday,
			        success: function(result){
			        	var parseResult=$.parseJSON(result);
			        	var finalHTMLResult="";
			        	finalHTMLResult+="<div class='text-center'><b>Day - "+weekday+"</b></div>";
			        	finalHTMLResult+="<table border='1px' class='time-table-show'><thead><tr><td>NAME OF TEACHER</td><td>DESIGNATION</td><td>1ST PERIOD</td><td>2ND PERIOD</td><td>3RD PERIOD</td><td>4TH PERIOD</td><td>BREAK</td><td>5TH PERIOD</td><td>6TH PERIOD</td><td>7TH PERIOD</td><td>8TH PERIOD</td></tr></thead><tbody>";
			        	 $.each(parseResult, function(i, single_teacher) {
			        		 var count;
			        		 finalHTMLResult+="<tr><td>"+single_teacher['name']+"</td>";
			        		 finalHTMLResult+="<td>"+single_teacher['designation']+"</td>";
			        		 for (count = 1; count <=9; count++) {
				        		 var to_compare=count;
				        		 if(count==5){
				        			 finalHTMLResult+="<td></td>";
				        			 continue;
					        		 }
				        		 if(count>5){
										to_compare=count-1;	
									}
									var flag=false;
					        	
					        		 $.each(single_teacher['timetables'], function(i, another_item) {
						        	 if(to_compare==another_item['period']){
						        		 	flag=true;
							        	 	finalHTMLResult+="<td>"+another_item['subject']['subject_name']+"<br>("+another_item['grade']['grade_name']+")</td>";
						        		 }
					        		 });
					        		if(!flag){
					        			finalHTMLResult+="<td class='empty-table-cell'></td>";
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