    <div class="container">
<pre>
<?php
//test
 ?>
</pre>
            <h4><?= @$text_header?></h4>
			<form method="post" enctype="application/x-www-form-urlencoded" >
			
			  <div class="form-group">
                  <?php //labelDisplay() in lib/TemplateHelper file ?>
				<label for="name" class="<?=@$this->labelDisplay('name', $supplier)?>"><?=@$text_name?></label> 
				<input type="text" class="form-control" name="name" id="username" value="<?=@$this->showValue('name',$supplier)?>" maxlength="40" placeholder="<?=@$text_name?>" required>
			  </div>
			  
                <div class="form-group">
				<label for="address" class="<?=@$this->labelDisplay('address', $supplier)?>"><?=@$text_address?></label> 
				<input type="text" class="form-control" name="address" id="address" value="<?=@$this->showValue('address',$supplier)?>" maxlength="60" placeholder="<?=@$text_address?>">
			  </div>
         
			  
			  <div class="form-group">
				<label for="email" class="<?=@$this->labelDisplay('email',$supplier)?>"><?=@$text_email?></label> 
				<input type="email" class="form-control" name="email" id="email"  value="<?=@$this->showValue('email', $supplier)?>" maxlength="40" placeholder="<?=@$text_email?>" >
			  </div>
			  
			  
			  <div class="form-group">
				<label for="phone_number" class="<?=@$this->labelDisplay('phone_number', $supplier)?>"><?=@$text_phone_number?></label> 
				<input type="text" class="form-control" name="phone_number" id="phone_number"  maxlength="15" value="<?=@$this->showValue('phone_number',$supplier)?>" placeholder="<?=@$text_phone_number?>">
			  </div>
	
			  
			  <button type="submit" name="submit" id='create' class="btn btn-primary">Submit</button>
			  
			</form>
			
	</div>