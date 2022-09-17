    <div class="container">
<pre>
<?php
     // echo  $this->labelDisplay('username');
        ?>
        </pre>
            <h4><?= @$text_header?></h4>
			<form method="post" enctype="application/x-www-form-urlencoded" >
			
			  <div class="form-group">
                  <?php //labelDisplay() in lib/TemplateHelper file ?>
				<label for="username" class="<?=@$this->labelDisplay('username')?>"><?=@$text_username?></label> 
				<input type="text" class="form-control" name="username" id="username" value="<?=@$this->showValue('username')?>" maxlength="12" placeholder="<?=@$text_username?>" required>
			  </div>
			  
                <div class="form-group">
				<label for="first_name" class="<?=@$this->labelDisplay('first_name')?>"><?=@$text_first_name?></label> 
				<input type="text" class="form-control" name="first_name" id="username" value="<?=@$this->showValue('first_name')?>" maxlength="12" placeholder="<?=@$text_first_name?>" required>
			  </div>
                
                <div class="form-group">
                  <?php //labelDisplay() in lib/TemplateHelper file ?>
				<label for="last_name" class="<?=@$this->labelDisplay('last_name')?>"><?=@$text_username?></label> 
				<input type="text" class="form-control" name="last_name" id="username" value="<?=@$this->showValue('last_name')?>" maxlength="12" placeholder="<?=@$text_last_name?>" required>
			  </div>
                
                
			  <div class="form-group">
				<label for="password" class="<?=@$this->labelDisplay('password')?>"><?=@$text_password?></label> 
				<input type="password" class="form-control" name="password" id="password"  value="<?=@$this->showValue('password')?>" maxlength="60" placeholder="<?=@$text_password?>" required>
			  </div>
			  
			   <div class="form-group">
				<label for="confirm_passsword" class="<?=@$this->labelDisplay('cpassword')?>"><?=@$text_cpassword?></label> 
				<input type="password" class="form-control" name="cpassword" id="confirm_passsword"  maxlength="60" value="<?=@$this->showValue('cpassword')?>" placeholder="<?=@$text_cpassword?>" required>
			  </div>
			  
			  <div class="form-group">
				<label for="email" class="<?=@$this->labelDisplay('email')?>"><?=@$text_email?></label> 
				<input type="email" class="form-control" name="email" id="email"  value="<?=@$this->showValue('email')?>" maxlength="40" placeholder="<?=@$text_email?>" required>
			  </div>
			  
			  <div class="form-group">
				<label for="cemail" class="<?=@$this->labelDisplay('cemail')?>"><?=@$text_cemail?></label> 
				<input type="cemail" class="form-control" name="cemail" id="cemail" value="<?=@$this->showValue('cemail')?>" maxlength="40" placeholder="<?=@$text_cemail?>" required>
			  </div>
			  
			  <div class="form-group">
				<label for="phone_number" class="<?=@$this->labelDisplay('phone_number')?>"><?=@$text_phone_number?></label> 
				<input type="text" class="form-control" name="phone_number" id="phone_number"  maxlength="15" value="<?=@$this->showValue('phone_number')?>" placeholder="<?=@$text_phone_number?>" required>
			  </div>
			  
			  <div class="form-group"> 
			  
				  <select class="form-control" name= 'group_id' id="group_id">
				       <option value = "" > <?=@$text_group_id?> </option>
					   
				  <?php  if(isset($groups) && !empty($groups)) {
					  foreach($groups as $group) {
			      ?>
					  <option value = "<?=$group->id?>"  <?=$this->showValue('group_id') == $group->id ? 'selected' : ''?>> <?=$group->group_name?> </option>
				  <?php
					  }
				  }
				  ?>
					  
				  </select>
				  
			  </div>
			  
			  
			  
			  <button type="submit" name="submit" id='create' class="btn btn-primary">Submit</button>
			  
			</form>
			
	</div>