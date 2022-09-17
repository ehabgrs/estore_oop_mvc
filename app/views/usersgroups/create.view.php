    <div class="container">


            <h4><?= @$text_header?></h4>
			
			<form method="post" enctype="application/x-www-form-urlencoded" >
			
			  <div class="form-group">
				<label for="group_name"><?=@$text_users_group_name?></label> 
				<input type="text" class="form-control" name="group_name" id="group_name" maxlength="20"  placeholder="<?=@$text_users_group_name?>"  required>
			 
			  
			  <div><?=@$text_users_privileges?><div>
			  <?php 
			  if(isset($privileges) && $privileges !== false) {
			        foreach($privileges as $privilege) {
			  ?>
			
			 <div class="form-check">
			
			  <input class="form-check-input" type="checkbox" name="privileges[]" value="<?= $privilege->id?>" id="flexCheckChecked">
			  <label class="form-check-label" for="flexCheckChecked">
				<?= $privilege->privilege_title?>
			  </label>
			 </div>
			 <?php
			      }
			  }
			  ?>
			   </div>
			  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
			</form>
			
	</div>