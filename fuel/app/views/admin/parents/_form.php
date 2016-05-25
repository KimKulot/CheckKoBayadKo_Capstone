<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
	<div class="clearfix">
    	<?php echo Form::label('User', 'user_id'); ?>
 
    <div class="input">
        <?php echo Form::select('user_id', Input::post('user_id', isset($parent) ? $parent->user_id : $current_user->id), $users, array('class' => 'span6')); ?>
 
	    </div>
	</div>
		<div class="form-group">
			<?php echo Form::label('Password', 'password', array('class'=>'control-label')); ?>

				<?php echo Form::input('password', Input::post('password', isset($parent) ? $parent->password : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Password')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>