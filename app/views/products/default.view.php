  <div class="container">

              
		        <h4><?= @$text_start_line?></h4>
              
                <table class="table border-1">

                    <thead>
                    <tr>
                    <th><?= @$text_name?></th>
                    <th><?= @$text_category_id?></th>
                    <th><?= @$text_image?></th>
                    <th><?= @$text_quantity?></th>
                    <th><?= @$text_purchase_price?></th>
                    <th><?= @$text_sell_price?></th>
                    <th><?= @$text_vat?></th>
                    <th><?= @$text_barcode?></th>
                    <th><?= @$text_gtn_code?></th>

                    </tr>
                    </thead>

                    <tbody>

                    <?php
                    if(false !== $products) {
                        foreach($products as $product) { 
                    ?>
                    <tr>
                    <td><?= $product->name?></td>
                    <td><?= $product->category_name?></td>
                    <td>
                      
                        <p><?= $product->image?></p>
                         <p><img src="uploads/images/<?= $product->image?>" height="20" width="20"></p> 
                        
                        </td>
                    <td><?= $product->quantity?></td>
                    <td><?= $product->purchase_price?></td>
                    <td><?= $product->sell_price?></td>
                    <td><?= $product->vat?></td>
                    <td><?= $product->barcode?></td>
                    <td><?= $product->gtn_code?></td>
                        <td>
                            <a href="/products/edit/<?=$product->id?>">Edit</a>
                            <a href="/products/delete/<?=$product->id?>" onclick="if(!confirm('Do you want to delete this employee')) return false;"> Delete  </a>
                            
                        </td>

                    </tr>
                    <?php
                        }
                    } else {
                        ?>
                        <td colspan="5"> <?= @$text_no_data_message?></td>

                        <?php
                    }
                    ?>

                    </tbody>

                </table>
				<a href="/products/create"> <?= @$text_new_item ?></a>
              
		  </div>