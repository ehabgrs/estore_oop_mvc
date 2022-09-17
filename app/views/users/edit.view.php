    <div class="container">


            <h4><?= @$text_header?></h4>
			<form method="post" enctype="application/x-www-form-urlencoded" >
			
			  <div class="form-group">
				<label for="username" class="<?=@$this->labelDisplay('username',$user)?>">
                    <?=@$text_username?>
                </label> 
				<input type="text" class="form-control" id="username"  maxlength="12" value="<?=$this->showValue('username' , $user)?>"  placeholder="<?=@$text_username?>" readonly required>
			  </div>
			  
			  
			  
			  <div class="form-group">
				<label for="email" class="<?=@$this->labelDisplay('email',$user)?>">
                    <?=@$text_email?>
                </label> 
				<input type="email" class="form-control"  id="email"  maxlength="40" value="<?=$this->showValue('email' , $user)?>" placeholder="<?=@$text_email?>" required readonly>
			  </div>
			  
			  
			  <div class="form-group">
				<label for="phone_number"  class="<?=@$this->labelDisplay('phone_number',$user)?>">
                 <?=@$text_phone_number?>
                </label> 
				<input type="text" class="form-control" name="phone_number" id="phone_number"  maxlength="15" value="<?=$this->showValue('phone_number' , $user)?>" placeholder="<?=@$text_phone_number?>" required>
                  
			  </div>
			  
			  <div class="form-group"> 
			  
				  <select class="form-control" name= 'group_id' id="group_id">
				       <option value = "" > <?=@$text_group_id?></option>
					   
				  <?php  if(isset($groups) && !empty($groups)) {
					  foreach($groups as $group) {
						 
			      ?>
					  <option value = "<?=$group->id?>" <?=$user->group_id == $group->id ? 'selected' : ''?> > <?=$group->group_name?> </option>
				  <?php
					  
					  }
				  }
				  ?>
					  
				  </select>
				  
			  </div>
			  
			  
			  
			  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
			  
			</form>
			
	</div>