<div class="row justify-content-center">
	 <div class="col-lg-5 col-12 col-sm-10 col-md-9" > 
			<h1><b>Manage Time Table</b></h1>
			<div class="" >
			    <?php echo $this->Form->create($timetableEntity); ?>			    
				 <div class="select-teacher">
		             <?php 
		             echo $this->Form->control('teacher_id', array(
		             'type'=>'select',
		             'label'=>['class' => 'required-label','text' => 'Select Teacher'],
		             'options'=>$teachers,
		             'empty'=>'Select Teacher',
		             'class'=>'form-control',
		             'required'=>false
		             ));
		             
		             ?>
		          </div>
		          <div class="select-class">
		             <?php 
		             echo $this->Form->control('grade_id', array(
		             		'type'=>'select',
		             		'label'=>['class' => 'required-label','text' => 'Select Class'],
		             		'options'=>$grades,
		             		'empty'=>'Select Class',
		             		'class'=>'form-control',
		             		'required'=>false
		             ));
		             ?>
		          </div>
		          <div class="select-subject">
		             <?php 
		             
		             echo $this->Form->control('subject_id', array(
		             		'type'=>'select',
		             		'label'=>['class' => 'required-label','text' => 'Select Subject'],
		             		'options'=>$subjects,
		             		'empty'=>'Select Subject',
		             		'class'=>'form-control',
		             		'required'=>false
		             ));
		             ?>
		          </div>
		          <div class="select-period">
		             <?php 
		             echo $this->Form->control('period', array(
		             		'type'=>'select',
		             		'label'=>['class' => 'required-label','text' => 'Select Period'],
		             		'options'=>[1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7],
		             		'empty'=>'Select Period',
		             		'class'=>'form-control',
		             		'required'=>false
		             ));
		             ?>
		          </div>
		          <div class="select-weekday">
		             <?php 
		            
		             echo $this->Form->control('weekday', array(
		             		'type'=>'select',
		             		'label'=>['class' => 'required-label','text' => 'Select WeekDay'],
		             		'options'=>$weekdays,
		             		'empty'=>'Select WeekDay',
		             		'class'=>'form-control',
		             		'required'=>false
		             ));
		             ?>
		          </div>
				  <div class="col-lg-12 text-center" >
		            <?php	echo $this->Form->submit('Add New Entry', array( 'class'=>'btn btn1 btn-color')); ?>
		          </div>
			</div>
	</div>
</div>

