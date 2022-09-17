    <div class="container">
<pre>
<?php
//test
 ?>
</pre>
            <h4><?= @$text_header?></h4>
			<form method="post" enctype="multipart/form-data" >
			
			  <div class="form-group">
                  <?php //labelDisplay() in lib/TemplateHelper file ?>
				<label for="name" class="<?=@$this->labelDisplay('name')?>"><?=@$text_name?></label> 
				<input type="text" class="form-control" name="name" id="username" value="<?=@$this->showValue('name')?>" maxlength="40" placeholder="<?=@$text_name?>" required>
			  </div>
			  
                <div class="form-group">
				<label for="image" class="<?=@$this->labelDisplay('image')?>"><?=@$text_image?></label> 
                    <!-- accept="iamge/*" means just accept image files   * means all the formates of images  -->
				<input type="file" class="form-control" name="image" id="image" value="<?=@$this->showValue('image')?>" maxlength="60" accept="image/*" >
			  </div>
       
	
			  
			  <button type="submit" name="submit" id='create' class="btn btn-primary">Submit</button>
			  
			</form>
			
	</div>