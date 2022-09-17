    <div class="container">


            <h4><?= @$text_header?></h4>
			<form method="post" enctype="application/x-www-form-urlencoded" >
			  <div class="form-group">
				<label for="privilege_title"><?=@$text_users_privilege_title?></label> 
				<input type="text" class="form-control" name="privilege_title" id="privilege_title"  maxlength="30" placeholder="<?=@$text_users_privilege_title?>" required>
			  </div>
			  <div class="form-group">
				<label for="privilege_url"><?=@$text_users_privilege_url?></label>
				<input type="text" class="form-control" name="privilege_url" id="privilege_url" maxlength="30" placeholder="<?=@$text_users_privilege_url?>" required>
			  </div>
			  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
			</form>
			
	</div>