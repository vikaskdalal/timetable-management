<div class="row justify-content-center">
	 <div class="col-lg-5 col-12 col-sm-10 col-md-9" > 
			<h1><b>Add New Teacher</b></h1>
			<div class="" >
			    <?php echo $this->Form->create($teachersTableEntity); ?>			    
				 <div >
		             <?php echo $this->Form->control('name',array('type' => 'text','label'=>['class' => 'required-label','text' => 'Teacher Name'],'class'=>'form-control','required'=>true));?>
		          </div>
		          <div>
		             <?php echo $this->Form->control('designation',array('type' => 'text','label'=>['class' => 'required-label','text' => 'Teacher Designation'],'class'=>'form-control','required'=>true));?>
		          </div>
				  <div class="col-lg-12 text-center" >
		            <?php	echo $this->Form->submit('Add Teacher', array( 'class'=>'btn btn-primary')); ?>
		          </div>
			</div>
	</div>
</div>

