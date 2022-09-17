  <div class="container">

              
		        <h4><?= @$text_start_line?></h4>
              
                <table class="table border-1">

                    <thead>
                    <tr>
                    <th><?= @$text_name?></th>
                    <th><?= @$text_image?></th>
                    <th><?= @$text_control?></th>

                    </tr>
                    </thead>

                    <tbody>

                    <?php
                    if(false !== $products_categories) {
                        foreach($products_categories as $product_category) { 
                    ?>
                    <tr>
                    <td><?= $product_category->name?></td>
                    <td><?= $product_category->image?></td>
                        <td>
                            <a href="/productscategories/edit/<?=$product_category->id?>">Edit</a>
                            <a href="/productscategories/delete/<?=$product_category->id?>" onclick="if(!confirm('Do you want to delete this employee')) return false;"> Delete  </a>
                            
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
				<a href="/productscategories/create"> <?= @$text_new_item ?></a>
              
		  </div>