<div class="row justify-content-center">
	 <div class="col-lg-5 col-12 col-sm-10 col-md-9" > 
			<h1><b>Manage Time Table</b></h1>
			<div class="" >
			    <?php echo $this->Form->create($timetableEntity,['context' => ['validator' => 'timetable']]); ?>			    
				 <div class="select-teacher">
		             <?php 
		             echo $this->Form->select(
		             		'teacher_id',
		             		$teachers,
		             		['empty' => '(Select Teacher)','required'=>false]
		             		
		             		);
		             ?>
		          </div>
		          <div class="select-class">
		             <?php 
		             echo $this->Form->select(
		             		'grade_id',
		             		$grades,
		             		['empty' => '(Select Class)']
		             		);
		             ?>
		          </div>
		          <div class="select-subject">
		             <?php 
		             echo $this->Form->select(
		             		'subject_id',
		             		$subjects,
		             		['empty' => '(Select Subject)']
		             		);
		             ?>
		          </div>
		          <div class="select-period">
		             <?php 
		             echo $this->Form->select(
		             		'period',
		             		[1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7],
		             		['empty' => '(Select Period)']
		             		);
		             ?>
		          </div>
		          <div class="select-weekday">
		             <?php 
		             echo $this->Form->select(
		             		'weekday',
		             		$weekdays,
		             		['empty' => '(Select Weekday)']
		             		);
		             ?>
		          </div>
				  <div class="col-lg-12 text-center" >
		            <?php	echo $this->Form->submit('Add New Entry', array( 'class'=>'btn btn1 btn-color')); ?>
		          </div>
			</div>
	</div>
</div>

