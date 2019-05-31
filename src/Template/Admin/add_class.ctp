<div class="row justify-content-center no-lr-margin">
	 <div class="container-border col-lg-5 col-12 col-sm-10 col-md-9 login_form" > 
			<h1 class=" heading_xsq" ><b>Change Your Password</b></h1>
			<div class="removepadding400  padding-lr-15px" >
				    <?php echo $this->Form->create(); ?>			    
					 <div class="form_div_padding" >
			             <?php echo $this->Form->control('grade',array('type' => 'text','label'=>['class' => 'required-label','text' => 'Class'],'class'=>'form-control','required'=>true));?>
			          </div>
			          <div class="form_div_padding" >
			             <?php echo $this->Form->control('grade_name',array('type' => 'text','label'=>['class' => 'required-label','text' => 'Class Name'],'class'=>'form-control','required'=>true));?>
			          </div>
					  <div class="col-lg-12 text-center" >
			            <?php	echo $this->Form->submit('Add Class', array( 'class'=>'btn btn1 btn-color')); ?>
			          </div>
					
			</div>
	</div>
	
</div>

