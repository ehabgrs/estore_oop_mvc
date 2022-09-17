    <div class="container">
<pre>
<?php
     // echo  $this->labelDisplay('username');
        ?>
        </pre>
            <h4><?= @$text_header?></h4>
			<form method="post" enctype="multipart/form-data" >
			
			  <div class="form-group">
                  <?php //labelDisplay() in lib/TemplateHelper file ?>
				<label for="name" class="<?=@$this->labelDisplay('name')?>"><?=@$text_name?></label> 
				<input type="text" class="form-control" name="name" id="name" value="<?=@$this->showValue('name')?>" maxlength="70" placeholder="<?=@$text_name?>" required>
			  </div>
			  
                <div class="form-group">
				<label for="quantity" class="<?=@$this->labelDisplay('quantity')?>"><?=@$text_quantity?></label> 
				<input type="number" class="form-control" name="quantity" id="quantity" value="<?=@$this->showValue('quantity')?>" maxlength="12" placeholder="<?=@$text_quantity?>" required>
			  </div>
                
                <div class="form-group">
                  <?php //labelDisplay() in lib/TemplateHelper file ?>
				<label for="purchase_price" class="<?=@$this->labelDisplay('purchase_price')?>"><?=@$text_purchase_price?></label> 
				<input type="number" step="0.01" class="form-control" name="purchase_price" id="purchase_price" value="<?=@$this->showValue('purchase_price')?>" maxlength="12" placeholder="<?=@$text_purchase_price?>" required>
			  </div>
                
             <div class="form-group">
                  <?php //labelDisplay() in lib/TemplateHelper file ?>
				<label for="sell_price" class="<?=@$this->labelDisplay('sell_price')?>"><?=@$text_sell_price?></label> 
				<input type="number"  step="0.01"  class="form-control" name="sell_price" id="sell_price" value="<?=@$this->showValue('sell_price')?>" maxlength="12" placeholder="<?=@$text_sell_price?>" required>
			  </div>
                
                
                 <div class="form-group"> 
			  
				  <select class="form-control" name= 'vat' id="vat">
				       <option value = "" > <?=@$text_vat?> </option>
					  <option value = 0 > 0% </option>
                      <option value = 15 > 15% </option>

				  </select>
				  
			  </div>
                
                 <div class="form-group">
                  <?php //labelDisplay() in lib/TemplateHelper file ?>
				<label for="barcode" class="<?=@$this->labelDisplay('barcode')?>"><?=@$text_barcode?></label> 
				<input type="text" class="form-control" name="barcode" id="barcode" value="<?=@$this->showValue('barcode')?>" maxlength="30" placeholder="<?=@$text_barcode?>">
			  </div>
                
            <div class="form-group">
                  <?php //labelDisplay() in lib/TemplateHelper file ?>
				<label for="gtn_code" class="<?=@$this->labelDisplay('gtn_code')?>"><?=@$text_gtn_code?></label> 
				<input type="text" class="form-control" name="gtn_code" id="gtn_code" value="<?=@$this->showValue('gtn_code')?>" maxlength="30" placeholder="<?=@$text_gtn_code?>">
			  </div>
       
		
			  <div class="form-group"> 
			  
				  <select class="form-control" name= 'category_id' id="category_id">
				       <option value = "" > <?=@$text_category_id?> </option>
					   
				  <?php  if(isset($categories) && !empty($categories)) {
					  foreach($categories as $category) {
			      ?>
					  <option value = "<?=$category->id?>"  <?=$this->showValue('category_id') == $category->id ? 'selected' : ''?>> <?=$category->name?> </option>
				  <?php
					  }
				  }
				  ?>
					  
				  </select>
				  
			  </div>
               
              <div class="form-group">
                <label for="image"><?=@$text_image?></label> 
                <input class="form-control" type="file" name="image" id="image" accept="image/*"> 
              </div>
			  
			  
			  
			  <button type="submit" name="submit" id='create' class="btn btn-primary">Submit</button>
			  
			</form>
			
	</div>