<div class="row justify-content-center">
	 <div class="col-lg-5 col-12 col-sm-10 col-md-9" > 
			<h1><b>Add New Class</b></h1>
			<div class="" >
			    <?php echo $this->Form->create(); ?>			    
				  <div>
		             <?php echo $this->Form->control('grade_name',array('type' => 'text','label'=>['class' => 'required-label','text' => 'Class Name'],'class'=>'form-control','required'=>true));?>
		          </div>
				  <div class="col-lg-12 text-center" >
		            <?php	echo $this->Form->submit('Add Class', array( 'class'=>'btn btn1 btn-color')); ?>
		          </div>
			</div>
	</div>
</div>

