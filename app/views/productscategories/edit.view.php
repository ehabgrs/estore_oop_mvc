    <div class="container">
<pre>
<?php
//test
 ?>
</pre>
            <h4><?= @$text_header?></h4>
        <!-- multipart/form-data the only type will accept upload the image for $_FILES not just as a post name  -->
			<form method="post" enctype="multipart/form-data" >
			
			  <div class="form-group">
                  <?php //labelDisplay() in lib/TemplateHelper file ?>
				<label for="name" class="<?=@$this->labelDisplay('name', $product_category)?>"><?=@$text_name?></label> 
				<input type="text" class="form-control" name="name" id="username" value="<?=@$this->showValue('name',$product_category)?>" maxlength="40" placeholder="<?=@$text_name?>" required>
			  </div>
			  
             <div class="form-group">
				<label for="image" class="<?=@$this->labelDisplay('image', $product_category)?>"><?=@$text_image?></label> 
				<input type="file" class="form-control" name="image" id="image" maxlength="60" accept="image/*">
			  </div>
			  <div class="<?=@ !empty($product_category->image) ? 'd-block' : 'd-none'?>">
			  <img src="/uploads/images/<?=@$product_category->image?>" width="100" height="100">
			  </div>
  
			  <button type="submit" name="submit" id='create' class="btn btn-primary">Submit</button>
			  
			</form>
			
	</div>