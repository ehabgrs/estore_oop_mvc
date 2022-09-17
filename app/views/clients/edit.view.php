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
				<label for="name" class="<?=@$this->labelDisplay('name', $client)?>"><?=@$text_name?></label> 
				<input type="text" class="form-control" name="name" id="username" value="<?=@$this->showValue('name',$client)?>" maxlength="40" placeholder="<?=@$text_name?>" required>
			  </div>
			  
                <div class="form-group">
				<label for="address" class="<?=@$this->labelDisplay('address', $client)?>"><?=@$text_address?></label> 
				<input type="text" class="form-control" name="address" id="address" value="<?=@$this->showValue('address',$client)?>" maxlength="60" placeholder="<?=@$text_address?>">
			  </div>
         
			  
			  <div class="form-group">
				<label for="email" class="<?=@$this->labelDisplay('email',$client)?>"><?=@$text_email?></label> 
				<input type="email" class="form-control" name="email" id="email"  value="<?=@$this->showValue('email', $client)?>" maxlength="40" placeholder="<?=@$text_email?>" >
			  </div>
			  
			  
			  <div class="form-group">
				<label for="phone_number" class="<?=@$this->labelDisplay('phone_number', $client)?>"><?=@$text_phone_number?></label> 
				<input type="text" class="form-control" name="phone_number" id="phone_number"  maxlength="15" value="<?=@$this->showValue('phone_number',$client)?>" placeholder="<?=@$text_phone_number?>">
			  </div>
	
			  
			  <button type="submit" name="submit" id='create' class="btn btn-primary">Submit</button>
			  
			</form>
			
	</div>