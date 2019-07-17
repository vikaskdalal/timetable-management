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



<div class="modal" tabindex="-1" role="dialog" id="edit-timetable-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body edit-timetable-modal-body">
        
      </div>
      <div class="modal-footer edit-timetable-modal-footer">
      </div>
    </div>
  </div>
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
							        	 	finalHTMLResult+="<td class='table-cell'>"+another_item['subject']['subject_name']+"<br>("+another_item['grade']['grade_name']+")<img src='/img/edit-icon.svg' width='20px' class='edit-icon-style' attr-id='"+another_item['id']+"'></td>";
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

var timetable_key="";
			// here is the code to edit the teachers assignment
			
			$("body").on("click", ".edit-icon-style", function() {
			    var timetable_primary_key=$(this).attr("attr-id");
			    $.ajax({
			        type:'POST',
			        beforeSend: function(xhr){
			             xhr.setRequestHeader('X-CSRF-Token', csrfToken);}, 
			        url: "/Admin/editTimetable/"+timetable_primary_key,
			        success: function(result){
			        	var parseResult=$.parseJSON(result);
			        	var weekdays=parseResult['weekdays'];
			        	var grades=parseResult['grades'];
			        	var subjects=parseResult['subjects'];
			        	var teachers=parseResult['teachers'];
			        	var timetabledata=parseResult['tabledata'];
			        	var teacher_id=timetabledata[0]['teacher_id'];
			        	var subject_id=timetabledata[0]['subject_id'];
			        	var grade_id=timetabledata[0]['grade_id'];
			        	var period=timetabledata[0]['period'];

			        	timetable_key=timetabledata[0]['id'];
			        	
			        	var subject_list="<select class='subject-list-for-update'>";
			        	
			        	$.each(subjects, function(key, value) {
				        	var selected="";
				        	if(key==subject_id){
				        			selected="selected";
					        	}
				        	subject_list += "<option value='"+key+"' "+selected+">"+value+"</option>";
			        	});
			        	subject_list += "</select>";

						var class_list="<select class='class-list-for-update'>";
			        	$.each(grades, function(key, value) {
				        	var selected="";
				        	if(key==grade_id){
				        			selected="selected";
					        	}
				        	class_list += "<option value='"+key+"' "+selected+">"+value+"</option>";
			        	});
			        	class_list += "</select>";

			        	var update_button="<button class='update-timetable btn btn-primary'>Save Changes</button>";
			        	$(".edit-timetable-modal-body").html(subject_list + class_list );
			        	$(".edit-timetable-modal-footer").html(update_button );
			        	$("#edit-timetable-modal").modal();	        	
			        },
			        error: function(xhr,textStatus,error){
			            // alert(xhr);
			        }
			    });
			});

			$("body").on("click", ".update-timetable", function() {
					var subject_id=$(".subject-list-for-update").val();
					var grade_id=$(".class-list-for-update").val();
					var formsubmitdata={"id":timetable_key,"subject_id":subject_id,"grade_id":grade_id};
					$.ajax({
				        type:'POST',
				        beforeSend: function(xhr){
				             xhr.setRequestHeader('X-CSRF-Token', csrfToken);}, 
				        url: "/Admin/updateTimetable/"+JSON.stringify(formsubmitdata),
				        success: function(result){
				        	var parseResult=$.parseJSON(result);
				        	        	
				        },
				        error: function(xhr,textStatus,error){
				            // alert(xhr);
				        }
				    });
					
			});
			
		});

</script>